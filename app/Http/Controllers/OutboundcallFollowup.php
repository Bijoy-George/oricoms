<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRole;
use DB;
use App\LeadSources;
use App\CustomerProfile;
use App\User; 
use App\LeadFollowup; 
use App\LeadStatus; 
use App\BatchProcess; 
use Auth;
use App\QueryStatusRelation;
use App\Jobs\Outboundcalls_batchwise_insertion;
use App\CronLog;
use App\Priority;
use App\QueryTypes;
use App\Helpers;
use Carbon\Carbon;

class OutboundcallFollowup extends Controller
{
    /**
    * outbound call Controller
    * @author AKHIL MURUKAN
    * @date 28/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return 
   */ 
	
     public function __construct()
    {
        $this->middleware('auth');
       
    }
        /**
    * get_moutbound followups
    * @author AKHIL MURUKAN
    * @date 28/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Outbound call page
   */ 

     public function listing($leadsource=null)
    {
		
        $leads=array();
		$agent_list     = array();
        $cus_lead_source   = LeadSources::where('cmpny_id',Auth::user()->cmpny_id)->pluck('name', 'id')->all();
		
		$agent = Helpers::get_company_meta('agent');
		if(isset($agent) && !empty($agent))
		{
			$agent_list     = User::where('cmpny_id',Auth::user()->cmpny_id)
									//->where('role_id',$agent)
									->where('role_id','like','%:"' . $agent . '";%')
									->where('deleted_at',null)->get();	
		}
        $leadstatus='';
        $process_count = BatchProcess::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.INACTIVE'))->where('cmpny_id',Auth::user()->cmpny_id)->where('process_type',config('constant.ASSIGN_FOLLOWUP'))->count(); //cantact_grp_status
    	
		$query_types = ['' => 'Select Category'] +QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('sort_order')->pluck('query_type', 'id')->all();
		$priority_type = ['' => 'Select Priority'] + Priority::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('sort_order')->pluck('name', 'id')->all();

		 
        return view('outboundcall.index', compact('query_types','priority_type','process_count','leads','cus_lead_source','leadsource','leadstatus','agent_list'));
    }   
       /**
    * get_moutbound followups
    * @author AKHIL MURUKAN
    * @date 28/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Outbound call page
   */ 
     public function outboundcall_followup_list(Request $request)
    {
        $response           =   $request->all();
        $page               =   $response['page'];            
        $query_types        =   $response['query_types'];     
        $query_status       =   $response['query_status'];     
        $search_keywords    =   $response['search_keywords'];
        $query_category     =   $response['query_category'];
        $agent_id           =   $response['agent_id'];
        $call_status        =   $response['call_status']; 
        $priority_type      =   $response['priority_type'];  
        $profile            =  array();
        $followups          =  array();
        $results            =  LeadFollowup::select('ori_mast_query_status.name as status_name','ori_users.name as agent_name','ori_lead_followups.*','ori_customer_profiles.id as profile_id', 'ori_customer_profiles.first_name', 'ori_customer_profiles.middle_name','ori_customer_profiles.last_name','ori_customer_profiles.mobile','ori_customer_profiles.email')
                               ->leftjoin('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_lead_followups.customer_id')
                               ->leftjoin('ori_users', 'ori_users.id', '=', 'ori_lead_followups.assigned_agent')
                               ->leftjoin('ori_mast_query_status', 'ori_mast_query_status.id', '=', 'ori_lead_followups.query_status')
                                ->orderBy('ori_lead_followups.updated_at', 'desc');
         $results->where('ori_customer_profiles.status','1');
         $results->where('ori_customer_profiles.deleted_at', '=', Null);
         $results->where('ori_lead_followups.status','1');
         $results->where('ori_lead_followups.deleted_at', '=', Null);
         $results->where('ori_lead_followups.outbound_calls',config('constant.MANUAL_OUTBOUND_CALLS'));
         if(isset($query_types) && !empty($query_types) && $query_types != '0') 
            {
                
                $results->where('ori_lead_followups.query_type', '=', $query_types);
                
            }
            if(isset($query_category) && !empty($query_category) && $query_category != '0') 
            {
                
                $results->where('ori_lead_followups.query_category', '=', $query_category);
                
            }
             if(isset($agent_id) && !empty($agent_id) && $agent_id != '0') 
            {
                
                $results->where('ori_lead_followups.assigned_agent', '=', $agent_id);
                
            }
            if(isset($call_status) && !empty($call_status) && $call_status != '0') 
            {
                if($call_status == 1)
                {
                    $results->Where('ori_lead_followups.assigned_agent','=',0);
                }
                if($call_status == 2)
                {
                    $results->Where('ori_lead_followups.assigned_agent','!=',0);
                }
               
                
            }
        if(isset($query_status) && !empty($query_status) && $query_status != '0') 
            {
                
                $results->where('ori_lead_followups.query_status', '=', $query_status);
                
            }
        if(isset($priority_type) && !empty($priority_type) && $priority_type != '0') 
            {
                
                $results->where('ori_lead_followups.priority', '=', $priority_type);
                
            }
        if(isset($search_keywords) && !empty($search_keywords)) 
            {
              $results->where(function($results) use ($search_keywords){
                $results->orWhere('first_name', 'like', '%' . $search_keywords . '%');
                $results->orWhere('ori_lead_followups.id', 'like', '%' . $search_keywords . '%');
                $results->orWhere('short_message', 'like', '%' . $search_keywords . '%');
                $results->orWhere('req_title', 'like', '%' . $search_keywords . '%');
                $results->orWhere('todo', 'like', '%' . $search_keywords . '%');
              });
            }                       
        $followups            = $results->paginate(config('constant.pagination_constant'));
        $list_count          = $results->count();                 
        
    $cus_lead_source  = LeadSources::where('cmpny_id',Auth::user()->cmpny_id)->pluck('name', 'id')->all();

  /*  $ss =array('Call back Request'=>config('constant.Call_back_mobile'),'Manual Call'=>config('constant.Manual_Call'));
                    foreach($ss as $key => $value)
                    {                                       
                    $all_call_his['open'][$key] = cc_lead_followup::where('status',config('constant.ACTIVE'))
                        ->where('query_type',config('constant.enq_type_Lead_Followup'))
                        ->where('query_category',$value)
                        ->where('lead_status',config('constant.status_type_open'))->count();
                    $all_call_his['Processing'][$key] = cc_lead_followup::where('status',config('constant.ACTIVE'))
                        ->where('query_type',config('constant.enq_type_Lead_Followup'))
                        ->where('query_category',$value)
                        ->where('lead_status',config('constant.status_type_processing'))->count();
                    $all_call_his['closed'][$key] = cc_lead_followup::where('status',config('constant.ACTIVE'))
                    ->where('query_category',$value)
                        ->where('query_type',config('constant.enq_type_Lead_Followup'))
                        ->where('lead_status',config('constant.status_type_closed'))->count();
                    if($value == config('constant.Call_back_mobile') || $value == config('constant.Manual_Call')){
                        $all_call_his['not assigned'][$key] = cc_lead_followup::where('query_type',config('constant.enq_type_Lead_Followup'))
                        ->where('query_category',$value)
                        ->where('assigned_agent',0)->count();
                    }else{
                    $all_call_his['not assigned'][$key] = afterhourcall::where('type',$key)
                        ->whereNull('followpid')
                        ->where('assigned_agent',0)->count();
                    }
                    $all_call_his['total'][$key] = $all_call_his['open'][$key] + $all_call_his['Processing'][$key] + $all_call_his['closed'][$key] +$all_call_his['not assigned'][$key];
                    }*/

   
		$html = view('outboundcall.list')->with(compact('followups','list_count','cus_lead_source','agents','all_call_his'))->render();
		$result_arr = array('success' => true,'html' => $html);
		return json_encode($result_arr);


   }  



   /**
    * get outbound followups agent
    * @author AKHIL MURUKAN
    * @date 12/05/2018
    * @since version 1.0.0
    * @param NULL
    * @return Outbound call page
   */ 

     public function agent_followups($leadsource=null)
    {
         $leads=array();
         $cus_lead_source     = LeadSources::where('cmpny_id',Auth::user()->cmpny_id)->pluck('name', 'id')->all();
         $results             = CustomerProfile::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('id', 'desc');
         $agent_list          = array();
		 $agent = Helpers::get_company_meta('agent');
			if(isset($agent) && !empty($agent))
			{
				$agent_list     = User::where('cmpny_id',Auth::user()->cmpny_id)
				                       //->where('role_id',$agent)
									   ->where('role_id','like','%:"' . $agent . '";%')
									   ->where('deleted_at',null)->get();	
			}
         $leadstatus          =  '';
         $l_count             = $results->count();
		 $query_types = QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('sort_order')->pluck('query_type', 'id')->all();
		 $priority_type = Priority::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('sort_order')->pluck('name', 'id')->all();

         return view('outboundcall.agent_index', compact('query_types','priority_type','leads','cus_lead_source','leadsource','leadstatus','l_count','agent_list'));
    } 

	    /**
    * get_moutbound followups
    * @author AKHIL MURUKAN
    * @date 12/05/2018
    * @since version 1.0.0
    * @param NULL
    * @return Outbound call page
   */ 
     public function agent_followups_list(Request $request)
    {
        $userid             =     Auth::User()->id;
        $response           =   $request->all();
        $page               =   $response['page'];            
        $query_type         =   $response['query_types'];     
        $query_status       =   $response['query_status'];     
        $search_keywords    =   $response['search_keywords'];
        $query_category     =   $response['query_category'];
        $remainder_date     =   $response['remainder_date'];
        $priority_type      =   $response['priority_type']; 
        $profile            =  array();
        $followups          =  array();
        $results            = LeadFollowup::select('ori_mast_query_status.name as status_name','ori_users.name as agent_name','ori_lead_followups.*','ori_customer_profiles.id as profile_id', 'ori_customer_profiles.first_name', 'ori_customer_profiles.middle_name','ori_customer_profiles.last_name','ori_customer_profiles.mobile','ori_customer_profiles.email')
                               ->leftjoin('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_lead_followups.customer_id')
                               ->leftjoin('ori_users', 'ori_users.id', '=', 'ori_lead_followups.assigned_agent')
                               ->leftjoin('ori_mast_query_status', 'ori_mast_query_status.id', '=', 'ori_lead_followups.query_status')
                                ->orderBy('ori_lead_followups.updated_at', 'desc');
         $results->where('ori_customer_profiles.status','1');
         $results->where('ori_customer_profiles.deleted_at', '=', Null);
         $results->where('ori_lead_followups.status','1');
         $results->where('ori_lead_followups.deleted_at', '=', Null);
    //     $results->where('ori_lead_followups.outbound_calls',config('constant.MANUAL_OUTBOUND_CALLS'));
         $results->where('ori_lead_followups.assigned_agent',$userid);
         if(isset($query_type) && !empty($query_type) && $query_type != '0') 
            {
                
                $results->where('ori_lead_followups.query_type', '=', $query_type);
                
            }
            if(isset($query_category) && !empty($query_category) && $query_category != '0') 
            {
                
                $results->where('ori_lead_followups.query_category', '=', $query_category);
                
            }
            if(isset($call_status) && !empty($call_status) && $call_status != '0') 
            {
                
                $results->where('ori_lead_followups.call_status', '=', $call_status);
                
            }
            if(isset($priority_type) && !empty($priority_type) && $priority_type != '0') 
            {
                
                $results->where('ori_lead_followups.priority', '=', $priority_type);
                
            }
        if(isset($query_status) && !empty($query_status) && $query_status != '0') 
            {
                
                $results->where('ori_lead_followups.lead_status', '=', $query_status);
                
            }
           if(isset($remainder_date) && !empty($remainder_date)) 
            {
               
                $date_format       =   explode('/', $remainder_date);
                     if(isset($date_format[2]) && !empty($date_format[2]) && isset($date_format[1]) && !empty($date_format[1]) && isset($date_format[0]) && !empty($date_format[0]) )
                     {
                        $today_date=date('Y-m-d');
                        $dob1    =   $date_format[2].'-'.$date_format[1].'-'.$date_format[0];
                        $remainder_date     =   date('Y-m-d', strtotime($dob1)); 
                      }else{
                        $remainder_date='';
                      }
                $results->Where('remainder_date', 'like', '%' .$remainder_date. '%');
                
            }
        if(isset($search_keywords) && !empty($search_keywords)) 
            {
              $results->where(function($results) use ($search_keywords){
                $results->orWhere('first_name', 'like', '%' . $search_keywords . '%');
                $results->orWhere('ori_lead_followups.id', 'like', '%' . $search_keywords . '%');
                $results->orWhere('short_message', 'like', '%' . $search_keywords . '%');
                $results->orWhere('req_title', 'like', '%' . $search_keywords . '%');
                $results->orWhere('todo', 'like', '%' . $search_keywords . '%');
              });
            }                       
        $followups            = $results->paginate(config('constant.pagination_constant'));
        $l_count          = $results->count();                 
        
  //  $cus_lead_source  = cc_lead_source::all('name', 'id');
   // return view('outboundcall.agent_list',compact('followups','l_count','cus_lead_source','agents'));
	$cus_lead_source     = LeadSources::where('cmpny_id',Auth::user()->cmpny_id)->pluck('name', 'id')->all();
        
		$html = view('outboundcall.agent_list')->with(compact('followups','l_count','cus_lead_source','agents'))->render();
		$result_arr = array('success' => true,'html' => $html);
		return json_encode($result_arr);
    } 


	
	
}