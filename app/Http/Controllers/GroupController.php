<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\CampaignBatch;
use App\Group;
use App\Http\Requests\SaveGroupRequest;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
        $this->middleware('check-permission:group create', ['only' => ['create']]);
        $this->middleware('check-permission:group edit',   ['only' => ['edit']]);
        $this->middleware('check-permission:group edit|group create',   ['only' => ['store']]);
        $this->middleware('check-permission:group list',   ['only' => ['index','search_list']]);
        $this->middleware('check-permission:group delete',   ['only' => ['destroy']]);
    }

    /*
    * GROUP LISTING CONTAINER VIEW
    * @author RAHUL R.
    * @date 06/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return group list container view with filters
    */
    public function index()
    {
    	return view('groups.index');
    }

    /*
    * GROUP LIST VIEW
    * @author RAHUL R.
    * @date 07/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return group list view
    */
    public function search_list(Request $request)
    {
    	$search_keywords	= $request->post('search_keywords');
        $company_id         = auth()->user()->cmpny_id;

    	$groups	= Group::whereIn('status', [config('constant.ACTIVE'), config('constant.INACTIVE')])->with('creator', 'campaigns', 'campaign_batches');

        if (isset($search_keywords) && !empty($search_keywords))
        {
            $groups->where(function($query) use ($search_keywords) {
                $query->where('ori_groups.name', 'like', '%'.$search_keywords.'%');
            });
        }

        $groups = $groups->orderBy('ori_groups.created_at', 'DESC')->paginate(config('constant.pagination_constant'));
        $html   = view('groups.listview')->with(compact('groups'))->render();
        $result_arr=array('success' => true,'html' => $html);
        return json_encode($result_arr);
    }

    /*
    * GROUP CREATION VIEW
    * @author RAHUL R.
    * @date 08/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return group creation view
    */
    public function create()
    {
        return view('groups.create');
    }

    /*
    * CREATE OR UPDATE GROUP
    * @author RAHUL R.
    * @date 08/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return create or update group 
    */
    public function store(SaveGroupRequest $request)
    {
        $group_id   = $request->post('id');
        $group_name = $request->post('name');
        $company_id = auth()->user()->cmpny_id;
        $success    = false;
        $message    = '';

        do {
            if ($group_id)
            {
                $group  = Group::find($group_id);
                if (!$group)
                {
                    $message    = "Cannot find the group";
                    break;
                }
                $group->fill([
                    'name'  => $group_name
                ])->save();
                $success = true;
                break;
            }

            $group  = Group::create([
                'cmpny_id'      => $company_id,
                'name'          => $group_name,
                'status'        => config('constant.ACTIVE'),
                'created_by'    => auth()->user()->id,
            ]);

            $success    = true;
        }
        while(false);

        if ($success)
        {
            $message    = "Group Saved Successfully";
        }
        else {
            $message    = $message ?? "Group could not be saved";
        }

        $result_arr = array('success' => $success, 'message' => $message);
        if (!$group_id)
        {
            $result_arr['reset']    = true;
        }

        $data = array(
            'group_id'  => $group->id
        );
        $result_arr['data'] = $data;

        echo json_encode($result_arr);
    }

    /*
    * EDIT GROUP VIEW
    * @author RAHUL R.
    * @date 08/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return group edit view 
    */
    public function edit(Group $group)
    {
        $group->load('excel_batches');
        return view('groups.edit', compact('group'));
    }

    /*
    * DELETE GROUP
    * @author RAHUL R.
    * @date 08/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return status json 
    */
    public function destroy(Group $group)
    {
        $user_company_id    = auth()->user()->cmpny_id;
        $success            = false;
        $message            = '';

        do {
            if ($user_company_id != $group->cmpny_id)
            {
                $message    = 'You are not authorized to delete the group';
                break;
            }

            $group->load('processing_import_batches');
            $processing_import_batches = $group->processing_import_batches;
            foreach ($processing_import_batches as $batch)
            {
                $batch->status  = config('constant.INSERTING_MODEL_DELETED');
                $batch->save();
                $batch->delete();
            }

            $group->delete();
            $success = true;
            $message = 'Group Deleted Successfully';
        }
        while(false);

        if (!$success)
        {
            $message    = $message ?? 'Group could not be deleted.';
        }

        $result_arr = array('success' => $success, 'message' => $message, 'refresh' => true);

        echo json_encode($result_arr);
    }

    /*
    * GET GROUP DROPDOWN DATA
    * @author RAHUL R.
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return group dropdown data json 
    */
    public function dropdown(Request $request)
    {
        $campaign_id         = (int)$request->post('campaign_id');
        $groups_json_list   = '';
        $groups     = Group::select('ori_groups.id', 'ori_groups.name')
                            ->where('ori_groups.cmpny_id', auth()->user()->cmpny_id)
                            ->where('ori_groups.status', config('constant.ACTIVE'))
                            // ->whereHas('contacts')
                            ->orderBy('ori_groups.updated_at', 'desc')
                            ->get();

        do {

            if (count($groups) < 0)
            {
                $groups_json_list = '[{"id":"0","disabled": true,"name":"No Group found","selected":false}]';
                break;
            }

            $groups_json_list   = '[';

            $campaign_group_ids = [];
            if ($campaign_id)
            {
                $campaign = Campaign::find($campaign_id);
                $campaign_group_ids = $campaign->groups->pluck('id')->all();
            }

            foreach ($groups as $group)
            {
                $group_id               = $group->id;
                $group_name             = $group->name;
                $group_contacts         = $group->contacts;
                $group_contacts_count   = count($group_contacts);
                $group_selected         = (in_array($group->id, $campaign_group_ids)) ? 'true' : 'false';

                $groups_json_list   .= '{"id":'.$group_id.',"name":"'.$group_name.'('.$group_contacts_count.')","selected":'.$group_selected.'},';
            }
            $groups_json_list   = rtrim($groups_json_list, ',');
            $groups_json_list   .= ']';

        }
        while(false);

        return view('groups.dropdown',compact('groups_json_list','groups'));
    }

    /*
    * GET GROUP DROPDOWN DATA AS ARRAY
    * @author RAHUL R.
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return group dropdown data json 
    */
    public function batch_groups(Request $request)
    {
        $batch_id       = $request->post('batch_id');
        $campaign_id    = $request->post('campaign_id');
        $batch_groups   = array();
        if ($batch_id)
        {
            $batch = CampaignBatch::find($batch_id);
            if ($batch)
            {
                $batch->load('groups');
                $batch_groups   += $batch->groups->pluck('name', 'id')->all();
            }
        }
        else
        {
            if ($campaign_id)
            {
                $campaign = Campaign::find($campaign_id);
                if ($campaign)
                {
                    $campaign->load('groups');
                    $campaign_groups = $campaign->groups;
                    $batch_groups += $campaign_groups->pluck('name', 'id')->all();
                }
            }
        }

        return json_encode($batch_groups);

    }
}
