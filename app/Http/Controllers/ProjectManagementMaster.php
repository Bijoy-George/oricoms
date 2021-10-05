<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PmMaster;
use App\Helpers;
use Auth;
use DB;

class ProjectManagementMaster extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:project management', ['only' => ['create']]);
       $this->middleware('check-permission:project management',   ['only' => ['edit']]);
       $this->middleware('check-permission:project management|project management',   ['only' => ['store']]);
       $this->middleware('check-permission:project management',   ['only' => ['destroy']]);
    }
	/*
    * @author RINKU.E.B
    * @date 02/12/2019
    * @since version 1.0.0
    * @param NULL
    * PROJECT MASTER MANAGEMENT
    */
	public function index()
    {
        return view('pm.master.index');
    }
	
	/*
    * Project Master data Listing 
    * @author RINKU.E.B.
    * @date 02/12/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results 			= array();	
        $results = PmMaster::orderBy('id', 'asc');

        if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('name', 'like', '%' . $search_keywords . '%');
                });
            }
		$list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		$html = view('pm.master.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * Function for creating Project master data
    * @author RINKU.E.B.
    * @date 11/10/2018
    * @since version 1.0.0
    */
	public function create()
    {   
		return view('pm.master.create');
    }
	
	/*
    * Update function for Project master data management
    * @author RINKU.E.B.
    * @date 02/12/2019
    * @since version 1.0.0
    * @param NULL
    * editings Project master data management
    */
	public function edit($id)
    {   
            $pm_master = PmMaster::findOrFail($id);
            return view('pm.master.create', compact('pm_master'));
    }


    /*
    * Save function for Project master data Add&Update
    * @author RINKU.E.B.
    * @date 02/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
	   $this->validate($request,
				['name' => 'required|string','type' => 'required'],
				['name.required' => 'The name field is required.','type.required' => 'The type field is required.']);
		$status = PmMaster::updateOrCreate(
            [
                'id' => request('id')
            ],
            [
				'cmpny_id' => Auth::user()->cmpny_id,
				'name' => request('name'),
				'type' => request('type'),
                'status' => request('status'),
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
    * Project master data deletion function
    * @author RINKU.E.B
    * @date 02/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    /* public function destroy(Request $request)
    {
        $id = $request->id;
	   
        if($id)
        {
            $cust_nat_id = PmMaster::find($id);
            $cust_nat_id->delete();
        }
		$result_arr=array('success' => true,'message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    } */
}
