<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tracker;
use App\Project;
use App\ProjectTask;
use App\PmMaster;
use App\User;
use App\Helpers;
use Auth;
use DB;
use Carbon\Carbon;
use App\Jobs\NotifytrackerlistReportCompletion;
use App\Exports\trackerlogexport;
use App\Exports\trackerhoursreport;
use App\Jobs\NotifytrackerhoursReportCompletion;
class TrackerController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:tracker create', ['only' => ['create']]);
       $this->middleware('check-permission:tracker edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:tracker edit|tracker create',   ['only' => ['store']]);
       $this->middleware('check-permission:tracker delete',   ['only' => ['destroy']]);
    }
	/*
    * @author RINKU.E.B.
    * @date 05/12/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function index()
    {
		$priority = PmMaster::where('type',array_search('Priority',config('constant.pm_master_types')))->pluck('name','id')->all();
		$category = PmMaster::where('type',array_search('Category',config('constant.pm_master_types')))->pluck('name','id')->all();
		$status = PmMaster::where('type',array_search('Task Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		$projects = Project::pluck('prjt_name','id')->all();
        return view('pm.tracker.index',compact('priority','category','projects','status'));
    }
	
	/*
    * @author RINKU.E.B.
    * @date 05/12/2019
    * @since version 1.0.0
    */
	public function search_list(Request $request)
    {	
        $response = $request->all();
        $search_keywords = $response['search_keywords'];
		$project_id = $response['project_id'];
        $priority = $response['priority'];
        $category = $response['category'];
        //$members = $response['members'];
		$status = $response['status'];
        $start_date = $response['start_date'];
        $end_date = $response['end_date'];
        $results = array();	
        $results = ProjectTask::where('status',config('constant.ACTIVE'))
                                ->where('members','like','%:"'.Auth::User()->id.'";%')
                                ->orderBy('id', 'desc');

        if(isset($search_keywords) && !empty($search_keywords)) 
		{
			$results->where(function($results) use ($search_keywords){
				$results->orWhere('title', 'like', '%' . $search_keywords . '%');
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
		/*if(isset($members) && !empty($members)) 
		{
			$results->where('members', 'like', '%:"'.$members.'";%');
		}*/
		if(isset($status) && !empty($status)) 
		{
			$results->where('task_status', $status);
		}
		if(isset($start_date) && !empty($start_date)) 
		{
			$start_date = str_replace('/', '-', $start_date);
			$start_date = date('Y-m-d', strtotime($start_date)).' 00:00:00';
			$results->where('created_at', '>', $start_date);
		}
		if(isset($end_date) && !empty($end_date)) 
		{
			$end_date = str_replace('/', '-', $end_date);
			$end_date = date('Y-m-d', strtotime($end_date)).' 23:59:59';
			$results->where('created_at', '<=', $end_date);
		}
		// 
		
		// dd($pmaster);
       
		$list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		$html = view('pm.tracker.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * @author RINKU.E.B.
    * @date 05/12/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function create($task_id)
    { 
		$tracker_array = array();
		$status_arr = PmMaster::where('type',array_search('Task Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		if(isset($task_id) && !empty($task_id))
		{
			$tracker_array = Tracker::select('id','from_time','to_time','description')
            ->where('task_id',$task_id)
            ->where('user_id',Auth::user()->id)
            ->orderBy('id', 'desc')->take(5)
            ->get();
		}
		
		return view('pm.tracker.create', compact('status_arr','task_id','tracker_array'));
    }
	
	/*
    * @author RINKU.E.B.
    * @date 05/12/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function edit($id)
	{   
		$tracker_data = Tracker::findOrFail($id);
		$status_arr = PmMaster::where('type',array_search('Project Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		return view('pm.tracker.create', compact('tracker_data','status_arr'));
    }


    /*
    * @author RINKU.E.B.
    * @date 05/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
		$this->validate($request,[
				'from_time' => 'required|date_format:d/m/Y H:i|before:to_time',
				'to_time' => 'required|date_format:d/m/Y H:i|after:from_time',
    			],[
				'to_time.required' => ' The to time is required.',
				'from_time.required' => ' The from time is required.',
    			]);

		if(request('from_time') && !empty(request('from_time')))
		{
			$from_time = str_replace('/', '-', request('from_time'));
			$from_time = date('Y-m-d H:i', strtotime($from_time)).':00';
		}
		if(request('to_time') && !empty(request('to_time')))
		{
			$to_time = str_replace('/', '-', request('to_time'));
			$to_time = date('Y-m-d H:i', strtotime($to_time)).':00';
		}
		$status = Tracker::updateOrCreate(
            ['id' => request('id')],
            [
				'cmpny_id'       => Auth::user()->cmpny_id,
				'user_id'       => Auth::user()->id,
                'description'    => request('description'),
                'from_time'       => $from_time,
                'to_time'       => $to_time,
                'status' 		 => request('status'),
                'task_id' 		 => request('task_id'),
			]);
		$status_task = ProjectTask::updateOrCreate(
			['id' => request('task_id')],
			[
				'task_status' => request('status'),
			]
			);
			
			
			if(!empty(request('id')))
			{
                $result_arr=array('reset'=>false,'success' => true,'status' => 'success','message' => 'Successfuly updated');
            }else{
                $result_arr=array('reset'=>true,'success' => true,'status' => 'success','message' => 'Successfuly added');
            }
			return $result_arr;		
	}


    /*
    * @author RINKU.E.B.
    * @date 05/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public function destroy($id)
    {
        if($id)
        {
            $tracker = Tracker::find($id); 
			
            $tracker->delete();
        }
		$result_arr=array('success' => true,'status' => 'success','message' => 'Successfuly deleted', 'refresh' => true);
		return $result_arr;		
    
    } 
	
	
		/*
    * @author RINKU.E.B.
    * @date 06/12/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function tracker_index()
    {
		$status_arr = PmMaster::where('type',array_search('Project Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		$projects = Project::where('status',config('constant.ACTIVE'))->pluck('prjt_name','id')->all();
        return view('pm.tracker.tracker_index',compact('status_arr','projects'));
    }
	
	/*
    * @author RINKU.E.B.
    * @date 06/12/2019
    * @since version 1.0.0
    */
	public function tracker_search_list(Request $request)
    {	
        $response           = $request->all();
        //$search_keywords    = $response['search_keywords'];
        $from_time    = $response['from_time'];
        $to_time    = $response['to_time'];
        $status    = $response['status'];
        $prjt_id    = $response['prjt_id'];
        $task       = $response['task'];
        $results 			= array();	
        $results = Tracker::with('task.project')->where('user_id',Auth::User()->id)->orderBy('id', 'asc');

        /*if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('title', 'like', '%' . $search_keywords . '%');
                });
            }*/
		if(isset($from_time) && !empty($from_time))
		{
			$from_time = str_replace('/', '-', $from_time);
			$from_time = date('Y-m-d', strtotime($from_time)).' 00:00:00';
			$results->where('from_time', '>=', $from_time);
		}
		if(isset($to_time) && !empty($to_time))
		{
			$to_time = str_replace('/', '-', $to_time);
			$to_time = date('Y-m-d', strtotime($to_time)).' 23:59:59';
			$results->where('to_time', '<=', $to_time);
		}
		if(isset($status) && !empty($status))
		{
			$results->where('status', $status);
		}
		if(isset($prjt_id) && !empty($prjt_id)) 
        {
        $results->whereHas('task.project', function($results) use ($prjt_id){
            $results->where('project_id','=',$prjt_id);

        });
        }
		if(isset($task) && !empty($task))
		{
			$results->where('task_id', $task);
		}
		$list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
		$html = view('pm.tracker.tracker_listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;		
	}
	
	/*
    * @author RINKU.E.B.
    * @date 06/12/2019
    * @since version 1.0.0
    */
	public function tracker_data_edit($id)
	{
		$tracker_data = Tracker::findOrFail($id);
		$status_arr = PmMaster::where('type',array_search('Project Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		return view('pm.tracker.create', compact('tracker_data','status_arr'));
	}

	public function tasks_graph(Request $request)
	{

		$user_id = Auth::User()->id;
		$pmaster = PmMaster::where('type',array_search('Task Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		$user_info = ProjectTask::select('task_status', DB::raw('count(*) as total'))->where('members','like','%:"'.Auth::User()->id.'";%')
                 ->groupBy('task_status')
                 ->get();
		$task_status_array = array();
		foreach ($pmaster as $id => $value1) {
			$name = $value1;
			$status_count	= $user_info->where('task_status', $id)->first();
			$status_count	= $status_count->total ?? 0;
// dd($status_count);
			$task_status_array[]	= ['name'	=> $name,'total' => $status_count];
		}

		// dd($task_status_array);


  //                FaqCategories::select('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id as category_id', 'ori_mast_faq_categories.short_code')
		// ->join('ori_mast_query_category_relation', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
                 // echo "<pre>";
                 // print_r($user_info);die;
       // $tgraph = array();
        $tgraph = '[';
        foreach ($task_status_array as $value) {
                 $tstaus = $value['name'];
                 $tcount = $value['total'];
                 $tgraph.='{"name":"'.$tstaus.'","y":'.$tcount.'},';
                 // $tgraph['name'][] = $tstaus;
                 // $tgraph['y'][]=$tcount ; 
                 }
                $tgraph = rtrim( $tgraph,",") ;  
                 $tgraph .="]";  
                return json_encode($tgraph);
	}


	public function get_task_list(Request $request)
	{
		$prjct_id = request('prjct_id');
		$tasks = ProjectTask::select('id','title')->where('project_id',$prjct_id)
                 ->get();
         echo $tasks;
	}

	public function export_trackerlog(Request $request)
    {
        $prjt_id = $request->post('prjct_id');
        $task = $request->post('task');
        $from_time = $request->post('from_time');
        $to_time = $request->post('to_time');
        $status = $request->post('status');
        $user_id         = Auth::user()->id;
        $cmpny_id        = Auth::user()->cmpny_id;
        $now             = time();
         $file_name         = 'tasklog - '.$now.'.xlsx';
        $path='/export_tracker/'.$file_name;

        $data = [
            'user_id'  => $user_id,
            'cmpny_id' => $cmpny_id,
             'file_name'        => urlencode($file_name),
             'prjt_id'  => $prjt_id,
             'task'  => $task,
             'from_time'  => $from_time,
             'to_time'  => $to_time,
             'status'        => $status
        ];
        (new trackerlogexport($data))->queue($path)->chain([
            new NotifytrackerlistReportCompletion($data),

        ]);

    }

    public function download_task_log_report($file_name)
    {
        $file_name  = urldecode($file_name);
        $path = storage_path('app/export_tracker/'.$file_name);
        return response()->download($path);
    }
        public function tracker_history_index(Request $request)
    {
        $projects = Project::pluck('prjt_name','id')->all();
        // $tasks = PmMaster::where('type',array_search('Project Status',config('constant.pm_master_types')))->pluck('name','id')->all();
        $tasks = ProjectTask::pluck('title','id')->all();
        $users       =  User::where('status', config('constant.ACTIVE'))->pluck('name', 'id')->all();
        return view ('pm.tracker.index_history',compact('projects','tasks','users'));
    }

    public function tracker_history_details(Request $request)
    {
        $response           = $request->all(); 
        $from_time    = $response['start_date'];
        $to_time    = $response['end_date'];
        $prjt_id    = $response['prjt_id'];
        $task       = $response['task'];
        $user       = $response['user'];
        $results            = array();  
        $results = Tracker::with('task.project')->orderBy('id', 'asc');

        /*if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('title', 'like', '%' . $search_keywords . '%');
                });
            }*/
        if(isset($from_time) && !empty($from_time))
        {
            $from_time = str_replace('/', '-', $from_time);
            $from_time = date('Y-m-d', strtotime($from_time)).' 00:00:00';
            $results->where('from_time', '>=', $from_time);
        }
        if(isset($to_time) && !empty($to_time))
        {
            $to_time = str_replace('/', '-', $to_time);
            $to_time = date('Y-m-d', strtotime($to_time)).' 23:59:59';
            $results->where('from_time', '<=', $to_time);
        }
        if(isset($prjt_id) && !empty($prjt_id)) 
        {
        $results->whereHas('task.project', function($results) use ($prjt_id){
            $results->where('project_id','=',$prjt_id);

        });
        }
        if(isset($task) && !empty($task))
        {
            $results->where('task_id', $task);
        }
		 if(isset($user) && !empty($user))
        {
            $results->where('user_id', $user);
        }
        $list_count = $results->count();
        $results    =   $results->paginate(config('constant.pagination_constant'));
        $html = view('pm.tracker.tracker_details')->with(compact('results','list_count'))->render();
        $result_arr=array('success' => true,'html' => $html);
        return $result_arr;     
    }
//Export
    public function export_trackerhours(Request $request)
    {
        
        $prjt_id = $request->post('prjct_id');
        $task = $request->post('task');
        $startdate       = $request->post('start_date');
        $enddate         = $request->post('end_date');
        $user_id         = Auth::user()->id;
        $cmpny_id        = Auth::user()->cmpny_id;
        $now             = time();
         $file_name         = 'TrackerReport-'.$now.'.xlsx';
         $path='/export_tracker_hours/'.$file_name;

        $data = [
            'user_id'  => $user_id,
            'cmpny_id' => $cmpny_id,
             'file_name'        => urlencode($file_name),
             
             'prjt_id'  => $prjt_id,
             'task'  => $task,
             'startdate'        => $startdate,
             'enddate'          => $enddate
        ];
 
        (new trackerhoursreport($data))->queue($path)->chain([
            new NotifytrackerhoursReportCompletion($data),

        ]);

    }

    public function download_tracker_report($file_name)
    {
        
        $file_name  = urldecode($file_name);
        $path = storage_path('app/export_tracker_hours/'.$file_name);
        return response()->download($path);
    } 


    
}