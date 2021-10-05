<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Auth;
use App\User;
use DB;
use App\ChatThreadLog;
use App\Helpers;
use App\ChatFeedbackCount;
use App\Helpdesk;
use App\QueryStatus;
use App\QueryTypes;
use App\QueryStatusRelation;
use App\CommonSmsEmail;
use App\LeadSources;
use App\HelpdeskLog;
use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
		$this->middleware('check-permission:escalation reports',   ['only' => ['escalation_report','escalation_view_reports']]);
	 
    }

    public function index()
    {
    	$start_date = Carbon::now()->subDays(30)->format('d/m/Y'); 
        $end_date = Carbon::now()->format('d/m/Y');
		return view('reports.index', compact('start_date','end_date'));
    }

    public function fetch_agent_chat_report(Request $request)
    {
    	$response  = $request->all();
    	$cmpny_id  = Auth::User()->cmpny_id;
        $date_range = [];
        $agent_name = [];
        $count_arr = "";
        $i=0;
        $j=0;
    	$chat_agent_id = Helpers::get_company_meta("chat_agent");

    	$agentlist = User::select('id','name')
                        ->where('cmpny_id',$cmpny_id)
                        ->where('role_id','like','%:"' . $chat_agent_id . '";%')
    					->get();
        if(isset($agentlist) && !empty($agentlist))
        {
            foreach ($agentlist as $key => $value) {
                $agent_name[] = $value->name;
            }
            $agents=implode("','",$agent_name);
        }
		
		$start_date  = str_replace("/","-",$response['start_date']);
        $end_date    = str_replace("/","-",$response['end_date']);

        $sdate = strtotime($start_date);
        $edate = strtotime($end_date);
        
        $start_date  = date("Y-m-d", strtotime($start_date));
        $end_date  = date('Y-m-d 23:59:59',strtotime($end_date));

        $period = new DatePeriod(
            new DateTime($start_date),
            new DateInterval('P1D'),
            new DateTime($end_date)
        );
        
        foreach ($agentlist as $key => $value)
        {
            $agent_id = $value->id;
            foreach ($period as $key => $value) 
            {
                $date_range[] = $value->format('Y-m-d');
                $fetched_date = $value->format('Y-m-d');

                $total_chat_count = ChatThreadLog::with('ChatThread')
                                    ->select(DB::raw("DISTINCT(ori_chat_thread_logs.thread_id)"), DB::raw('CAST(ori_chat_thread_logs.created_at as DATE)'))
                                    ->where(DB::raw('CAST(ori_chat_thread_logs.created_at as DATE)'),'=',$fetched_date);

                $total_chat_count->where(function ($q1) use ($agent_id)
                {
                    $q1->orWhereHas('ChatThread', function($q2) use($agent_id) 
                    {
                        $q2->where('ori_chat_thread.agent_id', $agent_id);
                    });
                });
                $total_chat_count=$total_chat_count->get();
                $count_arr .="[".$i.",".$j.",".count($total_chat_count)."],";
                $i++;
            }
            $i=0;
            $j++;              
        }
        
        $range=implode("','",$date_range);

        //return view('reports.results', compact('agents','range','count_arr'));


        $html = view('reports.results')->with(compact('agents','range','count_arr'))->render();    
        $result_arr = array('success' => true,'html' => $html);
        return $result_arr;
    }

    public function fetch_feedback_rating(Request $request)
    {
        $response       =   $request->all();
        $search_date    =   $response['date'];
        $agent_name     =   $response['agentname'];
        $cmpny_id       =   Auth::User()->cmpny_id;
        $agent_details  =   User::select('id')
                                ->where('cmpny_id',$cmpny_id)
                                ->where('name','like', $agent_name)
                                ->first();
        if(isset($agent_details) && !empty($agent_details))
        {
            $agent_id = $agent_details->id;
        }
        else
        {
            $agent_id = 0;
        }
        $feedback_rating_list = ChatFeedbackCount::where('date',$search_date)
                                            ->where('agent_id',$agent_id)
                                            ->first();
        if(isset($feedback_rating_list) && !empty($feedback_rating_list))
        {
            $result_arr = array('success' => true,'agent_name' => $agent_name, 'list_result' => $feedback_rating_list);
            return json_encode($result_arr);
        } 
        else
        {
            $result_arr = array('success' => false,'agent_name' => $agent_name, 'selected_date' => $search_date);
            return json_encode($result_arr);
        }  
    }
	
	
	 /**
    * Agent Escalation REport
    * @author AKHIL MURUKAN
    * @date 07/02/2019
    * @since version 1.0.0
    * @param NULL
    * @return Agent Escalation REport page
   */
	 
	 public function escalation_report($leadsource=null)
    {
       //  $status     = cc_lead_status::all('name', 'id');
         $status     = QueryStatus::where('is_close',1)->pluck('name', 'id')->all();
        // $agent_list     = cc_admin_user::where('status',config('constant.ACTIVE'))->get();
         $agent_list     = ['' => 'Select User'] + User::where('status',config('constant.ACTIVE'))->pluck('name', 'id')->all();
		 $query_types 	= 	['' => 'Select Type'] + QueryTypes::orderBy('query_type')
							->where('status',config('constant.ACTIVE'))
							->pluck('query_type', 'id')->all();
         return view('reports.escalation.escalation_index', compact('agent_list','status','query_types'));
    }
        /**
    * Agent Escalation REport
    * @author AKHIL MURUKAN
    * @date 07/02/2019
    * @since version 1.0.0
    * @param NULL
    * @return Agent Escalation REport page
   */

     public function escalation_view_reports(Request $request)
    {
         $reports=array();
         $status=array();
         $response           =   $request->all();
         $from_agent_id               =   $response['from_agent_id'];
         $to_agent_id               =   $response['to_agent_id'];
         $start_date               =   $response['startdate'];
         $end_date               =   $response['enddate'];
         $query_type               =   $response['query_types'];
         $category               =   $response['query_category'];
         $followup_status               =   $response['query_status'];

	    $query_arr ="";
		$qry 	= QueryTypes::orderBy('query_type')
							->where('status',config('constant.ACTIVE'))
							->pluck('query_type', 'id')->all();
		// $qry = config('constant.query_type_help_desk');
        foreach($qry as $key => $value)
			{
				$query_value_type = $value;
				$query_value = $key;
		    	$master_querytype[$query_value]['id'] = $query_value;
		    	$master_querytype[$query_value]['name'] = $query_value_type;
				$query_value_type = str_replace(" ","_",$query_value_type);
				$master_querytype[$query_value][$query_value_type.'total_cont'] = 0;
		    	$master_querytype_check[$query_value_type] = $query_value;
				$query_arr .=$query_value.',';
			}
		    $query_arr=rtrim($query_arr,",");
		    if(isset($query_type) && !empty($query_type)) 
            {
                $query_types = array($query_type);    
            } 
            else
			{
				if(isset($query_arr) && !empty($query_arr))
				{
					$query_arr_status1 = explode(',', $query_arr);
					$query_types = $query_arr_status1;
				}
			}
			// master status array		
        $ss = QueryStatusRelation::select('ori_mast_query_status.id','ori_mast_query_status.name')
		                    ->leftjoin('ori_mast_query_status','ori_mast_query_status.id','=','ori_mast_query_status_relation.query_status_id')
							->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
							->whereIn('ori_mast_query_status_relation.query_type_id', $query_types)
							->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
							->groupBy('ori_mast_query_status.id')
							->groupBy('ori_mast_query_status.name')
							->where('ori_mast_query_status_relation.deleted_at', '=', Null)
							->get();								
       
	   foreach($ss as $values)
			{
				$key = $values->name;
				$value = $values->id;
		    	$master_status['Total'] = 'Total';
		    	$master_status[$value] = $key;
			}
		 			/***** other task *******/
		$other_task_docket_no =  HelpdeskLog::select('docket_number')
								->where('ori_helpdesk_log.status',config('constant.ACTIVE'))
								->Where('ori_helpdesk_log.escalation_status', '!=', 0)
								->Where('ori_helpdesk_log.escalate','!=',0)
						        ->Where('ori_helpdesk_log.escalation_status', '!=', 0);
        $other_task_docket_no = $other_task_docket_no->get();
		$dd_no ="";
		$other_task =array();
		foreach($other_task_docket_no as $d_no)
		{
			$dd_no .=$d_no->docket_number.',';
		}
		$dd_no=rtrim($dd_no,",");
		if(isset($dd_no) && !empty($dd_no))
		{
			$list = explode(',', $dd_no);
			$arr_id = $list;
			
			$other_task = Helpdesk::select(DB::raw('count(ori_helpdesk.query_status) as counts'),'ori_helpdesk.created_by','ori_helpdesk.escalate','ori_helpdesk.query_status','ori_helpdesk.query_type')
								->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_helpdesk.customer_id')
								->whereNull('ori_customer_profiles.deleted_at')
								->join('ori_users', 'ori_users.id', '=', 'ori_helpdesk.escalate')
								->whereNull('ori_users.deleted_at')
								->where('ori_helpdesk.status',config('constant.ACTIVE'))
								->WhereIn('ori_helpdesk.query_type', $query_types)
								->WhereIn('ori_helpdesk.docket_number',$arr_id)
								->where('ori_helpdesk.escalation_status', '!=', 0)
								->where('ori_helpdesk.escalation_status', 1)
								->groupBy('escalate')
								->groupBy('query_type')
								->orderBy('escalate')
								->orderBy('query_type');
			if(isset($from_agent_id) && $from_agent_id !='' && $from_agent_id !=0){
            $other_task->where('ori_helpdesk.created_by',$from_agent_id);
            }
			if(isset($to_agent_id) && $to_agent_id !='' && $to_agent_id !=0){
            $other_task->where('ori_helpdesk.escalate',$to_agent_id);
            }
			if(isset($followup_status) && $followup_status !='' && $followup_status !=0){
            $other_task->where('ori_helpdesk.query_status',$followup_status);
            }	
			if(isset($category) && $category !='' && $category !=0){
            $other_task->where('ori_helpdesk.query_category',$category);
           }
		$other_task=$other_task->get();
		$list_count = $other_task->count();
		}
		$esc_ss = User::select('ori_users.name','ori_users.id')->get();		
       
	   foreach($esc_ss as $esc_values)
			{
				$key = $esc_values->name;
				$value = $esc_values->id;
		    	$esc_master_status['Total'] = 'Total';
		    	$esc_master_status[$value] = $key;
			}
		              /***** other task end *******/
		$set_re_open_category = Helpers::get_company_meta('re_open_status');
	   // $set_closed_category_arr = Helpers::get_company_meta('re_open_status');	
		$set_closed_category_arr   = QueryStatus::where('is_close',config('constant.ACTIVE'))->where('cmpny_id',Auth::user()->cmpny_id)->pluck('id')->all();

		$html = view('reports.escalation.escalation_list')->with(compact('esc_master_status','other_task','master_querytype_check','master_querytype','master_status','set_re_open_category','set_closed_category_arr','list_count'))->render();    
        $result_arr = array('success' => true,'html' => $html);
        return $result_arr;			  
      //  return view('reports.escalation.escalation_list', compact('esc_master_status','other_task','master_querytype_check','master_querytype','master_status'));
    }

     public function report_email($customerid=null,$search_keywords=null,$sent_type=null)
    {
        if(isset($customerid) && $customerid !=null)
        {
            $customerid=$customerid;
        }else{
            $customerid=0;
        }
        $cus_lead_source = LeadSources::all();
         
        return view('email_sms_report.mail.mail', compact('cus_lead_source','customerid','sent_type','search_keywords'));

    }
    public function search_email_reports(Request $request)
    {
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
        $from_date          = $request->post('startdate') ?? '';
        $from_date          = str_replace('/', '-', $from_date);
        $to_date            = $request->post('enddate') ?? '';
        $to_date            = str_replace('/', '-', $to_date);
        $customerid         =   $response['customerid'];
        // $source_type        =   $response['source_type'];
        $email_status       =   $response['email_status'];

       if (!empty($from_date))
        {
            $from_date          =   date('Y-m-d', strtotime($from_date)).' 00:00:01';
        }
        if (!empty($to_date))
        {
            $to_date            =   date('Y-m-d', strtotime($to_date));
        }
        if($to_date <= '2000-01-01')
        {
            $to_date = '';
        }
        else
        {
            $to_date = $to_date.' 23:59:59';
        }
        $report=array();
        $results = CommonSmsEmail::select('id','customer_id','contact_id','source','mobile','email','sent_type','response','created_at','subject','content','status','created_by')
        ->where('sent_type', config('constant.CH_EMAIL'))
        ->orderBy('id','desc');
        $cus_lead_source = LeadSources::all();

        if(isset($search_keywords) && !empty($search_keywords))
            {
                $results->where(function ($results) use ($search_keywords) { 
                    $results->where('email', $search_keywords);
                    $results->orWhere('mobile', 'like', '%' . $search_keywords . '%');
                    $results->orWhere('subject', 'like', '%' . $search_keywords . '%');
                    $results->orWhere('content', 'like', '%' . $search_keywords . '%');
                
                });
                    
                
                
            }     
       if(isset($from_date) && !empty($from_date))
            {
                $results->where('created_at','>=',$from_date);
            }
            if(isset($to_date) && !empty($to_date))
            {
                $results->where('created_at','<=',$to_date);
            }
        if(isset($source_type) && !empty($source_type))
            {
                $results->where('source', $source_type);
            }
        if(isset($customerid) && !empty($customerid) && $customerid !=0)
        {
            $results->where(function ($results) use ($customerid) {
                $results->where('customer_id', $customerid);
                $results->orWhere('customer_id', '');
                $results->orWhereNull('customer_id');
            });
        }
        
    
            if(isset($email_status) && !empty($email_status))
            {
                $results->where('status',$email_status);
            }



        $report = $results->paginate(config('constant.pagination_constant'));


        $html       = view('email_sms_report.mail.listview_mail')->with(compact('report','from','cus_lead_source'))->render();    
        $result_arr = array('success' => true,'html' => $html);
        return $result_arr; 
    
    }

    public function getEmailSmsDetail(Request $request)
    {
         $p_key = request('p_key');
        $res = CommonSmsEmail::find($p_key);
        return $res->content;
    }

    
}
