<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use App\ChatThreadLog;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping; 
//class ChatExport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
class ChatExport implements FromCollection, ShouldQueue, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $search_value;
    public function __construct($details) 
    {
        $this->search_value = $details;
    }
  
    public function collection()
    {
        $search_criteria=$this->search_value;
        $cond_arr = array();
        //print_r($search_criteria['start_date']. " and ". $search_criteria['end_date']);die;
        $start_date = $search_criteria['start_date'];
        $end_date = $search_criteria['end_date'];
        $s_date ='';
        $e_date='';
        if(isset($start_date) && !empty($start_date) && $start_date != '00-00-0000')
        {
            $date_format_sdate  =   explode('-', $start_date);
            $sdate  =   $date_format_sdate[2].'-'.$date_format_sdate[1].'-'.$date_format_sdate[0];
            $s_date =$sdate;
        }

        if(isset($end_date) && !empty($end_date) && $end_date != '00-00-0000')
        {
            $date_format_edate  =   explode('-', $end_date);
            $edate  =   $date_format_edate[2].'-'.$date_format_edate[1].'-'.$date_format_edate[0];
            $e_date=$edate;
        }

        $chat_details=ChatThreadLog::with('ChatThread.LeadSource', 'ChatThread.Customer', 'ChatThread.Agent')
                                    ->orderBy('id','desc');

        if(isset($search_criteria['search_keywords']) && !empty($search_criteria['search_keywords']))
        {
            $chat_details->where('chat_body','like','%'.'hi'.'%'); 
        }
                                   
        if(isset($e_date) && !empty($e_date) && ($e_date!='1970-01-01') && isset($s_date) && !empty($s_date) && ($s_date!='1970-01-01'))
        {
            $chat_details->where(function($chat_details) use ($s_date,$e_date)
            {
                $chat_details->orWhere('created_at', '>=', $s_date . ' 00:00:00');
                $chat_details->where('created_at', '<=', $e_date . ' 23:59:59');
                
            });
        }
        else if(isset($s_date) && !empty($s_date) && ($s_date!='1970-01-01'))
        {
            $chat_details->where(function($chat_details) use ($s_date)
            {
                $chat_details->orWhere('created_at', '>=', $s_date . ' 00:00:00');
                
            });
        }

        if(isset($search_criteria['agentid']) && !empty($search_criteria['agentid']))
        {
            $agent_id = $search_criteria['agentid'];
            $chat_details->where(function ($q1) use ($agent_id)
            {
                $q1->orWhereHas('ChatThread', function($q2) use($agent_id) 
                {
                    $q2->where('agent_id', $agent_id);
                });
            }); 
        }

        if(isset($search_criteria['customer_id']) && !empty($search_criteria['customer_id']))
        {
            $customer_id = $search_criteria['customer_id'];
            $chat_details->where(function ($q1) use ($customer_id)
            {
                $q1->orWhereHas('ChatThread', function($q2) use($customer_id) 
                {
                    $q2->where('cust_id', $customer_id);
                });
            }); 
        }

        if(isset($search_criteria['source_type']) && !empty($search_criteria['source_type']))
        {
            print_r($search_criteria['source_type']);die;
            $lead_src_id = $search_criteria['source_type'];
            $chat_details->where(function ($q1) use ($lead_src_id)
            {
                $q1->orWhereHas('ChatThread', function($q2) use($lead_src_id) 
                {
                    $q2->where('lead_source_id', $lead_src_id);
                });
            }); 
            }

        $chat_details = $chat_details->get();
        //print_r($chat_details);die;

        // if(isset($search_criteria['start_date']) && !empty($search_criteria['start_date']))
        // {
        //     print_r($search_criteria['start_date']);die;
        // }
                                    
        return $chat_details;
    }
   
    public function headings() : array
    {
        return [
            '#',
            'Chat From',
            'Chat To',
            'Message',
            'Source Type',
            'Date (IST)',
        ];
    }

    /**
    * checking for the entered keyword whether it starts with the required text
    * @author Loraine Varghese
    * @date 18-01-2019
    * @since version 1.0.0
    */
    public function startsWithCheck($string=null, $startString=null) 
    { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    }

    public function map($chat_details): array 
    {
        if($chat_details->chat_from_type==1)
        {
            //Chat from = Customer
            $chat_from = $chat_details->ChatThread->Customer->first_name;
            $chat_to = $chat_details->ChatThread->Agent->name;
        }
        else
        {
            // Chat from = Agent
            $chat_from = $chat_details->ChatThread->Agent->name;
            $chat_to = $chat_details->ChatThread->Customer->first_name;
        }     

        if($this->startsWithCheck($chat_details->chat_body,"Sending|"))
        {
            $explodeMessage = explode("|",$chat_details->chat_body);
            $message = $explodeMessage[2];
            $message = " has shared the file ";
            $message .= url('/uploads/chat_documents')."/".$explodeMessage[1];
        }      
        else
        {
            $message = $chat_details->chat_body;
        }      
        return [
            '',
            $chat_from,
            $chat_to,
            $message,
            $chat_details->ChatThread->LeadSource->name,
            $chat_details->created_at,  
        ];
    }
}
