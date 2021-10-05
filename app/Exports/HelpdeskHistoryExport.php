<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use App\HelpdeskLog;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping; 
class HelpdeskHistoryExport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $search_value;
    public function __construct($details) {
        $this->search_value = $details;
    }
  
    public function collection()
    {
        $search_criteria=$this->search_value;
        
        $results = HelpdeskLog::select('ori_helpdesk_log.req_title','ori_helpdesk_log.question','ori_helpdesk_log.answer','ori_helpdesk_log.query_status','ori_helpdesk_log.escalation_due_date','ori_helpdesk_log.updated_at','created_at')->with('GetQueryStatus')->with('GetEscalateUser')->with('GetEscalateFrom')
            ->where('ori_helpdesk_log.docket_number',$search_criteria['docket_number'])
            ->get();
            
        
        return $results;
        
    }
  
     public function headings() : array
    {
        return [
            'Enquiry Title',
            'Question',
            'Answer',
            'Status',
            'Escalated From',
            'Escalation To',
            'Escalation due-date',
            'Updated At',
        ];
    }

    public function map($helpdesk_det): array {
          
        return [
            $helpdesk_det->req_title,
            strip_tags($helpdesk_det->question),
            strip_tags($helpdesk_det->answer),
            $helpdesk_det['GetQueryStatus']['name'],
            $helpdesk_det['GetEscalateFrom']['name'],
            $helpdesk_det['GetEscalateUser']['name'],
            $helpdesk_det->escalation_due_date, 
            $helpdesk_det['created_at']->format('d-m-Y H:i:s A'),
            
        ];
    }
}
