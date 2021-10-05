<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

use App\CommonSmsEmail;  
use App\CronLog;
use App\Helpers;
use DB; 
use App\CustomerProfile;
use App\BatchProcess;
use App\LeadFollowup;



class Outboundcalls_batchwise_insertion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {    
		try{
			 
			$batch_process  = BatchProcess::select('id', 'cmpny_id', 'searched_criteria', 'last_processed_id', 'group_id','exclude_list','include_list')
                                ->where('process_type', config('constant.MANUAL_OUTBOUND_TYPE'))
                                ->where('status', config('constant.INACTIVE'))
                                ->first();
            
            do {
                if (empty($batch_process))
                {
					
                    break;
                }

                $searched_criteria  = json_decode($batch_process->searched_criteria);
                $search_keywords    = '';
                $selected_agent          = '';
                $status_type            = '';
                $query_type            = '';
                $category            = '';
                $call_status            = '';
                $agent_id            = '';
                $priority_type            = '';
                $global_select_all_id            = '';
                if (!empty($searched_criteria))
                {
                    if (isset($searched_criteria->search_keywords) && !empty($searched_criteria->search_keywords))
                    {
                        $search_keywords    = $searched_criteria->search_keywords;
                    }

                    if (isset($searched_criteria->selected_agent) && !empty($searched_criteria->selected_agent))
                    {
                        $selected_agent    = $searched_criteria->selected_agent;
                    }

                    if (isset($searched_criteria->status_type) && !empty($searched_criteria->status_type))
                    {
                        $status_type    = $searched_criteria->status_type;
                    }
					if (isset($searched_criteria->query_type) && !empty($searched_criteria->query_type))
                    {
                        $query_type    = $searched_criteria->query_type;
                    }
					if (isset($searched_criteria->category) && !empty($searched_criteria->category))
                    {
                        $category    = $searched_criteria->category;
                    }
					if (isset($searched_criteria->call_status) && !empty($searched_criteria->call_status))
                    {
                        $call_status    = $searched_criteria->call_status;
                    }
					if (isset($searched_criteria->agent_id) && !empty($searched_criteria->agent_id))
                    {
                        $agent_id    = $searched_criteria->agent_id;
                    }
					if (isset($searched_criteria->priority_type) && !empty($searched_criteria->priority_type))
                    {
                        $priority_type    = $searched_criteria->priority_type;
                    }
					if (isset($searched_criteria->global_select_all_id) && !empty($searched_criteria->global_select_all_id))
                    {
                        $global_select_all_id    = $searched_criteria->global_select_all_id;
                    }

                }
                $last_processed_id  = (int)$batch_process->last_processed_id;
                $relation_id     = $batch_process->id;
                $group_id           = $batch_process->group_id;
                $company_id         = $batch_process->cmpny_id;
                $exclude_list         = $batch_process->exclude_list;
                $include_list         = $batch_process->include_list;
                $results = array();
                $fields_str = '';
			  //dd($last_processed_id);
				$results=   LeadFollowup::select('ori_lead_followups.*','ori_customer_profiles.id as profile_id', 'ori_customer_profiles.first_name','ori_customer_profiles.email')
									   ->leftjoin('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_lead_followups.customer_id')
									   ->leftjoin('ori_users', 'ori_users.id', '=', 'ori_lead_followups.assigned_agent')
										->where('ori_lead_followups.id','>', $last_processed_id)->orderBy('ori_lead_followups.id', 'asc');

						 
				 $results->where('ori_customer_profiles.status','1');
				 $results->where('ori_customer_profiles.deleted_at', '=', Null);
				 $results->where('ori_lead_followups.status','1');
				 $results->where('ori_lead_followups.deleted_at', '=', Null);
			//	 $results->where('ori_lead_followups.outbound_calls',config('constant.MANUAL_OUTBOUND_CALLS'));
				 if(isset($query_type) && !empty($query_type)) 
					{
						
						$results->where('ori_lead_followups.query_type', '=', $query_type);
						
					}
					if(isset($category) && !empty($category)) 
					{
						
						$results->where('ori_lead_followups.query_category', '=', $category);
						
					}
				if(isset($status_type) && !empty($status_type) && $status_type != '0') 
					{
						
						$results->where('ori_lead_followups.query_status', '=', $status_type);
						
					}
				if(isset($agent_id) && !empty($agent_id) && $agent_id != '0') 
					{
						
						$results->where('ori_lead_followups.assigned_agent', '=', $agent_id);
						
					}
					if(isset($priority_type) && !empty($priority_type) && $priority_type != '0') 
					{
						
						$results->where('ori_lead_followups.priority', '=', $priority_type);
						
					}
					if(isset($call_status) && !empty($call_status) && $call_status != '0') 
					{
						if($call_status == 1)
						{
							$results->Where('ori_lead_followups.assigned_agent','=',0);
						}
						if($call_status == 2)
						{
							$results->Where('ori_lead_followups.assigned_agent','!=',0);
						}
					   
						
					}
				if(isset($search_keywords) && !empty($search_keywords) && $search_keywords != 'null') 
					{
					  $results->where(function($results) use ($search_keywords){
						$results->orWhere('first_name', 'like', '%' . $search_keywords . '%');
						$results->orWhere('ori_lead_followups.id', 'like', '%' . $search_keywords . '%');
						$results->orWhere('short_message', 'like', '%' . $search_keywords . '%');
						$results->orWhere('req_title', 'like', '%' . $search_keywords . '%');
						$results->orWhere('todo', 'like', '%' . $search_keywords . '%');
					  });
					} 
				  $exclude_arr=explode(",",$exclude_list);
				  $include_arr=explode(",",$include_list);
				 if($global_select_all_id ==1)
				  {
					$results->whereNotIn('ori_lead_followups.id',$exclude_arr);
					
				  }else{
					$results->whereIn('ori_lead_followups.id',$include_arr);
				  }


					$followup=$results->limit(50)->get();

					$total_count=$results->count();
					if(count($followup) >0)
					{
					  foreach ($followup as  $value) {
						$followpid=$value->id;
						$update_arr=array('assigned_agent'=>$selected_agent);
						$update_result=LeadFollowup::where('id',$followpid)->update($update_arr);
						$relation_arr1=array('last_processed_id'=>$followpid);
						BatchProcess::where(['id'=>$relation_id])->update($relation_arr1);
					  }
					}else{
					  $relation_arr=array('status'=>config('constant.ACTIVE')); // cantact_grp_status
					  BatchProcess::where(['id'=>$relation_id])->update($relation_arr);
					}
					$pending_call=$total_count-count($followup);
					$res_arr=array('total'=>$total_count,'pending_call'=>$pending_call);
					echo json_encode($res_arr);


				
		    }
            while(false);

		}
            catch(\Illuminate\Database\QueryException $ex){
                        $cc_cron_log    = new CronLog;
                        $cron_logid           = $cc_cron_log->createLog('outboundcalls_batchwise_insertion');
                        $error      = $ex->getMessage();
                        $cc_cron_log->updateLog($cron_logid,$error);
						dd($error);
            }
    }
}
