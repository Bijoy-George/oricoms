<?php

namespace App\Http\Controllers;

use Auth;
use App\QueryAction;
use Illuminate\Http\Request;

class QueryActionController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:query action create', ['only' => ['create']]);
       $this->middleware('check-permission:query action edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:query action edit|query action create',   ['only' => ['store']]);
       $this->middleware('check-permission:query action list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:query action delete',   ['only' => ['destroy']]);
    }

    /*
    * Query Action
    * @author Rahul Raveendran
    * @date 28/03/2018
    * @since version 1.0.0
    * @param NULL
    * @return query action list
    */
	public function index()
    {
        return view('masters.queryAction.index');
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
        $results = QueryAction::orderBy('id', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('action', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		$html = view('masters.queryAction.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * Function for creating Query Action
    * @author Rahul Raveendran
    * @date 28/03/2020
    * @since version 1.0.0
    * @param NULL
    * @return view for editings query action
    */
	public function create()
    {   
		return view('masters.queryAction.create');
    }
	
	/*
    * Update function for Query Action
    * @author Rahul Raveendran
    * @date 28/03/2020
    * @since version 1.0.0
    * @param NULL
    * @return view for editings Query Action
    */
	public function edit($id)
    {   
            $query_action = QueryAction::findOrFail($id);
            return view('masters.queryAction.create', compact('query_action'));
    }


    /*
    * Save function for Query Action Add&Update
    * @author Rahul Raveendran
    * @date 28/03/2020
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
	   $this->validate($request,[
				'action' => 'required|string|max:500|unique:ori_mast_query_actions,action,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
    			],[
				'action.required' => ' The action field is required.',
    			]);
		$status = QueryAction::updateOrCreate(
            [
                'id' 			  => request('id')
            ],
            [
				'cmpny_id'        => Auth::user()->cmpny_id,
				'action' 		=> request('action'),
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
}
