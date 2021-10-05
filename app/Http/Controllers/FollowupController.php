<?php

namespace App\Http\Controllers;
use App\Exports\FollowupReport;
use App\Helpdesk;
use App\HelpdeskLog;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\Jobs\NotifyFollowupReportCompletion;
use App\LeadFollowup;
use App\LeadFollowupLog;
use App\QueryStatus;
use App\QueryStatusRelation;
use App\QueryTypes;
use Auth;
use DB;
use Illuminate\Http\Request;

class FollowupController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:followup view',   ['only' => ['index','search_list','get_helpdesk','helpdesk_more_details']]);
	   $this->middleware('check-permission:escalated to',   ['only' => ['taskslist','taskslist_search']]);
    }
	/*
    * LeadFollowup
    * @author PRANEESHA KP
	* @author AKHIL MURUKAN
    * @date 17/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return followups index page
    */
	public function index()
    {
		$query_types 	= 	['' => 'Select Type'] + QueryTypes::orderBy('query_type')
							->where('status',config('constant.ACTIVE'))
							->where('type',config('constant.FOLLOWUPS'))
							->pluck('query_type', 'id')->all();
		$today = "";						
		return view('followups.index', compact('query_types','today'));
    }
			
	/*
    * LeadFollowup Listing 
    * @author PRANEESHA KP
	* @author AKHIL MURUKAN
    * @date 17/10/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
		$query_type         =   $response['query_types'];         
        $category_type      =   $response['query_category'];         
        $status_type        =   $response['query_status'];         
        $start_date         =   $response['startdate'];
        $end_date           =   $response['enddate'];
        $todayfollowup           =   $response['todayfollowup'];
		$results 			= 	array();	
        $results 	 		=   LeadFollowup::select('id','docket_number','req_title','query_status',
								'query_type','customer_id','lead_source_id','priority')
								->with('GetCustomer')
								->whereHas('GetCustomer')
								->orderBy('ori_lead_followups.id', 'asc');
	if(isset($todayfollowup) && !empty($todayfollowup) && $todayfollowup !=0) 
        {
               	
				$user = Auth::User()->id;
            
                $req_nxt_follow = date('d-m-Y', time());   
                $date_follow          =   date("Y-m-d", strtotime($req_nxt_follow)); 
                $results->where('ori_lead_followups.remainder_date','like', '%' . $date_follow . '%');
			
                     if( helpers::checkPermission('todays followup dashboard'))
                    {
                       $results->where('ori_lead_followups.updated_by',$user);
                    } 
                    else{
                        $results->where('ori_lead_followups.escalate',$user);

                    }
        }	
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
                $results->where('ori_lead_followups.query_type', '=', $query_type);
        } 
		if(isset($category_type) && !empty($category_type)) 
        {
                $results->where('ori_lead_followups.query_category', '=', $category_type);
        }
		if(isset($status_type) && !empty($status_type) && $status_type !=0) 
        {
                $results->where('ori_lead_followups.query_status', '=', $status_type);
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
            $results->where('ori_lead_followups.created_at', '>=', $start_date.' 00:00:00')
            ->where('ori_lead_followups.created_at', '<=', $end_date.' 23:59:59');
        } 
		////////****** Help desk counts  starts ********/////////
				// master querytype array
			$qry = QueryTypes::orderBy('query_type')->where('status',config('constant.ACTIVE'))->where('type', config('constant.FOLLOWUPS'))->pluck('query_type', 'id')->all();
			$query_arr ="";
			$query_types	= array();
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
			$dd = LeadFollowup::select(DB::raw('count(query_type) as counts'),'ori_lead_followups.query_status','query_type')
									->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_lead_followups.customer_id')
									->whereNull('ori_customer_profiles.deleted_at')
									->where('ori_lead_followups.status',config('constant.ACTIVE'))
									->whereIn('ori_lead_followups.query_type', $query_types)
									->groupBy('ori_lead_followups.query_status')
									->groupBy('query_type')
									->orderBy('ori_lead_followups.query_status')
									->orderBy('query_type');			   
									
			if(isset($status_type) && !empty($status_type) && $status_type !=0) 
				{ 
					$lead_status1 = array($status_type);    
					$dd->whereIn('ori_lead_followups.query_status', $lead_status1);			   
				}
			
			else{
			if(isset($status_arr) && !empty($status_arr))
				{
					$lead_status1 = explode(',', $status_arr);
					$dd->whereIn('ori_lead_followups.query_status', $lead_status1);
				}
				}
			$dds=$dd->get();
		////////****** Help desk counts  starts ********/////////
		
		$list_count =   $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		foreach ($results  as $value) 
        {
            $customer_id     	= $value->customer_id;         
			$value->follo_count = LeadFollowup::where('customer_id',$customer_id)
								->count();
		}
		$html 		=   view('followups.listview')->with(compact('dds','master_querytype','master_querytype_check','master_status','results','list_count','close_status_arr'))->render();
		$result_arr =	array('success' => true,'html' => $html);
		
		return $result_arr;		
	}
        public function todayfollowup()
	{
		$query_types 	= 	['' => 'Select Type'] + QueryTypes::orderBy('query_type')
							->where('status',config('constant.ACTIVE'))
							->where('type',config('constant.FOLLOWUPS'))
							->pluck('query_type', 'id')->all();
		$today = 1;					
		return view('followups.index', compact('query_types','today'));
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
		$results 		= LeadFollowup::select('*')
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
        $rem_date        	=   date('Y-m-d', strtotime($req_nxt_follow));
        $search_keywords    =   $response['search_keywords'];
        $esc_status         =   $response['esc_status']; 
        $user               =   Auth::User()->id;
		
		$results 	 		=   LeadFollowup::select('id','docket_number','req_title','query_status',
								'query_type','customer_id','lead_source_id','priority','escalation_due_date','req_title','created_at','escalate')
								->with('GetCustomer')
								->whereHas('GetCustomer')
								//->where('escalation_status','=','1')
								//->where('escalate','!=','')
								->orderBy('ori_lead_followups.id', 'asc');
								
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
				$results->whereDate('remainder_date', '=' , $rem_date);                    
		}
		if(isset($status_type) && !empty($status_type))
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
			
		$dd = LeadFollowup::select(DB::raw('count(query_type) as counts'),'ori_lead_followups.query_status','query_type')
	                        	//->with('GetCustomer')
		                         ->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_lead_followups.customer_id')
								->whereNull('ori_customer_profiles.deleted_at')
								->where('ori_lead_followups.status',config('constant.ACTIVE'))
								->whereIn('ori_lead_followups.query_type', $query_types)
								->where('ori_lead_followups.escalate','!=',0)
								->where('ori_lead_followups.escalation_status', 1)
								->groupBy('ori_lead_followups.query_status')
								->groupBy('query_type')
								->orderBy('ori_lead_followups.query_status')
								->orderBy('query_type');
		if(isset($status_type) && !empty($status_type) && $status_type !=0) 
            { 
                $lead_status1 = array($status_type);    
                $dd->whereIn('ori_lead_followups.query_status', $lead_status1);			   
            }
		if(!helpers::checkPermission('service request all list'))
				{
						$dd->Where('ori_lead_followups.escalate',$user);
				}
		$dds=$dd->get();
	    ////////****** Tasklist counts  ends ********/////////
		
		$list_count =   $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		
		
		foreach ($results  as $value) 
        {
				$customer_id     	= $value->customer_id;         
				$value->follo_count = LeadFollowup::where('customer_id',$customer_id)
									->count();
		}
		$html 		=   view('escalate_followup.listview')->with(compact('dds','master_querytype','master_querytype_check','master_status','results','list_count','close_status_arr'))->render();
		$result_arr =	array('success' => true,'html' => $html);
		
		return $result_arr;
		
    }

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
        $file_name			= 'Followup Report - '.$now.'.xlsx';
        $path='/followup_report/'.$file_name;

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

        (new FollowupReport($data))->queue($path)->chain([
            new NotifyFollowupReportCompletion($data),
        ]);
    }

    /*
    * Download exported Followup Report as Excel
    * @author Rahul Raveendran
    * @date 22/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return excel
    */
    public function download_followup_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/followup_report/'.$file_name);
        return response()->download($path);
    }
}	
