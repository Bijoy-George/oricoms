<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CustomerNature;
use App\Helpers;
use Auth;
use DB;

class CustomerNatureController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:customer nature create', ['only' => ['create']]);
       $this->middleware('check-permission:customer nature edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:customer nature edit|customer nature create',   ['only' => ['store']]);
       $this->middleware('check-permission:customer nature list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:customer nature delete',   ['only' => ['destroy']]);
    }
	/*
    * Customer Nature
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return customer_nature list
    */
	public function index()
    {
        return view('masters.customerNature.index');
    }
	
	/*
    * Customer Nature Listing 
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results 			= array();	
        $results = CustomerNature::orderBy('id', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('customer_nature', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		$html = view('masters.customerNature.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * Function for creating Customer Nature
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings customer nature
    */
	public function create()
    {   
		return view('masters.customerNature.create', compact(''));
    }
	
	/*
    * Update function for Customer Nature
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings Customer Nature
    */
	public function edit($id)
    {   
            $cust_nature = CustomerNature::findOrFail($id);
            return view('masters.customerNature.create', compact('cust_nature'));
    }


    /*
    * Save function for Customer Nature Add&Update
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
	   $this->validate($request,[
				'customer_nature' => 'required|string|max:500|unique:ori_mast_customer_nature,customer_nature,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
    			],[
				'customer_nature.required' => ' The customer nature field is required.',
    			]);
		$status = CustomerNature::updateOrCreate(
            [
                'id' 			  => request('id')
            ],
            [
				'cmpny_id'        => Auth::user()->cmpny_id,
				'customer_nature' => request('customer_nature'),
				'sort_order'      => request('sort_order'),
                'status' 		  => request('status'),
			]);
			
			if(!empty(request('id')))
			{
                $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
            }else{
                $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
            }
			return $result_arr;		
	}


    /*
    * Customer Nature deletion function
    * @author PRANEESHA KP
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    /* public function destroy(Request $request)
    {
        $id = $request->id;
	   
        if($id)
        {
            $cust_nat_id = CustomerNature::find($id);
            $cust_nat_id->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    } */
}
