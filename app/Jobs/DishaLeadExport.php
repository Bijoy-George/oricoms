<?php

namespace App\Jobs;

use DB;
use App\CustomerProfile;
use App\Jobs\NotifyLeadlsistReportCompletion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DishaLeadExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $search_keywords = $this->data['search_keywords'] ?? '';
        $country = $this->data['country'] ?? '';
        $cmpny_id        =  $this->data['cmpny_id'] ?? '';
        $startdate       = $this->data['startdate'] ?? '';
        $enddate       =   $this->data['enddate'] ?? '';
        $file_name      = $this->data['file_name'];
        $last_processed_id  = (int)$this->data['last_processed_id'];
        $batch_last_processed_id = $last_processed_id;
        $last_helpdesk_id  = (int)$this->data['last_helpdesk_id'];
        $batch_last_helpdesk_id = $last_helpdesk_id;
        $processed_count  = (int)$this->data['processed_count'];
        $leads     = array();

        $leads        = CustomerProfile::select('ori_customer_profiles.id','ori_customer_profiles.created_by','ori_customer_profiles.created_at', 'ori_customer_profiles.first_name', 'ori_customer_profiles.last_name','ori_customer_profiles.country_id','ori_customer_profiles.other_country','ori_customer_profiles.state_id','ori_customer_profiles.other_state','ori_customer_profiles.district_id','ori_customer_profiles.address','ori_customer_profiles.mobile','ori_helpdesk.req_title', 'ori_helpdesk.answer','ori_helpdesk.short_message','ori_mast_faq_categories.category_name','ori_mast_query_actions.action','ori_mast_query_type.query_type',DB::raw('ori_helpdesk.id AS helpdesk_id'))
            ->leftJoin('ori_helpdesk', 'ori_customer_profiles.id','=','ori_helpdesk.customer_id')
            ->leftJoin('ori_mast_query_type', 'ori_mast_query_type.id', '=', 'ori_helpdesk.query_type')
            ->leftJoin('ori_mast_faq_categories', 'ori_mast_faq_categories.id', '=', 'ori_helpdesk.sub_query_category')
            ->leftJoin('ori_mast_query_actions', 'ori_mast_query_actions.id', '=', 'ori_helpdesk.action_taken')
            ->whereNotNull('ori_helpdesk.customer_id')
            ->where('ori_customer_profiles.cmpny_id',$cmpny_id)
            ->where('ori_customer_profiles.id', '>=', $last_processed_id)
            ->with('profile_details','GetLeadSource','GetCreator','getDistrict','getState','getCountry');

        if(isset($search_keywords) && !empty($search_keywords)) 
        {
                $leads->where(function($leads) use ($search_keywords){
                    $leads->orWhere('ori_customer_profiles.first_name', 'like', '%' . $search_keywords . '%');
                    $leads->orWhere('ori_customer_profiles.email', 'like', '%' . $search_keywords . '%');
                    $leads->orWhere('ori_customer_profiles.mobile', 'like', '%' . $search_keywords . '%');
                });
        }
        if(isset($country) && !empty($country))
        {
            $leads->where('ori_customer_profiles.country_id', $country);
        }
          if(isset($startdate) && !empty($startdate) && isset($enddate) && !empty($enddate))
        {
            $s_date        =   explode('/', $startdate);

            if(isset($s_date[2]) && !empty($s_date[2]) && isset($s_date[1]) && !empty($s_date[1]) && isset($s_date[0]) && !empty($s_date[0]) )
            {
            $startdate    =   $s_date[2].'-'.$s_date[1].'-'.$s_date[0];
            $startdate    =   date('Y-m-d', strtotime($startdate));
            }
            $e_date        =   explode('/', $enddate);
            
            if(isset($e_date[2]) && !empty($e_date[2]) && isset($e_date[1]) && !empty($e_date[1]) && isset($e_date[0]) && !empty($e_date[0]) )
            {
            $enddate      =   $e_date[2].'-'.$e_date[1].'-'.$e_date[0];
            $enddate      =   date('Y-m-d', strtotime($enddate));
            }
            $enddate      =   date('Y-m-d', strtotime($enddate));
            $leads->where('ori_customer_profiles.created_at', '>=', $startdate.' 00:00:00')
            ->where('ori_customer_profiles.created_at', '<=', $enddate.' 23:59:59');
        } 

        $leads = $leads->orderBy('ori_customer_profiles.id', 'asc')->orderBy('ori_helpdesk.id', 'asc')->limit(1000)->get();

        do {

            if (empty($file_name))
            {
                break;
            }

            $file_name  = urldecode($file_name);
            $file_path = storage_path('app/export_leads/'.$file_name);
            //Writing data to excel
            $handle = fopen($file_path, 'a');

            if ($last_processed_id < 1)
            {
                $headings = ['Agent Number','Date','Time','Name','Country','State','District','Address','Phone No.','Nearest Health Facility','No. of family members of the caller','Date of arrival in home','Purpose of the call','Query Type','Type of call','Action taken','Remarks'];
                fputcsv($handle, $headings);
            }

            if (count($leads) < 1)
            {
                NotifyLeadlsistReportCompletion::dispatch($this->data);
                fclose($handle);
                break;
            }

            foreach ($leads as $lead)
            {
                if ($lead->id == $batch_last_processed_id && $lead->helpdesk_id <= $batch_last_helpdesk_id)
                {
                    continue;
                }
                $leads_data  = array();
                $leads_data['agent_number'] = $lead->GetCreator->agent_number ?? '';
                $leads_data['created_date']     = !empty($lead->created_at) ? date('d/m/Y', strtotime($lead->created_at)) : '';
                $leads_data['created_time']     = !empty($lead->created_at) ? date('H:i', strtotime($lead->created_at)) : '';
                $leads_data['customer_name']  = $lead->first_name;
                $leads_data['customer_name']    .= (isset($lead->last_name) && !empty($lead->last_name)) ? ' ' . $lead->last_name : '';
                $country_name = '';
                $country   = $lead->getCountry;
                if ($country)
                {
                    $country_name = $country->name;
                    if ($country->is_other == 1)
                    {
                        $country_name = $lead->other_country;
                    }
                }
                $leads_data['country']  = $country_name;
                $state_name = '';
                $state   = $lead->getState;
                if ($state)
                {
                    $state_name = $state->name;
                    if ($state->is_other == 1)
                    {
                        $state_name = $lead->other_state;
                    }
                }
                $leads_data['state']  = $state_name;
                $leads_data['district']    = $lead->getDistrict->name ?? '';
                $leads_data['address'] = $lead->address;
                $leads_data['mobile']  = $lead->mobile;
                $leads_data['nearest_health_facility'] = $lead->profile_details->where('field_id', 245)->first()->value ?? '';
                $leads_data['number_of_family_members'] = $lead->profile_details->where('field_id', 246)->first()->value ?? '';
                $leads_data['date_of_arrival']  = $lead->profile_details->where('field_id', 247)->first()->value ?? '';
                $leads_data['purpose_of_call']  = $lead->req_title ?? '';
                $leads_data['query_type']   = $lead->query_type ?? '';
                $leads_data['type_of_call'] = $lead->category_name ?? '';
                $leads_data['action_taken'] = $lead->action ?? '';
                $leads_data['remarks']  = strip_tags(str_replace("&nbsp;", '',$lead->answer)) ?? '';

                fputcsv($handle, $leads_data);
                $processed_count++;
                $this->data['processed_count']  = $processed_count;
                $this->data['last_processed_id']  = $lead->id;
                $this->data['last_helpdesk_id']  = $lead->helpdesk_id;
            }

            fclose($handle);
            self::dispatch($this->data);
        }
        while(FALSE);
    }
}
