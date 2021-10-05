<?php

namespace App\Jobs;

use App\AutomatedProcessRelations;
use App\CampaignBatch;
use App\CommonSmsEmail;
use App\CronLog;
use App\GroupContact;
use App\LeadFollowup;
use App\LeadFollowupLog;
use App\CustomerProfile;
use App\CmpContact;
use App\Helpers;
use App\CustomerProfileLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\SurveyDetail;
class ProcessCampaignManualCallBatches implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try
        {
            $batch = CampaignBatch::where('ori_campaign_batches.status', config('constant.INACTIVE'))
                                    ->where('ori_campaign_batches.channel_type', config('constant.CH_MANUAL_CALL'))
                                    ->with('groups', 'campaign_det')
                                    ->orderBy('ori_campaign_batches.campaign_type', 'desc')
                                    ->orderBy('ori_campaign_batches.created_at', 'asc')
                                    ->first();

            do {

                if (!isset($batch->id) || empty($batch->id))
                {
                    break;
                }
                $process_type=NULL;
				$batch_id = $batch->id;
                $groups   = $batch->groups;
                $group_ids  = $groups->pluck('id')->all();
                $last_processed_id  = (int)$batch->last_processed_id;
                $processed_count    = (int)$batch->processed_count;
                $survey_id   = $batch->survey_id;
                $content = $batch->content;
                $title = $batch->title;
				$obc_type = $batch->obc_type;
				$priority = $batch->enq_priority;
				if($priority == 0)
				{
					$priority = NULL;
				}
				$obc_category = $batch->obc_category;
				$obc_subcategory = $batch->obc_subcategory;
				
                //$random_no = str_random(10);
                $random_no = md5(microtime());
                $contacts = GroupContact::select('ori_group_contacts.id','ori_group_contacts.contact_id','ori_group_contacts.group_id','ori_cmp_contacts.mobile','ori_cmp_contacts.country_code','ori_cmp_contacts.user_id','ori_cmp_contacts.email')
                            ->join('ori_cmp_contacts', function($query) {
                                $query->on('ori_cmp_contacts.id', '=', 'ori_group_contacts.contact_id');
                                $query->where('ori_cmp_contacts.status', '=', config('constant.ACTIVE'));
                            })
                            ->where('ori_group_contacts.status', '=', config('constant.ACTIVE'))
                            ->whereNotNull('ori_cmp_contacts.mobile')
                            ->where('ori_group_contacts.id', '>', $last_processed_id)
                            ->whereIn('ori_group_contacts.group_id', $group_ids)
							->where('ori_group_contacts.cmpny_id',$batch->cmpny_id)
                            ->orderBy('ori_group_contacts.id', 'asc')->limit(15)->get();

                if (count($contacts) < 1)
                {
                    $batch->status = config('constant.ACTIVE');
                    $batch->save();
                    break;
                }

                $open_status = Helpers::get_company_meta('open_status',$batch->cmpny_id);
				$set_crm_source = Helpers::get_campaign_source($batch->campaign_id,$batch->cmpny_id);
				$auto_stage_activation = Helpers::get_company_meta('auto_stage_activation',$batch->cmpny_id);
				$auto_lead_stage = Helpers::get_company_meta('sales_automation_lead_stage',$batch->cmpny_id);
                foreach ($contacts as $contact)
                {
                    $customer_id = $contact->user_id ?? 0;
                    // $contact_auto_process   = AutomatedProcessRelations::where('customer_id', $customer_id)->where('cmpny_id',$batch->cmpny_id)->first();
                    // $contact_auto_process_rel_id = null;
                    // $contact_current_stage = null;
                    // if (isset($contact_auto_process->id))
                    // {
                    //     $contact_auto_process_rel_id    = $contact_auto_process->id;
                    //     $contact_current_stage          = $contact_auto_process->auto_process_id;
                    // }
                   
					$mobile = $contact->mobile;
					if(!empty($mobile))
					{
						//// starts
						
						if(isset($contact->user_id) && !empty($contact->user_id)){
										$customer_id=$contact->user_id;
								}else
								{  
									if(isset($mobile) && !empty($mobile))
									{
										$user_mobile_exist = CustomerProfile::where(['mobile'=>$mobile,'status'=>config('constant.ACTIVE'),'cmpny_id'=>$batch->cmpny_id])->first();
									}		
											
									if(isset($user_mobile_exist->id) && !empty($user_mobile_exist->id))
									{                        
											$customer_id=$user_mobile_exist->id;

									}else
									{
											$customer_arr['cmpny_id'] = $batch->cmpny_id;
											if(isset($mobile) && !empty($mobile))
											{	
												$customer_arr['mobile']=$mobile;
											}
											if(isset($contact->country_code) && !empty($contact->country_code))
											{	
												$customer_arr['country_code']=$contact->country_code;
											} 
											if(isset($contact->email) && !empty($contact->email))
											{	
												$customer_arr['email']=$contact->email;
											}
											$customer_arr['status'] = config('constant.ACTIVE');
											$customer_arr['source'] = $set_crm_source;
											$profile = CustomerProfile::create($customer_arr);
											if(!empty($profile->id))
											{
												$customer_id=$profile->id;
												$contact_arr=array('user_id'=>$customer_id);
												$res5=CmpContact::where('id', $contact->contact_id)->where('cmpny_id',$batch->cmpny_id)->update($contact_arr);
												
												$customer_arr['user_id']=$profile->id;
												$log_insertion = CustomerProfileLog::create($customer_arr);
											}
											
											
											/////////// AUTOMATED PROCESS CODES STARTS HERE ////////////
											
											if($auto_stage_activation==1)
											{
											if(isset($auto_lead_stage) && !empty($auto_lead_stage))
											{
											Helpers::auto_process_params($batch->cmpny_id,$customer_id,$auto_lead_stage);
											$fresults = CustomerProfile::where('id',$customer_id)->where('cmpny_id',$batch->cmpny_id)->first();
											if($fresults)
											{
											$upd = array(
											'[[ First Name ]]' => $fresults->first_name
											);
											$updarr = array('mail_field' => json_encode($upd));
											AutomatedProcessRelations::where('customer_id',$customer_id)->where('cmpny_id',$batch->cmpny_id)->limit(1)->update($updarr);
											}
											}
											}
											/////////// AUTOMATED PROCESS CODES ENDS HERE ////////////
											
									}
									
								}
						
						
						//// ends
						if(!empty($customer_id) && ($customer_id!=0))
						{
							if(empty($survey_id)){

								echo $docket_number = str_random(5); 
								 $f_arr=array();
								 $f_arr['cmpny_id']=$batch->cmpny_id;
								 $f_arr['query_type']=$obc_type;
								 $f_arr['priority']=$priority;
								 $f_arr['customer_id']=$customer_id;
								 $f_arr['batch_id']=$batch_id;
								 $f_arr['docket_number']=$docket_number;
								 $f_arr['lead_source_id']=$set_crm_source; 
								 $f_arr['remainder_date']=date('Y-m-d');
								 $f_arr['req_title']=$title;
								 $f_arr['question']=$content;
								 $f_arr['query_status']=$open_status;
								 $f_arr['created_at']=date('Y-m-d H:i:s');
								 $f_arr['status']=config('constant.ACTIVE');
								 $f_arr['created_by']=1;
								 $f_arr['attended_by']=1;
								 $f_arr['outbound_calls']=config('constant.MANUAL_OUTBOUND_CALLS');
								if(isset($obc_category) && !empty($obc_category) && ($obc_category!=0))
								{
									$f_arr['query_category']=$obc_category;
								}
								else
								{
									$f_arr['query_category'] = NULL;
								}
								if(isset($obc_subcategory) && !empty($obc_subcategory) && ($obc_subcategory!=0))
								{
									$f_arr['sub_query_category']=$obc_subcategory;
								}
								else
								{
									$f_arr['sub_query_category']	= NULL;
								}

								$follow = LeadFollowup::create($f_arr);
								$follow_log = LeadFollowupLog::create($f_arr);
							}
							if(isset($contact->country_code) && !empty($contact->country_code))
							{
								$mobile = $contact->country_code.$contact->mobile;
							}
							else
							{
								$mobile = $contact->mobile;
							}
							
	                        if(!empty($survey_id))
		                    {
		                    	$process_type  =2; 
		                        $survey_det=SurveyDetail::firstOrCreate([
		                            'batch_id'              => $batch_id,
		                            'customer_id'           => $customer_id,

		                        ],[
		                            'campaign_id'           => $batch->campaign_id,
		                            'contact_id'            => $contact->contact_id,
		                            'survey_id'             => $survey_id,
		                            'cmpny_id'              => $batch->cmpny_id,
		                            'type'                  =>config('constant.CH_MANUAL_CALL'),
		                            'status'                =>config('constant.INACTIVE'),

		                        ]);
		                       $surv_id=$survey_det->id;
		                    }else{
		                    	$surv_id=NULL;
		                    }					
							$email = CommonSmsEmail::firstOrCreate([
								'mobile'                => $mobile,
								'batch_id'              => $batch_id,
							],[
								'authentication'        => '',
								'cmpny_id'              => $batch->cmpny_id,
								'customer_id'           => $customer_id,
								'campaign_id'           => $batch->campaign_id,
								'contact_id'            => $contact->contact_id,
								'group_id'              => $contact->group_id,
								'sent_type'             => config('constant.CH_MANUAL_CALL'),
								'communication_type'    => $batch->campaign_type,
								'content'               => $content,
								'subject'               => $batch->subject,
								// 'goal_stage'            => $batch->goal_stage,
								// 'auto_process_rel_id'   => $contact_auto_process_rel_id,
								// 'current_stage'         => $contact_current_stage,
								'process'               => $process_type,
								'random_code'           => $random_no,
								'source'				=> $set_crm_source,
								'survey_id'             => $surv_id,
								'status'                => config('constant.INACTIVE')
							]);
							
						}
					}
                }

                $last_contact       = $contacts->last();
                $last_processed_id  = $last_contact->id;
                $processed_count    = CommonSmsEmail::where('batch_id', $batch->id)->where('cmpny_id',$batch->cmpny_id)->count();

                $batch->processed_count     = $processed_count;
                $batch->last_processed_id   = $last_processed_id;
                $batch->save();
            }
            while(false);

        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $cc_cron_log    = new CronLog;
            $cron_logid           = $cc_cron_log->createLog('process_campaign_manual_call_batches');
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
    }
}
