<?php

namespace App\Jobs;

use App\AutomatedProcessRelations;
use App\AutomatedProcessRelationsCustomer;
use App\CampaignBatch;
use App\CommonSmsEmail;
use App\CronLog;
use App\GroupContact;
use App\Helpers;
use App\LeadFollowup;
use App\LeadFollowupLog;
use App\SurveyDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
class ProcessCampaignAutodialBatches implements ShouldQueue
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
                                    ->where('ori_campaign_batches.channel_type', config('constant.CH_AUTODIAL'))
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
                $groups   = $batch->groups;
                $group_ids  = $groups->pluck('id')->all();
                $last_processed_id  = (int)$batch->last_processed_id;
                $processed_count    = (int)$batch->processed_count;
                $survey_id   = $batch->survey_id;
                $content	= $batch->content;
				$batch_id   = $batch->id;
                //$random_no = str_random(10);
				$obc_type = $batch->obc_type;
				$obc_category = $batch->obc_category;
                $random_no = md5(microtime());
                $contacts = GroupContact::select('ori_group_contacts.id','ori_group_contacts.contact_id','ori_group_contacts.group_id','ori_cmp_contacts.mobile','ori_cmp_contacts.country_code','ori_cmp_contacts.user_id')
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
				
				$set_crm_source = Helpers::get_campaign_source($batch->campaign_id,$batch->cmpny_id);
				$open_status = Helpers::get_company_meta('open_status',$batch->cmpny_id);
                $response   = 'notsent';
                foreach ($contacts as $contact)
                {
                    $customer_id = $contact->user_id ?? 0;
                    $contact_auto_process   = AutomatedProcessRelationsCustomer::where('customer_id', $customer_id)->where('cmpny_id',$batch->cmpny_id)->first();
                    $contact_auto_process_rel_id = null;
                    $contact_current_stage = null;
                    if (isset($contact_auto_process->id))
                    {
                        $contact_auto_process_rel_id    = $contact_auto_process->id;
                        $contact_current_stage          = $contact_auto_process->auto_process_id;
                    }
                   
					if(isset($contact->country_code) && !empty($contact->country_code))
					{
						$mobile = $contact->country_code.$contact->mobile;
					}
					else
					{
						$mobile = $contact->mobile;
					}
					if(!empty($mobile))
					{      
                            if(empty($survey_id)){    
							     $docket_number = str_random(5); 
								 $f_arr=array();
								 $f_arr['query_type']=$obc_type;
								 $f_arr['query_category']=$obc_category;
								 $f_arr['customer_id']=$customer_id;
								 $f_arr['batch_id']=$batch_id;
								 $f_arr['docket_number']=$docket_number;
								 $f_arr['lead_source_id']=$set_crm_source; 
								 $f_arr['remainder_date']=date('Y-m-d');
								 $f_arr['req_title']=$content;
								 $f_arr['query_status']=$open_status;
								 $f_arr['created_at']=date('Y-m-d H:i:s');
								 $f_arr['status']=config('constant.ACTIVE');
								 $f_arr['created_by']=1;
								 $f_arr['attended_by']=1;
								 $f_arr['cmpny_id']=$batch->cmpny_id;
								
								
							$follow = LeadFollowup::create($f_arr);
							$follow_log = LeadFollowupLog::create($f_arr);
						      
							}	
							$follow_id ='';
							if(isset($follow->id) && !empty($follow->id))
							{
								$follow_id =$follow->id;
							}
                        
                        
                        if(!empty($survey_id))
                        {
                        $survey_det=$process_type  =2; 
                        SurveyDetail::firstOrCreate([
                        'batch_id'              => $batch->id,
                        'customer_id'           => $customer_id,
                        ],[
                        'campaign_id'           => $batch->campaign_id,
                        'contact_id'            => $contact->contact_id,
                        'survey_id'             => $survey_id,
                        'cmpny_id'              => $batch->cmpny_id,
                        'type'                  =>config('constant.CH_AUTODIAL'),
                        'status'                =>config('constant.INACTIVE'),

                        ]);
                        $surv_id=$survey_det->id;
                        }else{
                            $surv_id=NULL;
                        }
						$email = CommonSmsEmail::firstOrCreate([
                        'mobile'                => $mobile,
                        'batch_id'              => $batch->id,
						],[
                        'authentication'        => '',
                        'cmpny_id'              => $batch->cmpny_id,
                        'customer_id'           => $customer_id,
                        'campaign_id'           => $batch->campaign_id,
                        'contact_id'            => $contact->contact_id,
                        'group_id'              => $contact->group_id,
                        'sent_type'             => config('constant.CH_AUTODIAL'),
                        'communication_type'    => $batch->campaign_type,
						'autodial_schedule_id'  => $batch->autodial_schedule_id,
						'follow_id'				=> $follow_id,
                        'content'               => $content,
                        'subject'               => $batch->subject,
                        'response'              => $response,
                        'goal_stage'            => $batch->goal_stage,
                        'auto_process_rel_id'   => $contact_auto_process_rel_id,
                        'current_stage'         => $contact_current_stage,
                        'process'               => $process_type,
                        'random_code'           => $random_no,
						'source'				=> $set_crm_source,
                        'survey_id'             => $surv_id,
                        'status'                => config('constant.INACTIVE')
						]);
                        
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
            $cron_logid           = $cc_cron_log->createLog('process_campaign_autodial_batches');
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
    }
}
