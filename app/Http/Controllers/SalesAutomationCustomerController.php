<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\QueryTypes;
use App\AutomatedProcessCustomer;
use App\AutomatedProcessRelationsCustomer;
use App\AutomatedProcessLogCustomer;
use App\CustomerProfile;
use App\Templates;
use App\CompanyChannel;
use App\Channel;
use App\QueryStatus;
use App\CustomerNature;
use App\Priority;
use App\LeadSources;
use Auth;
use Illuminate\Http\Request;


class SalesAutomationCustomerController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:sales automation create', ['only' => ['create']]);
       $this->middleware('check-permission:sales automation edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:sales automation edit|sales automation create',   ['only' => ['store']]);
       $this->middleware('check-permission:sales automation list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:sales automation delete',   ['only' => ['destroy']]);
    }
	/*
    * @author RINKU.E.B. 
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return AUTO PROCESS LIST 
    */
	public function index()
    {
        return view('masters.salesAutomationCustomer.index');
    }
	
	/*
    * AUTO PROCESS LIST
    * @author RINKU.E.B. 
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
        $results = array();	
        $results = AutomatedProcessCustomer::orderBy('id', 'asc');
        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('process_name', 'like', '%' . $search_keywords . '%');
                   
                });
            }
		$list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		$html = view('masters.salesAutomationCustomer.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * Function for adding new auto process stages
    * @author RINKU.E.B.
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function create()
    { 
		$templates = Templates::pluck('subject','id')->all();
		$process = AutomatedProcessCustomer::pluck('process_name','id')->all();
		$results = CompanyChannel::with('GetTemplateType')->get();
		$query_type = QueryTypes::pluck('query_type','id')->all();
		$query_status = QueryStatus::pluck('name','id')->all();
		$customer_nature = CustomerNature::pluck('customer_nature','id')->all();
		$priority = Priority::pluck('name','id')->all();
		$lead_sources = LeadSources::pluck('name','id')->all();
		return view('masters.salesAutomationCustomer.create', compact('templates','process','results','query_type','query_status','customer_nature','priority','lead_sources'));
    }
	
	/*
    * Update function for auto process 
    * @author RINKU.E.B.
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editing auto process 
    */
	public function edit($id)
    {   
            $automated_process = AutomatedProcessCustomer::findOrFail($id);
			$templates = Templates::pluck('subject','id')->all();
			$process = AutomatedProcessCustomer::pluck('process_name','id')->all();
			$results = CompanyChannel::with('GetTemplateType')->get();
			$query_type = QueryTypes::pluck('query_type','id')->all();
			$query_status = QueryStatus::pluck('name','id')->all();
			$customer_nature = CustomerNature::pluck('customer_nature','id')->all();
			$priority = Priority::pluck('name','id')->all();
			$lead_sources = LeadSources::pluck('name','id')->all();
			//echo "<pre>";print_r($results);die;
            return view('masters.salesAutomationCustomer.create', compact('automated_process','templates','process','results','query_type','query_status','customer_nature','priority','lead_sources'));
    }


    /*
    * Save function for auto process Add&Update
    * @author RINKU.E.B. 
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
	   //$user_id = Auth::User()->id;
       $this->validate($request,[
				'process_name' => 'required',
    			'action_time' => 'required|integer',
    			'expiry_time' => 'required|integer',
				'content' => 'required_with:action',
    			],[
				'process_name.required' => ' The Process name is required.',
    			'action_time.required' => ' The action time is required.',
    			'expiry_time.required' => ' The expiry time is required.',
				'content.required' => ' The Content is required.',
    		]);
		$status = AutomatedProcessCustomer::updateOrCreate(
            [
                
                'id' => request('id'),
				'cmpny_id' => Auth::user()->cmpny_id,
            ],
            [
				'process_name' => request('process_name'),
                'response_pos' => request('response_pos'),
                'action' => request('action'),
                'response_neg' => request('response_neg'),
				'action_time' => request('action_time'),
                'expiry_time' => request('expiry_time'),
                'process_type' => request('process_type'),
                'query_type' => request('query_type'),
				'query_status' => request('query_status'),
                'customer_nature' => request('customer_nature'),
                'priority' => request('priority'),
                'lead_source_id' => request('lead_source_id'),
				'content' => request('content'),
            ]);
			$result_arr=array('success' => true,'message' => 'Successfuly updated','reset'=>true);
			return $result_arr;		
	}


    /*
    * Auto process deletion function
    * @author RINKU.E.B. 
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function destroy(Request $request)
    {
        $id = $request->id;
	   
        if($id)
        {
            $id = AutomatedProcessCustomer::find($id);
            $id->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    }
	
	/**
    * DISPLAY AUTO STAGE ON PROFILE WITH PROFILE ID $id
    * @author RINKU.E.B
    * @date 15/11/2019
    */
	public function get_auto_process_status(Request $request)
	{
		$response = $request->all();
		$id = $response['id'];
		$cmpny_id = $response['cmpny_id'];
		$count = AutomatedProcessRelationsCustomer::where('customer_id',$id)->where('cmpny_id',$cmpny_id)->count();
		if($count>0)
		{
			$auto_id = AutomatedProcessRelationsCustomer::select('ori_automated_process_customer.process_name','ori_automated_process_customer.id AS cid')
			->join('ori_automated_process_customer','ori_automated_process_customer.id','=','ori_automated_process_relations_customer.auto_process_id')
			->where('ori_automated_process_relations_customer.customer_id',$id)
			->orderBy('ori_automated_process_relations_customer.id','asc')
			->first();
			return "Stage ".$auto_id->cid." ".$auto_id->process_name;
		}
		else
		{
			return "";
		}
		
	}
	/**
    * customer stage history
    * @author RINKU.E.B.
    * @date 15/11/2019
   */ 
    public function customer_stage_history($id=null,$cmpny_id=null)
    {	
        $customer_id=urldecode(base64_decode($id));		
		return view('stage.index', compact('id','cmpny_id'));
    }
	
	/**
    * customer stage history
    * @author RINKU.E.B.
    * @date 15/11/2019
    * @since version 1.0.0
    * @param NULL
    * @return individual stage history details
   */ 
    public function stage_history(Request $request)
    {  
		$response = $request->all();
        $customer_id = $response['customer_id'];
        $cmpny_id = $response['cmpny_id'];
		
		$customer_stage_history        =    	 AutomatedProcessLogCustomer::select('ori_automated_process_log_customer.action_created_time','ori_automated_process_log_customer.created_at','ori_automated_process_log_customer.auto_process_id','ori_automated_process_log_customer.action_time',
												'ori_automated_process_customer.process_name','ori_automated_process_customer.process','ori_automated_process_customer.action','ori_automated_process_customer.category')
												->join('ori_automated_process_customer','ori_automated_process_customer.id','=','ori_automated_process_log_customer.auto_process_id')
												->where('ori_automated_process_log_customer.customer_id',$customer_id)
												->orderBy('ori_automated_process_log_customer.created_at','desc');
		$stage_historys=$customer_stage_history->paginate(config('constant.pagination_constant'));
		
		$customer_details       	 = 			CustomerProfile::select('id','first_name','middle_name','last_name')
												->where('id',$customer_id)
												->first();										
	
		return view('stage.stage_history', compact('stage_historys','customer_details'));
    }
	
	
}
