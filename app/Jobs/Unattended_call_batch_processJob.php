<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\CommonSmsEmail;  
use App\Mail\CommonMail;
use App\BatchProcess;
use App\CronLog;
use App\CustomerProfileLog;
use App\Helpers;
use DB; 
use App\Afterhourcall;
use App\CustomerProfile;
use App\LeadFollowup;



class Unattended_call_batch_processJob implements ShouldQueue
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
            $batch_process=BatchProcess::where('status',2)->where('process_type',config('constant.UNATTENDED_CALL_TYPE'))->first(); //cantact_grp_status
    // print_r($batch_process);die;
	   do {
			if (empty($batch_process))
			{
				
				break;
			}
			 $searched_criteria         = json_decode($batch_process->searched_criteria);
                $search_keywords        = '';
                $selected_agent         = '';
                $type_list              = '';
                $start_date             = '';
                $end_date               = '';
                $call_status            = '';
                $agent_id               = '';
                $global_select_all_id   = '';
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
					if (isset($searched_criteria->type_list) && !empty($searched_criteria->type_list))
                    {
                        $type_list    = $searched_criteria->type_list;
                    }
					if (isset($searched_criteria->call_status) && !empty($searched_criteria->call_status))
                    {
                        $call_status    = $searched_criteria->call_status;
                    }
					if (isset($searched_criteria->agent_id) && !empty($searched_criteria->agent_id))
                    {
                        $agent_id    = $searched_criteria->agent_id;
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
	 
            $results = Afterhourcall::select('ori_afterhourcall.cmpny_id','ori_afterhourcall.id','ori_afterhourcall.phone','ori_afterhourcall.type','ori_afterhourcall.status','ori_afterhourcall.created_at','ori_afterhourcall.assigned_agent','ori_afterhourcall.followpid','ori_afterhourcall.country_code')
                                ->leftjoin('ori_users', 'ori_users.id', '=', 'ori_afterhourcall.assigned_agent')
                                ->where('ori_afterhourcall.id','>', $last_processed_id)
                                ->where('ori_afterhourcall.cmpny_id', $company_id)
								->orderBy('ori_afterhourcall.id', 'asc');
        
            if(isset($type_list) && !empty($type_list)) 
                {
					$query_cat ='';
                    $results->Where('ori_afterhourcall.type',$type_list);
                    if($type_list == 'abandoned')
                    {
                      $query_cat= Helpers::get_company_meta('set_abandoned_category');
                    }
                     if($type_list == 'after hour')
                    {
						$query_cat= Helpers::get_company_meta('set_after_hour_category');
                    }
                     if($type_list == 'holiday')
                    {
					    $query_cat= Helpers::get_company_meta('set_holiday_category');
                    }

                }
            
            if(isset($start_date) && !empty($start_date) && $start_date != NULL)
                {

                    $date1 = str_replace("/","-",$start_date);
                    $start_date=date('Y-m-d', strtotime($date1));
                    $results->Where('ori_afterhourcall.created_at','>=' , $start_date.' 00:00:00' ); 
                }
            if(isset($end_date) && !empty($end_date) && $end_date != NULL)
                {
                    $date2 = str_replace("/","-",$end_date);
                    $end_date=date('Y-m-d', strtotime($date2));
                    $results->Where('ori_afterhourcall.created_at','<=' ,  $end_date.' 23:59:59');  
                }
            if(isset($agent_id) && !empty($agent_id) && $agent_id != '0') 
                {
                    
                    $results->where('ori_afterhourcall.assigned_agent', '=', $agent_id);
                    
                }

            if(isset($call_status) && !empty($call_status) && $call_status != '0') 
                {
                    if($call_status == 1)
                    {
                        $results->Where('ori_afterhourcall.assigned_agent','=',0);
                    }
                    if($call_status == 2)
                    {
                        $results->Where('ori_afterhourcall.assigned_agent','!=',0);
                    }                  
                    
                }
            if(isset($search_keywords) && !empty($search_keywords) && $search_keywords != 'null') 
                {
                  $results->where(function($results) use ($search_keywords){
                    $results->Where('ori_afterhourcall.phone', 'like', '%' . $search_keywords . '%');
                  });
                }
                
                  $exclude_arr=explode(",",$exclude_list);
                  $include_arr=explode(",",$include_list);
                 if($global_select_all_id ==1)
                  {
                    $results->whereNotIn('ori_afterhourcall.id',$exclude_arr);
                    
                  }else{
                    $results->whereIn('ori_afterhourcall.id',$include_arr);
                  }

                    $followup=$results->limit(10)->get();
                //    print_r($followup);die;
                    $user_id ='';
                    $total_count=$results->count();
                    if(count($followup) >0)
                    {
                      foreach ($followup as  $value) {
                        $process_id=$value->id;
                        $followpid=$value->followpid;
                        $mobile=$value->phone;
                        $country_code=$value->country_code;
                        $company_id=$value->cmpny_id;
                        $customer_arr=array();
                        
                                       if(isset($mobile) && !empty($mobile))
                                        {
                                            $user_mobile_exist = CustomerProfile::where(['mobile'=>$mobile,'cmpny_id'=>$company_id,'status'=>config('constant.ACTIVE')])->where(['mobile'=>$mobile,'status'=>config('constant.ACTIVE')])->first();
                                        }       
                                                
                                        if(isset($user_mobile_exist->id) && !empty($user_mobile_exist->id))
                                        {                        
                                                $user_id=$user_mobile_exist->id;    
                                                
                                        }else
                                        {
                                                if(isset($mobile) && !empty($mobile))
                                                {   
                                                    $customer_arr['mobile']=$mobile;
                                                }
                                                if(isset($country_code) && !empty($country_code))
                                                {   
                                                    $customer_arr['country_code']=$country_code;
                                                } 
                                                
                                                $customer_arr['cmpny_id'] = $company_id;
                                                $customer_arr['status'] = config('constant.ACTIVE');
                                                $customer_arr['source'] = Helpers::get_company_meta('set_unattended_call_source');
                                                $profile = CustomerProfile::create($customer_arr);
                                                if(!empty($profile->id))
                                                {
                                                    $user_id=$profile->id;
                                                    $customer_arr['customer_id']=$profile->id;
                                                    $log_insertion = CustomerProfileLog::create($customer_arr);
                                                }
                
                                        }       
                                        
                        if(!isset($followpid) && empty($followpid) && isset($user_id) && !empty($mobile))
                        { 
                            $docket_number = str_random(5); 
                            $f_arr=array();
                            $f_arr['cmpny_id']= $company_id;
                            $f_arr['query_type']= Helpers::get_company_meta('set_manual_call_query_type');
                            $f_arr['customer_id']=$user_id;
                            $f_arr['docket_number']=$docket_number;
                            $f_arr['lead_source_id']= Helpers::get_company_meta('set_unattended_call_source');
                            $f_arr['remainder_date']=date('Y-m-d');
                            $f_arr['query_category']=$query_cat;
                            $f_arr['req_title']='unattended calls';
                            $f_arr['assigned_agent']= $selected_agent;
                           // $f_arr['lead_status']=config('constant.status_type_open');
                            $f_arr['created_at']=date('Y-m-d H:i:s');
                            $f_arr['status']=config('constant.ACTIVE');
                            $f_arr['created_by']=1;
                            $f_arr['attended_by']=1;
                            $f_arr['outbound_calls']=config('constant.MANUAL_OUTBOUND_CALLS');

                            $follow = LeadFollowup::create($f_arr);
                            
                            if(!empty($follow->id))
                                {
                                    $follow_id=$follow->id;
                                    $update_array=array('followpid'=>$follow_id,'assigned_agent'=>$selected_agent);
                                    $update_result=Afterhourcall::where('id',$process_id)->update($update_array);
                                }
                        }
                        else
                        {
                            $update_arr=array('assigned_agent'=>$selected_agent);
                            $update_results=LeadFollowup::where('id',$followpid)->update($update_arr);
                            
                            $update_array2=array('followpid'=>$followpid,'assigned_agent'=>$selected_agent);
                            $update_result=Afterhourcall::where('id',$process_id)->update($update_array2);
                        }

                        $relation_arr1=array('last_processed_id'=>$process_id);
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
                $cron_logid           = $cc_cron_log->createLog('unattended_calls_batchwise_insertion');
                $error      = $ex->getMessage();
                $cc_cron_log->updateLog($cron_logid,$error);
            }
	}
}
