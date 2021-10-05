<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\SupplyCards;

use Auth;
use App\Http\Controllers\Controller;

class SupplyCardController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:supply card create', ['only' => ['create']]);
       $this->middleware('check-permission:supply card edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:supply card edit|supply card create',   ['only' => ['store']]);
       $this->middleware('check-permission:supply card list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:supply card delete',   ['only' => ['destroy']]);
    }
	/*
    * Query Status 
    * @author PRANEESHA KP
    * @date 10/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return query_status list
    */
	public function index()
    {
        return view('masters.supplyCard.index');
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
		
        $results = SupplyCards::orderBy('id', 'asc')->orderBy('sort_order','asc');
		if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('name', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$html 		= view('masters.supplyCard.listview')
					->with(compact('results','list_count'))->render();
					
		$result_arr=array('success' => true,'html' => $html);
		
		return $result_arr;		
	}
	
	/*
    * Function for creating Query Status
    * @author PRANEESHA KP
    * @date 10/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for creating query_status
    */
	public function create()
    {  
		
		return view('masters.supplyCard.create');
    }
	
	/*
    * Update function for Query status
    * @author PRANEESHA KP
    * @date 10/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings query_status
    */
	public function edit($id)
    { 
		
						
		$supply_card 	= SupplyCards::findOrFail($id);
		
		return view('masters.supplyCard.create', compact('supply_card'));
    }


    /*
    * Save function for Query status Add&Update
    * @author PRANEESHA KP
    * @date 10/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {  
		$this->validate($request,[
			'name' => 'required|string|max:500|unique:ori_mast_supply_cards,name,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id
    		
    	],[
			'name.required' => ' The Name field is required.'
    		
    	]);
		$response           = $request->all();
        
	   
		$stat_id = SupplyCards::updateOrCreate(
        [
           'id' => request('id')
        ],
        [
			'cmpny_id' => Auth::user()->cmpny_id,
			'name' => request('name'),
            'sort_order' => request('sort_order'),
            'status' => request('status'),
		])->id; 
			
						
			

            if(!empty($stat_id)){
                if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
                }else{
                    $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
                }
            }else{
                    $result_arr=array('reset'=>false,'success' => false,'message' => 'Something went wrong');
            }
			return $result_arr;		
	}


    /*
    * Query status deletion function
    * @author PRANEESHA KP
    * @date 10/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    /* public function destroy(Request $request)
    {
	   $qstatusid = $request->id;
	   
	   if($qstatusid)
        {
            $id = QueryStatus::find($qstatusid);
			$id ->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    } */
	
	
	/*
    * Query status deletion function
    * @author RINKU.E.B.
    * @date 07/12/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function add_new_querystatus(Request $request)
    {
	   $new_query_status = $request->new_query_status;
	   
	   if($new_query_status)
        {
            $stat_id = QueryStatus::create(
			[
				'cmpny_id' => Auth::user()->cmpny_id,
				'name' => $new_query_status,
				'color' => '#000ddd',
				'sort_order' => 0,
				'status' => config('constant.ACTIVE'),
			]); 
			return $stat_id->id;
        }
			
    
    } 
}
