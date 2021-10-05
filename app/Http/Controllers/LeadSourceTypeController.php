<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\LeadSourceType;
use App\Helpers;
use Auth;
use DB;
use Illuminate\Http\Request;

class LeadSourceTypeController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:lead source type create', ['only' => ['create']]);
       $this->middleware('check-permission:lead source type edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:lead source type edit|lead source type create',   ['only' => ['store']]);
       $this->middleware('check-permission:lead source type list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:lead source type delete',   ['only' => ['destroy']]);
    }
	/*
    * Lead Source Types 
    * @author PRANEESHA KP
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function index()
    {
        return view('masters.leadSourceType.index');
    }
	
	/*
    * LeadSource Listing 
    * @author PRANEESHA KP
    * @date 14/11/2018
    * @since version 1.0.0
    */
	public function search_list(Request $request)
    {
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
        $results 			= 	array();
		
        $results = LeadSourceType::orderBy('id', 'asc');
		if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('source_type', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count 	= $results->count();
        $results   		= $results->paginate();
		$html 			= view('masters.leadSourceType.listview')
						->with(compact('results','list_count'))->render();
		$result_arr		=array('success' => true,'html' => $html);
		
		return $result_arr;		
	}
	
	/*
    * Function for creating LeadSourceType
    * @author PRANEESHA KP
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function create()
    {  
		return view('masters.leadSourceType.create', compact(''));
    }
	
	/*
    * Update function for LeadSourceType
    * @author PRANEESHA KP
    * @date 14/11/2018
    * @since version 1.0.0
    */
	public function edit($id)
    { 
		$LeadSources = LeadSourceType::findOrFail($id);
		return view('masters.leadSourceType.create', compact('LeadSources'));
    }


    /*
    * Save function for LeadSourceType
    * @author PRANEESHA KP
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {  
		$this->validate($request,[
			'source_type' => 'required|string|max:500|unique:ori_mast_lead_source_type,source_type,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
			],[
			'source_type.required' => ' The Query Type field is required.',
		]);
		$response           =   $request->all();
        $source_type        =   $response['source_type'];     
        
		$statuss = LeadSourceType::updateOrCreate(
            [
                
                'id' 		  => request('id')
            ],
            [
				'cmpny_id'    => Auth::user()->cmpny_id,
				'source_type' => $source_type,
                'status' 	  => request('status'),
			]);
			
			if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
            }else{
                    $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
            }
			return $result_arr;		
	}


    /*
    * LeadSourceType deletion function
    * @author PRANEESHA KP
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    */
    /* public function destroy(Request $request)
    {
	   $leadsourceid = $request->id;
	   
	   if($leadsourceid)
        {
            $id = LeadSourceType::find($leadsourceid);
			$id ->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    } */
}
