<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Priority;
use App\Helpers;
use Auth;
use DB;

class PriorityController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:customer priority create', ['only' => ['create']]);
       $this->middleware('check-permission:customer priority edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:customer priority edit|customer priority create',   ['only' => ['store']]);
       $this->middleware('check-permission:customer priority list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:customer priority delete',   ['only' => ['destroy']]);
    }
	/*
    * Proirity 
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return customer_nature list
    */
	public function index()
    {
        return view('masters.priority.index');
    }
	
	/*
    * Priority Listing 
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results 			= array();
		
        $results = Priority::orderBy('id', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('name', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$html 		= view('masters.priority.listview')
					-> with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		
		return $result_arr;		
	}
	
	/*
    * Function for Priority creation
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings priority
    */
	public function create()
    {   
		return view('masters.priority.create', compact(''));
    }
	
	/*
    * Update function for Priority
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings Priority
    */
	public function edit($id)
    {   
            $res = Priority::findOrFail($id);
            return view('masters.priority.create', compact('res'));
    }


    /*
    * Save function for Priority Add&Update
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
		$this->validate($request,[
            'name' => 'required|string|max:500|unique:ori_mast_priority,name,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
			]); 
		
		$cmpny_id = Auth::user()->cmpny_id;	
		$status = Priority::updateOrCreate(
        [
            'id' 		 => request('id') 
        ],
        [
			'cmpny_id'   => Auth::user()->cmpny_id,
			'name' 		 => request('name'),
			'sort_order' => request('sort_order'),
            'status' 	 => request('status'),
		]);
		if(!empty(request('id'))){
                $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
        }else{
                $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
        }
		return $result_arr;		
	}


    /*
    * Priority deletion function
    * @author PRANEESHA KP
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    /* public function destroy(Request $request)
    {
        $id = $request->id;
	   
        if($id)
        {
            $id = Priority::find($id);
            $id->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    } */
}
