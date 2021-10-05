<?php

namespace App\Exports;

use App\LeadFollowup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FollowupReport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
{
    use Exportable;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$search_keywords    = $this->data['search_keywords'] ?? '';
        $query_type         = $this->data['query_type'] ?? 0;
        $query_category     = $this->data['query_category'] ?? 0;
        $query_status       = $this->data['query_status'] ?? 0;
        $start_date         = $this->data['start_date'] ?? '';
        $end_date           = $this->data['end_date'] ?? '';
        $followups          = array();

        $followups          = LeadFollowup::select('docket_number', 'req_title', 'question', 'answer', 'customer_id','created_at', 'query_type', 'query_status', 'created_by', 'priority', 'query_category')
                                ->with('GetCustomer', 'GetQueryType', 'GetQueryStatus', 'GetCreator', 'GetPriority', 'GetQueryCategory')
                                ->whereHas('GetCustomer')
                                ->orderBy('ori_lead_followups.id', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
        {
                $followups->where(function($followups) use ($search_keywords){
                    $followups->orWhere('query_type', 'like', '%' . $search_keywords . '%');
                    $followups->orWhere('req_title', 'like', '%' . $search_keywords . '%');
                    $followups->orWhere('docket_number', 'like', '%' . $search_keywords . '%');
                    $followups->orWhere('query_status', 'like', '%' . $search_keywords . '%');
                });
                $followups->orWhereHas('GetCustomer', function($followups) use($search_keywords) 
                {
                    $followups->where('first_name', 'like', '%' . $search_keywords . '%');
                });
        }
        if(isset($query_type) && !empty($query_type)) 
        {
                $followups->where('ori_lead_followups.query_type', '=', $query_type);
        } 
        if(isset($query_category) && !empty($query_category)) 
        {
                $followups->where('ori_lead_followups.query_category', '=', $query_category);
        }
        if(isset($query_status) && !empty($query_status) && $query_status !=0) 
        {
                $followups->where('ori_lead_followups.query_status', '=', $query_status);
        }
        if(isset($start_date) && !empty($start_date) && isset($end_date) && !empty($end_date))
        {
            $s_date        =   explode('/', $start_date);

            if(isset($s_date[2]) && !empty($s_date[2]) && isset($s_date[1]) && !empty($s_date[1]) && isset($s_date[0]) && !empty($s_date[0]) )
            {
            $start_date    =   $s_date[2].'-'.$s_date[1].'-'.$s_date[0];
            $start_date    =   date('Y-m-d', strtotime($start_date));
            }
            $e_date        =   explode('/', $end_date);
            
            if(isset($e_date[2]) && !empty($e_date[2]) && isset($e_date[1]) && !empty($e_date[1]) && isset($e_date[0]) && !empty($e_date[0]) )
            {
            $end_date      =   $e_date[2].'-'.$e_date[1].'-'.$e_date[0];
            $end_date      =   date('Y-m-d', strtotime($end_date));
            }
            $end_date      =   date('Y-m-d', strtotime($end_date));
            $followups->where('ori_lead_followups.created_at', '>=', $start_date.' 00:00:00')
            ->where('ori_lead_followups.created_at', '<=', $end_date.' 23:59:59');
        } 

        $followups = $followups->get();

		$export_data	= array();
		foreach ($followups as $followup)
		{
			$followup_data	= array();
			$customer	   = $followup->GetCustomer ?? NULL;
            $priority       = $followup->GetPriority ?? NULL;
            $query_type     = $followup->GetQueryType ?? NULL;
            $query_status   = $followup->GetQueryStatus ?? NULL;
            $creator        = $followup->GetCreator ?? NULL;
            $query_category = $followup->GetQueryCategory ?? NULL;

			$followup_data['docket_number']	 = $followup->docket_number;
            $followup_data['customer_name']  = $customer->first_name;
			$followup_data['customer_name']	.= (isset($customer->middle_name) && !empty($customer->middle_name)) ? ' ' . $customer->middle_name : '';
			$followup_data['customer_name']	.= (isset($customer->last_name) && !empty($customer->last_name)) ? ' ' . $customer->last_name : '';
            $followup_data['mobile']         = $customer->mobile ?? '';
            $followup_data['email']          = $customer->email ?? '';
            $followup_data['priority']       = $priority->name ?? '';
            $followup_data['query_type']     = $query_type->query_type ?? '';
            $followup_data['category']       = $query_category->category_name ?? '';
			$followup_data['enquiry_title']  = $followup->req_title ?? '';
			//$followup_data['question']       = $followup->question ?? '';
            //$followup_data['answer']         = $followup->answer ?? '';
            $followup_data['question']       = strip_tags(str_replace("&nbsp;", '',$followup->question)) ?? '';
            $followup_data['answer']         = strip_tags(str_replace("&nbsp;", '',$followup->answer)) ?? '';
			$followup_data['query_status']   = $query_status->name ?? '';
            $followup_data['created_by']     = $creator->name ?? '';
			$followup_data['created_at']	 = $followup->created_at;

			$export_data[]	= $followup_data;
		}

		$export_data	= collect($export_data);

        return $export_data;


    }

    public function headings() : array
    {
        return [
            'Docket Number',
            'Customer Name',
            'Mobile',
            'Email',
            'Priority',
            'Query Type',
            'Department',
            'Enquiry Title',
            'Question',
            'Answer',
            'Status',
            'Created By',
            'Created At'
        ];
    }

    public function map($export_data): array {
        return [
            $export_data['docket_number'],
            $export_data['customer_name'],
            $export_data['mobile'],
            $export_data['email'],
            $export_data['priority'],
            $export_data['query_type'],
            $export_data['category'],
            $export_data['enquiry_title'],
            $export_data['question'],
            $export_data['answer'],
            $export_data['query_status'],
            $export_data['created_by'],
            $export_data['created_at']
        ];
    }
}
