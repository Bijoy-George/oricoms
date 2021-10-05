<?php

namespace App\Jobs;

use DB;
use Helpers;
use App\CustomerProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LeadWithHelpdeskExport implements ShouldQueue
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
        $cmpny_id        =  $this->data['cmpny_id'] ?? '';
        $startdate       = $this->data['startdate'] ?? '';
        $enddate       =   $this->data['enddate'] ?? '';
        $file_name      = $this->data['file_name'];
        $last_processed_id  = (int)$this->data['last_processed_id'];
        $processed_count  = (int)$this->data['processed_count'];
        $leads     = array();

        $leads = CustomerProfile::select('ori_customer_profiles.id','ori_customer_profiles.first_name','ori_customer_profiles.last_name','ori_customer_profiles.district_id','ori_customer_profiles.state_id','ori_customer_profiles.country_id','ori_customer_profiles.address','ori_helpdesk.req_title', 'ori_helpdesk.answer','ori_users.name',DB::raw("ori_mast_query_status.name AS status"),'ori_helpdesk.created_at')
            ->leftJoin('ori_helpdesk', function($query) {
                    $query->on('ori_customer_profiles.id','=','ori_helpdesk.customer_id')
                        ->whereRaw('ori_helpdesk.id IN (select MAX(a2.id) from ori_helpdesk as a2 join ori_customer_profiles as u2 on u2.id = a2.customer_id group by u2.id)');
            })
            ->leftJoin('ori_users', 'ori_users.id', '=', 'ori_helpdesk.escalate')
            ->leftJoin('ori_mast_query_status', 'ori_mast_query_status.id', '=', 'ori_helpdesk.query_status')
                    ->where('ori_customer_profiles.cmpny_id',$cmpny_id)
                    ->where('ori_customer_profiles.id', '>', $last_processed_id)
                    ->with('getDistrict', 'getCountry', 'getState');

        if(isset($search_keywords) && !empty($search_keywords)) 
        {
                $leads->where(function($leads) use ($search_keywords){
                    $leads->orWhere('ori_customer_profiles.first_name', 'like', '%' . $search_keywords . '%');
                    $leads->orWhere('ori_customer_profiles.email', 'like', '%' . $search_keywords . '%');
                    $leads->orWhere('ori_customer_profiles.mobile', 'like', '%' . $search_keywords . '%');
                });
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

        $leads = $leads->orderBy('ori_customer_profiles.id', 'asc')->limit(100)->get();

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
                if ($cmpny_id)
                {
                    $title_label    = Helpers::get_company_meta('title_label', $cmpny_id) ?? 'Enquiry Title';
                    $answer_label    = Helpers::get_company_meta('answer_label', $cmpny_id) ?? 'Answer';
                    $escalated_to_label = Helpers::get_company_meta('escalated_to_label', $cmpny_id) ?? 'Escalated To';
                }
                $headings = ['Date','Name','Country','State','District','Address','Contact Number',$title_label,$escalated_to_label,$answer_label,'Status'];
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
                $leads_data  = array();
                $leads_data['created_at']   = date('d-m-Y H.i a', strtotime($lead->created_at));
                $leads_data['customer_name']  = $lead->first_name;
                $leads_data['customer_name']    .= (isset($lead->last_name) && !empty($lead->last_name)) ? ' ' . $lead->last_name : '';
                $leads_data['country']    = $lead->getCountry->name ?? '';
                $leads_data['state']    = $lead->getState->name ?? '';
                $leads_data['district']    = $lead->getDistrict->name ?? '';
                $leads_data['address']    = $lead->address;
                $leads_data['mobile']  = $lead->mobile;
                $leads_data['enquiry_title']    = $lead->req_title ?? '';
                $leads_data['escalated_to']    = $lead->name ?? '';
                $leads_data['answer']    = strip_tags(str_replace("&nbsp;", '',$lead->answer)) ?? '';
                $leads_data['status'] = $lead->status ?? '';

                fputcsv($handle, $leads_data);
                $processed_count++;
                $this->data['processed_count']  = $processed_count;
                $this->data['last_processed_id']  = $lead->id;
            }

            fclose($handle);
            self::dispatch($this->data);
        }
        while(FALSE);
    }
}
