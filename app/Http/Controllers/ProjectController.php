<?php

namespace App\Http\Controllers;
use App\CommonSmsEmail;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\PmMaster;
use App\Project;
use App\ProjectIntimations;
use App\ProjectMeta;
use App\Templates;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Exports\projecttasklistreport;
use App\Jobs\NotifyprojecttasklistReportCompletion;

class ProjectController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:project create', ['only' => ['create']]);
       $this->middleware('check-permission:project edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:project edit|project create',   ['only' => ['store']]);
       $this->middleware('check-permission:project delete',   ['only' => ['destroy']]);
    }
	/*
    * Customer Nature
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return customer_nature list
    */
	public function index()
    {
		$project_status = PmMaster::where('type',array_search('Project Status',config('constant.pm_master_types')))->pluck('name','id')->all();
        return view('pm.project.index',compact('project_status'));
    }
	
	/*
    * Customer Nature Listing 
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $project_status    = $response['project_status'];
        $start_date         = $request->post('startdate');
        $end_date           = $request->post('enddate');

        $results 			= array();	
        $results = Project::where('status',config('constant.ACTIVE'))->orderBy('id', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
		{
			$results->where(function($results) use ($search_keywords){
				$results->orWhere('prjt_name', 'like', '%' . $search_keywords . '%');
			});
		}
		if(isset($project_status) && !empty($project_status)) 
		{
			$results->where('project_status',$project_status);
		}

        // $results = Tracker::where('status',config('constant.ACTIVE'))->orderBy('id', 'desc');
        if(isset($start_date) && !empty($start_date)) 
        {
            $start_date = str_replace('/', '-', $start_date);
            $start_date = date('Y-m-d', strtotime($start_date)).' 00:00:00';
            $results->where('created_at', '>=', $start_date);
        }
        if(isset($end_date) && !empty($end_date)) 
        {
            $end_date = str_replace('/', '-', $end_date);
            $end_date = date('Y-m-d', strtotime($end_date)).' 23:59:59';
            $results->where('created_at', '<=', $end_date);
        }

		$list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		$html = view('pm.project.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * Function for creating Customer Nature
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings customer nature
    */
	public function create()
    { 
		$category = PmMaster::where('type',array_search('Project Category',config('constant.pm_master_types')))->pluck('name','id')->all();
		$framework = PmMaster::where('type',array_search('Technology',config('constant.pm_master_types')))->pluck('name','id')->all();
		$project_status = PmMaster::where('type',array_search('Project Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		$vendor_count = 0;

        $users = Helpers::getUserByPermission('project management','yes');
        $users = collect($users);
        $users_array = [];
        foreach ($users as $user)
        {
            $users_array[$user['id']] = $user['name']; 
        }

		return view('pm.project.create', compact('category','framework','vendor_count','users_array','project_status'));
    }
	
	/*
    * Update function for Customer Nature
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings Customer Nature
    */
	public function edit($id)
    {
		$category = PmMaster::where('type',array_search('Project Category',config('constant.pm_master_types')))->pluck('name','id')->all();
		$framework = PmMaster::where('type',array_search('Technology',config('constant.pm_master_types')))->pluck('name','id')->all();
		$project_status = PmMaster::where('type',array_search('Project Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		$vendor_count = Helpers::get_contact_count($id);
		$project = Project::findOrFail($id);

        $users = Helpers::getUserByPermission('project management','yes');
        $users = collect($users);
        $users_array = [];
        foreach ($users as $user)
        {
            $users_array[$user['id']] = $user['name']; 
        }

		return view('pm.project.create', compact('project','category','framework','vendor_count','users_array','project_status'));
    }


    /*
    * Save function for Customer Nature Add&Update
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
		$vendor_array = array();
        $due_date = NULL;
        $new_members = (request('assign_members') == NULL)?array():request('assign_members');
        $old_members = (request('members') == NULL)?array():request('members');
        $total_members = array_merge($new_members, $old_members);
        $project_lead   = $request->post('project_lead');

        if(request('due_date') && !empty(request('due_date')))
        {
            $due_date = str_replace('/', '-', request('due_date'));
            $due_date = date('Y-m-d', strtotime($due_date));
        }
	   $this->validate($request,[
				'prjt_name' => 'required|string|max:500|unique:ori_projects,prjt_name,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
    			],[
				'prjt_name.required' => ' The Project name field is required.',
    			]);

        //Intimations
        $intimation_settings    = ProjectIntimations::where('cmpny_id', Auth::user()->cmpny_id)->first();

        $project_id = (int)$request->post('id');
        $project_status = $request->post('project_status');
        $new_project_lead   = 0;
        if ($project_id)
        {
            $project    = Project::find($project_id);
            if ($project)
            {
                $old_project_lead   = $project->project_lead;
                if ($project_lead != $old_project_lead)
                {
                    $new_project_lead   = $project_lead;
                }
                $current_project_status = $project->project_status;
            }
        }
        else
        {
            $new_project_lead   = $project_lead;
        }

		$stat_id = Project::updateOrCreate(
            ['id' 			     => request('id')],
            [
				'cmpny_id'       => Auth::user()->cmpny_id,
				'prjt_name'      => request('prjt_name'),
                'description'    => request('description'),
                'category'  	 => request('category'),
                'framework'      => request('framework'),
                'project_lead'   => $project_lead,
                'due_date'       => $due_date,
                'budget'         => request('budget'),
                'required_time'  => request('required_time'),
                'members'        => (($new_members != NULL)? serialize($total_members) : serialize(request('members'))),
				'sort_order'     => request('sort_order'),
                'status' 		 => request('status'),
                'project_status' => request('project_status'),
			])->id; 
			
			if(!empty(request('id')))
			{				
				if(count(request('vendor'))>0)
				{
					$i = 0;
					foreach(request('vendor') as $vendor)
					{
						$vendor_array[$i]['vendor'] = $vendor;
						$vendor_array[$i]['email'] = request('vendor_email')[$i];
						$vendor_array[$i]['phone'] = request('vendor_phone')[$i];
						$i++;
					}
				}
				//echo "<pre>";print_r($vendor_array);echo serialize($vendor_array);die;
				$contact_details = serialize($vendor_array);	
				$server_credentials = request('server_credentials');
				$meta_del = ProjectMeta::where('project_id',request('id'))->delete();
				$meta_res = ProjectMeta::firstOrCreate([
					'cmpny_id' => Auth::user()->cmpny_id, 
					'project_id' => request('id'), 
					'contact_details' => $contact_details, 
					'server_credentials' => $server_credentials, 
				]);
			}

            if (!$project_id || !isset($project) || empty($project))
            {
                $project    = Project::find($stat_id);
            }

            if ($intimation_settings && $intimation_settings->project_assignment_intimations_members && !empty($intimation_settings->project_assignment_intimations_members_mail) && isset($new_members) && !empty($new_members))
            {
                //Project Assignment Members Intimation
                $mail_template  = Templates::find($intimation_settings->project_assignment_intimations_members_mail);
                if ($mail_template)
                {  
                    $subject    = $mail_template->subject;
                    $content    = $mail_template->content;
                    $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
                    foreach ($new_members as $member)
                    {
                        $member_details = User::find($member);
                        if ($member_details && !empty($member_details->email))
                        {
                            $new_content    = $content;
                            $new_content    = str_replace('[[ Name ]]', $member_details->name, $new_content);
                            $random_code    = str_random(12);

                            $mail_arr = CommonSmsEmail::create(
                                                [
                                                'authentication' => '',
                                                'cmpny_id' => Auth::user()->cmpny_id,
                                                'email' => $member_details->email,
                                                'customer_id' => '',
                                                'sent_type' => config('constant.CH_EMAIL'),
                                                'response' => 'notsent',
                                                'mail_response' => '',
                                                'random_code' => $random_code,
                                                'content' => $new_content,
                                                'subject' => $subject,  
                                                'email_cc' => '',   
                                                'status' => config('constant.INACTIVE'),
                                                'created_by' => 0,
                                                'updated_by' => 0,
                                                'created_at' => date('Y-m-d H:i:s')
                                               ]);
                        }
                    }
                }

                $mail_template  = Templates::find($intimation_settings->project_assignment_intimations_lead_mail);
                if ($mail_template)
                {
                    $subject    = $mail_template->subject;
                    $content    = $mail_template->content;
                    $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
                    $random_code    = str_random(12);
                    $project_lead_details = User::find($new_project_lead);
                    if ($project_lead_details && !empty($project_lead_details->email))
                    {
                        $new_content    = $content;
                        $new_content    = str_replace('[[ Name ]]', $project_lead_details->name, $new_content);

                        $mail_arr = CommonSmsEmail::create(
                                                [
                                                'authentication' => '',
                                                'cmpny_id' => Auth::user()->cmpny_id,
                                                'email' => $project_lead_details->email,
                                                'customer_id' => '',
                                                'sent_type' => config('constant.CH_EMAIL'),
                                                'response' => 'notsent',
                                                'mail_response' => '',
                                                'random_code' => $random_code,
                                                'content' => $new_content,
                                                'subject' => $subject,  
                                                'email_cc' => '',   
                                                'status' => config('constant.INACTIVE'),
                                                'created_by' => 0,
                                                'updated_by' => 0,
                                                'created_at' => date('Y-m-d H:i:s')
                                               ]);

                    }
                }
            }

            //Project Assignment Project Lead Intimation
            if ($intimation_settings && $intimation_settings->project_assignment_intimations_lead && !empty($intimation_settings->project_assignment_intimations_lead_mail) && isset($new_project_lead) && !empty($new_project_lead))
            {
                $mail_template  = Templates::find($intimation_settings->project_assignment_intimations_lead_mail);
                if ($mail_template)
                {
                    $subject    = $mail_template->subject;
                    $content    = $mail_template->content;
                    $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
                    $random_code    = str_random(12);
                    $project_lead_details = User::find($new_project_lead);
                    if ($project_lead_details && !empty($project_lead_details->email))
                    {
                        $new_content    = $content;
                        $new_content    = str_replace('[[ Name ]]', $project_lead_details->name, $new_content);

                        $mail_arr = CommonSmsEmail::create(
                                                [
                                                'authentication' => '',
                                                'cmpny_id' => Auth::user()->cmpny_id,
                                                'email' => $project_lead_details->email,
                                                'customer_id' => '',
                                                'sent_type' => config('constant.CH_EMAIL'),
                                                'response' => 'notsent',
                                                'mail_response' => '',
                                                'random_code' => $random_code,
                                                'content' => $new_content,
                                                'subject' => $subject,  
                                                'email_cc' => '',   
                                                'status' => config('constant.INACTIVE'),
                                                'created_by' => 0,
                                                'updated_by' => 0,
                                                'created_at' => date('Y-m-d H:i:s')
                                               ]);

                    }
                }
            }


            //Project Completion Intimations
            if (!empty($project_status) && isset($current_project_status) && !empty($current_project_status) && $project_status != $current_project_status && !empty($intimation_settings->project_completion_status) && $project_status == $intimation_settings->project_completion_status)
            {
                //Members Project Completion Mail
                if ($intimation_settings && $intimation_settings->project_completion_intimations_members && !empty($intimation_settings->project_completion_intimations_members_mail) && isset($total_members) && !empty($total_members))
                {
                    $mail_template  = Templates::find($intimation_settings->project_completion_intimations_members_mail);

                    if ($mail_template)
                    {  
                        $subject    = $mail_template->subject;
                        $content    = $mail_template->content;
                        $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
                        foreach ($total_members as $member)
                        {
                            $member_details = User::find($member);
                            if ($member_details && !empty($member_details->email))
                            {
                                $new_content    = $content;
                                $new_content    = str_replace('[[ Name ]]', $member_details->name, $new_content);
                                $random_code    = str_random(12);

                                $mail_arr = CommonSmsEmail::create(
                                                    [
                                                    'authentication' => '',
                                                    'cmpny_id' => Auth::user()->cmpny_id,
                                                    'email' => $member_details->email,
                                                    'customer_id' => '',
                                                    'sent_type' => config('constant.CH_EMAIL'),
                                                    'response' => 'notsent',
                                                    'mail_response' => '',
                                                    'random_code' => $random_code,
                                                    'content' => $new_content,
                                                    'subject' => $subject,  
                                                    'email_cc' => '',   
                                                    'status' => config('constant.INACTIVE'),
                                                    'created_by' => 0,
                                                    'updated_by' => 0,
                                                    'created_at' => date('Y-m-d H:i:s')
                                                   ]);
                            }
                        }
                    }
                }

                //Project Completion Lead Intimation
                $project_lead   = $project->project_lead;
                $project_lead   = User::where('id', $project_lead)
                                ->where('status', config('constant.ACTIVE'))
                                ->first();
                if ($intimation_settings && $intimation_settings->project_completion_intimations_lead && !empty($intimation_settings->project_completion_intimations_lead_mail) && isset($project_lead) && !empty($project_lead->email))
                {
                    $mail_template  = Templates::find($intimation_settings->project_completion_intimations_lead_mail);
                    if ($mail_template)
                    {
                        $subject    = $mail_template->subject;
                        $content    = $mail_template->content;
                        $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
                        $content    = str_replace('[[ Name ]]', $project_lead->name, $content);

                        $random_code    = str_random(12);

                        $mail_arr = CommonSmsEmail::create(
                                            [
                                            'authentication' => '',
                                            'cmpny_id' => $cmpny_id,
                                            'email' => $project_lead->email,
                                            'customer_id' => '',
                                            'sent_type' => config('constant.CH_EMAIL'),
                                            'response' => 'notsent',
                                            'mail_response' => '',
                                            'random_code' => $random_code,
                                            'content' => $content,
                                            'subject' => $subject,  
                                            'email_cc' => '',   
                                            'status' => config('constant.INACTIVE'),
                                            'created_by' => 0,
                                            'updated_by' => 0,
                                            'created_at' => date('Y-m-d H:i:s')
                                           ]);
                    }
                }

                //Project Completion Creator Intimation
                $project_creator = $project->created_by;
                $project_creator   = User::where('id', $project_creator)
                                    ->where('status', config('constant.ACTIVE'))
                                    ->first();
                if ($intimation_settings && $intimation_settings->project_completion_intimations_creator && !empty($intimation_settings->project_completion_intimations_creator_mail) && isset($project_creator) && !empty($project_creator->email))
                {
                    $mail_template  = Templates::find($intimation_settings->project_completion_intimations_creator_mail);
                    if ($mail_template)
                    {
                        $subject    = $mail_template->subject;
                        $content    = $mail_template->content;
                        $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
                        $content    = str_replace('[[ Name ]]', $project_lead->name, $content);

                        $random_code    = str_random(12);

                        $mail_arr = CommonSmsEmail::create(
                                            [
                                            'authentication' => '',
                                            'cmpny_id' => $cmpny_id,
                                            'email' => $project_creator->email,
                                            'customer_id' => '',
                                            'sent_type' => config('constant.CH_EMAIL'),
                                            'response' => 'notsent',
                                            'mail_response' => '',
                                            'random_code' => $random_code,
                                            'content' => $content,
                                            'subject' => $subject,  
                                            'email_cc' => '',   
                                            'status' => config('constant.INACTIVE'),
                                            'created_by' => 0,
                                            'updated_by' => 0,
                                            'created_at' => date('Y-m-d H:i:s')
                                           ]);
                    }
                }
                
            }
			
			
			if(!empty($stat_id)){
                if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfully updated');
                }else{
                    $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfully added');
                }
            }else{
                    $result_arr=array('reset'=>false,'success' => false,'message' => 'Something went wrong');
            }
            return $result_arr;	
	}


    /*
    * Customer Nature deletion function
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function destroy($id)
    {
        //$id = $request->id;
	   
        if($id)
        {
            $project = Project::where('id',$id)->update(['status' => config('constant.INACTIVE')]);
			//$project->tasks()->delete();
            //$project->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfully deleted', 'refresh' => true);
		return $result_arr;		
    
    }
     public function export_projectlist(Request $request)
    {
        $search_keywords = $request->post('search_keywords');
    
        $status          = $request->post('project_status');
        $startdate       = $request->post('startdate');
        $enddate         = $request->post('enddate');
        $user_id         = Auth::user()->id;
        $cmpny_id        = Auth::user()->cmpny_id;
        $now             = time();
         $file_name         = 'ProjectReport-'.$now.'.xlsx';
         $path='/export_project/'.$file_name;

        $data = [
            'user_id'  => $user_id,
            'cmpny_id' => $cmpny_id,
             'file_name'        => urlencode($file_name),
             'search_keywords'  => $search_keywords,
             'status'           => $status,
             'startdate'        => $startdate,
             'enddate'          => $enddate
        ];
 
        (new projecttasklistreport($data))->queue($path)->chain([
            new NotifyprojecttasklistReportCompletion($data),

        ]);

    }

    public function download_project_report($file_name)
    {
        
        $file_name  = urldecode($file_name);
        $path = storage_path('app/export_project/'.$file_name);
        return response()->download($path);
    } 
}
