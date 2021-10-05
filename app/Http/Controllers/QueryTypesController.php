<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\QueryTypes;
use App\DeptDesignationRelation;
use App\Designations;
use Auth;
use Helpers;
use App\Events\Oripusher;
use Illuminate\Http\Request;


class QueryTypesController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:query type create', ['only' => ['create']]);
       $this->middleware('check-permission:query type edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:query type edit|query type create',   ['only' => ['store']]);
       $this->middleware('check-permission:query type list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:query type delete',   ['only' => ['destroy']]);
    }
	/*
    * Query Types 
    * @author PRANEESHA KP
    * @date 03/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return query_types list
    */
	public function index()
    {
        return view('masters.queryType.index');
    }
	
	/*
    * Query Type Listing 
    * @author PRANEESHA KP
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results 			= array();
		
        $results = QueryTypes::orderBy('id', 'asc')->orderBy('sort_order','asc');
		if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('query_type', 'like', '%' . $search_keywords . '%');
					$results->orWhere('short_code', 'like', '%' . $search_keywords . '%');
                    $results->orWhere('slug', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		
		$html 		= view('masters.queryType.listview')
					->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * Function for creating Query Type
    * @author PRANEESHA KP
    * @date 03/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings query_types
    */
	public function create()
    {   
		
		/* $designations = Designations::where('status',config('constant.ACTIVE'))
						->pluck('designation', 'id')
						->all();
						 */
		return view('masters.queryType.create');
    }
	
	/*
    * Update function for Query Types 
    * @author PRANEESHA KP
    * @date 03/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings query_types
    */
	public function edit($id)
    {   
			$query_type = QueryTypes::findOrFail($id);
            /* $designations = Designations::where('status',config('constant.ACTIVE'))
						->pluck('designation', 'id')
						->all();
							
			$dpt_desig_relation = DeptDesignationRelation::orderBy('id', 'asc')
						->where('query_type_id',$id)	
						->pluck('designation_id', 'id')
						->all(); */
						
			return view('masters.queryType.create', compact('query_type'));
    }


    /*
    * Save function for Query Types & its relations
    * @author PRANEESHA KP
    * @date 03/10/2018
    * @since version 1.0.0
    * @param NULL
	* @Modified at 07/01/2019
    */
    public function store(Request $request)
    {
		$this->validate($request,[
           'query_type' => 'required|string|max:500|unique:ori_mast_query_type,query_type,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
		]);
	    $status = QueryTypes::updateOrCreate(
        [
            'id' => request('id')
        ],
        [
			'cmpny_id' 		=> Auth::user()->cmpny_id,
			'query_type'  	=> request('query_type'),
			'slug'          => strtolower(str_replace(" ", "_",request('query_type'))),
			'short_code'  	=> request('short_code'),
            'type' 			=> request('type'),
            'sort_order' 	=> request('sort_order'),
            'status' 		=> request('status'),
        ])->id;
		
		
		/* $rel  = DeptDesignationRelation::where('cmpny_id',Auth::user()->cmpny_id)
						->where('query_type_id',$status)
						->forceDelete();
						
		
		if(!empty(request('designations')))
		{
			$designations	= request('designations');
			
			foreach($designations as $key => $value)
			{
				$statuss = DeptDesignationRelation::Create(
				[
						'cmpny_id' => Auth::user()->cmpny_id,
						'query_type_id' => $status,
						'designation_id' => $value,
						'status' => request('status'),
						'sort_order' => request('sort_order'),
				]);
			}
		} */
		if(!empty(request('id'))){
             $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
        }else{
             $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
        }

         $query_type =$request->post('query_type');
        Helpers::add_pusher($query_type,"Create/Update",url('/query_type'),Auth::user()->id,Auth::user()->cmpny_id);
        $cmpny_id =Auth::user()->cmpny_id;
        $created_by = Helpers::get_pusher_cretor(Auth::user()->id);
        $url=url('/query_type');
        $idc =  $request->post('id');
        if($idc)
        {
        $msg ="Query type name:".$query_type.''.", edited by".$created_by;
        }
        else
        {
           $msg ="Query type name:".$query_type.''.", created by".$created_by; 
        }
       
       
        $data = [
            
            'cmpny_id' => $cmpny_id,
            'p_name' =>$query_type,
             'url'        => $url,
             'msg' => $msg
        ];

        event(new Oripusher($data));
		return $result_arr;		
	}


    /*
    * Query Type deletion function
    * @author PRANEESHA KP
    * @date 04/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    /* public function destroy(Request $request)
    {
        $qTypeid = $request->id;
	   
        if($qTypeid)
        {
            $id = QueryTypes::find($qTypeid);
                $id->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    }*/
	
}
