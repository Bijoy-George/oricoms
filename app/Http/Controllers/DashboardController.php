<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\CmpSubscriptions;
use App\CustomerProfile;
use App\FaqCategories;
use App\Feedback;
use App\FeedbackDetail;
use App\Helpdesk;
use App\Helpers;
use App\LeadFollowup;
use App\QueryStatus;
use App\QueryStatusRelation;
use App\QueryTypes;
use App\EmailFetch;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use App\Server;
use App\Service;
use App\ServerService;
use App\Serverresource;
use Illuminate\Http\Request;
use Artisan;
use Redirect;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function cache_clear()
    {  
		Artisan::call('cache:clear');
		Artisan::call('view:clear');
		Artisan::call('config:cache');
		Artisan::call('config:clear');
		Artisan::call('route:clear');
		return Redirect::back()->withErrors(['msg', 'Cache clear successfully']);
	}
	public function dismiss_pop_sbcr_exp()
    {  
		session(['sbcrptn_exp_pop_dismiss'=>1]);
	}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$ann_start_dt = Carbon::now()->subDays(30)->format('d/m/Y'); 
        $ann_end_dt = Carbon::now()->format('d/m/Y');
		$totallead = CustomerProfile::where('profile_status', config('constant.LEAD'))->count();
		$totalcustomer = CustomerProfile::where('profile_status', config('constant.CUSTOMER'))->count();
		
		$last_sbcr	=array();
		$sbcr_expired		= "";
		$cmpny_id 			= Auth::User()->cmpny_id;
		$sbcryptn_status	= config('constant.SUBSCRIPTION_STATUS');
		$cur_date		 	= Carbon::now();
		$exp_period			= $cur_date->copy()->addDays(config('constant.SBCR_EXPIRE_NOTIFICATION_PERIOD'));
		if(isset($cmpny_id))
		{
			$last_sbcr = CmpSubscriptions::select('id','extended_expiry_date')
									->where('cmpny_id',$cmpny_id)
									->where('status',$sbcryptn_status[1])
									->whereDate('extended_expiry_date','>',$cur_date)
									->whereDate('extended_expiry_date','<',$exp_period)
									->orderBy('id', 'desc')
									->first();
									
									
			$date = new Carbon($last_sbcr['extended_expiry_date']);
			$sbcr_expired = $cur_date->diffInDays($date);
			
			//$interval = $cur_date->diff($date);
			//$sbcr_expired = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
			
		}

		//Dashboard Counts
		$total_leads_count	= CustomerProfile::where('cmpny_id',Auth::User()->cmpny_id)->count();
		$campaign_count	= Campaign::count();
		$open_leads_count	= CustomerProfile::where('cmpny_id',Auth::User()->cmpny_id)->where('ori_customer_profiles.profile_status', '!=' , config('constant.CUSTOMER'))->count();
		$open_leads_count = CustomerProfile::where('cmpny_id',Auth::User()->cmpny_id)
								->where(function($query) {
									return $query->where('ori_customer_profiles.profile_status', '!=' , config('constant.CUSTOMER'))
												->orWhereNull('ori_customer_profiles.profile_status');
								})->count();
		$converted_leads_count	= CustomerProfile::where('cmpny_id',Auth::User()->cmpny_id)->where('ori_customer_profiles.profile_status', config('constant.CUSTOMER'))->count();
		$total_email   =   EmailFetch::select(DB::raw('count(*) as total'))
					->where('cmpny_id',Auth::User()->cmpny_id)
					->where('email_id', '!=', '0')
                    ->groupBy('thread_id')->get();
        $total_email=count($total_email);
		$unread_count   =   EmailFetch::select(DB::raw('count(*) as total'))
	                ->where('cmpny_id',Auth::User()->cmpny_id)
                    ->where('email_id', '!=', '0')
                    ->where('read_status', '=', '0')
                    ->groupBy('thread_id')->get();
        $unread_count=count($unread_count);
		
		$open_status = Helpers::get_company_meta('open_status');
		$open_ticket_count	= Helpdesk::where('cmpny_id',Auth::User()->cmpny_id)->where('query_status', $open_status)->whereHas('GetCustomer')->count();
		
		$close_status = QueryStatus::where('cmpny_id',Auth::user()->cmpny_id)->where('is_close', 1)->pluck('id')->all();
		$closed_ticket_count	= Helpdesk::where('cmpny_id',Auth::User()->cmpny_id)->whereIn('query_status', $close_status)->whereHas('GetCustomer')->count();
		
		$processing_status = QueryStatus::where('cmpny_id',Auth::user()->cmpny_id)->where('is_close', 1)->pluck('id')->all();
		array_push($processing_status, $open_status);
		$processing_ticket_count	= Helpdesk::where('cmpny_id',Auth::User()->cmpny_id)->whereNotIn('query_status', $processing_status)->whereHas('GetCustomer')->count();
		if(Auth::User()->cmpny_id == 32)
		{
			if(Auth::User()->id == 298)
			{
			$processing_ticket_count	= Helpdesk::where('cmpny_id',Auth::User()->cmpny_id)->where('query_status', 97)->count();
			$closed_ticket_count	= Helpdesk::where('cmpny_id',Auth::User()->cmpny_id)->where('query_status', 96)->count();
			$open_ticket_count	= Helpdesk::where('cmpny_id',Auth::User()->cmpny_id)->where('query_status', 95)->count();
			}else{
			$processing_ticket_count	= Helpdesk::where('cmpny_id',Auth::User()->cmpny_id)->where('query_status', 97)->where('escalate', Auth::User()->id)->count();
			$closed_ticket_count	= Helpdesk::where('cmpny_id',Auth::User()->cmpny_id)->where('query_status', 96)->where('escalate', Auth::User()->id)->count();
			$open_ticket_count	= Helpdesk::where('cmpny_id',Auth::User()->cmpny_id)->where('query_status', 95)->where('escalate', Auth::User()->id)->count();

				}

		}
		return view('dashboard.dashboard', compact('ann_start_dt','ann_end_dt','totallead','totalcustomer','sbcr_expired','campaign_count','total_leads_count','open_leads_count', 'converted_leads_count','total_email','unread_count','open_ticket_count','processing_ticket_count','closed_ticket_count'));
    }
	
	public function dashboardGraph(Request $request) {
		$response           =   $request->all();
		
		$ann_start_dt = str_replace("/","-",$response['ann_start_date']);
        $ann_end_dt = str_replace("/","-",$response['ann_end_date']);
        $ann_start_dt = date("Y-m-d", strtotime($ann_start_dt));
        $ann_end_dt = date('Y-m-d',strtotime($ann_end_dt));

		$resource = Serverresource::with('getresources');
		// dd(count($resource));
		$resource = $resource->paginate(4);
	// 	foreach ($resource as  $value) 
	// {
	// 		$server_id = $value->getresources->id;
	// 		$time = $value->created_at;
	// 		$resource1 = $value->resource1;
	// 		$resource2 = $value->resource2;
	// 		$resource3 = unserialize($value->resource3);
	// 		$server_name = $value->getresources->server_name;
	// 		$threshold_resource1 = $value->getresources->threshold_resource1;
	// 		$threshold_resource2 = $value->getresources->threshold_resource2;
	// 		$threshold_resource3 = $value->getresources->threshold_resource3;

	// 	// dd($resource3[0]['used']);
	// 	if ($resource1 > $threshold_resource1) 
	// 	{
	// 	$resource1_alert[] = $resource1;
	// 	$threshold_resource1_alert[] = $threshold_resource1;
	// 	$time_alert[] = $time;
	// 	$server_name_alert[] = $server_name;
	//     }
	// }

		////////****** Help desk && Escalation counts Common code starts ********/////////
				// master querytype array
			$qry = QueryTypes::orderBy('query_type')->where('status',config('constant.ACTIVE'))->pluck('query_type', 'id')->all();
			$query_arr ="";
			$query_types =array();
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
			if(isset($query_arr) && !empty($query_arr))
			{
				$query_arr_status1 = explode(',', $query_arr);
				$query_types = $query_arr_status1;
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
			////////****** Help desk && Escalation counts Common code end ********/////////
					////////****** Help desk counts  starts ********/////////
			$helpdesk_status_details =array();
			if(helpers::checkPermission('escalation summary chart'))
			{
				$helpdesk_status = Helpdesk::select(DB::raw('count(query_type) as counts'),'ori_helpdesk.query_status','query_type')
										->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_helpdesk.customer_id')
										->whereNull('ori_customer_profiles.deleted_at')
										->where('ori_helpdesk.status',config('constant.ACTIVE'))
										->whereIn('ori_helpdesk.query_type', $query_types)
										->groupBy('ori_helpdesk.query_status')
										->groupBy('query_type')
										->orderBy('ori_helpdesk.query_status')
										->orderBy('query_type');			   				
				if(isset($status_arr) && !empty($status_arr))
					{
						$lead_status1 = explode(',', $status_arr);
						$helpdesk_status->whereIn('ori_helpdesk.query_status', $lead_status1);
					}
				$helpdesk_status_details=$helpdesk_status->get();
			}
		     ////////****** Help desk counts  starts ********/////////	
			 ////////****** Escalation counts  starts ********/////////
			$escalation_status_details =array();
			$user               =   Auth::User()->id;
			if(helpers::checkPermission('escalation summary chart'))
			{
				$escalation_det = Helpdesk::select(DB::raw('count(query_type) as counts'),'ori_helpdesk.query_status','query_type')
										->join('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_helpdesk.customer_id')
										->whereNull('ori_customer_profiles.deleted_at')
										->where('ori_helpdesk.status',config('constant.ACTIVE'))
										->whereIn('ori_helpdesk.query_type', $query_types)
										->where('ori_helpdesk.escalate','!=',0)
								    	->where('ori_helpdesk.escalation_status',1)
										->groupBy('ori_helpdesk.query_status')
										->groupBy('query_type')
										->orderBy('ori_helpdesk.query_status')
										->orderBy('query_type');			   				
								if(!helpers::checkPermission('service request all list'))
								{
										$escalation_det->Where('ori_helpdesk.escalate',$user);
								}
				$escalation_status_details=$escalation_det->get();
			}
		     ////////****** Escalation counts  starts ********/////////
		
			
		// Call Summary Start
		if(Helpers::checkPermission('call summary chart'))
		{
			//$ss =array('after hour'=>config('constant.AFTER_HOUR_CALL'),'abandoned'=>config('constant.ABANDONED_CALL'),'holiday'=>config('constant.HOLIDAY_CALL'),'Call back Request'=>config('constant.CALL_BACK_MOBILE'),'Manual Call'=>config('constant.MANUAL_CALL'));
			$ss = FaqCategories::where('cmpny_id',Auth::user()->cmpny_id)->where('type', config('constant.CALL'))->orderBy('category_name')->pluck('id', 'category_name')->all();
			$followup_query_types = QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('type', config('constant.FOLLOWUPS'))->orderBy('query_type')->pluck('id')->all();
            foreach($ss as $key => $value)
            {         
				$query_status = QueryStatus::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('id')->pluck('id', 'name')->all();
				foreach($query_status as $key1 => $status)
				{
					$all_call_his[$key1][$key] = LeadFollowup::where('status',config('constant.ACTIVE'))
						->whereIn('query_type', $followup_query_types)
						->where('query_category',$value)
						->where('query_status',config('constant.status_type_open'))->count();
				}
				
                /*if($value == config('constant.Call_back_mobile') || $value == config('constant.Manual_Call'))
				{
                    $all_call_his['not assigned'][$key] = LeadFollowup::where('query_type',config('constant.enq_type_Lead_Followup'))
                        ->where('query_category',$value)
                        ->where('assigned_agent',0)->count();
                }
				else{
                    $all_call_his['not assigned'][$key] = afterhourcall::where('type',$key)
                        ->whereNull('followpid')
                        ->where('assigned_agent',0)->count();
                }*/
                $all_call_his['total'][$key] = $all_call_his['Open'][$key] + $all_call_his['Processing'][$key] + $all_call_his['Closed'][$key];
            }
		}
		// Call Summary End 
		
		
		
		// Feedback Graph Start
		$fb_graph=array();
        if(Helpers::checkPermission('feedback settings'))
        {  
            $fb_pie ='';
            $data = '';
            $drill_feedback='';
                                        
            $fb_arr=['1'=>'SMS','2'=>'EMAIL','10'=>'CHAT'];
            //config('constant.FB_TYPE');
            $total_fb_count = 0;
            foreach ($fb_arr as $fb_key => $fb_value)
            {
                $count_type=0;
                       
				$count_type           =   FeedbackDetail::where('fb_type', $fb_key)->where('status',config('constant.ACTIVE'))->count();
                       
                $data .="{name:'".$fb_value."',y:".$count_type.",drilldown:'".$fb_value."'},";

                $rating_arr=['5'=>'Excellent','4'=>'Good','3'=>'Average','2'=>'Bad','1'=>'Very Bad','0'=>'No Rating'];
                $drill_feedback.="{name:'".$fb_value."',id:'".$fb_value."',data:[";
                foreach ($rating_arr as $rating_key => $rating_val) {
                    $fb_type_cnt           =   FeedbackDetail::where('fb_type',$fb_key)->where('rating',$rating_key)->where('status',config('constant.ACTIVE'))->count();
                    $drill_feedback.="['".$rating_val."',".$fb_type_cnt."],";
                    $total_fb_count = $total_fb_count + $fb_type_cnt;
                }
                $drill_feedback = rtrim($drill_feedback,",");
                $drill_feedback.="]},";
			}
            $fb_pie = rtrim($data,",");
            $fb_drilldown = rtrim($drill_feedback,",");           
            $fb_graph['fb_pie']= $fb_pie;
            $fb_graph['fb_drilldown']= $fb_drilldown;
            $fb_graph['total_fb_count1']=$total_fb_count;
        }

        $cmpny_query_types = QueryTypes::select('ori_mast_query_type.id', 'ori_mast_query_type.query_type')
                            ->where('ori_mast_query_type.status', config('constant.ACTIVE'))
                            ->pluck('query_type', 'id')
                            ->all();
		// Feedback Graph End 

		/* Today's Followup start  */   
            $user = Auth::User()->id;
            $followup_all_count = 0;
                date_default_timezone_set('Asia/Kolkata'); 
                $req_nxt_follow = date('d-m-Y', time());   
                $date_follow          =   date("Y-m-d", strtotime($req_nxt_follow));  
                $followup =array();
                /*if( helpers::checkPermission('todays followup dashboard'))
                {*/
                    /*$result    = DB::table('ori_lead_followups')
                                    ->leftjoin('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_lead_followups.customer_id')
                                    ->select('ori_lead_followups.customer_id','ori_lead_followups.remainder_date','ori_lead_followups.status','ori_lead_followups.deleted_at','ori_lead_followups.updated_by', 'ori_customer_profiles.first_name', 'ori_customer_profiles.last_name', 'ori_customer_profiles.mobile_number')
                                   // ->where('ori_lead_followups.remainder_date','like', '%' . $date_follow . '%')
                                    ->where('ori_customer_profiles.status','1')
                                    ->where('ori_customer_profiles.deleted_at', '=', Null)
                                    ->where('ori_lead_followups.status','1')
                                    ->where('ori_lead_followups.deleted_at', '=', Null);*/
                    $result = LeadFollowup::select('id','docket_number','req_title','query_status',
								'query_type','customer_id','lead_source_id','priority')
								->with('GetCustomer')
								->whereHas('GetCustomer')
								->orderBy('ori_lead_followups.id', 'asc');
					
                    if( helpers::checkPermission('todays followup dashboard'))
                    {
                      // $result->where('ori_lead_followups.updated_by',$user);
                    } 
                    else{
                       // $result->where('ori_lead_followups.escalate',$user);

                    }
                    $followup_all_count = $result->count(); 
                   // $followup = $result->get(); 
               /* }*/

                /****************** Today followup count start ***************/
                $followup_called_count = 0;
                /*if(helpers::checkPermission('todays followup dashboard'))
                {*/
                    /*$result    = DB::table('ori_lead_followups_log')
                                    ->leftjoin('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_lead_followups_log.customer_id')
                                    ->select('ori_lead_followups_log.id','ori_lead_followups_log.customer_id','ori_lead_followups_log.docket_number')
                                   // ->where('ori_lead_followups_log.remainder_date','like', '%' . $date_follow . '%')
                                    ->where('ori_customer_profiles.status','1')
                                    ->where('ori_customer_profiles.deleted_at', '=', Null)
                                    ->where('ori_lead_followups_log.status','1')
                                    ->where('ori_lead_followups_log.deleted_at', '=', Null)
                                    ->groupBy('ori_lead_followups_log.docket_number');*/
		   /*$result    = DB::table('ori_lead_followups')
                                    ->leftjoin('ori_customer_profiles', 'ori_customer_profiles.id', '=', 'ori_lead_followups.customer_id')
                                    ->select('ori_lead_followups.customer_id','ori_lead_followups.remainder_date','ori_lead_followups.status','ori_lead_followups.deleted_at','ori_lead_followups.updated_by', 'ori_customer_profiles.first_name', 'ori_customer_profiles.last_name', 'ori_customer_profiles.mobile_number')
                                    ->where('ori_lead_followups.remainder_date','like', '%' . $date_follow . '%')
                                    ->where('ori_customer_profiles.status','1')
                                    ->where('ori_customer_profiles.deleted_at', '=', Null)
                                    ->where('ori_lead_followups.status','1')
                                    ->where('ori_lead_followups.deleted_at', '=', Null);*/
                                    //->groupBy('ori_lead_followups.docket_number');
                    $result = LeadFollowup::select('id','docket_number','req_title','query_status',
								'query_type','customer_id','lead_source_id','priority')
                                                                 ->where('remainder_date','like', '%' . $date_follow . '%')
                                                                ->with('GetCustomer')
								->whereHas('GetCustomer')
								->orderBy('ori_lead_followups.id', 'asc');

                     if( helpers::checkPermission('agents followup dashboard'))
                    {
                       $result->where('ori_lead_followups.updated_by',$user);
                    } 
                    else{
                       // $result->where('ori_lead_followups.escalate',$user);

                    }
          
                    $followup_called_count = $result->count();
               /* }*/
                /****************** Today followup count  end ***************/ 



		return view('dashboard.dashboardgraph',compact('escalation_status_details','helpdesk_status_details','master_querytype','master_querytype_check','master_status','fb_graph', 'cmpny_query_types','resource','followup_all_count','followup_called_count'));		
	}
	
}
