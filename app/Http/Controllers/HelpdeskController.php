<?php

namespace App\Http\Controllers;
use App\Exports\DishaHelpdeskReport;
use App\Exports\EhealthHelpdeskReport;
use App\Exports\EhealthtaskkReport;
use App\Exports\HelpdeskReport;
use App\Helpdesk;
use App\HelpdeskLog;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\Jobs\NotifyHelpdeskReportCompletion;
use App\Jobs\NotifytaskReportCompletion;
use App\LeadFollowupLog;
use App\QueryStatus;
use App\QueryStatusRelation;
use App\QueryTypes;
use App\User;
use App\FaqCategories;
use Auth;
use DB;
use Illuminate\Http\Request;

class HelpdeskController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:Helpdesk',   ['only' => ['index','search_list','get_helpdesk','helpdesk_more_details']]);
	   $this->middleware('check-permission:escalated to',   ['only' => ['taskslist','taskslist_search']]);
    }
	/*
    * Helpdesk
    * @author PRANEESHA KP
	* @author AKHIL MURUKAN
    * @date 17/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return helpdesk index page
    */
	public function index()
    {
		$query_types 	= 	['' => 'Select Type'] + QueryTypes::orderBy('query_type')
							->where('status',config('constant.ACTIVE'))
							->where('type',config('constant.TICKET'))
							->pluck('query_type', 'id')->all();
		$demo = array();	
                $sub_category = array();
		if(Auth::user()->cmpny_id == 14){
		$demo = ['' => 'Demo'] + config('constant.DEMO');	
                $sub_category = ['' => 'SubCategory'] + FaqCategories::where('cmpny_id',Auth::user()->cmpny_id)
		                ->whereNotNull('parent_category_id')
		                ->where('status',config('constant.ACTIVE'))
						->pluck('category_name','id')->all();
		}
                if(Auth::user()->cmpny_id == 32)
		{
			$query_types = ['' => 'Select Call From'] + QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->where('short_code','!=',"issue")->where('short_code','!=',"measure_taken")->orderBy('sort_order')->pluck('query_type', 'id','type','short_code')->all();
			$issues = ['' => 'Select Issue'] + QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->where('short_code','=',"issue")->orderBy('sort_order')->pluck('query_type', 'id','type','short_code')->all();
			$measure_taken = ['' => 'Select Measure Taken'] + QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->where('short_code','=',"measure_taken")->orderBy('sort_order')->pluck('query_type', 'id','type','short_code')->all();
			
		}
		else{$issues = array();$measure_taken = array();}					
		return view('helpdesk.index', compact('query_types','demo','sub_category','issues','measure_taken'));
    }
			
	/*
    * Helpdesk Listing 
    * @author PRANEESHA KP
	* @author AKHIL MURUKAN
    * @date 17/10/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           =   $request->all();
        $demo = array();	
        $sub_category = array();
	$query_types        =  array();
        $search_keywords    =   $response['search_keywords'];
	$query_type         =   $response['query_types'];         
        $category_type      =   $response['query_category'];         
        $status_type        =   $response['query_status'];         
        $start_date         =   $response['startdate'];
        $end_date           =   $response['enddate'];
	$escalted_test = 5;
	if(Auth::user()->cmpny_id == 32){
        $escalted_test 		=   $response['escalate']; 
    	}
        if(Auth::user()->cmpny_id == 14){ 
        $demo        =   $response['demo'];         
        $sub_category        =   $response['sub_category']; }
	$results 			= 	array();	
        $results 	 		=   Helpdesk::select('id','docket_number','req_title','query_status',
								'query_type','customer_id','lead_source_id','priority','escalate','demo','sub_query_category')
								->with('GetCustomer','GetEscalateUser')
                                                                ->with('GetSubQueryCategory')
								->whereHas('GetCustomer')
								->orderBy('ori_helpdesk.id', 'desc');
		
		$close_status = QueryStatus::where('is_close',1)->pluck('id');
        foreach ($close_status as $value) {
            $close_status_arr[]	= $value;
        }
		
		if(isset($search_keywords) && !empty($search_keywords)) 
        {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('query_type', 'like', '%' . $search_keywords . '%');
                    $results->orWhere('req_title', 'like', '%' . $search_keywords . '%');
                    $results->orWhere('docket_number', 'like', '%' . $search_keywords . '%');
                    $results->orWhere('query_status', 'like', '%' . $search_keywords . '%');
				});
				$results->orWhereHas('GetCustomer', function($results) use($search_keywords) 
				{
					$results->where('first_name', 'like', '%' . $search_keywords . '%');
				});
        }
		if(isset($query_type) && !empty($query_type)) 
        {
                $results->where('ori_helpdesk.query_type', '=', $query_type);
        } 
		if($escalted_test == 1) 
        {
                $results->where('ori_helpdesk.escalate', '!=', null);
        } 
	if($escalted_test == 2) 
        {
                $results->where('ori_helpdesk.escalate', '=', null);
        } 


		if(isset($category_type) && !empty($category_type)) 
        {
                $results->where('ori_helpdesk.query_category', '=', $category_type);
        }
		if(isset($status_type) && !empty($status_type) && $status_type !=0) 
        {
                $results->where('ori_helpdesk.query_status', '=', $status_type);
        }
               if(isset($demo) && !empty($demo)) 
        {
                $results->where('ori_helpdesk.demo', '=', $demo);
        }
		if(isset($sub_category) && !empty($sub_category)) 
        {
                $results->where('ori_helpdesk.sub_query_category', '=', $sub_category);
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
            $results->where('ori_helpdesk.created_at', '>=', $start_date.' 00:00:00')
            ->where('ori_helpdesk.created_at', '<=', $end_date.' 23:59:59');
        } 
		////////****** Help desk counts  starts ********/////////
				// master querytype array
			$qry = QueryTypes::orderBy('query_type')->where('status',config('constant.ACTIVE'))->where('type', config('constant.TICKET'))->pluck('query_type', 'id')->all();
			if(Auth::user()->cmpny_id == 32)
		        {
			  $qry = QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->where('short_code','!=',"issue")->where('short_code','!=',"measure_taken")->orderBy('sort_order')->pluck('query_type', 'id','type','short_code')->all();
			
		        }
                        $query_arr ="";
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
                  		
		 //print_r($ss);					
		   $status_arr ="";
		   foreach($ss as $values)
				{
					$key = $values->name;
					$value_d = $values->id;
					$master_status['Total'] = 'Total';
					$master_status[$value_d] = $key;
					$status_arr .=$value_d.',';
				}
				$status_arr=rtrim($status_arr,",");
			$dd = Helpdesk::select(DB::raw('count(query_type) as counts'),'ori_helpdesk.query_status','query_type')
									->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_helpdesk.customer_id')
									->whereNull('ori_customer_profiles.deleted_at')
									->where('ori_helpdesk.status',config('constant.ACTIVE'))
									->whereIn('ori_helpdesk.query_type', $query_types)
									->groupBy('ori_helpdesk.query_status')
									->groupBy('query_type')
									->orderBy('ori_helpdesk.query_status')
									->orderBy('query_type');			   
									
			if(isset($status_type) && !empty($status_type) && $status_type !=0) 
				{ 
					$lead_status1 = array($status_type);    
					$dd->whereIn('ori_helpdesk.query_status', $lead_status1);			   
				}
			
			else{
			if(isset($status_arr) && !empty($status_arr))
				{
					$lead_status1 = explode(',', $status_arr);
					$dd->whereIn('ori_helpdesk.query_status', $lead_status1);
				}
				}
			$dds=$dd->get();
		////////****** Help desk counts  starts ********/////////
		
		$list_count =   $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		foreach ($results  as $value) 
        {
            $customer_id     	= $value->customer_id;         
			$value->follo_count = Helpdesk::where('customer_id',$customer_id)
								->count();
		}

		//Helpdesk status wise summary
		$query_status_array = $ss->pluck('name','id')->all();
		$helpdesk_statuswise_stats = Helpdesk::select('query_status', DB::raw("COUNT(*) AS query_status_count"))
					->whereHas('GetCustomer')
					->groupBy('query_status')
					->get();
		$statuswise_helpdesk_count = [];
		foreach ($query_status_array as $q_status_id => $q_status_name)
		{
			$status_helpdesk_count = 0;
			$status_helpdesk = $helpdesk_statuswise_stats->where('query_status', $q_status_id)->first();
			if ($status_helpdesk)
			{
				$status_helpdesk_count = $status_helpdesk->query_status_count;
			}

			$statuswise_helpdesk_count[$q_status_name]	= $status_helpdesk_count;
		}
		
                $faq_category = FaqCategories::where('cmpny_id',Auth::user()->cmpny_id)->pluck('category_name','id')->all();
		$html 		=   view('helpdesk.listview')->with(compact('dds','escalted_test','master_querytype','master_querytype_check','master_status','results','list_count','close_status_arr','statuswise_helpdesk_count','faq_category'))->render();
		$result_arr =	array('success' => true,'html' => $html);
		
		return $result_arr;		
	}	
	/*	  
		* Get customer enquiries to popup
		* @author PRANEESHA KP
		* @date 01/11/2018
		* @since version 1.0.0
		* @param NULL
	*/
	function enquiry_listing(Request $request)
    {
        $response 		= $request->all();
        $customer_id 	= $response['follow_id'];
		if(isset($customer_id) && !empty($customer_id)){
		$results 		= Helpdesk::select('*')
                                ->where('customer_id',$customer_id)
								//->where('query_type','!=',config('constant.enq_type_Lead_Followup'))
								->orderBy('updated_at', 'DESC')
                                ->get();
		}
		return view('profile.enquiry.enquiry_list_popup', compact('results'));
    }
	 /*
     * Index page for tasks
     * @author PRANEESHA KP
	 * @author AKHIL MURUKAN
     * @date 03/11/2018
     * @since version 1.0.0
	 * @param NULL
    */
    public function taskslist(Request $request)
    {
		$query_types 	= 	['' => 'Select Type'] + QueryTypes::orderBy('query_type')
		                          ->where('type',config('constant.TICKET'))->where('status',config('constant.ACTIVE'))->pluck('query_type', 'id')->all();
							
		return view('escalate_followup.index',compact('query_types'));
    }
	/*
     * listing tasks 
     * @author PRANEESHA KP
     * @author AKHIL MURUKAN
     * @date 07/11/2018
     * @since version 1.0.0
	 * @param NULL
    */
    public function taskslist_search(Request $request)
    {
		$response           =   $request->all();   
        $query_type         =   $response['query_types'];              
		$status_type        =   $response['query_status'];  			
		$req_nxt_follow     =   $response['req_nxt_follow'];  			
        $rem_date        	=   date('Y-m-d H:i', strtotime($req_nxt_follow));
        $search_keywords    =   $response['search_keywords'];
        $esc_status         =   $response['esc_status']; 
        $user               =   Auth::User()->id;
		
		$results 	 		=   Helpdesk::select('id','docket_number','req_title','query_status',
								'query_type','customer_id','lead_source_id','priority','escalation_due_date','req_title','created_at','escalate')
								->with('GetCustomer')
								->whereHas('GetCustomer')
								//->where('escalation_status','=','1')
								//->where('escalate','!=','')
								->orderBy('ori_helpdesk.id', 'asc');
		if(Auth::User()->cmpny_id == 32){
		$results 	 		=   Helpdesk::select('id','docket_number','req_title','query_status',
								'query_type','customer_id','lead_source_id','priority','escalation_due_date','req_title','created_at','escalate')
								->with('GetCustomer')
								->whereHas('GetCustomer')
								//->where('escalation_status','=','1')
								->where('escalate',Auth::User()->id)
								->orderBy('ori_helpdesk.id', 'desc');
		}
								
        if(isset($search_keywords) && !empty($search_keywords))
        {
                $results->where(function($results) use ($search_keywords){
					$results->orWhere('query_type', 'like', '%' . $search_keywords . '%');
                    $results->orWhere('req_title', 'like', '%' . $search_keywords . '%');
                    $results->orWhere('query_status', 'like', '%' . $search_keywords . '%');
					$results->orWhereHas('GetCustomer', function($results) use($search_keywords) 
					{
						$results->where('first_name', 'like', '%' . $search_keywords . '%');
					});
				});
        }
		if(!Helpers::checkPermission('service request all list'))
		{
				$results->orWhere('escalate',$user);
				if($esc_status == 0) 
				{
					$results->orWhere('updated_by',$user);
				}
		}
		
		if(isset($query_type) && !empty($query_type))
		{
				$results->where('query_type', '=', $query_type);
		}
		if(isset($req_nxt_follow) && !empty($req_nxt_follow)) 
		{            
			//$results->whereDate('remainder_date', '=' , $rem_date);		
			$f_date        =   explode('/', $req_nxt_follow);

            if(isset($f_date[2]) && !empty($f_date[2]) && isset($f_date[1]) && !empty($f_date[1]) && isset($f_date[0]) && !empty($f_date[0]) )
            {
			$follow_date    =   $f_date[2].'-'.$f_date[1].'-'.$f_date[0];
			$follow_date    =   date('Y-m-d', strtotime($follow_date));
            }
              		
                $results->whereDate('remainder_date', '=' , $follow_date);				
		}		if(isset($status_type) && !empty($status_type))
		{
				$results->where('query_status', '=', $status_type);
		}
		if(isset($esc_status) && $esc_status !=0) 
		{                 
				$results->where('escalation_status', '=', $esc_status);
		}
		$close_status = QueryStatus::where('is_close',1)->pluck('id');
		
        foreach ($close_status as $value) {
				$close_status_arr[]	= $value;
        }
		
		////////****** Tasklist counts  starts ********/////////
		
			// master querytype array
		$qry = QueryTypes::orderBy('query_type')->where('type',config('constant.TICKET'))->where('status',config('constant.ACTIVE'))->pluck('query_type', 'id')->all();
		$query_arr ="";
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
				$value_d = $values->id;
		    	$master_status['Total'] = 'Total';
		    	$master_status[$value_d] = $key;
			}
			
		$dd = Helpdesk::select(DB::raw('count(query_type) as counts'),'ori_helpdesk.query_status','query_type')
	                        	//->with('GetCustomer')
		                        ->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_helpdesk.customer_id')
								->whereNull('ori_customer_profiles.deleted_at')
								->where('ori_helpdesk.status',config('constant.ACTIVE'))
								->whereIn('ori_helpdesk.query_type', $query_types)
								->where('ori_helpdesk.escalate','!=',0)
								->where('ori_helpdesk.escalation_status', 1)
								->groupBy('ori_helpdesk.query_status')
								->groupBy('query_type')
								->orderBy('ori_helpdesk.query_status')
								->orderBy('query_type');
		if(isset($status_type) && !empty($status_type) && $status_type !=0) 
            { 
                $lead_status1 = array($status_type);    
                $dd->whereIn('ori_helpdesk.query_status', $lead_status1);			   
            }
		if(!helpers::checkPermission('service request all list'))
				{
						$dd->Where('ori_helpdesk.escalate',$user);
				}
		$dds=$dd->get();
	    ////////****** Tasklist counts  ends ********/////////
		$list_count =   $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		
		
		foreach ($results  as $value) 
        {
				$customer_id     	= $value->customer_id;         
				$value->follo_count = Helpdesk::where('customer_id',$customer_id)
									->count();
		}
			       /***** my task *******/
		$my_task = Helpdesk::select(DB::raw('count(ori_helpdesk.query_status) as counts'),'ori_helpdesk.query_status','ori_helpdesk.query_type')
		                        ->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_helpdesk.customer_id')
								->whereNull('ori_customer_profiles.deleted_at')
								->where('ori_helpdesk.status',config('constant.ACTIVE'))
								->whereIn('ori_helpdesk.query_type', $query_types)
								->Where('ori_helpdesk.escalate',$user)
								->Where('ori_helpdesk.escalation_status', '!=', 0)
								->groupBy('ori_helpdesk.query_status')
								->groupBy('ori_helpdesk.query_type')
								->orderBy('ori_helpdesk.query_status')
								->orderBy('ori_helpdesk.query_type')
								->get();
					/***** my task end  *******/
				/***** other task *******/
		$other_task_docket_no =  HelpdeskLog::select('docket_number')
								->where('ori_helpdesk_log.status',config('constant.ACTIVE'))
								->Where('ori_helpdesk_log.escalation_status', '!=', 0)
								->Where('ori_helpdesk_log.escalate','!=',$user)
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
		$other_task=$other_task->get();
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
		
		$html 		=   view('escalate_followup.listview')->with(compact('set_re_open_category','set_closed_category_arr','my_task','other_task','esc_master_status','dds','master_querytype','master_querytype_check','master_status','results','list_count','close_status_arr'))->render();
		$result_arr =	array('success' => true,'html' => $html);
		
		return $result_arr;
		
    }

    /*
    * Initiate Helpdesk Excel Export
    * @author Rahul Raveendran
    * @date 19/02/2019
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function export(Request $request)
    {
    	$search_keywords 	= $request->post('search_keywords');
    	$query_type 		= $request->post('query_types');
    	$query_category		= $request->post('query_category');
    	$query_status 		= $request->post('query_status');
    	$start_date			= $request->post('startdate');
    	$end_date 			= $request->post('enddate');
	
    	$user_id 			= Auth::user()->id;
        $cmpny_id 			= Auth::user()->cmpny_id;
        $now 				= time();
        $file_name			= 'Helpdesk Report - '.$now.'.xlsx';
        $path='/helpdesk_report/'.$file_name;

        $data = [
            'user_id'   		=> $user_id,
            'cmpny_id'  		=> $cmpny_id,
            'file_name' 		=> urlencode($file_name),
            'search_keywords' 	=> $search_keywords,
            'query_type'		=> $query_type,
            'query_category'	=> $query_category,
            'query_status'		=> $query_status,
            'start_date'		=> $start_date,
            'end_date'			=> $end_date
        ];

        (new HelpdeskReport($data))->queue($path)->chain([
            new NotifyHelpdeskReportCompletion($data),
        ]);
    }

    public function export_disha(Request $request)
    {
    	$search_keywords 	= $request->post('search_keywords');
    	$query_type 		= $request->post('query_types');
    	$query_category		= $request->post('query_category');
    	$query_status 		= $request->post('query_status');
    	$start_date			= $request->post('startdate');
    	$end_date 			= $request->post('enddate');

    	$user_id 			= Auth::user()->id;
        $cmpny_id 			= Auth::user()->cmpny_id;
        $now 				= time();
        $file_name			= 'Helpdesk Report - '.$now.'.xlsx';
        $path='/helpdesk_report/'.$file_name;

        $data = [
            'user_id'   		=> $user_id,
            'cmpny_id'  		=> $cmpny_id,
            'file_name' 		=> urlencode($file_name),
            'search_keywords' 	=> $search_keywords,
            'query_type'		=> $query_type,
            'query_category'	=> $query_category,
            'query_status'		=> $query_status,
            'start_date'		=> $start_date,
            'end_date'			=> $end_date
        ];

        (new DishaHelpdeskReport($data))->queue($path)->chain([
            new NotifyHelpdeskReportCompletion($data),
        ]);
    }
public function export_ehealth(Request $request)
    {
    	$search_keywords 	= $request->post('search_keywords');
    	$query_type 		= $request->post('query_types');
    	$query_category		= $request->post('query_category');
    	$query_status 		= $request->post('query_status');
    	$start_date			= $request->post('startdate');
    	$end_date 			= $request->post('enddate');
	
    	$user_id 			= Auth::user()->id;
        $cmpny_id 			= Auth::user()->cmpny_id;
        $now 				= time();
        $file_name			= 'Helpdesk Report - '.$now.'.xlsx';
        $path='/helpdesk_report/'.$file_name;

        $data = [
            'user_id'   		=> $user_id,
            'cmpny_id'  		=> $cmpny_id,
            'file_name' 		=> urlencode($file_name),
            'search_keywords' 	=> $search_keywords,
            'query_type'		=> $query_type,
            'query_category'	=> $query_category,
            'query_status'		=> $query_status,
            'start_date'		=> $start_date,
            'end_date'			=> $end_date
        ];

        (new EhealthHelpdeskReport($data))->queue($path)->chain([
            new NotifyHelpdeskReportCompletion($data),
        ]);
    }

    /*
    * Download exported Helpdesk Report as Excel
    * @author Rahul Raveendran
    * @date 19/02/2019
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function download_helpdesk_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/helpdesk_report/'.$file_name);
        return response()->download($path);
    }
public function export_ehealth_task(Request $request)
    {
    	$search_keywords 	= $request->post('search_keywords');
    	$query_type 		= $request->post('query_types');
    	//$query_category		= $request->post('query_category');
    	$query_status 		= $request->post('query_status');
    	//$start_date			= $request->post('startdate');
    	//$end_date 			= $request->post('enddate');
	
    	$user_id 			= Auth::user()->id;
        $cmpny_id 			= Auth::user()->cmpny_id;
        $now 				= time();
        $file_name			= 'Helpdesk Report - '.$now.'.xlsx';
        $path='/helpdesk_report/'.$file_name;

        $data = [
            'user_id'   		=> $user_id,
            'cmpny_id'  		=> $cmpny_id,
            'file_name' 		=> urlencode($file_name),
            'search_keywords' 	=> $search_keywords,
            'query_type'		=> $query_type,
            
            'query_status'		=> $query_status
           
        ];

        (new EhealthtaskkReport($data))->queue($path)->chain([
            new NotifytaskReportCompletion($data),
        ]);
    }

}	
