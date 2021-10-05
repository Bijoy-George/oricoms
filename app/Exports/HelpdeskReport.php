<?php

namespace App\Exports;

use App\Helpdesk;
use Helpers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HelpdeskReport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
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
        $tickets          = array();

        $tickets          = Helpdesk::select('docket_number', 'req_title', 'question', 'answer', 'customer_id','created_at', 'query_type', 'query_status', 'created_by', 'priority', 'escalate', 'updated_by', 'escalation_due_date', 'query_category')
                                ->with('GetCustomer', 'GetQueryType', 'GetQueryStatus', 'GetCreator', 'GetPriority', 'GetEscalateUser', 'GetEscalateFrom', 'GetQueryCategory')
                                ->whereHas('GetCustomer')
                                ->orderBy('ori_helpdesk.id', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
        {
                $tickets->where(function($tickets) use ($search_keywords){
                    $tickets->orWhere('query_type', 'like', '%' . $search_keywords . '%');
                    $tickets->orWhere('req_title', 'like', '%' . $search_keywords . '%');
                    $tickets->orWhere('docket_number', 'like', '%' . $search_keywords . '%');
                    $tickets->orWhere('query_status', 'like', '%' . $search_keywords . '%');
                });
                $tickets->orWhereHas('GetCustomer', function($tickets) use($search_keywords) 
                {
                    $tickets->where('first_name', 'like', '%' . $search_keywords . '%');
                });
        }
        if(isset($query_type) && !empty($query_type)) 
        {
                $tickets->where('ori_helpdesk.query_type', '=', $query_type);
        } 
        if(isset($query_category) && !empty($query_category)) 
        {
                $tickets->where('ori_helpdesk.query_category', '=', $query_category);
        }
        if(isset($query_status) && !empty($query_status) && $query_status !=0) 
        {
                $tickets->where('ori_helpdesk.query_status', '=', $query_status);
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
            $tickets->where('ori_helpdesk.created_at', '>=', $start_date.' 00:00:00')
            ->where('ori_helpdesk.created_at', '<=', $end_date.' 23:59:59');
        } 

        $tickets = $tickets->get();

		$export_data	= array();
		foreach ($tickets as $ticket)
		{
			$ticket_data	= array();
			$customer	   = $ticket->GetCustomer ?? NULL;
            $priority       = $ticket->GetPriority ?? NULL;
            $query_type     = $ticket->GetQueryType ?? NULL;
            $query_status   = $ticket->GetQueryStatus ?? NULL;
            $creator        = $ticket->GetCreator ?? NULL;
            $escalated_from = $ticket->GetEscalateFrom ?? NULL;
            $escalated_to   = $ticket->GetEscalateUser ?? NULL;
            $query_category = $ticket->GetQueryCategory ?? NULL;

			$ticket_data['docket_number']	 = $ticket->docket_number;
            $ticket_data['customer_name']  = $customer->first_name;
			$ticket_data['customer_name']	.= (isset($customer->middle_name) && !empty($customer->middle_name)) ? ' ' . $customer->middle_name : '';
			$ticket_data['customer_name']	.= (isset($customer->last_name) && !empty($customer->last_name)) ? ' ' . $customer->last_name : '';
            $ticket_data['mobile']              = $customer->mobile ?? '';
            $ticket_data['email']               = $customer->email ?? '';
            $ticket_data['priority']            = $priority->name ?? '';
            $ticket_data['query_type']          = $query_type->query_type ?? '';
            $ticket_data['category']            = $query_category->category_name ?? '';
			$ticket_data['enquiry_title']       = $ticket->req_title ?? '';
            $ticket_data['question']            = strip_tags(str_replace("&nbsp;", '',$ticket->question)) ?? '';
			$ticket_data['answer']              = strip_tags(str_replace("&nbsp;", '',$ticket->answer)) ?? '';
			$ticket_data['query_status']        = $query_status->name ?? '';
            $ticket_data['escalated_from']      = $escalated_from->name ?? '';
            $ticket_data['escalated_to']        = $escalated_to->name ?? '';
            $ticket_data['escalation_due_date'] = $ticket->escalation_due_date ?? '';
            $ticket_data['created_by']          = $creator->name ?? '';
			$ticket_data['created_at']	        = $ticket->created_at;

			$export_data[]	= $ticket_data;
		}

		$export_data	= collect($export_data);

        return $export_data;


    }

    public function headings() : array
    {
        $cmpny_id   = $this->data['cmpny_id'] ?? NULL;

        $title_label    = 'Enquiry Title';
        $answer_label    = 'Answer';
        $escalated_to_label    = 'Escalated To';
        if ($cmpny_id)
        {
            $title_label    = Helpers::get_company_meta('title_label', $cmpny_id) ?? 'Enquiry Title';
            $answer_label    = Helpers::get_company_meta('answer_label', $cmpny_id) ?? 'Answer';
            $escalated_to_label = Helpers::get_company_meta('escalated_to_label', $cmpny_id) ?? 'Escalated To';
        }

        $headings = [
            'Docket Number',
            'Name',
            'Mobile',
            'Email',
            'Priority',
            'Query Type',
            'Department',
            $title_label];

        if (empty($cmpny_id) || Helpers::get_company_meta('question_show', $cmpny_id) != 2)
        {
            $headings[] = 'Question';
        }

        $headings = array_merge($headings, [$answer_label,
            'Status',
            'Escalated From',
            $escalated_to_label,
            'Escalation Due Date',
            'Created By',
            'Created At'
        ]);

        return $headings;
    }

    public function map($export_data): array {
        $cmpny_id   = $this->data['cmpny_id'] ?? NULL;

        $row_data = [
            $export_data['docket_number'],
            $export_data['customer_name'],
            $export_data['mobile'],
            $export_data['email'],
            $export_data['priority'],
            $export_data['query_type'],
            $export_data['category'],
            $export_data['enquiry_title']
        ];

        if (empty($cmpny_id) || Helpers::get_company_meta('question_show', $cmpny_id) != 2)
        {
            $row_data[] = $export_data['question'];
        }

        $row_data   = array_merge($row_data, [
            $export_data['answer'],
            $export_data['query_status'],
            $export_data['escalated_from'],
            $export_data['escalated_to'],
            $export_data['escalation_due_date'],
            $export_data['created_by'],
            $export_data['created_at']
        ]);
        return $row_data;
    }
}
