<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use App\Server;
use App\Service;
use App\ServerService;
use App\Serverresource;
use Helpers;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\serverdataexport;
use App\Events\Oripusher;
use App\Jobs\NotifyserverdataReportCompletion;

class ServerController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:server create', ['only' => ['create']]);
       $this->middleware('check-permission:server edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:server edit|server create',   ['only' => ['store']]);
       $this->middleware('check-permission:server delete',   ['only' => ['destroy']]);
    }
	/*
    * @author RINKU.E.B
    * @date 02/12/2019
    * @since version 1.0.0
    * @param NULL
    * PROJECT TASK VIEW
    */
	public function index()
    {
		
        return view('server_management.server.index');
    }
	
	/*
    * @author RINKU.E.B
    * @date 03/12/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function search_list(Request $request)
    {	
        $response = $request->all();
        $search_keywords = $response['search_keywords'];
        $results = array();	
        $results_scnd = array();
        $user_info = array();
        $results = Server::where('status',config('constant.ACTIVE'));
        $server_details = array();
        if(isset($search_keywords) && !empty($search_keywords)) 
		{
			$results->where(function($results) use ($search_keywords){
				$results->orWhere('server_name', 'like', '%' . $search_keywords . '%');
			});
    	}

		if(isset($project_id) && !empty($project_id)) 
		{
			$results->where('project_id', $project_id);
		}
		if(isset($priority) && !empty($priority)) 
		{
			$results->where('priority', $priority);
		}
		if(isset($category) && !empty($category)) 
		{
			$results->where('category', $category);
		}
		if(isset($members) && !empty($members)) 
		{
			$results->where('members', 'like', '%:"'.$members.'";%');
            $user_info = ProjectTask::select('project_id', DB::raw('count(*) as total'))->where('members','like','%:"'.$members.'";%')->where('status',config('constant.ACTIVE'))
                 ->groupBy('project_id')
                 ->get();
                 // $user_info = $user_info->sum('required_time');
                 // dd($user_info);
            $search_table = array();
            foreach ($results_scnd as $id => $value) {
                $name = $value;
                $task_count = $user_info->where('project_id',$id)->first();
                $task_count1 = ProjectTask::where('status',config('constant.ACTIVE'))->where('project_id',$id)->sum('required_time');
                $task_count = $task_count->total ?? 0;
                $search_table []  = ['name'   => $name,'total' => $task_count,'time' =>$task_count1];
            }

            
		}

		if(isset($status) && !empty($status)) 
		{
			$results->where('task_status', $status);
		}
		if(isset($start_date) && !empty($start_date)) 
		{
			$start_date = str_replace('/', '-', $start_date);
			$start_date = date('Y-m-d', strtotime($start_date)).' 00:00:00';
			$results->where('created_at', '>', $start_date);
            $results_scnd = Project::where('created_at', '>', $start_date)->pluck('prjt_name','id')->all();
        $user_info = ProjectTask::where('status',config('constant.ACTIVE'))->where('created_at', '>', $start_date)->select('project_id', DB::raw('count(*) as total'))
                 ->groupBy('project_id')
                 ->get();
            $search_table = array();
            foreach ($results_scnd as $id => $value) {
                $name = $value;
                $task_count = $user_info->where('project_id',$id)->first();
                $task_count1 = ProjectTask::where('status',config('constant.ACTIVE'))->where('project_id',$id)->where('created_at', '>', $start_date)->sum('required_time');
                $task_count = $task_count->total ?? 0;
                $search_table []  = ['name'   => $name,'total' => $task_count,'time' =>$task_count1];
            }
		}
		if(isset($end_date) && !empty($end_date)) 
		{
			$end_date = str_replace('/', '-', $end_date);
			$end_date = date('Y-m-d', strtotime($end_date)).' 23:59:59';
			$results->where('created_at', '<=', $end_date);

            $results_scnd = Project::where('created_at', '<=', $end_date)->pluck('prjt_name','id')->all();
        $user_info = ProjectTask::where('status',config('constant.ACTIVE'))->where('created_at', '<=', $end_date)->select('project_id', DB::raw('count(*) as total'))
                 ->groupBy('project_id')
                 ->get();
            $search_table = array();
            foreach ($results_scnd as $id => $value) {
                $name = $value;
                $task_count = $user_info->where('project_id',$id)->first();
                $task_count1 = ProjectTask::where('status',config('constant.ACTIVE'))->where('project_id',$id)->where('created_at', '<=', $end_date)->sum('required_time');
                $task_count = $task_count->total ?? 0;
                $search_table []  = ['name'   => $name,'total' => $task_count,'time' =>$task_count1];
            }
		}
		

		$list_count = $results->count();

        $results    =   $results->paginate(config('constant.pagination_constant'));
		$html = view('server_management.server.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
        // dd($result_arr)
		return $result_arr;		
	}
	
	/*
    * @author RINKU.E.B
    * @date 03/12/2019
    * @since version 1.0.0
    * @param NULL
    * @return view for editings customer nature
    */
	public function create()
    { 
        $permissions = array();
        $list = Service::select('id','service_name','service_flag')->where('status',config('constant.ACTIVE'))->get();
        // dd($list);
        $permission = array();
        foreach ($list as $value) {
           $permission[]=Array ( 'name' => $value->service_name,'id' => $value->id,'service_flag'=>$value->service_flag);
        }

		return view('server_management.server.create',compact('permission'));
    }
	
	/*
    * @author RINKU.E.B
    * @date 03/12/2019
    * @since version 1.0.0
    * @param NULL
    * @return view for editings Customer Nature
    */
	public function edit($id)
    {   
		$server_list = Server::findOrFail($id);
        $service_id1 = Server::select('service','threshold_resource3')->where('id',$id)->get();
        $service_id =array();
        // $threshold_resource3 = array();
        foreach ($service_id1 as  $value) {
            $service_id =unserialize($value->service);
            // dd($value->threshold_resource3);
            $threshold_resource3 = unserialize($value->threshold_resource3);
        }
         // dd($threshold_resource3);
		$permission = array();
        $list = Service::select('id','service_name','service_flag')->get();
        foreach ($list as $value) {
           $permission[]=Array ( 'name' => $value->service_name,'id' => $value->id,'service_flag'=>$value->service_flag);
        }


        
        return view('server_management.server.create',compact('permission','server_list','service_id','threshold_resource3'));
    }


    /*
    * @author RINKU.E.B
    * @date 03/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
  
		$this->validate($request,
				['server_name' => 'required|string|max:500',
                'threshold_resource1' => 'string|nullable',
                'threshold_resource2' => 'numeric|nullable',
                'inputs.*' =>'numeric|nullable',
                'status' => 'required'
                  ] 
				);
        $validate_array = array();
        for($x=0; $x<=26; $x++) {
            if(!empty($request->post('total'.$x)))
            {
             $validate_array['total'. $x] = 'required|numeric';
             }
             }
             $this->validate($request, $validate_array
                );

		$task_id = (int)$request->post('id');
		$task_status = $request->post('task_status');
        $permissions = $request->post('check_list');
        $hdd_array = array();
    for($i=0;$i<=26;$i++)
    {
        if( $request->post('inputs'.$i)!=null)
        {
       $hdd_array[$i]['drive'] = $request->post('inputs'.$i);
       $hdd_array[$i]['total'] = $request->post('total'.$i);
       $hdd_array[$i]['tbgb'] = $request->post('size'.$i);
        }
        
    }
   
        $hard_disk_array = serialize($hdd_array);
     
        if (!empty($permissions))
        {
            $permissions = serialize($permissions);
        }

        $task_tracker = server::updateOrCreate(
            ['id'                => request('id')],
            [
                'cmpny_id'       => Auth::user()->cmpny_id,
                'server_name'       => request('server_name'),
                'description'    => request('description'),
                'server_ip'       => request('server_ip'),
                'threshold_resource1'       =>request('threshold_resource1'),
                'threshold_resource2'       => request('threshold_resource2'),
                'threshold_resource3'    => $hard_disk_array,
                'server_ip'       => request('server_ip'),

                'stage'       => request('status'),
                'service' =>$permissions,
                'created_by' =>Auth::user()->id,
                'updated_by' =>Auth::user()->id,
            ]);			
		if(!empty(request('id')))
		{
            $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
        }else{
            $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
        }

        // $cmpny_id        = Auth::user()->cmpny_id;
        // $now             = time();
        // $file_name         = 'serverlog - '.$now.'.xlsx';

        Helpers::add_pusher("Server","Create/Update",url('/server'),Auth::user()->id,Auth::user()->cmpny_id);
        $cmpny_id =Auth::user()->cmpny_id;
        $url='/server';
        $msg = "New server created";
        $server_name =$request->post('server_name');
        $data = [
            
            'cmpny_id' => $cmpny_id,
            'server_name' =>$server_name,
             'url'        => $url,
             'msg' => $msg
        ];

        event(new Oripusher($data));
		return $result_arr;		
	}


    /*
    * @author RINKU.E.B
    * @date 03/12/2019
    * @since version 1.0.0
    * @param NULL
    */
     public function destroy($id)
    {
		$userid = Auth::User()->id;
		$message = '';
		$success = false;
        if($id)
        {	
			$tasks = Server::where('id',$id)->update(['status' => config('constant.INACTIVE'),'updated_by' => $userid]);
			$message = "Successfuly Deleted";$success = true;	
        }
		$result_arr=array('success' => $success,'message' => $message, 'refresh' => true);
		return $result_arr;		
    
    } 
	
	/*
    * get members based on a project
    * @author RINKU.E.B.
    * @date 04/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public function get_project_members(Request $request)
	{
		$project = request('project');
		$results = Project::select('members')->where('id',$project)->first();//echo "<pre>";print_r($results);die;
		$pass_arr = array();
		if($results)
		{
			$members = $results->members;
			$members_arr = unserialize($members);
			foreach($members_arr as $data)
			{
				$mem_id = $data;
				$mem_name = Helpers::get_username_by_id($mem_id);
				$pass_arr[$mem_id] = $mem_name;
			}
		}
		echo json_encode($pass_arr);
	}


    public function export_taskslist(Request $request)
    {
        $search_keywords = $request->post('search_keywords');
        $members = $request->post('members');
        $project_id = $request->post('project_id');
        $priority = $request->post('priority');
        $category = $request->post('category');
        $status = $request->post('status');
        $startdate       = $request->post('startdate');
        $enddate         = $request->post('enddate');
        $user_id         = Auth::user()->id;
        $cmpny_id        = Auth::user()->cmpny_id;
        $now             = time();
         $file_name         = 'Lead Report - '.$now.'.xlsx';
        $path='/export_tasks/'.$file_name;

        $data = [
            'user_id'  => $user_id,
            'cmpny_id' => $cmpny_id,
             'file_name'        => urlencode($file_name),
             'search_keywords'  => $search_keywords,
             'members'  => $members,
             'project_id'  => $project_id,
             'category'  => $category,
             'priority'  => $priority,
             'status'  => $status,
             'startdate'        => $startdate,
             'enddate'          => $enddate
        ];
        (new tasklistreport($data))->queue($path)->chain([
            new NotifytasklistReportCompletion($data),

        ]);

    }

 public function download_projecttask_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/export_tasks/'.$file_name);
        return response()->download($path);
    }
	
 public function serviceedit($id)  
 {
    $resources = Server::select('service','server_name','threshold_resource1','threshold_resource2','threshold_resource3')->where('id',$id)->first();
    $service = array();
    if(!empty($resources->service)) 
    {
        $service = unserialize($resources->service);
        $server_name = $resources->server_name;
        $threshold_resource3 =unserialize($resources->threshold_resource3);
    }
    $services1 = array();  
    $services1 = Service::select('service_name','id','service_flag')->wherein('id',$service)->get();
    return view('server_management.server.service_resource',compact('services1','resources','id','server_name','threshold_resource3'));
 } 
 public function service_edit(Request $request)
 {

    $server_id = $request->post('server_id');
    $service_id = $request->post('id');
    $services1 = Service::select('service_name')->where('id',$service_id)->first();
     $result_arr = array('success' => true,'services1' => $services1->service_name ?? '', 'service_id' => $service_id,'server_id'=>$server_id);
        return json_encode($result_arr);
 }

 public function server_service(Request $request)
 {

    $this->validate($request,
                ['description' => 'string|nullable',
                'remark1'=>'string|nullable',
                'remark2'=>'string|nullable',
                'remark3'=>'string|nullable',
                 'resource1' =>'numeric|nullable',
                 'resource2' =>'numeric|nullable',
                 // 'resource3.*' =>'numeric|nullable',
                 
                  ]
                );

    $server_id = $request->post('server_id');
    $services_count = $request->post('services_count');
    $status = $request->post('status');
    $description = $request->post('description');
    $resource1 = $request->post('resource1');
    $resource2 = $request->post('resource2');
    $hdd_array = array();
   for($i=0;$i<=26;$i++)
   {
    if( $request->post('inputs'.$i)!=null)
        {
    $hdd_array[$i]['drive'] = $request->post('inputs'.$i);
    $hdd_array[$i]['total'] = $request->post('total'.$i);
    $hdd_array[$i]['used'] = $request->post('used'.$i);
    $hdd_array[$i]['size'] = $request->post('size'.$i);
        }
   }  
   $hard_disk_array = serialize($hdd_array);
	$new_array = array();
    $server_services = Serverresource::updateOrCreate(
            ['id'                => request('id')],
            [
                'cmpny_id'       => Auth::user()->cmpny_id,
                'server_id'       =>$server_id,
                'resource1' =>$resource1,
                'status' =>1,
                'resource2' =>$resource2,
                'resource3' =>$hard_disk_array,
            ]); 


    for($i=0;$i<$services_count;$i++)
   {
    $status_resource = $request->post('status'.$i);
    $service_id = $request->post('service_id'.$i);
    $resource_array = [
        'cmpny_id' =>Auth::user()->cmpny_id,
        'server_id'=>$server_id,
        'service_id'=>$service_id,
        'server_resource_id' => $server_services->id,
        'status'=>$status_resource
       ];
     if($resource_array) 
     {
        $task_tracker = ServerService::updateOrCreate(
            ['id'                => request('id')],$resource_array
            );     
     } 
   }                
        
            $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly updated');
        return $result_arr;     

 }

    public function server_deatials($id)
    {
        return view('server_management.server.index_server',compact('id'));
    }

    public function server_details_list(Request $request)
    {
        $server_id = $request->post('server_id');
        $services = Server::where('id',$server_id)->get();

        $from_date          = $request->post('startdate') ?? '';
        $from_date          = str_replace('/', '-', $from_date);
        $to_date            = $request->post('enddate') ?? '';
        $to_date            = str_replace('/', '-', $to_date);
                if (!empty($from_date))
        {
            $from_date          =   date('Y-m-d', strtotime($from_date)).' 00:00:01';
        }
        if (!empty($to_date))
        {
            $to_date            =   date('Y-m-d', strtotime($to_date));
        }
        if($to_date <= '2000-01-01')
        {
            $to_date = '';
        }
        else
        {
            $to_date = $to_date.' 23:59:59';
        }
        foreach ($services as  $value) {
            $services_id = $value->service;
            $server_name = $value->server_name;


        }
        $service_idn = unserialize($services_id);
        $server_resource = Serverresource::select('resource1','resource2','resource3','status','created_at')->where('server_id',$server_id);

        $resources3 = $server_resource->get();
        // dd($resources3);
        $resource_collcetion = array();
        foreach ($resources3 as $value) {
            
         $resource_collcetion[] =   unserialize($value->resource3);


         } 
         
        $service_details = ServerService::query();
        if (empty($service_idn))
        {
            $service_idn = array();
        }
        if(isset($service_idn))
        {
            $service_details = $service_details->wherein('service_id',$service_idn)->with('getservices');
        }
            if(isset($from_date) && !empty($from_date))
            {
                $service_details->where('created_at','>=',$from_date);
                $server_resource->where('created_at','>=',$from_date);
            }
            if(isset($to_date) && !empty($to_date))
            {
                $service_details->where('created_at','<=',$to_date);
                $server_resource->where('created_at','<=',$to_date);
            }
       
        if(isset($service_details))
        {
        $service_details    =   $service_details->Paginate(config('constant.pagination_constant'));
        }
                    if(isset($from_date) && !empty($from_date))
            {
                $service_details->where('created_at','>=',$from_date);
            }
            if(isset($to_date) && !empty($to_date))
            {
                $service_details->where('created_at','<=',$to_date);
            }
        $server_resource    =   $server_resource->Paginate(config('constant.pagination_constant'));
         $html = view('server_management.server.service_edit')->with(compact('service_details','server_resource','services'))->render();
        $result_arr=array('success' => true,'html' => $html);
        // dd($result_arr)
        return $result_arr; 

    }

    public function server_reports(Request $request)
    {
        return view('server_management.server.server_export');
    }

    public function export_server_report(Request $request)
    {
        $startdate = $request->post('startdate');
        $stage = $request->post('stage');
        $user_id         = Auth::user()->id;
        $cmpny_id        = Auth::user()->cmpny_id;
        $now             = time();
        $file_name         = 'serverlog - '.$now.'.xlsx';
        $path='/export_server/'.$file_name;
        $data = [
            'user_id'  => $user_id,
            'cmpny_id' => $cmpny_id,
             'file_name'        => urlencode($file_name),
             'startdate' => $startdate,
             'stage' => $stage
        ];
        (new serverdataexport($data))->queue($path)->chain([
            new NotifyserverdataReportCompletion($data),

        ]);

    }

    public function download_server_report($file_name)
    {       
        $file_name  = urldecode($file_name);
        $path = storage_path('app/export_server/'.$file_name);
        return response()->download($path);
    }

    public function resource_alert(Request $request)
    {
        $resource = Serverresource::with('getresources');
        $resource = $resource->paginate(config('constant.pagination_constant'));

        return view('server_management.server.resource_alert',compact('resource'));
    }

    public function service_resource_delete($id)
    {
 
        $success    = false;
        $message    = '';
        
        do {
            $server_service = ServerService::where('server_resource_id',$id)->delete();
            $server_resource = Serverresource::where('id',$id)->delete();
            $success = true;
            $message = 'Service and Resource Deleted Successfully';
        }
        while(false);

        if (!$success)
        {
            $message    = $message ?? 'Service could not be deleted.';
        }

        $result_arr = array('success' => $success, 'message' => $message, 'refresh' => true);

        echo json_encode($result_arr);
    }

    public function server_qamonitoring(Request $request)
    {
       $stage = $request->post('status');
       $resources = Server::select('service','server_name','id','threshold_resource1','threshold_resource2','threshold_resource3')->where('status',config('constant.ACTIVE'))->get();
       if(isset($stage)&&!empty($stage))
       {
        $resources = Server::select('service','server_name','id','threshold_resource1','threshold_resource2','threshold_resource3')->where('status',config('constant.ACTIVE'))->where('stage',$stage)->get();
       }
       
    $service = array();
    $server_name = array();
    $services1 = array();
    $threshold_resource3 = array();
    $id = array();
    $permission =array();
    
    if(!empty($resources)) 
    {
        foreach($resources as $res)
        {
        $service = unserialize($res->service);
        $server_name = $res->server_name;
        $id = $res->id;
        $threshold_resource3 =$res->threshold_resource3; 
        
        $services1= Service::select('service_name','id','service_flag')->wherein('id',$service)->get();

        $permission[]=Array ( 'server_name' =>$server_name,'id' => $id,'threshold_resource3'=>$threshold_resource3,'services1'=>$services1);

        }
    }

      $html = view('server_management.server.server_fullist')->with(compact('permission'))->render();
        $result_arr=array('success' => true,'html' => $html);
        return $result_arr; 
     // return view('server_management.server.server_fullist',compact('permission'));
    }

    public  function server_monitoring(Request $request)
    {
        $server_count = $request->post('server_count');
        for($j=1;$j<=$server_count;$j++)
        {
            $server_id = $request->post('server_id'.$j);
            $validate_array['resource1'.$server_id] = 'numeric|nullable';
            $validate_array['resource2'.$server_id] = 'numeric|nullable'; 
            for($k=0;$k<=26;$k++)
        {
            if( $request->post('inputs'.$server_id.$k)!=null)
            {
                $validate_array['used'.$server_id.$k] = 'numeric|nullable';
            }
            }      
        }
        $this->validate($request,$validate_array,
                ['description' => 'string|nullable',
                'remark1'=>'string|nullable',
                'remark2'=>'string|nullable',
                'remark3'=>'string|nullable',
                 'resource1' =>'numeric|nullable',
                 'resource2' =>'numeric|nullable',
                 // 'resource3.*' =>'numeric|nullable',
                 
                  ]
                );
    $server_count = $request->post('server_count');
    for($j=1;$j<=$server_count;$j++)
    {
        $hdd_array = array();
        $server_id = $request->post('server_id'.$j);
        $service_count = $request->post('service_count'.$j);
        $resource1 = $request->post('resource1'.$server_id);
        $resource2 = $request->post('resource2'.$server_id);
        for($k=0;$k<=26;$k++)
        {
            if( $request->post('inputs'.$server_id.$k)!=null)
            {
                $hdd_array[$k]['drive'] = $request->post('inputs'.$server_id.$k);
                $hdd_array[$k]['total'] = $request->post('total'.$server_id.$k);
                $hdd_array[$k]['used'] = $request->post('used'.$server_id.$k);
                $hdd_array[$k]['size'] = $request->post('size'.$server_id.$k);
            }
            
        }
        $hard_disk_array = serialize($hdd_array);
        $server_services = Serverresource::updateOrCreate(
            ['id'                => request('id')],
            [
                'cmpny_id'       => Auth::user()->cmpny_id,
                'server_id'       =>$server_id,
                'resource1' =>$resource1,
                'status' =>1,
                'resource2' =>$resource2,
                'time'      =>date('H:i'),
                'resource3' =>$hard_disk_array,
            ]); 
       for($i=0;$i<$service_count;$i++)
       {
        $status_resource = $request->post('status'.$server_id.$i);
        $service_id = $request->post('service_id'.$server_id.$i);
        $resource_array = [
        'cmpny_id' =>Auth::user()->cmpny_id,
        'server_id'=>$server_id,
        'service_id'=>$service_id,
        'server_resource_id' => $server_services->id,
        'status'=>$status_resource
       ];
     if($resource_array) 
     {
        $task_tracker = ServerService::updateOrCreate(
            ['id'                => request('id')],$resource_array
            );     
     } 
       }
    }
                       
            // $result_arr=array('success' => true,'message' => 'Successfuly updated');
        return view('server_management.server.server_monitor');
        // $result_arr;     

 }


 public function test_export(Request $request)
 {
   
        $cond_arr = array();
        //print_r($search_criteria['start_date']. " and ". $search_criteria['end_date']);die;
        $start_date = "16/04/2020";
        // $end_date = $search_criteria['end_date'];
      
        
            $date_format_sdate=explode('/', $start_date);
            $sdate  =   $date_format_sdate[2].'-'.$date_format_sdate[1].'-'.$date_format_sdate[0];
            $s_date =$sdate;
      
        $services = Server::query()->get();
        foreach ($services as  $value) {
            $services_id = $value->service;
            $server_name = $value->server_name;
        }
        // $server_reservice = Serverresource::select('id','server_id','resource1','resource2','resource3','created_at')->where('created_at', '>=', $s_date . ' 00:00:00')->where('created_at', '<=', $s_date . ' 23:59:59')->get();

        $results = Serverresource::with('getresource','getserver')->where('created_at', '>=', $s_date . ' 00:00:00')->where('created_at', '<=', $s_date . ' 23:59:59');
        $results = $results->get();



        // $helpdesk_noresponse = CustomerProfile::with('GetHelpdesk')->whereHas('GetHelpdesk', function($query) use ($no_responseid) { $query->where('customer_response', $no_responseid); })->where('profile_status',config('constant.Valid_Customer'))->where('agent_id',$agent_id)->count();

        $results1 = Server::with('getresource','getservice')->whereHas('getresource', function($query) use ($s_date) { $query->where('created_at', '>=', $s_date . ' 00:00:00')->where('created_at', '<=', $s_date . ' 23:59:59'); });
        $results1 = $results1->get();
        // dd($results1);

         $server_relations = Serverresource::with('getserver')->where('created_at', '>=', $s_date . ' 00:00:00')->where('created_at', '<=', $s_date . ' 23:59:59')->get();
         // dd($server_relations);
        $server_id = array();
        $resource1 = array();
        $resource2 = array();
        $resource3 = array();
        $server_service = array();
        $server_details = array();
        $service_name = array();
        $server_name = array();
        $service = array();
        $services1 = array();
        // foreach ($server_reservice as $value) {
        //     $server_details = Server::select('server_name','service')->where('id',$value->server_id)->get();
        //     foreach ($server_details as  $res) {
        //         $server_name = $res->server_name;
        //         $service = unserialize($res->service);
        //         $services1= Service::select('service_name','id','service_flag')->wherein('id',$service)->get();
        //         foreach ($services1 as  $service_status) {
        //              $service_sts = ServerService::select('status')->where('service_id',$service_status->id)->get();
        //         }

        //     }



        // }
        // dd($service_sts);




        // $results = ServerService::with('getservices','getserver','getresource')->where('created_at', '>=', $s_date . ' 00:00:00')->where('created_at', '<=', $s_date . ' 23:59:59'); 
        // $results = $results->get();
        // dd($results);
        return view('server_management.server.assets',compact('results1'));

 }
  public function server_monitor(Request $request)
 {
    return view('server_management.server.server_monitor');
 }
 
    public function test_export123(Request $request)
 {
   $results1 = array();$time_arr = array();
   $time_arr = Serverresource::distinct()->where('created_at','like','%2020-04-16%')->get(['time']);
   // echo "<pre>";print_r($time_arr);die;
		$servers = Server::select('id','service','server_name')->where('status',config('constant.ACTIVE'))->get();

       
        return view('server_management.server.test',compact('results1','servers','time_arr'));

 }

}
