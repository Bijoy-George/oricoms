<?php

namespace App\Jobs;

use App\AutomatedProcess;
use App\BatchProcess;
use App\Campaign;
use App\CampaignBatch;
use App\CmpContact;
use App\CronLog;
use App\CustomerProfileField;
use App\Group;
use App\GroupContact;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReassignCampaignContacts implements ShouldQueue
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
            $batch_process  = BatchProcess::select('id', 'cmpny_id', 'searched_criteria', 'last_processed_id', 'group_id', 'campaign_id', 'exclude_list', 'include_list')
                                ->where('process_type', config('constant.BP_REASSIGN_GROUP_IMPORT'))
                                ->where('status', config('constant.INACTIVE'))
                                ->first();

            do
            {
                if (empty($batch_process))
                {
                    break;
                }

                $searched_criteria  = json_decode($batch_process->searched_criteria);
                $batch_id = '';
                $old_group_id = '';
                // $customer_stage = '';
                $campaign_channel = '';
                $communication_status = '';
                $search_keywords = '';

                if (!empty($searched_criteria))
                {
                    if (isset($searched_criteria->batch_id) && !empty($searched_criteria->batch_id))
                    {
                        $batch_id    = $searched_criteria->batch_id;
                    }

                    if (isset($searched_criteria->old_group_id) && !empty($searched_criteria->old_group_id))
                    {
                        $old_group_id    = $searched_criteria->old_group_id;
                    }

                    // if (isset($searched_criteria->customer_stage) && !empty($searched_criteria->customer_stage))
                    // {
                    //     $customer_stage    = $searched_criteria->customer_stage;
                    // }

                    if (isset($searched_criteria->campaign_channel) && !empty($searched_criteria->campaign_channel))
                    {
                        $campaign_channel    = $searched_criteria->campaign_channel;
                    }

                    if (isset($searched_criteria->communication_status) && !empty($searched_criteria->communication_status))
                    {
                        $communication_status    = $searched_criteria->communication_status;
                    }

                    if (isset($searched_criteria->search_keywords) && !empty($searched_criteria->search_keywords))
                    {
                        $search_keywords    = $searched_criteria->search_keywords;
                    }
                }

                $last_processed_id  = (int)$batch_process->last_processed_id;
                $group_id           = $batch_process->group_id;
                $campaign_id        = $batch_process->campaign_id;
                $cmpny_id         = $batch_process->cmpny_id;
                $exclude_list       = trim($batch_process->exclude_list);
                $exclude_list       = (isset($exclude_list) && !empty($exclude_list)) ? explode(',', $exclude_list) : [];
                $include_list       = trim($batch_process->include_list);
                $include_list       = (isset($include_list) && !empty($include_list)) ? explode(',', $include_list) : [];
                $group_ids          = array();
                $contacts           = collect([]);

                $campaign = Campaign::find($campaign_id);
                if (!$campaign)
                {
                    break;
                }

                if (isset($old_group_id) && !empty($old_group_id))
                {
                    $group_ids = [$old_group_id];
                }
                else if (isset($batch_id) && !empty($batch_id))
                {
                    $batch = CampaignBatch::find($batch_id);
                    if ($batch)
                    {
                        $group_ids = $batch->groups->pluck('id')->all();
                    }
                }
                else
                {
                    $group_ids = $campaign->groups->pluck('id')->all();
                }

                if (empty($group_ids))
                {
                    break;
                }

                $fields = CustomerProfileField::select('field_name')->where('cmpny_id',$cmpny_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))->where('report_field',1)->where('status',config('constant.ACTIVE'))->get();
                $cust_fields = CustomerProfileField::select('id','label')
                             ->where('cmpny_id',$cmpny_id)
                             ->where('type',config('constant.CUSTOM_FIELD'))
                             ->where('status',config('constant.ACTIVE'))
                             ->where('report_field',1)
                             ->get();
                $deflt_fields = CustomerProfileField::select('id','label','field_name')
                             ->where('cmpny_id',$cmpny_id)
                             ->where('type',config('constant.DEFAULT_FEILD'))
                             ->where('status',config('constant.ACTIVE'))
                             ->where('report_field',1)
                             ->get();

                 $contacts = CmpContact::select('ori_cmp_contacts.id')
                            ->join('ori_group_contacts', 'ori_group_contacts.contact_id', '=', 'ori_cmp_contacts.id')
                            ->leftJoin('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_cmp_contacts.user_id')
                            ->whereIn('ori_group_contacts.group_id', $group_ids)
                            ->where('ori_cmp_contacts.id', '>', $last_processed_id)
                            ->where('ori_cmp_contacts.status', config('constant.ACTIVE'))
                            ->with('contact_details');

                // if (isset($customer_stage) && !empty($customer_stage))
                // {
                //     $customer_stage_children    = AutomatedProcess::select('id')->where('parent_id', $customer_stage)
                //                                     ->pluck('id')->all();
                //     $contacts->leftJoin('ori_automated_process_relations', 'ori_automated_process_relations.customer_id', '=', 'ori_customer_profiles.id')
                //                     ->whereIn('ori_automated_process_relations.auto_process_id', $customer_stage_children)
                //                     ->whereNotNull('ori_customer_profiles.id');
                // }
                if (isset($campaign_channel) && !empty($campaign_channel) && isset($communication_status) && !empty($communication_status))
                {
                    $contacts->leftJoin('ori_common_sms_email', 'ori_common_sms_email.contact_id', '=', 'ori_group_contacts.contact_id')
                            ->where('ori_common_sms_email.batch_id', '=', DB::raw($batch_id))
                            ->where('ori_common_sms_email.sent_type', '=', DB::raw($campaign_channel));

                    if ($campaign_channel == config('constant.CH_SMS'))
                    {
                        $success_sms_status = config('constant.sms_success_status');
                        $success_sms_status = array_keys($success_sms_status);
                        $failure_sms_status = config('constant.sms_failure_status');
                        $failure_sms_status = array_keys($failure_sms_status);
                        $sms_status_array   = array();
                        if ($communication_status == 1)
                        {
                          $sms_status_array  = $success_sms_status;
                        }
                        else if ($communication_status == 2)
                        {
                          $sms_status_array  = $failure_sms_status;
                        }
                        if (!empty($sms_status_array))
                        {
                            $contacts->whereIn('ori_common_sms_email.status', $sms_status_array);
                        }
                    }
                    else if ($campaign_channel == config('constant.CH_EMAIL'))
                    {
                        $success_mail_status   = config('constant.email_success_status');
                        $success_mail_status   = array_keys($success_mail_status);
                        $failure_mail_status = config('constant.email_failure_status');
                        $failure_mail_status = array_keys($failure_mail_status);
                        $mail_status_array   = array();
                        if ($communication_status == 1)
                        {
                          $mail_status_array  = $success_mail_status;
                        }
                        else if ($communication_status == 2)
                        {
                          $mail_status_array  = $failure_mail_status;
                        }
                        if (!empty($mail_status_array))
                        {
                            $contacts->whereIn('ori_common_sms_email.status', $mail_status_array);
                        }
                    }
                    else if ($campaign_channel == config('constant.CH_AUTODIAL'))
                    {
                        $success_call_status  = config('constant.call_success_status');
                        $success_call_status  = array_keys($success_call_status);
                        $failure_call_status  = config('constant.call_failure_status');
                        $failure_call_status  = array_keys($failure_call_status);
                        $call_status_array    = array();
                        if ($communication_status == 1)
                        {
                            $call_status_array  = $success_call_status;
                        }
                        else if ($communication_status == 2)
                        {
                            $call_status_array = $failure_call_status;
                        }
                        if (!empty($call_status_array))
                        {
                            $contacts->whereIn('ori_common_sms_email.status', $call_status_array);
                        }
                    }
                }
                if(isset($search_keywords) && !empty($search_keywords))
                 {
                    $contacts->where(function ($q2) use ($search_keywords,$deflt_fields) {

                
                        $q2->where(function ($q3) use ($search_keywords,$deflt_fields) {
                            foreach($deflt_fields as $fields)
                            {
                                $fname = $fields->field_name;
                                $q3->orWhere('ori_cmp_contacts.' . $fname, 'like', '%' . $search_keywords . '%');
                            }
                        }); 
                        $q2->orWhereHas('contact_details', function($q4) use($search_keywords) 
                        {
                            $q4->where('value', 'like', '%' . $search_keywords . '%');
                        });
                    }); 
                                
                 }
                 if (isset($include_list) && !empty($include_list))
                 {
                    $contacts->whereIn('ori_cmp_contacts.id', $include_list);
                 }
                 if (isset($exclude_list) && !empty($exclude_list))
                 {
                    $contacts->whereNotIn('ori_cmp_contacts.id', $exclude_list);
                 }
                 $contacts = $contacts->groupBy('ori_cmp_contacts.id')
                                      ->orderBy('ori_cmp_contacts.id')
                                      ->limit(500)
                                      ->get();

                if (count($contacts) < 1)
                {
                    $batch_process->status  = config('constant.ACTIVE');
                    $batch_process->save();
                    $group_contacts_count   = GroupContact::where('group_id', $group_id)
                        ->where('status', config('constant.ACTIVE'))
                        ->count();
                    Group::where('id', $group_id)
                            ->update([
                                'total_count'   => $group_contacts_count
                            ]);

                    break;
                }

                $contacts->each(function($contact) use ($group_id, $cmpny_id) {
                    $contact_id = $contact->id;
                    $new_grp_contact = GroupContact::updateOrCreate([
                        'group_id'      => $group_id,
                        'contact_id'    => $contact_id
                    ], [
                        'cmpny_id'      => $cmpny_id,
                        'status'        => config('constant.ACTIVE')
                    ]);
                });

                $last_processed_contact  = $contacts->last();
                $batch_process->last_processed_id   = $last_processed_contact->id;
                $batch_process->save();
            }
            while(false);
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $cc_cron_log    = new CronLog;
            $cron_logid           = $cc_cron_log->createLog('reassign_campaign_contacts');
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
    }
}
