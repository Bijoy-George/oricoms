<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tab;
use App\Helpers;
use Auth;
use DB;

class TabController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:customer tab create', ['only' => ['create']]);
       $this->middleware('check-permission:customer tab edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:customer tab edit|customer tab create',   ['only' => ['store']]);
       $this->middleware('check-permission:customer tab list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:customer tab delete',   ['only' => ['destroy']]);
    }
	/*
    * Tab settings 
    * @author Reshma Rajan
    * @date 05/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return  list
    */
	public function index()
    {
        return view('masters.Tab.index');
    }
	
	/*
    * Tab Listing 
    * @author Reshma Rajan
    * @date 05/12/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results 			= array();
		
        $results = Tab::orderBy('id', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('name', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$html 		= view('masters.Tab.listview')
					-> with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		
		return $result_arr;		
	}
	
	/*
    * Function for TAb creation
    * @author Reshma Rajan
    * @date 05/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings priority
    */
	public function create()
    {   
		return view('masters.Tab.create');
    }
	
	/*
    * Update function for tab
   * @author Reshma Rajan
    * @date 05/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings Priority
    */
	public function edit($id)
    {   
            $res = Tab::findOrFail($id);
            return view('masters.Tab.create', compact('res'));
    }


    /*
    * Save function for Tab Add&Update
   * @author Reshma Rajan
    * @date 05/12/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
        $cmpny_id = Auth::user()->cmpny_id; 
        $id=request('id');
		$this->validate($request,[
            'name' => 'required|string|max:250',
            'name' => 'unique:ori_tabs,name,'.$id.',id,cmpny_id,'.$cmpny_id,
			]); 
		
		$cond_arr=array('cmpny_id'=>Auth::user()->cmpny_id,'id'=>request('id'));
        $up_arr  =array('name'=>request('name'),'sort_order'=>request('sort_order'),'status'=>config('constant.ACTIVE'));
        if(request('type'))
        {
            $up_arr['type']=request('type');
        }
		$status = Tab::updateOrCreate($cond_arr,$up_arr);
        if(!empty(request('id'))){
                $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
        }else{
                $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
        }
		return $result_arr;		
	}


    /*
    * Priority deletion function
   * @author Reshma Rajan
    * @date 05/12/2018
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
