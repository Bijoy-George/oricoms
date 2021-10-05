<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\QueryStatusRelation;
use App\QueryStatus;
use App\QueryTypes;
use App\Helpers;
use App\Events\Oripusher;
use Auth;
use App\Http\Controllers\Controller;

class QueryStatusContoller extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:query status create', ['only' => ['create']]);
       $this->middleware('check-permission:query status edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:query status edit|query status create',   ['only' => ['store']]);
       $this->middleware('check-permission:query status list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:query status delete',   ['only' => ['destroy']]);
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
        return view('masters.queryStatus.index');
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
		
        $results = QueryStatus::orderBy('id', 'asc')->orderBy('sort_order','asc');
		if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('name', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$html 		= view('masters.queryStatus.listview')
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
		$query_types =['' => 'Select'] + QueryTypes::orderBy('query_type')
					 ->pluck('query_type', 'id')
					 ->all();	
		return view('masters.queryStatus.create', compact('query_types'));
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
		$query_types  	=['' => 'Select'] + QueryTypes::orderBy('query_type')
						->pluck('query_type', 'id')->all();
						
		$query_status 	= QueryStatus::findOrFail($id);
		$type_relation 	=QueryStatusRelation::orderBy('id', 'asc')
						->where('query_status_id',$id)	
						->pluck('query_type_id', 'id')
						->all();
		
		return view('masters.queryStatus.create', compact('query_status','query_types','type_relation'));
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
			'name' => 'required|string|max:500|unique:ori_mast_query_status,name,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
    		'query_type_id' => 'required',
    	],[
			'name.required' => ' The Name field is required.',
    		'query_type_id.required' => ' The Query Type field is required.',
    	]);
		$response           = $request->all();
        $query_type_id      = $response['query_type_id'];
	    $is_close			= request('is_close');
		
		if(isset($is_close) && ($is_close == 'on'))
		{
			$is_close=config('constant.IS_CLOSE');
		}else{
			
			$is_close=config('constant.NOT_CLOSE');
		}
	   
		$stat_id = QueryStatus::updateOrCreate(
        [
           'id' => request('id')
        ],
        [
			'cmpny_id' => Auth::user()->cmpny_id,
			'name' => request('name'),
            'color' => request('color'),
            'is_close' => $is_close,
            'sort_order' => request('sort_order'),
            'status' => request('status'),
		])->id; 
			$rel     	= QueryStatusRelation::where('cmpny_id',Auth::user()->cmpny_id)
						->where('query_status_id',$stat_id)
						->forceDelete();
						
			foreach($query_type_id as $key => $value)
			{
					$status = QueryStatusRelation::Create(
					[
						'cmpny_id' => Auth::user()->cmpny_id,
						'query_type_id' => $value,
						'query_status_id' => $stat_id,
						'status' => request('status'),
					]);
			}

            if(!empty($stat_id)){
                if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
                }else{
                    $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
                }
            }else{
                    $result_arr=array('reset'=>false,'success' => false,'message' => 'Something went wrong');
            }
            $query_status =$request->post('name');
        Helpers::add_pusher($query_status,"Create/Update",url('/query_status'),Auth::user()->id,Auth::user()->cmpny_id);
        $cmpny_id =Auth::user()->cmpny_id;
        $created_by = Helpers::get_pusher_cretor(Auth::user()->id);
        $url=url('/query_status');
        $idc =  $request->post('id');
        if($idc)
        {
        $msg ="Query status name:".$query_status.''.", edited by".$created_by;
        }
        else
        {
           $msg ="Query status name:".$query_status.''.", created by".$created_by; 
        }
        $data = [
            
            'cmpny_id' => $cmpny_id,
            'p_name' =>$query_status,
             'url'        => $url,
             'msg' => $msg
        ];

        event(new Oripusher($data));
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
