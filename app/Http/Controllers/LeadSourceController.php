<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\LeadSourceType;
use App\LeadSources;
use App\Helpers;
use Auth;
use DB;
use Illuminate\Http\Request;

class LeadSourceController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:lead source create', ['only' => ['create']]);
       $this->middleware('check-permission:lead source edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:lead source edit|lead source create',   ['only' => ['store']]);
       $this->middleware('check-permission:lead source list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:lead source delete',   ['only' => ['destroy']]);
    }
	/*
    * Lead Sources 
    * @author PRANEESHA KP
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function index()
    {
        return view('masters.leadSource.index');
    }
	
	/*
    * LeadSource Listing 
    * @author PRANEESHA KP
    * @date 14/11/2018
    * @since version 1.0.0
    */
	public function search_list(Request $request)
    {
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results 			= array();	
        $results 			= LeadSources::orderBy('id', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('name', 'like', '%' . $search_keywords . '%');
                   
                });
            }
		$list_count =  $results->count();
        $results    =  $results->paginate(config('constant.pagination_constant'));
		$html = view('masters.leadSource.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * Function for creating LeadSource
    * @author PRANEESHA KP
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function create($lead_source_type_id=null)
    {
        if(isset($lead_source_type_id) && !empty($lead_source_type_id))
        {
            $selected_lead_src_type = $lead_source_type_id;
            $flag = 1;
        }
        else
        {
            $selected_lead_src_type = 0;
            $flag = 0;
        }
		$lead_source_types  = ['' => 'Source Type'] + LeadSourceType::orderBy('source_type')
							-> pluck('source_type', 'id')->all();
		return view('masters.leadSource.create', compact('lead_source_types','selected_lead_src_type','flag'));
    }
	
	/*
    * Update function for LeadSourceType
    * @author PRANEESHA KP
    * @date 14/11/2018
    * @since version 1.0.0
    */
	public function edit($id,$lead_source_type_id=0)
    { 
		$lead_source_types  = ['' => 'Source Type'] + LeadSourceType::orderBy('source_type')
							-> pluck('source_type', 'id')->all();
							
		$LeadSources 		= LeadSources::findOrFail($id);
        if(isset($lead_source_type_id) && !empty($lead_source_type_id))
        {
            $selected_lead_src_type = $lead_source_type_id;
            $flag = 1;
        }
        else
        {
            $selected_lead_src_type = 0;
            $flag = 0;
        }
		
		return view('masters.leadSource.create', compact('LeadSources','lead_source_types','selected_lead_src_type','flag'));
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
        $response           = $request->all();
        $source_name        = $response['name'];     
        $source_type        = $response['source_type'];  
        $id                 = $response['id'];  
        $source_key         = $response['source_key'];
		$this->validate($request,[
			'name' => 'required|string|max:500|unique:ori_mast_lead_sources,name,'.request('id').',id,cmpny_id,'.Auth::user()->cmpny_id,
			'source_type' => 'required',
			],[
			'name.required' => ' The category_name field is required.',
			'source_type.required' => ' The Query Type field is required.',
		]);
		
		
		if(isset($id) && !empty($id)){
				$statuss = LeadSources::updateOrCreate(
				[
					
					'id' 					=> request('id')
				],
				[
					'cmpny_id' 				=> Auth::user()->cmpny_id,
					'name'   				=> request('name'),
					'lead_source_type_id' 	=> $source_type,
					'status' 				=> request('status'),
				]);
		}
		else
		{
				$statuss = LeadSources::Create(
				[
					'cmpny_id' 				=> Auth::user()->cmpny_id,
					'name'   				=> request('name'),
					'lead_source_type_id' 	=> $source_type,
					'source_key' 			=> $source_key,
					'status' 				=> request('status'),
				]);
		}
			
		$result_arr	= array('success' => true,'message' => 'Successfuly updated');
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
            $id = LeadSources::find($leadsourceid);
			$id ->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    } */

    /*
    * FETCH LEAD SOURCES BY LEAD SOURCE TYPE
    * @author RAHUL R.
    * @date 16/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return json encoded lead source list
    */
    public function lead_source_dropdown_list(Request $request)
    {
        $lead_sources = [];
        $lead_source_type = (int)$request->post('source_type');

        if ($lead_source_type > 0)
        {
            $lead_sources = LeadSources::where('lead_source_type_id', $lead_source_type)
                                        ->where('status', config('constant.ACTIVE'))
                                        ->pluck('name', 'id')
                                        ->all();
        }

        return json_encode($lead_sources);

    }
}
