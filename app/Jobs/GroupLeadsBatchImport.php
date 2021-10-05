<?php

namespace App\Jobs;

use App\BatchProcess;
use App\CmpContact;
use App\CmpContactMeta;
use App\CronLog;
use App\CustomerProfile;
use App\CustomerProfileField;
use App\Group;
use App\GroupContact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GroupLeadsBatchImport implements ShouldQueue
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
            $batch_process  = BatchProcess::select('id', 'cmpny_id', 'searched_criteria', 'last_processed_id', 'group_id','exclude_list')
                                ->where('process_type', config('constant.BP_GROUP_LEAD_IMPORT'))
                                ->where('status', config('constant.INACTIVE'))
                                ->first();

            do {
                if (empty($batch_process))
                {
                    break;
                }

                $searched_criteria  = json_decode($batch_process->searched_criteria);
                $search_keywords    = '';
                $startdate          = '';
                $enddate            = '';
                if (!empty($searched_criteria))
                {
                    if (isset($searched_criteria->search_keywords) && !empty($searched_criteria->search_keywords))
                    {
                        $search_keywords    = $searched_criteria->search_keywords;
                    }

                    if (isset($searched_criteria->startdate) && !empty($searched_criteria->startdate))
                    {
                        $startdate    = $searched_criteria->startdate;
                        $startdate      = str_replace('/', '-', $startdate);
                    }

                    if (isset($searched_criteria->enddate) && !empty($searched_criteria->enddate))
                    {
                        $enddate    = $searched_criteria->enddate;
                        $enddate    = str_replace('/', '-', $enddate);
                    }
                }
                $from_date = '';
                $to_date = '';
                if (!empty($startdate))
                {
                    $from_date          =   date('Y-m-d', strtotime($startdate)).' 00:00:01';
                }
                if (!empty($enddate))
                {
                    $to_date            =   date('Y-m-d', strtotime($enddate));
                }
                if($to_date <= '2000-01-01')
                {
                    $to_date = '';
                }
                else
                {
                    $to_date = $to_date.' 23:59:59';
                }
                $last_processed_id  = (int)$batch_process->last_processed_id;
                $group_id           = $batch_process->group_id;
                $company_id         = $batch_process->cmpny_id;

                $fields = array();
                $fields_str = '';
        
                $fields = CustomerProfileField::select('field_name')->where('cmpny_id',$company_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))->where('report_field',1)->where('status',config('constant.ACTIVE'))->get();
                $cust_fields = CustomerProfileField::select('id','label')
                     ->where('cmpny_id',$company_id)
                     ->where('type',config('constant.CUSTOM_FIELD'))
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->get();
                $deflt_fields = CustomerProfileField::select('id','label','field_name')
                     ->where('cmpny_id',$company_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('status',config('constant.ACTIVE'))
                     ->where('report_field',1)
                     ->get();
                $unique_fields = CustomerProfileField::select('id','label','field_name')
                     ->where('cmpny_id',$company_id)
                     ->where('type',config('constant.DEFAULT_FEILD'))
                     ->where('status',config('constant.ACTIVE'))
                     ->where('is_unique',1)
                     ->get();

                $results = CustomerProfile::where('ori_customer_profiles.cmpny_id',$company_id)
                            ->where('ori_customer_profiles.id', '>', $last_processed_id)
                            ->where('ori_customer_profiles.status', config('constant.ACTIVE'))
                            ->with('profile_details');

                if (!empty($batch_process->exclude_list))
                {
                    $excluded_profile_ids   = $batch_process->exclude_list;
                    $excluded_profile_ids   = explode(',', $excluded_profile_ids);
                    $results->whereNotIn('ori_customer_profiles.id', $excluded_profile_ids);
                }

                if(isset($search_keywords) && !empty($search_keywords))
                {
                    $results->where(function ($q2) use ($search_keywords,$deflt_fields) {

            
                        $q2->where(function ($q3) use ($search_keywords,$deflt_fields) {
                            foreach($deflt_fields as $fields)
                            {
                                $fname = $fields->field_name;
                                $q3->orWhere($fname, 'like', '%' . $search_keywords . '%');
                            }
                        }); 
                        $q2->orWhereHas('profile_details', function($q4) use($search_keywords) 
                        {
                            $q4->where('value', 'like', '%' . $search_keywords . '%');
                        });
                    }); 
                            
                }
                if(isset($from_date) && !empty($from_date))
                {
                    $results->where('ori_customer_profiles.created_at','>=',$from_date);
                }
                if(isset($to_date) && !empty($to_date))
                {
                    $results->where('ori_customer_profiles.created_at','<=',$to_date);
                }

                $leads  = $results->orderBy('ori_customer_profiles.id')
                                ->limit(500)
                                ->get();

                if (count($leads) < 1)
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

                $leads->each(function($lead) use ($group_id, $company_id, $deflt_fields, $cust_fields, $unique_fields) {
                    $lead_meta_details  = $lead->profile_details;

                    $contact_id = 0;
                    $customer_contact = CmpContact::select('id')->where(['user_id' => $lead->id])->first();

                    //If Customer already exists in contact list
                    if (isset($customer_contact->id) && !empty($customer_contact->id))
                    {
                        //Update Contact data with new Customer Profile data
                        $contact_update_array   = array();
                        foreach ($deflt_fields as $deflt_field)
                        {
                            $deflt_field_name   = $deflt_field->field_name;
                            $contact_update_array[$deflt_field_name] = $lead->$deflt_field_name;
                        }
                        CmpContact::where('id', $customer_contact->id)
                                    ->update($contact_update_array);

                        //Create or Update Contact Meta Data with new Customer Profile Data
                        foreach ($lead_meta_details as $lead_meta_prop)
                        {
                            CmpContactMeta::updateOrCreate([
                                'cmpny_id'  => $company_id,
                                'contact_id'    => $customer_contact->id,
                                'field_id'      => $lead_meta_prop->field_id
                            ], [
                                'field_name'    => $lead_meta_prop->field_name,
                                'value'         => $lead_meta_prop->value,
                                'sort_order'    => $lead_meta_prop->sort_order,
                                'status'        => $lead_meta_prop->status
                            ]);
                        }

                        $contact_id = $customer_contact->id;
                    }
                    else
                    {
                        //Create new contact from customer profile
                        $new_contact_array  = array();
                        foreach ($deflt_fields as $deflt_field)
                        {
                            $deflt_field_name   = $deflt_field->field_name;
                            $new_contact_array[$deflt_field_name]   = $lead->$deflt_field_name;
                        }

                        $new_contact_array['cmpny_id']  = $lead->cmpny_id;
                        $new_contact_array['user_id']   = $lead->id;
                        $new_contact_array['source']    = $lead->source;
                        $new_contact_array['status']    = $lead->status;

                        $new_contact = CmpContact::create($new_contact_array);

                        //Create contact meta fields from customer profile meta fields
                        foreach ($lead_meta_details as $lead_meta_prop)
                        {
                            CmpContactMeta::create([
                                'cmpny_id'      => $lead_meta_prop->cmpny_id,
                                'contact_id'    => $new_contact->id,
                                'field_name'    => $lead_meta_prop->field_name,
                                'value'         => $lead_meta_prop->value,
                                'field_id'      => $lead_meta_prop->field_id,
                                'sort_order'    => $lead_meta_prop->sort_order,
                                'status'        => $lead_meta_prop->status
                            ]);
                        }

                        $contact_id = $new_contact->id;
                    }

                    //Add or update contact to the group
                    GroupContact::updateOrCreate([
                        'group_id'      => $group_id,
                        'contact_id'    => $contact_id
                    ], [
                        'cmpny_id'      => $company_id,
                        'status'        => config('constant.ACTIVE')
                    ]);
                });

                $last_processed_lead  = $leads->last();
                $batch_process->last_processed_id   = $last_processed_lead->id;
                $batch_process->save();

            }
            while(false);
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $cc_cron_log    = new CronLog;
            $cron_logid           = $cc_cron_log->createLog('group_customer_batch_import');
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
    }
}
