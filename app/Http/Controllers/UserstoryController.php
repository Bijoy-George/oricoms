<?php

namespace App\Http\Controllers;

use Auth;
use App\UserStory;
use App\User;
use App\TaskStory;
use App\Sprint;
use App\Project;

use Illuminate\Http\Request;
class UserstoryController extends Controller
{
    
	 public function __construct()
    {
        $this->middleware('auth');
    }/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	/*
    * UserStory 
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */ 
    public function index()
    {
        return view('masters.userstory.index');
    }
	/*
    * UserStory List
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
   */
    public function search_list(Request $request)
    {
		$response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $project_id    = $response['project_id'];
        $sprint_id    = $response['sprint_id'];
        $results            = array();
        $results = UserStory::where('project_id',$project_id)->where('sprint_id',$sprint_id)->with('GetPriority')
					->whereHas('GetPriority')->orderBy('id', 'asc');
		if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('title', 'like', '%' . $search_keywords . '%');
                });
            }
	    $list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$users      = User::select('id','name')->get();
		$html       = view('masters.userstory.listview')->with(compact('results','list_count','users'))->render();
        $result_arr = array('success' => true,'html' => $html);
        return $result_arr; 

    }
	/*
    * UserStory Create
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */
	public function create()
    {  
	    $priority = ['' => 'Select'] + config('constant.PRIORITY'); 
		$users       = ['' => 'Select'] + User::where('status', config('constant.ACTIVE'))->pluck('name', 'id')->all();
		return view('masters.userstory.create',compact('users','priority'));
    }
	/*
    * UserStory Store
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */
	public function store(Request $request)
    {
			$this->validate($request,[
            'title' => 'required',
            'priority' => 'required',
            'estimate' => 'required',
            'user' => 'required',
            ],[
            'title.required' => ' The Title field is required.',
            'priority.required' => ' The Priority field is required.',
            'user.required' => ' The User field is required.',
            'estimate' => 'The Estimate field is required.',
            ]);
			$res = UserStory::updateOrCreate(
            [
                'id'      	=> request('id')
            ],
			[	  'title'    => (!empty(request('title'))? request('title'): NULL ),
				  'priority'   => (!empty(request('priority'))? request('priority'): NULL ),
				  'estimate'   => (!empty(request('estimate'))? request('estimate'): NULL ),
				  'user' => (!empty(request('user'))? request('user'): NULL ),
				  'goal'   => (!empty(request('goal'))? request('goal'): NULL ),
				  'given' => (!empty(request('given'))? request('given'): NULL ),
				  'when' => (!empty(request('when'))? request('when'): NULL ),
				  'then' => (!empty(request('then'))? request('then'): NULL ),
				  'created_by' => Auth::User()->id,
				  'updated_by' => Auth::User()->id,
				  'project_id' => request('project_id'),
				  'sprint_id' => request('sprint_id'),
				 
			])->id;
			if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
                }else{
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly added');
                }
			return $result_arr;		
	}
	/*
    * Task
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */
    public function addUserstoryTask($project_id  = null,$sprint_id  = null,$userstory_id  = null)
    {
        $users       = ['' => 'Select'] + User::where('status', config('constant.ACTIVE'))->pluck('name', 'id')->all();
	    $user_story = UserStory::where('id', $userstory_id)->get();
		return view('masters.userstory.task',compact('userstory_id','users','user_story','project_id','sprint_id'));
    }
	/*
    * Task Store
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */
	public function taskstore(Request $request)
    {  
	  	$this->validate($request,[
            'user' => 'required',
            'hour' => 'required',
            'task' => 'required',
            ],[
            'user.required' => ' The Asigned To field is required.',
            'hour.required' => ' The Hour field is required.',
            'task.required' => ' The Task field is required.',
            ]);
		$task = request('task');
		foreach($task as $tsk){
			$task_new = $tsk;
		}
	    if(request('task_id') != null){
			$story_history = TaskStory::where('id',request('task_id'))->pluck('userstory_id');
			foreach($story_history as $story_history->id){
			$res = TaskStory::updateOrCreate(
            [
                'id'      	=> request('task_id')
            ],
			[	  'userstory_id'    => $story_history->id,
     			  'status'   => request('status'),
				  'asigned_to' => (!empty(request('user'))? request('user'): NULL ),
				  'task'    =>  (!empty(request('task'))? $task_new: NULL ),
				  'hour'    => (!empty(request('hour'))? request('hour'): NULL ),
				  'updated_by' => Auth::User()->id,
				  'project_id' => request('project_id'),
				  'sprint_id' => request('sprint_id'),
			])->id;
			}
		}
		else{	
		    $res = TaskStory::Create(
          	[	  'userstory_id'    => request('id'),
     			  'status'   => 1,
				  'asigned_to' => (!empty(request('user'))? request('user'): NULL ),
				  'task'    =>  (!empty(request('task'))? $task_new: NULL ),
				  'hour'    => (!empty(request('hour'))? request('hour'): NULL ),
				  'created_by' => Auth::User()->id,
				  'project_id' => request('project_id'),
				  'sprint_id' => request('sprint_id'),
			])->id;
		
		}	
		/* if(request('task') != null){
			$task_list = serialize($task);
			$user_story = UserStory::where('id',request('id'))->pluck('task');
			foreach($user_story as $us){
				$task_stored = $us;
			}
			if($task_stored != null){
			$task_unserialized = unserialize($task_stored);
			$task_array = array_merge($task,$task_unserialized);}
			else{$task_array = $task;}
			$task_list = array_unique($task_array);
			$task_serialize = serialize($task_list);
			$task_res = UserStory::updateOrCreate(
						[
						'id'    => request('id'),
						],   
						[	 
					  'task'    =>  $task_serialize,
					  'created_by' => Auth::User()->id,
					  'updated_by' => Auth::User()->id,
						])->id;
		} */
       
			if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
                }else{
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly added');
                }
			return $result_arr;		
	}
	/*
    * Scrumboard
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    * @return company Store
    */
	public function scrumboard($project_id = null)
    {	
     // $sprints = Sprint::where('project_id',$project_id);
	  $sprints       = ['' => 'Select'] + Sprint::where('project_id', $project_id)->pluck('name', 'id')->all();
	  //print_r($sprints);die;
	  return view('masters.userstory.scrum.index',compact('project_id','sprints'));
    }
	/*
    * Scrumboard View
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */
    public function scrumboardview(Request $request)
    {
        
		$response           = $request->all();
        $search_keywords    = $response['search_keywords'];
		if(isset($response['sprint_id'])){
        $sprint_id    = $response['sprint_id'];}
        $project_id    = $response['project_id'];
        $results            = array();
        $results = UserStory::select('ori_user_story.title','ori_user_story.task','ori_user_story.id','ori_task_story.userstory_id','ori_task_story.task','ori_task_story.status')
		            ->rightjoin('ori_task_story', 'ori_task_story.userstory_id', '=', 'ori_user_story.id')
					->where('ori_task_story.project_id',$project_id)
                    ->orderBy('ori_user_story.id','asc')					
                    ->groupBy('ori_task_story.userstory_id'); 
       	if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('ori_user_story.title', 'like', '%' . $search_keywords . '%');
                });
            }
		if(isset($sprint_id) && !empty($sprint_id)) 
            {
                $results->where(function($results) use ($sprint_id){
                    $results->orWhere('ori_task_story.sprint_id', $sprint_id);
                });
            }
	    $list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$task_story = TaskStory::select('*')->get();      
        $html       = view('masters.userstory.scrum.list')->with(compact('results','list_count','task_story'))->render();
        $result_arr = array('success' => true,'html' => $html);
        return $result_arr; 

    }
	
	
	/*
    * Task Edit
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */
	public function taskedit($task_id  = null,$userstory_id = null)
    {
		$res = TaskStory::findOrFail($task_id);
		$project_id = $res->project_id;
		$sprint_id = $res->sprint_id;
		$status = ['' => 'Select'] + config('constant.QUERY_STATUS'); 
		$users       = ['' => 'Select'] + User::where('status', config('constant.ACTIVE'))->pluck('name', 'id')->all();
		return view('masters.userstory.task', compact('res','status','users','task_id','userstory_id','sprint_id','project_id'));
    }
	/*
    * UserStory Delete
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
   */
  public function destroy($id = null)
    {   
	    $success =true;
		$message ='';
        if($id!=null)
        {
                $userstory = UserStory::find($id);
				if ($userstory)
					{
						$userstory->delete();
						$success =true;
						$message ='Deleted Successfully';
					}
				else{
					 $message ='You are not authorized to delete the userstory';
					}
        }
        $result_arr = array('success' => $success, 'message' => $message, 'refresh' => true);
        echo json_encode($result_arr);
    }
	/*
    * Task Delete
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */
	public function destroytask($id = null)
    {   echo 1;die;
	    $success =true;
		$message ='';
        if($id!=null)
        {
                $taskstory = TaskStory::find($id);
				if ($taskstory)
					{
						$taskstory->delete();
						$success =true;
						$message ='Deleted Successfully';
					}
				else{
					 $message ='You are not authorized to delete the taskstory';
					}
        }
        $result_arr = array('success' => $success, 'message' => $message, 'refresh' => true);
        echo json_encode($result_arr);
    }
    public function sprint($project_id  = null)
    {
        return view('masters.userstory.sprint.index',compact('project_id'));
    }
	public function search_sprint(Request $request)
    {
		$response           = $request->all();
        $search_keywords    = $response['search_keywords'];
        $project_id    = $response['project_id'];
        $results            = array();
        $results = Sprint::where('project_id',$project_id)->orderBy('id', 'asc');
		if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('name', 'like', '%' . $search_keywords . '%');
                });
            }
	    $list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$project = Project::findOrFail($project_id);
		$project_name = $project->prjt_name;
		$html       = view('masters.userstory.sprint.listview')->with(compact('results','list_count','project_name'))->render();
        $result_arr = array('success' => true,'html' => $html);
        return $result_arr; 

    }
	public function sprintcreate($project_id = null)
    {  
	   
	   return view('masters.userstory.sprint.create',compact('project_id'));
    }
	public function sprint_store(Request $request)
    {
		
			$this->validate($request,[
            'name' => 'required',
            'goal' => 'required',
            'duedate' => 'required',
            
            ],[
            'name.required' => ' The Name field is required.',
            'goal.required' => ' The Goal field is required.',
            'duedate.required' => ' The Due Date field is required.',
          
            ]);
			$res = Sprint::updateOrCreate(
            [
                'id'      	=> request('id')
            ],
			[	  'name'    => (!empty(request('name'))? request('name'): NULL ),
				  'goal'   => (!empty(request('goal'))? request('goal'): NULL ),
				  'duedate'   => (!empty(request('duedate'))? date("Y-m-d H:i:s",strtotime(str_replace('/', '-',request('duedate') ))): NULL ),
				  'project_id' => request('project_id'),
				  'created_by' => Auth::User()->id,
				  'updated_by' => Auth::User()->id,
				 
			])->id;
			if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
                }else{
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly added');
                }
			return $result_arr;		
	}
	public function editSprint($sprint_id = null)
    {  
	   $res = Sprint::findOrFail($sprint_id);
	   $project_id = $res->project_id;
	   return view('masters.userstory.sprint.create',compact('res','project_id'));
    }
	 public function addUserstory($project_id  = null,$sprint_id = null)
    {
        $priority = ['' => 'Select'] + config('constant.PRIORITY'); 
		$users       = ['' => 'Select'] + User::where('status', config('constant.ACTIVE'))->pluck('name', 'id')->all();
		return view('masters.userstory.create',compact('users','priority','project_id','sprint_id'));
    }
	/*
    * UserStory Edit
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */
	public function editUserstory($project_id  = null,$sprint_id = null,$id = null)
    {
		$res = UserStory::findOrFail($id);
		$priority = ['' => 'Select'] + config('constant.PRIORITY'); 
		$users       = ['' => 'Select'] + User::where('status', config('constant.ACTIVE'))->pluck('name', 'id')->all();
		return view('masters.userstory.create', compact('res','priority','users','project_id','sprint_id'));
    }
	 public function userstoryList($project_id  = null,$sprint_id = null)
    {
       
		return view('masters.userstory.index',compact('project_id','sprint_id'));
    }
	/*
    * Company Store
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */
	public function taskList($project_id = null,$sprint_id = null,$userstory_id  = null)
    {
        $task_det = TaskStory::select('*')->where('project_id',$project_id)->where('sprint_id',$sprint_id)->where('userstory_id',$userstory_id)->get();
		$task_count = count($task_det);
		return view('masters.userstory.task.index',compact('userstory_id','project_id','sprint_id','task_count'));
    } 
	/*
    * Task List
    * @author veena S Das
    * @date 16/04/2020
    * @since version 1.0.0
    * @param NULL
    */
	public function search_task(Request $request)
    {
		$response           = $request->all();
		
        $search_keywords    = $response['search_keywords'];
       
        $userstory_id    = $response['userstory_id'];
        $results            = array();
        $results = TaskStory::where('userstory_id',$userstory_id)->orderBy('id', 'asc');
		if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where(function($results) use ($search_keywords){
                    $results->orWhere('task', 'like', '%' . $search_keywords . '%');
                });
            }
	    $list_count = $results->count();
        $results    = $results->paginate(config('constant.pagination_constant'));
		$users      = User::select('id','name')->get();
        $html       = view('masters.userstory.task.list')->with(compact('results','list_count','users'))->render();
        $result_arr = array('success' => true,'html' => $html);
        return $result_arr; 
    }
	public function projectgraph()
	{
		
		$project_ids = TaskStory::select('project_id')->get();
		
		foreach($project_ids->unique('project_id') as $project_id)
		{
			$prt_id = $project_id->project_id;
			$prt_name = Project::select('*')->where('id',$prt_id)->get();
			foreach($prt_name as $name){$project[] = $name->prjt_name;}
			
			$task = TaskStory::select('id')->where('project_id',$prt_id)->get();
			$task_clossed = TaskStory::select('id')->where('project_id',$prt_id)->where('status',3)->get();
			$count2 = count($task);
			$count3 = count($task_clossed);
			$task_avg = $count3 /$count2;
			$task_avgpercent = $task_avg*100;
			$data[] = $task_avgpercent;
		}
		
		return view('masters.userstory.graph.index',['ProjectName' => $project, 'Data' => $data]);
	}
	
	
}

