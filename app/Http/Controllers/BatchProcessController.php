<?php

namespace App\Http\Controllers;

use App\BatchProcess;
use App\CompanyScope;
use App\CustomerProfile;
use App\CustomerProfileField;
use App\Group;
use App\GroupContact;
use Illuminate\Http\Request;



class BatchProcessController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /*
    * CREATE BATCH PROCESS REQUESTS
    * @author RAHUL R.
    * @date 15/10/2018
    * @Updated by AKHIL MURUKAN
    * @date 03/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return create batch process requests 
    */
    public function store(Request $request)
    {
        $campaign_id        = $request->post('campaign_id');
    	$group_id			= $request->post('group_id');
    	$type				= $request->post('type');
    	$included_contacts	= $request->post('included_contacts');
		if(isset($included_contacts) && !empty($included_contacts))
		{
			$included_contacts	= trim($request->post('included_contacts'));
		}
    	$excluded_contacts	= $request->post('excluded_contacts');
		if(isset($excluded_contacts) && !empty($excluded_contacts))
		{
			$excluded_contacts  = trim($request->post('excluded_contacts'));
		}
    	$company_id			= auth()->user()->cmpny_id;
    	$success			= false;
    	$message			= "Could not process the request.";
        $file_name='';
    	do {

            if (!empty($group))
            {
    		$group	= Group::find($group_id);
            $group_id=$group->id;
            }

            
    		$searched_criteria	= $this->prepareSerializedSearchCriteria($type, $request);
            if(request('file_name'))
            {
               
                $file_name=request('file_name').str_random(5);
            }

    		$batch_process	= BatchProcess::create([
    			'cmpny_id'			=> $company_id,
    			'process_type'		=> $type,
    			'searched_criteria'	=> $searched_criteria,
    			'include_list'		=> $included_contacts,
    			'exclude_list'		=> $excluded_contacts,
    			'group_id'			=> $group_id,
                'campaign_id'       => $campaign_id,
                'file_name'         => $file_name,
    			'status'			=> config('constant.INACTIVE')
    		]);

    		if (empty($batch_process))
    		{
    			break;
    		}

    		$success	= true;
    		$message	= 'Batch Process Scheduled Successfully. Group is now in processing state. Once the batch process is successfully completed, group will become active.';
    	}
    	while(false);

    	return [
    		'success' => $success,
    		'message' => $message
    	];
    }

    /*
    * PREPARE SERIALIZED SEARCH CRITERIA
    * @author RAHUL R.
    * @date 15/10/2018
	* @Updated by AKHIL MURUKAN
    * @date 03/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return serialized search criteria
    */
    private function prepareSerializedSearchCriteria($type, $request)
    {
    	$search_criteria	= [];
    	if ($type == config('constant.BP_GROUP_LEAD_IMPORT'))
    	{
    		$search_keywords	= $request->post('search_keywords');
            $startdate          = $request->post('startdate');
            $enddate            = $request->post('enddate');
            $search_criteria['search_keywords'] = $search_keywords;
            $search_criteria['startdate'] = $startdate;
    		$search_criteria['enddate']	= $enddate;
    	}
		if ($type == config('constant.UNATTENDED_CALL_TYPE'))
        {
            $search_criteria['selected_agent'] = $request->post('selected_agent');
            $search_criteria['type_list'] = $request->post('type_list');
            $search_criteria['start_date'] = $request->post('start_date');
            $search_criteria['end_date'] = $request->post('end_date');
            $search_criteria['search_keywords'] = $request->post('search_keywords');
            $search_criteria['call_status'] = $request->post('call_status');
            $search_criteria['agent_id'] = $request->post('agent_id');
            $search_criteria['global_select_all_id'] = $request->post('global_select_all_id');	
        }
		if ($type == config('constant.MANUAL_OUTBOUND_TYPE'))
        {
            $search_criteria['selected_agent'] = $request->post('selected_agent');
            $search_criteria['status_type'] = $request->post('status_type');
            $search_criteria['search_keywords'] = $request->post('search_keywords');
            $search_criteria['query_type'] = $request->post('query_type');
            $search_criteria['category'] = $request->post('category');
            $search_criteria['call_status'] = $request->post('call_status');
            $search_criteria['agent_id'] = $request->post('agent_id');
            $search_criteria['priority_type'] = $request->post('priority_type');
            $search_criteria['global_select_all_id'] = $request->post('global_select_all_id');
			
        }
        if ($type == config('constant.BP_REASSIGN_GROUP_IMPORT'))
        {
            $search_criteria['batch_id']                = $request->post('batch_id');
            $search_criteria['old_group_id']            = $request->post('old_group_id');
            // $search_criteria['customer_stage']          = $request->post('customer_stage');
            $search_criteria['campaign_channel']        = $request->post('campaign_channel');
            $search_criteria['communication_status']    = $request->post('communication_status');
            $search_criteria['search_keywords']         = $request->post('search_keywords');
        }

    	return json_encode($search_criteria);
    }
}
