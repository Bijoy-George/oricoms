<?php

namespace App\Http\Controllers;
use App\CommonSmsEmail;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\PmMaster;
use App\Project;
use App\ProjectIntimations;
use App\ProjectTask;
use App\Templates;
use App\User;
use App\Tracker;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\tasklistreport;
use App\Exports\projecttaskhoursreport;
use App\Jobs\NotifytasklistReportCompletion;
use App\Jobs\NotifyprojecttaskhoursReportCompletion;

class ProjectTaskController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:task create', ['only' => ['create']]);
       $this->middleware('check-permission:task edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:task edit|task create',   ['only' => ['store']]);
       $this->middleware('check-permission:task delete',   ['only' => ['destroy']]);
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
		$priority = PmMaster::where('type',array_search('Priority',config('constant.pm_master_types')))->pluck('name','id')->all();
		$category = PmMaster::where('type',array_search('Task Type',config('constant.pm_master_types')))->pluck('name','id')->all();
		$status = PmMaster::where('type',array_search('Task Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		$projects = Project::pluck('prjt_name','id')->all();
        return view('pm.task.index',compact('priority','category','projects','status'));
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
        $project_id = $response['project_id'];
        $priority = $response['priority'];
        $category = $response['category'];
        $members = $response['members'];
        $status = $response['status'];
        $start_date = $response['start_date'];
        $end_date = $response['end_date'];
        $results = array();	
        $results_scnd = array();
        $user_info = array();
        $results = ProjectTask::where('status',config('constant.ACTIVE'))->orderBy('id', 'desc');
        $results_scnd = Project::pluck('prjt_name','id')->all();
       // dd($results_scnd);
        $user_info = ProjectTask::where('status',config('constant.ACTIVE'))->select('project_id', DB::raw('count(*) as total'))
                 ->groupBy('project_id')
                 ->get();
            $search_table = array();
            foreach ($results_scnd as $id => $value) {
                $name = $value;
                $task_count = $user_info->where('project_id',$id)->first();
                $task_count1 = ProjectTask::where('status',config('constant.ACTIVE'))->where('project_id',$id)->sum('required_time');
                // dd($task_count1);
                $task_count = $task_count->total ?? 0;
                $search_table []  = ['name'   => $name,'total' => $task_count,'time' =>$task_count1];
            }
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
                 // dd($search_table);
            }

            // $tasks_id = ProjectTask::pluck('title','id')->all();
            // foreach ($tasks_id as $id => $value) {
            //     // $search_table [$id]['spend_hours'] = 0;
            //     $spend_time = Tracker::select('from_time','to_time')->where('task_id',$id)->get();
            //      if(!empty($spend_time1))
            //      {
            //      // $search_table [$id]['spend_hours'] = $spend_time;
            //      dd($spend_time);
             // }
            // }

            // dd($search_table);
            // $results_scnd->where('members','like','%:"'.$members.'";%');
            
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
		$html = view('pm.task.listview')->with(compact('results','list_count','search_table'))->render();
		$result_arr=array('success' => true,'html' => $html);
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
		$category = PmMaster::where('type',array_search('Task Type',config('constant.pm_master_types')))->pluck('name','id')->all();
		$priority = PmMaster::where('type',array_search('Priority',config('constant.pm_master_types')))->pluck('name','id')->all();
		$project = Project::pluck('prjt_name','id')->all();
		$task_status = PmMaster::where('type',array_search('Task Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		$version = array(1 => 1,2,3,4,5,6,7,8,9,10);
		return view('pm.task.create', compact('category','priority','project','version','task_status'));
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
		$project_task = ProjectTask::findOrFail($id);
		$category = PmMaster::where('type',array_search('Task Type',config('constant.pm_master_types')))->pluck('name','id')->all();
		$priority = PmMaster::where('type',array_search('Priority',config('constant.pm_master_types')))->pluck('name','id')->all();
		$project = Project::pluck('prjt_name','id')->all();
		$task_status = PmMaster::where('type',array_search('Task Status',config('constant.pm_master_types')))->pluck('name','id')->all();
		$version = array(1 => 1,2,3,4,5,6,7,8,9,10);
		return view('pm.task.create', compact('project_task','category','priority','project','version','task_status'));
    }


    /*
    * @author RINKU.E.B
    * @date 03/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
		$due_date = NULL;
		if(request('due_date') && !empty(request('due_date')))
		{
			$due_date = str_replace('/', '-', request('due_date'));
			$due_date = date('Y-m-d', strtotime($due_date));
		}
		$this->validate($request,
				['title' => 'required|string|max:500',
                  'required_time' => 'required',
                  'task_status' => 'required',
                  'from_time' => 'required_with:to_time|nullable|date_format:d/m/Y H:i|before:to_time',
                'to_time' => 'required_with:from_time|nullable|date_format:d/m/Y H:i|after:from_time',
                  'members' => 'required',
                  ]
				);

		$task_id = (int)$request->post('id');
		$task_status = $request->post('task_status');
		$new_members	= array();
		$task_creator 	= NULL;
		if ($task_id)
		{
			$task = ProjectTask::find($task_id);
			if ($task)
			{
				$task_creator = $task->created_by;
				$members = $task->members;
				$members = unserialize($members);
				if (isset($members) && !empty($members))
				{
					$updated_members	= $request->post('members');
					$new_members	= array_diff($updated_members, $members);
				}
				$current_task_status = $task->task_status;
			}
		}
		else
        {
            $new_members   = $request->post('members');
        }

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

		$task = ProjectTask::updateOrCreate(
            [	'id'=> request('id')],
            [
				'cmpny_id' => Auth::user()->cmpny_id,
				'title' => request('title'),
				'description' => request('description'),
                'project_id' => request('project_id'),
                'due_date' => $due_date,
                'required_time' => request('required_time'),
                'version' => request('version'),
                'priority' => request('priority'),
                'category' => request('category'),
                'members' => serialize(request('members')),
                'status' => request('status'),
                'task_status' => request('task_status'),
			]);
        $task_tracker = Tracker::Create(
            [
                'cmpny_id'       => Auth::user()->cmpny_id,
                'user_id'       => Auth::user()->id,
                'description'    => request('description'),
                'from_time'       => $from_time ?? '',
                'to_time'       => $to_time ?? '',
                'status'        => request('status'),
                'task_id'       => $task->id,
            ]);

		//Intimations
        $intimation_settings    = ProjectIntimations::where('cmpny_id', Auth::user()->cmpny_id)->first();

        $project = NULL;
        if (isset($task) && !empty($task))
        {
        	$project 		= Project::find($task->project_id);
        }

        //Project Assignment Members Intimation
        if ($intimation_settings && $intimation_settings->task_assignment_intimations && !empty($intimation_settings->task_assignment_intimations_mail) && isset($new_members) && !empty($new_members))
        {
            $mail_template  = Templates::find($intimation_settings->task_assignment_intimations_mail);
            if ($mail_template)
            {  
                $subject    = $mail_template->subject;
      
                $content    = $mail_template->content;
                if (isset($project) && !empty($project))
                {
                	$content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
            	}
                $content    = str_replace('[[ Task Title ]]', $task->title, $content);
                $content    = str_replace('[[ Task Description ]]', $task->description, $content);
                foreach ($new_members as $member)
                {
                    $member_details = User::where('id', $member)
                                ->where('status', config('constant.ACTIVE'))
                                ->first();
                    if ($member_details && !empty($member_details->email))
                    {
                        $new_content    = $content;
                        $new_content    = str_replace('[[ Name ]]', $member_details->name, $new_content);
                        $random_code    = str_random(12);

                        $mail_arr = CommonSmsEmail::create(
                                            [
                                            'authentication' => '',
                                            'cmpny_id' => Auth::user()->cmpny_id,
                                            'email' => $member_details->email,
                                            'customer_id' => '',
                                            'sent_type' => config('constant.CH_EMAIL'),
                                            'response' => 'notsent',
                                            'mail_response' => '',
                                            'random_code' => $random_code,
                                            'content' => $new_content,
                                            'subject' => $subject,  
                                            'email_cc' => '',   
                                            'status' => config('constant.INACTIVE'),
                                            'created_by' => 0,
                                            'updated_by' => 0,
                                            'created_at' => date('Y-m-d H:i:s')
                                           ]);
                    }
                }
            }
        }

        //Project Task Completion Intimations
        if (!empty($task_status) && isset($current_task_status) && !empty($current_task_status) && $task_status != $current_task_status && !empty($intimation_settings->task_completion_status) && $task_status == $intimation_settings->task_completion_status)
        {

            //Project Task Completion Lead Intimation

            if ($project)
            {
	            $project_lead   = $project->project_lead;
	            $project_lead   = User::where('id', $project_lead)
	                            ->where('status', config('constant.ACTIVE'))
	                            ->first();
	            if ($intimation_settings && $intimation_settings->task_completion_intimations_lead && !empty($intimation_settings->task_completion_intimations_lead_mail) && isset($project_lead) && !empty($project_lead->email))
	            {
	                $mail_template  = Templates::find($intimation_settings->task_completion_intimations_lead_mail);
	                if ($mail_template)
	                {
	                    $subject    = $mail_template->subject;
	                    $content    = $mail_template->content;
	                    $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
                        $content    = str_replace('[[ Name ]]', $project_lead->name, $content);
                        $content    = str_replace('[[ Task Title ]]', $task->title, $content);
                		$content    = str_replace('[[ Task Description ]]', $task->description, $content);

	                    $random_code    = str_random(12);

	                    $mail_arr = CommonSmsEmail::create(
	                                        [
	                                        'authentication' => '',
	                                        'cmpny_id' => $cmpny_id,
	                                        'email' => $project_lead->email,
	                                        'customer_id' => '',
	                                        'sent_type' => config('constant.CH_EMAIL'),
	                                        'response' => 'notsent',
	                                        'mail_response' => '',
	                                        'random_code' => $random_code,
	                                        'content' => $content,
	                                        'subject' => $subject,  
	                                        'email_cc' => '',   
	                                        'status' => config('constant.INACTIVE'),
	                                        'created_by' => 0,
	                                        'updated_by' => 0,
	                                        'created_at' => date('Y-m-d H:i:s')
	                                       ]);
	                }
	            }
        	}

            //Project Task Completion Creator Intimation
            if (!$task_id)
            {
            	$task_creator = Auth::user()->id;
            }
            $project_task_creator = $task->created_by;

            if ($task_creator)
            {
            	$task_creator   = User::where('id', $task_creator)
                                ->where('status', config('constant.ACTIVE'))
                                ->first();
            }
            if ($intimation_settings && $intimation_settings->project_completion_intimations_creator && !empty($intimation_settings->project_completion_intimations_creator_mail) && isset($task_creator) && !empty($task_creator->email))
            {
                $mail_template  = Templates::find($intimation_settings->project_completion_intimations_creator_mail);
                if ($mail_template)
                {
                    $subject    = $mail_template->subject;
                    $content    = $mail_template->content;
                    $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
                    $content    = str_replace('[[ Name ]]', $task_creator->name, $content);
                    $content    = str_replace('[[ Task Title ]]', $task->title, $content);
            		$content    = str_replace('[[ Task Description ]]', $task->description, $content);

                    $random_code    = str_random(12);

                    $mail_arr = CommonSmsEmail::create(
                                        [
                                        'authentication' => '',
                                        'cmpny_id' => $cmpny_id,
                                        'email' => $task_creator->email,
                                        'customer_id' => '',
                                        'sent_type' => config('constant.CH_EMAIL'),
                                        'response' => 'notsent',
                                        'mail_response' => '',
                                        'random_code' => $random_code,
                                        'content' => $content,
                                        'subject' => $subject,  
                                        'email_cc' => '',   
                                        'status' => config('constant.INACTIVE'),
                                        'created_by' => 0,
                                        'updated_by' => 0,
                                        'created_at' => date('Y-m-d H:i:s')
                                       ]);
                }
            }
            
        }
			
		if(!empty(request('id')))
		{
            $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
        }else{
            $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
        }
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
        //$id = $request->id;
		$userid = Auth::User()->id;
		$message = '';
		$success = false;
        if($id)
        {
			$res = ProjectTask::select('created_by')->where('id',$id)->first();
			if($res)
			{
				if($res->created_by == $userid)
				{
					$tasks = ProjectTask::where('id',$id)->update(['status' => config('constant.INACTIVE')]);
					$message = "Successfuly Deleted";$success = true;
				}
				else
				{
					$message = "You Cannot Delete This Task";
				}
			}
            
            //$tasks->delete();
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
		$project = request('project');//echo $project;die;
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

    public function view_working_details(Request $request)
    {
        return view ('pm.task.index_detail');
    }
    public function employees_work(Request $request)
    {
    
        $response           = $request->all();
        $start_date         = $request->post('startdate');
        $end_date           = $request->post('enddate');


        $results            = array();
        $search_table       = array();
		if(isset($start_date) && !empty($start_date)) 
        {
            $start_date = str_replace('/', '-', $start_date);
            $start_date = date('Y-m-d', strtotime($start_date)).' 00:00:00';
            //$results->where('from_time', '>=', $start_date);
        }
		else
		{
			$start_date = date('Y-m-d').' 00:00:00';
		}
        if(isset($end_date) && !empty($end_date)) 
        {
            $end_date = str_replace('/', '-', $end_date);
            $end_date = date('Y-m-d', strtotime($end_date)).' 23:59:59';
           // $results->where('from_time', '<=', $end_date);
        }
		else
		{
			$end_date = date('Y-m-d').' 23:59:59';
		}
//$start_date = '2020-04-01 00:00:00';$end_date = '2020-04-10 23:59:59';
       /* $results = Tracker::where('status',config('constant.ACTIVE'))->orderBy('id', 'desc');
        if(isset($start_date) && !empty($start_date)) 
        {
            $start_date = str_replace('/', '-', $start_date);
            $start_date = date('Y-m-d', strtotime($start_date)).' 00:00:00';
            $results->where('from_time', '>=', $start_date);
        }
        if(isset($end_date) && !empty($end_date)) 
        {
            $end_date = str_replace('/', '-', $end_date);
            $end_date = date('Y-m-d', strtotime($end_date)).' 23:59:59';
            $results->where('from_time', '<=', $end_date);
        }
      
        foreach ($results as $data){
            $search_table = ['tracker_data'=>$data];

        }*/
		$out_array = array();
        $res_array = array();
		$users = User::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('name')->pluck('id');//echo "<pre>";print_r($users);die;
		if(count($users)>0)
		{
			$i = 0;
			foreach($users as $user)
			{
                $taken_time = 0;
                $task_arr = array();
				$out_array[$i]['user_id'] = $user;

                $res_array = Tracker::select('id','task_id','from_time','to_time')
                           ->where('user_id',$user)
                           ->where('from_time','>=',$start_date)
                           ->where('from_time','<=',$end_date);
                // dd($res_array);           
				$results = $res_array;//print_r($res_array);
				$res_array = $res_array->get();//print_r($res_array);
				
                if(count($res_array)>0)
				{
					foreach($res_array as $res)//echo $res_array->from_time;die;
					{
						$from = Carbon::parse($res->from_time);

						$to = Carbon::parse($res->to_time);
						$diff_in_mins = $to->diffInMinutes($from);//echo $diff_in_mins.'-';
						$taken_time = $taken_time + $diff_in_mins;//return $taken_time;
						$task_arr[] = $res->task_id;//echo $diff_in_mins.'---';
					}
				}
				$out_array[$i]['taken_time'] = round($taken_time/60,1);//echo $taken_time.'takennnn'.$user.'<br>';
				$out_array[$i]['task_ids'] = array_unique($task_arr);
				$i++;

			}
		}
        // dd($task_arr);
		//print_r($task_arr);
		
		//echo "<pre>";print_r($out_array);//die;

        $list_count = $results->count();
        $results   =   $results->paginate(config('constant.pagination_constant'));
        $html = view('pm.task.view_detail')->with(compact('search_table','list_count','results','out_array'))->render();
        $result_arr=array('success' => true,'html' => $html);
        return $result_arr;
    }
    //export
     public function export_projecthours(Request $request)
    {
        // $search_keywords = $request->post('search_keywords');
    
        // $status          = $request->post('project_status');
        $startdate       = $request->post('startdate');
        $enddate         = $request->post('enddate');
        $user_id         = Auth::user()->id;
        $cmpny_id        = Auth::user()->cmpny_id;
        $now             = time();
         $file_name         = 'ProjectReport-'.$now.'.xlsx';
         $path='/export_project/'.$file_name;
         
        $data = [
            'user_id'  => $user_id,
            'cmpny_id' => $cmpny_id,
             'file_name'        => urlencode($file_name),
             // 'search_keywords'  => $search_keywords,
             // 'status'           => $status,
             'startdate'        => $startdate,
             'enddate'          => $enddate
        ];
 
        (new projecttaskhoursreport($data))->queue($path)->chain([
            new NotifyprojecttaskhoursReportCompletion($data),

        ]);

    }

    public function download_project_task_report($file_name)
    {
        
        $file_name  = urldecode($file_name);
        $path = storage_path('app/export_project/'.$file_name);
        return response()->download($path);
    } 
	
}
