<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Afterhourcall; 
use DB;
use Auth;
use App\User; 
use App\BatchProcess; 
use App\LeadFollowup; 
use App\LeadSources; 
use App\FaqCategories; 
use App\CronLog;
use App\QueryStatus;
use App\Helpers;
use Carbon\Carbon;
use App\Jobs\Unattended_call_batch_processJob; 

class UnattendedCallController extends Controller
{
	
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	 /**
     * unattended call list
     * @author AKHIL MURUKAN
     * @date 12/11/2018
     * @since version 1.0.0
     * @param NULL
     * @return unattended.index blade
    */	  
	
     public function listing($leadsource=null)
    {
		$l_count = 0;
        $agent_list     = array();
		
		$agent = Helpers::get_company_meta('agent');
		if(isset($agent) && !empty($agent))
		{
			$agent_list     = User::where('cmpny_id',Auth::user()->cmpny_id)
							//->where('role_id',$agent)
							->where('role_id','like','%:"' . $agent . '";%')
							->where('deleted_at',null)->get();	
		}
		$process_count = BatchProcess::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.INACTIVE'))->where('cmpny_id',Auth::user()->cmpny_id)->where('process_type',config('constant.UNATTENDED_CALL_TYPE'))->count(); //cantact_grp_status
        $lead_sources       =  LeadSources::pluck('name', 'id')->all();
		$query_category   			=   FaqCategories::orderBy('category_name')->pluck('category_name', 'id')->all();
		$query_status   		=   QueryStatus::orderBy('name')->where('cmpny_id',Auth::user()->cmpny_id)->pluck('name', 'id')->all();

		
        return view('unattended.index', compact('agent_list','l_count','process_count','lead_sources','query_category','query_status'));
    }
	 /**
     * unattended call list
     * @author AKHIL MURUKAN
     * @date 12/11/2018
     * @since version 1.0.0
     * @param NULL
     * @return unattended.index blade
    */	
	public function search_unattended_calls(Request $request)
	{
		        $response           =   $request->all();    
                $type_list    =   $response['type_list']; 
                $start_date    =   $response['start_date']; 
                $end_date    =   $response['end_date']; 
				$call_status    =   $response['call_status'];
				$agent_id    =   $response['agent_id'];
				$search_keywords    =   $response['search_keywords'];
                $call_detail=array();

				
                $results = Afterhourcall::select('ori_afterhourcall.*','ori_users.name as agent_name')
				                           ->leftjoin('ori_users', 'ori_users.id', '=', 'ori_afterhourcall.assigned_agent');
               

                if(isset($type_list) && !empty($type_list)) 
                {
                    $results->Where('ori_afterhourcall.type',$type_list);

                }
                if(isset($start_date) && !empty($start_date) && $start_date != NULL)
                {

                    $date1 = str_replace("/","-",$start_date);
                    $start_date=date('Y-m-d', strtotime($date1));
                    $results->Where('ori_afterhourcall.created_at','>=' , $start_date.' 00:00:00' ); 
                }
                if(isset($end_date) && !empty($end_date) && $end_date != NULL)
                {
                    $date2 = str_replace("/","-",$end_date);
                    $end_date=date('Y-m-d', strtotime($date2));
                    $results->Where('ori_afterhourcall.created_at','<=' ,  $end_date.' 23:59:59');  
                }
				if(isset($agent_id) && !empty($agent_id) && $agent_id != '0') 
				{
					
					$results->where('ori_afterhourcall.assigned_agent', '=', $agent_id);
					
				}
				if(isset($call_status) && !empty($call_status) && $call_status != '0') 
				{
					if($call_status == 1)
					{
						$results->Where('ori_afterhourcall.assigned_agent','=',0);
					}
					if($call_status == 2)
					{
						$results->Where('ori_afterhourcall.assigned_agent','!=',0);
					}
				   
					
				}
				if(isset($search_keywords) && !empty($search_keywords)) 
				{
				  $results->where(function($results) use ($search_keywords){
					$results->orWhere('ori_afterhourcall.phone', 'like', '%' . $search_keywords . '%');
				  });
				}
                $results->orderBy('ori_afterhourcall.created_at','desc');
                $list_count =   $results->count();
                $call_detail = $results->paginate(config('constant.pagination_constant'));

 
	    $html = view('unattended.listview')->with(compact('call_detail','list_count'))->render();
		$result_arr = array('success' => true,'html' => $html);
		return json_encode($result_arr);
				
				
	}
	 
	function unattended_calls_batchwise_insertion()
    {
        $cron_log    = new CronLog;
        $cron_logid           = $cron_log->createLog('unattended_calls_batchwise_insertion');
        try{

            $queueJob = (new Unattended_call_batch_processJob())->delay(Carbon::now()->addSeconds(30));
                dispatch($queueJob); 
				
            $cron_log->updateLog($cron_logid);
        }
        catch(\Illuminate\Database\QueryException $ex){
                    $error      = $ex->getMessage();
                    $cron_log->updateLog($cron_logid,$error);
        }

    }
      
}
