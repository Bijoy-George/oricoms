<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeptDesignationRelation;
use App\Designations;
use App\Helpers;
use Auth;

class DesignationController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:designation create', ['only' => ['create']]);
       $this->middleware('check-permission:designation edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:designation edit|designation create',   ['only' => ['store']]);
       $this->middleware('check-permission:designation list',   ['only' => ['index','search_list']]);
    
	}
	/*
    * Available User designation 
    * @author PRANEESHA KP
    * @date 07/01/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function index()
    {
        return view('masters.designation.index');
    }
	/*
    * designations Listing 
    * @author PRANEESHA KP
    * @date 07/01/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results 			= array();
		
        $results = Designations::orderBy('id', 'asc')->orderBy('sort_order','asc');
		if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('designation', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$html 		= view('masters.designation.listview')
					->with(compact('results','list_count'))->render();
					
		$result_arr=array('success' => true,'html' => $html);
		
		return $result_arr;		
	}
	/*
    * Function for creating designation
    * @author PRANEESHA KP
    * @date 07/01/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function create()
    {  
		return view('masters.designation.create');
    }
	
	/*
    * Update function for complaint nature
    * @author PRANEESHA KP
    * @date 04/01/2019
    * @since version 1.0.0
    * @param NULL
    */
	
	public function edit($id)
    { 
						
		$designations 	= Designations::findOrFail($id);
		
		return view('masters.designation.create', compact('designations'));
    }


    /*
    * Save function for designation Add&Update
    * @author PRANEESHA KP
    * @date 07/01/2019
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    { 
		$this->validate($request,[
			'designation' => 'required|string|max:500|unique:ori_mast_designations,designation,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
    	],[
			'designation.required' => 'Please provide designation.',
    	]);
		
		$response           = $request->all();
		
        if(!empty(request('sort_order'))){
				$sort_order = request('sort_order');
		}else{$sort_order 	=0;}
		
		if(!empty(request('status'))){
				$status = request('status');
		}else{$status 	= config('constant.ACTIVE');}
		
	    $res = Designations::updateOrCreate(
        [
           'id' => request('id')
        ],
        [
			'cmpny_id' => Auth::user()->cmpny_id,
			'designation' => request('designation'),
             'sort_order' => $sort_order,
            'status' => $status,
		])->id; 
			
			
        if(!empty($res)){
            if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Designation updated Successfuly','reload' => true);
			}else{
              $result_arr=array('reset'=>true,'success' => true,'message' => 'Designation added Successfuly','reload' => true);
			}
        }else{
             $result_arr=array('reset'=>false,'success' => false,'message' => 'Something went wrong','reload' => true);
		}
		return $result_arr;		
	}
	/*
    * Get Designations under selected Department
    * @author PRANEESHA KP
    * @date 08/01/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function get_designation_by_dept(Request $request)
    {	
		$response          =   $request->all();
		$sel_query_type    =   $response['query_type'];
		$results 	= array();
		
        $results = DeptDesignationRelation::select('ori_mast_designations.id','ori_mast_designations.designation')
				 ->leftJoin('ori_mast_designations', 'ori_mast_query_designation_relation.designation_id', '=', 'ori_mast_designations.id')
				 ->where('ori_mast_query_designation_relation.query_type_id',$sel_query_type)
				 ->distinct('ori_mast_query_designation_relation.designation_id')
				 ->get();
		echo $results; 
	}
	
	
}
