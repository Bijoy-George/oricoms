<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\QueryStatusQueryTypeRelation;
use App\Plan;
use App\PlanDuration;
use App\CouponCodes;
use App\Helpers;
use Auth;
use App\Http\Controllers\Controller;

class PlansController extends Controller
{
	public function __construct()
    {
       $this->middleware('auth');
    }
    /*
    * Plans 
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return plans list
    */
	public function index()
    {
        return view('masters.plan.index');
    }
	/*
    * Query Status Listing 
    * @author PRANEESHA KP
    * @date 10/10/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results 			= array();
		
        $results = Plan::orderBy('id', 'asc');
		if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('plan', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$html 		= view('masters.plan.listview')->with(compact('results','list_count'))->render();
		$result_arr = array('success' => true,'html' => $html);
		
		return $result_arr;		
	}
	/*
    * Function for creating Plan
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for new plan
    */
	public function create()
    {  
		return view('masters.plan.create', compact(''));
    }
	/*
    * Update function for plan
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function edit($id)
    { 
		$res = Plan::findOrFail($id);
		return view('masters.plan.create', compact('res'));
    }
	/*
    * Save function for Plan Add&Update
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {  
			$this->validate($request,[
            'plan' => 'required|string|max:500|unique:ori_mast_plans,plan,'.request('id').',id',
			'plan_des' => 'required|string|max:200',
			]);
			$status = Plan::updateOrCreate(
            [
                'id'      	=> request('id')
            ],
            [
				'plan' 		=> request('plan'),
				'plan_des'=> request('plan_des'),
				'discount'=> request('discount'),
				'sort_order'=> request('sort_order'),
                'status' 	=> request('status'),
			])->id;
			if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated','plan_id' => $status);
                }else{
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly added','plan_id' => $status);
                }
			return $result_arr;		
	}


    /*
    * Plan deletion function
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    /* public function destroy(Request $request)
    {
	   $planid = $request->id;
	   
	   if($planid)
        {
            $id = Plan::find($planid);
			$id ->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    } */
	
	
	
	/*
    * Plans duration
    * @author AKHIL MURUKAN
    * @date 26/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return plans duration list
    */
	public function plan_duration()
    {
        return view('masters.planduration.index');
    }
	/*
    * Plans duration
    * @author AKHIL MURUKAN
    * @date 26/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function plan_duration_search_list(Request $request)
    {
        $response           = $request->all();

        $search_keywords    = $response['search_keywords'];
        $results 			= array();
		
        $results = PlanDuration::orderBy('id', 'asc')->with('GetParentPlan');

		/*if(isset($search_keywords) && !empty($search_keywords)) 
            {
					$results->orWhereMore('ori_mast_plans', function($results) use($search_keywords) 
					{
						$results->where('plan', 'like', '%' . $search_keywords . '%');
					});
            }*/
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$html 		= view('masters.planduration.listview')->with(compact('results','list_count'))->render();
		$result_arr = array('success' => true,'html' => $html);
		
		return $result_arr;		
	}
	
	/*
    * Function for creating Plan duration
    * @author AKHIL MURUKAN
    * @date 27/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for new plan duration
    */
	public function plan_duration_create()
    {  
	    $plans        =  Plan::where('status',config('constant.ACTIVE'))->pluck('plan', 'id')->all();
		return view('masters.planduration.create', compact('plans'));
    }
	/*
    * Update function for plan duration
    * @author AKHIL MURUKAN
    * @date 27/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function plan_duration_edit($id)
    { 
		$res = PlanDuration::findOrFail($id);
	    $plans        =  Plan::where('status',config('constant.ACTIVE'))->pluck('plan', 'id')->all();
		return view('masters.planduration.create', compact('res','plans'));
    }
	/*
    * Save function for Plan  duration Add&Update
    * @author AKHIL MURUKAN
    * @date 27/11/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function plan_duration_store(Request $request)
    {  
			$this->validate($request,[
            'plan_id' => 'required',
			'amount' => 'required|max:10',
			'start_date' => 'required',
            'end_date' => 'required',
			'duration' => 'required|string|max:100',
			]);
			
			$s_date        =   explode('/', request('start_date'));
			if(isset($s_date[2]) && !empty($s_date[2]) && isset($s_date[1]) && !empty($s_date[1]) &&isset($s_date[0]) && !empty($s_date[0]) )
            {
			$start_date    =   $s_date[2].'-'.$s_date[1].'-'.$s_date[0];
			$start_date    =   date('Y-m-d', strtotime($start_date));
            }
			$e_date        =   explode('/', request('end_date'));
			if(isset($e_date[2]) && !empty($e_date[2]) && isset($e_date[1]) && !empty($e_date[1]) &&isset($e_date[0]) && !empty($e_date[0]) )
            {
			$end_date    =   $e_date[2].'-'.$e_date[1].'-'.$e_date[0];
			$end_date    =   date('Y-m-d', strtotime($end_date));
            }
			
			$status = PlanDuration::updateOrCreate(
            [
                'id'      	=> request('id')
            ],
            [
				'plan_id' 		=> request('plan_id'),
				'amount'=> request('amount'),
				'duration'=> request('duration'),
				'start_date'=> $start_date,
				'end_date'=> $end_date,
				'sort_order'=> request('sort_order'),
                'status' 	=> request('status'),
			]);
			if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
                }else{
                    $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
                }
			return $result_arr;		
	}
	 
	public function remove_plan_duration(Request $request) 
    {
        if(request('id'))
        {
            PlanDuration::where('id',request('id'))->update(['status'=>config('constant.INACTIVE')]);
            return $result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
        }

    }
    public function activate_plan_duration(Request $request) 
    {
        if(request('categoryid'))
        {
            PlanDuration::where('id',request('categoryid'))->update(['status'=>config('constant.ACTIVE')]);
            return $result_arr=array('success' => true,'message' => 'Successfuly activated', 'refresh' => true);
        }

    }
	/*
    * Add new coupon for a plan
    * @author PRANEESHA KP
    * @date 29/12/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function add_coupon(Request $request) 
    {	
		$Response	= $request->all();
		$plan_id		= $Response['plan_id'];
		return view('masters.plan.edit_coupon', compact('plan_id'));
	}

	/*
    * Add new coupon for a plan
    * @author PRANEESHA KP
    * @date 29/12/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function save_coupon(Request $request) 
    {
		$this->validate($request,[
            'plan_id' => 'required',
			'coupon_name' => 'required',
			'coupon_code' => 'required',
			'discount' => 'required',
			'disc_type' => 'required',
			'duration' => 'required',
			'valid_to' => 'required',
			'valid_from' => 'required',
			],[
			'coupon_name.required' => 'Please enter coupon name.',
			'coupon_code.required' => 'Please enter coupon code.',
			'valid_to.required' => 'Please specify coupon validity.',
			'valid_from.required' => 'Please specify coupon validity.',
		]);
		$valid_from     =  request('valid_from');
		$valid_to    	=  request('valid_to');
		
			$s_date        =   explode('/', request('valid_from'));
			if(isset($s_date[2]) && !empty($s_date[2]) && isset($s_date[1]) && !empty($s_date[1]) &&isset($s_date[0]) && !empty($s_date[0]) )
            {
			$valid_from    =   $s_date[2].'-'.$s_date[1].'-'.$s_date[0];
			$valid_from    =   date('Y-m-d', strtotime($valid_from));
            }
			$e_date        =   explode('/', request('valid_to'));
			if(isset($e_date[2]) && !empty($e_date[2]) && isset($e_date[1]) && !empty($e_date[1]) &&isset($e_date[0]) && !empty($e_date[0]) )
            {
			$valid_to    =   $e_date[2].'-'.$e_date[1].'-'.$e_date[0];
			$valid_to    =   date('Y-m-d', strtotime($valid_to));
            }
			
        $Response		= $request->all();
        $plan			= $Response['plan_id'];
		$cpn_name		= $Response['coupon_name'];
        $cpn_code		= $Response['coupon_code'];
        $discount		= $Response['discount'];
        $disc_type		= $Response['disc_type'];
        $duration		= $Response['duration'];
        
		$res	= Couponcodes::updateOrCreate(
		[
			'id'			=> request('id'),
		],[
			'plan_id'		=> $plan,
			'coupon_name'	=> $cpn_name,
			'coupon_code'	=> $cpn_code,
			'discount'		=> $discount,
			'disc_flag'		=> $disc_type,
			'duration'		=> $duration,
			'valid_from'	=> $valid_from,
			'valid_to'		=> $valid_to,
			'status'		=> request('status'),
		]);
		return $result_arr=array('success' => true,'message' => 'Successfuly Updated', 'refresh' => true);
		
	}
	/*
    * Get available coupons
    * @author PRANEESHA KP
    * @date 31/12/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function couponlisting(Request $request) 
    {	
		$Response		= $request->all();
        $plan			= $Response['plan_id'];
		$results 		= Couponcodes::where('plan_id',$plan);
		$list_count 	= $results->count();
        $results    	= $results->paginate(config('constant.pagination_constant'));
		$html = view('masters.plan.couponlisting')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;	
	}
	/*
    * Edit coupon
    * @author PRANEESHA KP
    * @date 01/01/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function editpromo($cpn_id=null) 
    {	
		if(!empty($cpn_id)){
			$res = Couponcodes::findOrFail($cpn_id);
		}
		return view('masters.plan.edit_coupon', compact('res'));
    }
	
}
