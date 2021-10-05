<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\HelpdeskLog;
use App\Helpdesk;
use Excel;
use Auth;
use App\Exports\HelpdeskHistoryExport;
use App\Jobs\HelpdeskHistoryJob; 
class FileController extends Controller
{
    /*
    * Download excel file of follow up history
    * @author Reshma rajan
    * @date 02/11/2018
    * @since version 1.0.0
    */
    function download_history(Request $request)
    {
        $doc_no=request('doc_no');
        $hid=request('hid');
        $details=array('docket_number'=>$doc_no,'id'=>$hid);
        $file_name='helpdesk_history'.str_random(5).'.xlsx';
        $path='/helpdesk_history/'.$file_name;
        $details['path']=$path;
        $details['file_name']=$file_name;
        $details['cmpny_id']=Auth::user()->cmpny_id;
        $details['user_id']=Auth::user()->id;
		/*$doc_no = $doc_no;
		$hid 	= $hid;
		$type	='xls';
		
		$excel_content_types = [
          'xlsx'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
          'xls'   => 'application/vnd.ms-excel',
          'csv'   => 'text/csv',
        ];
       
        $results = HelpdeskLog::select('ori_helpdesk_log.req_title','ori_helpdesk_log.question','ori_helpdesk_log.answer','ori_helpdesk_log.query_status','ori_helpdesk_log.escalation_due_date','ori_mast_query_status.name as status','ori_helpdesk_log.updated_at','u2.name as escalate_to','ori_users.name as updated_by')
					->leftjoin('ori_users', 'ori_users.id', '=', 'ori_helpdesk_log.updated_by')
					->leftjoin('ori_users as u2', 'ori_helpdesk_log.escalate', '=', 'u2.id')
					->leftjoin('ori_mast_query_status', 'ori_mast_query_status.id', '=', 'ori_helpdesk_log.query_status')
					->where('ori_helpdesk_log.docket_number',$doc_no)
					->get();

        $email_batch_report = array();
        $email_batch_report[] = ['Sl no', 'Enquiry Title', 'Question', 'Answer', 'Status','Updated By','Escalation To','Escalation due-date','Updated At'];

        $i = 0;
        foreach ($results as $row)
        {
			if($i == 0){ $req_title = $row->req_title; } else{ $req_title = ''; }
          $i++;
          $email_batch_report[] = [$i, $req_title, strip_tags($row->question), strip_tags($row->answer),$row->status,$row->updated_by,$row->escalate_to,$row->escalation_due_date,$row->updated_at];
        }
        $file_name  = "Followup history for Docket No. $hid";
        Excel::create($file_name, function($excel) use ($email_batch_report) {
            $excel->sheet('sheet name', function($sheet) use ($email_batch_report)
            {
                $sheet->fromArray($email_batch_report);
            });
        })->store($type, public_path("uploads"));

        $file_path  = public_path("uploads/{$file_name}.{$type}");
        $file_name  = $file_name . ".{$type}";
        $headers    = ['Content-Type: ' . $excel_content_types[$type]];
        ob_end_clean();
        return response()->download($file_path, $file_name, $headers);
        */

        (new HelpdeskHistoryExport($details))->queue($path)->chain([
            new HelpdeskHistoryJob($details),
        ]);
		
    }
    /*
    * Download excel file of helpdesk history
    * @author Reshma rajan
     *@date 08/1/2019
    * @since version 1.0.0
    * @param NULL
    * @return report page
    */

	 function download_helpdeskhistory($path_name)
    {
       $path = storage_path('app/helpdesk_history/'.$path_name);
       return response()->download($path);
    }
	/*
	* Download excel file of chat history report
	* @author Loraine Varghese
	* @date 08/1/2019
	* @since version 1.0.0
	* @param NULL
	* @return report page
	*/
	function chatreport_download($customerid=null,$search_keywords=null,$start_date=null,$end_date=null,$source_type=null,$agentid=null)
    {
      
    }

    
}
