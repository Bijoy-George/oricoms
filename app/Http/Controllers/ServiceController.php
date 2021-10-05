<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\Project;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:service create', ['only' => ['create']]);
       $this->middleware('check-permission:service edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:service edit|service create',   ['only' => ['store']]);
       $this->middleware('check-permission:service delete',   ['only' => ['destroy']]);
    }

public function index()
    {
        return view('server_management.service.index');
    }
    
    public function search_list(Request $request)
    {   
        $response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $results            = array();  
        $results = Service::orderBy('id', 'asc');
        

        if(isset($search_keywords) && !empty($search_keywords)) 
        {
            $results->where(function($results) use ($search_keywords){
                $results->orWhere('service_name', 'like', '%' . $search_keywords . '%');
                $results->orWhere('description', 'like', '%' . $search_keywords . '%');
            });
        }
        $list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
        // dd($results);
        $html = view('server_management.service.listview')->with(compact('results','list_count'))->render();
        $result_arr=array('success' => true,'html' => $html);
        return $result_arr;     
    }

    public function create()
    { 

        $flags = array();
        $list = Service::select('id','service_name','service_flag')->get();
        foreach ($list as $value) {
           $flags[]=Array ( 'service_flag'=>$value->service_flag,'service_name' => $value->service_name,'id' => $value->id);
        }
        return view('server_management.service.create',compact('flags'));
    }
    

       public function edit($id)
    {   
            $service = Service::findOrFail($id);
            $flags = array();
            $list = Service::select('id','service_name','service_flag')->get();
            foreach ($list as $value) {
            $flags[]=Array ( 'service_flag'=>$value->service_flag,'service_name' => $value->service_name,'id' => $value->id);
        }
        return view('server_management.service.create', compact('service','flags'));
    }


    public function store(Request $request)
       {
        // dd($request);
       $this->validate($request,
                ['service_name' => 'required|string'],
                ['service_name.required' => 'The service name field is required.',
                  'description' =>'required',  
            ]);
        $status = Service::updateOrCreate(
            [
                'id' => request('id')
            ],
            [
                'cmpny_id' => Auth::user()->cmpny_id,
                'service_name' => request('service_name'),
                'description' => request('description') ?? '',
                'status' => request('status'),
                'service_flag' => request('check_list') ?? 0,
            ]);
            
            if(!empty(request('id')))
            {
                $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
            }else{
                $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
            }
            return $result_arr;     
    }
    public function destroy($id)
    {
        //$id = $request->id;
        $userid = Auth::User()->id;
        $message = '';
        $success = false;
        if($id)
        {
            $tasks = Service::where('id',$id)->update(['status' => config('constant.INACTIVE'),'updated_by' => $userid]);
            $message = "Successfuly Deleted";$success = true;
        }
        $result_arr=array('success' => $success,'message' => $message, 'refresh' => true);
        return $result_arr;     
    
    } 
    
}
