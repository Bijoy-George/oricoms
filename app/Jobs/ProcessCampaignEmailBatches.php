<?php

namespace App\Jobs;

use App\AutomatedProcessRelations;
use App\AutomatedProcessRelationsCustomer;
use App\CampaignBatch;
use App\CmpContactMeta;
use App\CommonSmsEmail;
use App\CronLog;
use App\GroupContact;
use App\Helpers;
use App\Survey;
use App\SurveyDetail;
use App\SurveyQuestion;
use App\CustomerProfileMeta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCampaignEmailBatches implements ShouldQueue
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
                                    ->where('ori_campaign_batches.channel_type', config('constant.CH_EMAIL'))
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
                 $content=$batch->content;
                //$random_no = str_random(10);
                
                $contacts = GroupContact::select('ori_group_contacts.id','ori_group_contacts.contact_id','ori_group_contacts.group_id','ori_cmp_contacts.email', 'ori_cmp_contacts.user_id', 'ori_cmp_contacts.first_name', 'ori_cmp_contacts.last_name')
                            ->join('ori_cmp_contacts', function($query) {
                                $query->on('ori_cmp_contacts.id', '=', 'ori_group_contacts.contact_id');
                                $query->where('ori_cmp_contacts.status', '=', config('constant.ACTIVE'));
                            })
                            ->where('ori_group_contacts.status', '=', config('constant.ACTIVE'))
                            ->whereNotNull('ori_cmp_contacts.email')
                            ->where('ori_group_contacts.id', '>', $last_processed_id)
                            ->whereIn('ori_group_contacts.group_id', $group_ids)
							->where('ori_cmp_contacts.cmpny_id',$batch->cmpny_id)
                            ->orderBy('ori_group_contacts.id', 'asc')->limit(15)->get();

                if (count($contacts) < 1)
                {
                    $batch->status = config('constant.ACTIVE');
                    $batch->save();
                    break;
                }

                $response   = 'notsent';
				$set_crm_source = Helpers::get_campaign_source($batch->campaign_id,$batch->cmpny_id);
                foreach ($contacts as $contact)
                {
                    $registration_code_data   = CmpContactMeta::where('status', config('constant.ACTIVE'))
                                        ->where('contact_id', $contact->contact_id)
                                        ->where('field_name', 'LIKE', '%registration_code%')
                                        ->first();
                    $registration_code  = $registration_code_data->value ?? '';
                    $called_name_data   = CmpContactMeta::where('status', config('constant.ACTIVE'))
                                        ->where('contact_id', $contact->contact_id)
                                        ->where('field_name', 'LIKE', '%called_name%')
                                        ->first();
                    $called_name  = $called_name_data->value ?? 'Sir/Madam';
                    $new_content=$content;
                    $customer_id = $contact->user_id ?? 0;
                    $contact_auto_process   = AutomatedProcessRelationsCustomer::where('customer_id', $customer_id)->where('cmpny_id',$batch->cmpny_id)->first();
                    $contact_auto_process_rel_id = null;
                    $contact_current_stage = null;
                    if (isset($contact_auto_process->id))
                    {
                        $contact_auto_process_rel_id    = $contact_auto_process->id;
                        $contact_current_stage          = $contact_auto_process->auto_process_id;
                    }
                    $random_no = md5(microtime());
                    if(!empty($survey_id))
                    {
                    $process_type  =2;  
                    $survey_url='';
                    
                    $survey_details=Survey::where('id',$survey_id)->where('cmpny_id',$batch->cmpny_id)->first();
                    if(isset($survey_details->is_lang1) && $survey_details->is_lang1 == config('constant.LANG_ENG'))
                    {
                        $eng_q_count=SurveyQuestion::where('survey_id',$survey_id)->where('qstn_id_lang1','!=',NULL)->where('cmpny_id',$batch->cmpny_id)->count();
                        if($eng_q_count > 0)
                        {
                             $str_eng=$random_no.'_'.$survey_id.'_'.config('constant.LANG_ENG');
                            $encoded_eng = urlencode( base64_encode( $str_eng ) );
                             $e_url=url('surveyform').'/'.$encoded_eng;
                            $survey_url.='<a href="'.$e_url.'">Click here For English Survey</a><br>';
                        }
                    }

                    if(isset($survey_details->is_lang2) && $survey_details->is_lang2 == config('constant.LANG_MALA'))
                    {
                        $mal_q_count=SurveyQuestion::where('survey_id',$survey_id)->where('qstn_id_lang2','!=',NULL)->where('cmpny_id',$batch->cmpny_id)->count();
                        if($mal_q_count > 0)
                        {
                            $str_mal=$random_no.'_'.$survey_id.'_'.config('constant.LANG_MALA');
                            $encoded_mal = urlencode( base64_encode( $str_mal ) );
                            $m_url=url('surveyform').'/'.$encoded_mal;
                            $survey_url.='<a href="'.$m_url.'">Click here For Malayalam Survey</a><br>';
                            
                        }
                    }
                
                   echo $new_content = str_replace('[[ survey_url ]]', $survey_url, $content);
                    }
                    if(!empty($survey_id))
                    {
                        $process_type  =2; 
                        $survey_det=SurveyDetail::firstOrCreate([
                            'batch_id'              => $batch->id,
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
                    $other_details = CustomerProfileMeta::select('value')
                                            ->where('cmpny_id',$batch->cmpny_id)
                                            ->where('user_id',$contact->user_id)
                                            ->where('field_name','company_name')
                                            ->first();
                    $u_company_name = '';
                    if(!empty($other_details)){
                         $u_company_name = $other_details->value;
                    }
                    $new_content = str_replace('[[ Company Name ]]', $u_company_name, $new_content);
                    $new_content = str_replace('[[ First Name ]]', $contact->first_name, $new_content);
                    $new_content = str_replace('[[ Last Name ]]', $contact->last_name, $new_content);
                    $new_content = str_replace('[[ Email ]]', $contact->email, $new_content);
                    $new_content    = str_replace('[[ Registration Code ]]', $registration_code, $new_content);
                    $new_content    = str_replace('[[ Called Name ]]', $called_name, $new_content);
						// ADDED FOR TEMPLATES HEADER AND FOOTER
						$email_header_content = '';$email_footer_content = '';
						$email_header = Helpers::get_company_meta('email_header',$batch->cmpny_id);
						$email_footer = Helpers::get_company_meta('email_footer',$batch->cmpny_id);
						if(isset($email_header) && !empty($email_header) && ($email_header>0))
						{
							$email_header_content = Helpers::get_template_content($email_header);
						}
						if(isset($email_footer) && !empty($email_footer) && ($email_footer>0))
						{
							$email_footer_content = Helpers::get_template_content($email_footer);
						}
						$new_content = $email_header_content.$new_content.$email_footer_content;
						// ADDED FOR TEMPLATES HEADER AND FOOTER
                    $email = CommonSmsEmail::firstOrCreate([
                        'email'                 => $contact->email,
                        'batch_id'              => $batch->id,
                    ],[
                        'authentication'        => '',
                        'cmpny_id'              => $batch->cmpny_id,
                        'customer_id'           => $customer_id,
                        'campaign_id'           => $batch->campaign_id,
                        'contact_id'            => $contact->contact_id,
                        'group_id'              => $contact->group_id,
                        'sent_type'             => config('constant.CH_EMAIL'),
                        'communication_type'    => $batch->campaign_type,
                        'content'               => $new_content,
                        'subject'               => $batch->subject,
                        'response'              => $response,
                        'goal_stage'            => $batch->goal_stage,
                        'auto_process_rel_id'   => $contact_auto_process_rel_id,
                        'current_stage'         => $contact_current_stage,
                        'process'               => $process_type,
                        'random_code'           =>$random_no,
                        'survey_id'             => $surv_id,
                        'status'                => config('constant.INACTIVE'),
						'source'				=> $set_crm_source,
                    ]);
                    

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
            $cron_logid           = $cc_cron_log->createLog('process_campaign_email_batches');
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
    }
}
