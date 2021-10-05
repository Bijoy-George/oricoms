<?php

namespace App\Http\Controllers;

use App\PmMaster;
use App\ProjectIntimations;
use App\Intimations;
use App\Templates;
use Auth;
use Illuminate\Http\Request;

class ProjectIntimationsController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:project intimation management', ['only' => ['show', 'store']]);
    }

    public function show()
    {
    	$project_intimations = ProjectIntimations::where('cmpny_id', Auth::user()->cmpny_id)->first();
        $mail_templates           = ['' => 'Select Template'] + Templates::where('status', config('constant.ACTIVE'))->where('type', config('constant.CH_EMAIL'))->pluck('title','id')->all();
        $project_status = ['' => 'Select Project Completion Status'] + PmMaster::where('type',array_search('Project Status',config('constant.pm_master_types')))->pluck('name','id')->all();
        $task_status = ['' => 'Select Task Completion Status'] + PmMaster::where('type',array_search('Task Status',config('constant.pm_master_types')))->pluck('name','id')->all();
    	return view('pm.intimations.settings', compact('project_intimations','mail_templates','project_status','task_status'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'project_assignment_intimations_members'	=> 'nullable|boolean',
    		'project_assignment_intimations_lead'		=> 'nullable|boolean',
    		'project_near_due_intimation_period'		=> 'nullable|numeric',
    		'project_near_due_intimations_members'		=> 'nullable|boolean',
    		'project_near_due_intimations_lead'			=> 'nullable|boolean',
    		'project_near_due_intimations_creator'		=> 'nullable|boolean',
    		'project_overdue_intimation_period'			=> 'nullable|numeric',
    		'project_overdue_intimations_members'		=> 'nullable|boolean',
    		'project_overdue_intimations_lead'			=> 'nullable|boolean',
    		'project_overdue_intimations_creator'		=> 'nullable|boolean',
    		'project_completion_intimations_members'	=> 'nullable|boolean',
    		'project_completion_intimations_lead'		=> 'nullable|boolean',
    		'project_completion_intimations_creator'	=> 'nullable|boolean',
            'project_completion_status'                 => 'nullable|numeric',
    		'task_assignment_intimations'				=> 'nullable|boolean',
    		'task_near_due_intimation_period'			=> 'nullable|numeric',
    		'task_near_due_intimations_members'			=> 'nullable|boolean',
    		'task_near_due_intimations_lead'			=> 'nullable|boolean',
    		'task_near_due_intimations_creator'			=> 'nullable|boolean',
    		'task_overdue_intimation_period'			=> 'nullable|numeric',
    		'task_overdue_intimations_members'			=> 'nullable|boolean',
    		'task_overdue_intimations_lead'				=> 'nullable|boolean',
    		'task_overdue_intimations_creator'			=> 'nullable|boolean',
    		'task_completion_intimations_lead'			=> 'nullable|boolean',
    		'task_completion_intimations_creator'		=> 'nullable|boolean',
            'task_completion_status'                    => 'nullable|numeric',
            'daily_view_deatils_intimations'            => 'nullable|numeric',
            'daily_view_deatils_intimations_mail'       => 'nullable|numeric',
            'monthly_view_deatils_intimations'          => 'nullable|numeric',
            'monthly_view_deatils_intimations_mail'     => 'nullable|numeric',
    	]);
    	$project_intimation_id = $request->post('id');
    	$project_assignment_intimations_members	= $request->post('project_assignment_intimations_members');
    	$project_assignment_intimations_members	= isset($project_assignment_intimations_members) ? 1 : 0;
        $project_assignment_intimations_members_mail    = $request->post('project_assignment_intimations_members_mail');
    	$project_assignment_intimations_lead	= $request->post('project_assignment_intimations_lead');
    	$project_assignment_intimations_lead	= isset($project_assignment_intimations_lead) ? 1 : 0;
        $project_assignment_intimations_lead_mail   = $request->post('project_assignment_intimations_lead_mail');

    	$project_near_due_intimation_period	= (int)$request->post('project_near_due_intimation_period');
    	$project_near_due_intimations_members	= $request->post('project_near_due_intimations_members');
    	$project_near_due_intimations_members	= isset($project_near_due_intimations_members) ? 1 : 0;
        $project_near_due_intimations_members_mail  = $request->post('project_near_due_intimations_members_mail');

    	$project_near_due_intimations_lead	= $request->post('project_near_due_intimations_lead');
    	$project_near_due_intimations_lead	= isset($project_near_due_intimations_lead) ? 1 : 0;
        $project_near_due_intimations_lead_mail = $request->post('project_near_due_intimations_lead_mail');

    	$project_near_due_intimations_creator	= $request->post('project_near_due_intimations_creator');
    	$project_near_due_intimations_creator	= isset($project_near_due_intimations_creator) ? 1 : 0;
        $project_near_due_intimations_creator_mail  = $request->post('project_near_due_intimations_creator_mail');

    	$project_overdue_intimation_period		= (int)$request->post('project_overdue_intimation_period');
    	$project_overdue_intimations_members	= $request->post('project_overdue_intimations_members');
    	$project_overdue_intimations_members	= isset($project_overdue_intimations_members) ? 1 : 0;
        $project_overdue_intimations_members_mail   = $request->post('project_overdue_intimations_members_mail');

    	$project_overdue_intimations_lead		= $request->post('project_overdue_intimations_lead');
    	$project_overdue_intimations_lead		= isset($project_overdue_intimations_lead) ? 1 : 0;
        $project_overdue_intimations_lead_mail  = $request->post('project_overdue_intimations_lead_mail');

    	$project_overdue_intimations_creator	= $request->post('project_overdue_intimations_creator');
    	$project_overdue_intimations_creator	= isset($project_overdue_intimations_creator) ? 1 : 0;
        $project_overdue_intimations_creator_mail   = $request->post('project_overdue_intimations_creator_mail');

    	$project_completion_intimations_members	= $request->post('project_completion_intimations_members');
    	$project_completion_intimations_members	= isset($project_completion_intimations_members) ? 1 : 0;
        $project_completion_intimations_members_mail    = $request->post('project_completion_intimations_members_mail');
    	$project_completion_intimations_lead	= $request->post('project_completion_intimations_lead');
    	$project_completion_intimations_lead	= isset($project_completion_intimations_lead) ? 1 : 0;
        $project_completion_intimations_lead_mail   = $request->post('project_completion_intimations_lead_mail');
    	$project_completion_intimations_creator	= $request->post('project_completion_intimations_creator');
    	$project_completion_intimations_creator	= isset($project_completion_intimations_creator) ? 1 : 0;
        $project_completion_intimations_creator_mail    = $request->post('project_completion_intimations_creator_mail');
        $project_completion_status  = $request->post('project_completion_status');

    	$task_assignment_intimations		= $request->post('task_assignment_intimations');
    	$task_assignment_intimations		= isset($task_assignment_intimations) ? 1 : 0;
        $task_assignment_intimations_mail   = $request->post('task_assignment_intimations_mail');

    	$task_near_due_intimation_period	= (int)$request->post('task_near_due_intimation_period');
    	$task_near_due_intimations_members	= $request->post('task_near_due_intimations_members');
    	$task_near_due_intimations_members	= isset($task_near_due_intimations_members) ? 1 : 0;
        $task_near_due_intimations_members_mail = $request->post('task_near_due_intimations_members_mail');
    	$task_near_due_intimations_lead		= $request->post('task_near_due_intimations_lead');
    	$task_near_due_intimations_lead		= isset($task_near_due_intimations_lead) ? 1 : 0;
        $task_near_due_intimations_lead_mail    = $request->post('task_near_due_intimations_lead_mail');
    	$task_near_due_intimations_creator	= $request->post('task_near_due_intimations_creator');
    	$task_near_due_intimations_creator	= isset($task_near_due_intimations_creator) ? 1 : 0;
        $task_near_due_intimations_creator_mail = $request->post('task_near_due_intimations_creator_mail');

    	$task_overdue_intimation_period		= (int)$request->post('task_overdue_intimation_period');
    	$task_overdue_intimations_members	= $request->post('task_overdue_intimations_members');
    	$task_overdue_intimations_members	= isset($task_overdue_intimations_members) ? 1 : 0;
        $task_overdue_intimations_members_mail  = $request->post('task_overdue_intimations_members_mail');
    	$task_overdue_intimations_lead		= $request->post('task_overdue_intimations_lead');
    	$task_overdue_intimations_lead		= isset($task_overdue_intimations_lead) ? 1 : 0;
        $task_overdue_intimations_lead_mail = $request->post('task_overdue_intimations_lead_mail');
    	$task_overdue_intimations_creator	= $request->post('task_overdue_intimations_creator');
    	$task_overdue_intimations_creator	= isset($task_overdue_intimations_creator) ? 1 : 0;
        $task_overdue_intimations_creator_mail  = $request->post('task_overdue_intimations_creator_mail');

    	$task_completion_intimations_lead		= $request->post('task_completion_intimations_lead');
    	$task_completion_intimations_lead		= isset($task_completion_intimations_lead) ? 1 : 0;
        $task_completion_intimations_lead_mail  = $request->post('task_completion_intimations_lead_mail');
    	$task_completion_intimations_creator	= $request->post('task_completion_intimations_creator');
    	$task_completion_intimations_creator	= isset($task_completion_intimations_creator) ? 1 : 0;
        $task_completion_intimations_creator_mail   = $request->post('task_completion_intimations_creator_mail');
        $task_completion_status  = $request->post('task_completion_status');
        $task_completion_status       = isset($task_completion_status) ? 1 : 0;
		
        $daily_view_deatils_intimations  = $request->post('daily_view_deatils_intimations');
        $daily_view_deatils_intimations       = isset($daily_view_deatils_intimations) ? 1 : 0;
		$daily_view_deatils_intimations_mail  = $request->post('daily_view_deatils_intimations_mail');
		
		$monthly_view_deatils_intimations  = $request->post('monthly_view_deatils_intimations');
        $monthly_view_deatils_intimations       = isset($monthly_view_deatils_intimations) ? 1 : 0;
        $monthly_view_deatils_intimations_mail  = $request->post('monthly_view_deatils_intimations_mail');        


    	$intimations_data	= [
    		'project_assignment_intimations_members'	=> $project_assignment_intimations_members,
            'project_assignment_intimations_members_mail'    => $project_assignment_intimations_members_mail,
    		'project_assignment_intimations_lead'		=> $project_assignment_intimations_lead,
            'project_assignment_intimations_lead_mail'       => $project_assignment_intimations_lead_mail,
    		'project_near_due_intimation_period'		=> $project_near_due_intimation_period,
    		'project_near_due_intimations_members'		=> $project_near_due_intimations_members,
            'project_near_due_intimations_members_mail'      => $project_near_due_intimations_members_mail,
    		'project_near_due_intimations_lead'			=> $project_near_due_intimations_lead,
            'project_near_due_intimations_lead_mail'         => $project_near_due_intimations_lead_mail,
    		'project_near_due_intimations_creator'		=> $project_near_due_intimations_creator,
            'project_near_due_intimations_creator_mail'      => $project_near_due_intimations_creator_mail,
    		'project_overdue_intimation_period'			=> $project_overdue_intimation_period,
    		'project_overdue_intimations_members'		=> $project_overdue_intimations_members,
            'project_overdue_intimations_members_mail'       => $project_overdue_intimations_members_mail,
    		'project_overdue_intimations_lead'			=> $project_overdue_intimations_lead,
            'project_overdue_intimations_lead_mail'          => $project_overdue_intimations_lead_mail,
    		'project_overdue_intimations_creator'		=> $project_overdue_intimations_creator,
            'project_overdue_intimations_creator_mail'       => $project_overdue_intimations_creator_mail,
    		'project_completion_intimations_members'	=> $project_completion_intimations_members,
            'project_completion_intimations_members_mail'    => $project_completion_intimations_members_mail,
    		'project_completion_intimations_lead_mail'		=> $project_completion_intimations_lead_mail,
    		'project_completion_intimations_creator_mail'	=> $project_completion_intimations_creator_mail,
            'project_completion_status'                 => $project_completion_status,
    		'task_assignment_intimations'				=> $task_assignment_intimations,
            'task_assignment_intimations_mail'          => $task_assignment_intimations_mail,
    		'task_near_due_intimation_period'			=> $task_near_due_intimation_period,
    		'task_near_due_intimations_members'			=> $task_near_due_intimations_members,
            'task_near_due_intimations_members_mail'         => $task_near_due_intimations_members_mail,
    		'task_near_due_intimations_lead'			=> $task_near_due_intimations_lead,
            'task_near_due_intimations_lead_mail'       => $task_near_due_intimations_lead_mail,
    		'task_near_due_intimations_creator'			=> $task_near_due_intimations_creator,
            'task_near_due_intimations_creator_mail'    => $task_near_due_intimations_creator_mail,
    		'task_overdue_intimation_period'			=> $task_overdue_intimation_period,
    		'task_overdue_intimations_members'			=> $task_overdue_intimations_members,
            'task_overdue_intimations_members_mail'          => $task_overdue_intimations_members_mail,
    		'task_overdue_intimations_lead'				=> $task_overdue_intimations_lead,
            'task_overdue_intimations_lead_mail'             => $task_overdue_intimations_lead_mail,
    		'task_overdue_intimations_creator'			=> $task_overdue_intimations_creator,
            'task_overdue_intimations_creator_mail'     => $task_overdue_intimations_creator_mail,
    		'task_completion_intimations_lead'			=> $task_completion_intimations_lead,
            'task_completion_intimations_lead_mail'          => $task_completion_intimations_lead_mail,
    		'task_completion_intimations_creator'		=> $task_completion_intimations_creator,
            'task_completion_intimations_creator_mail'  => $task_completion_intimations_creator_mail,
            'task_completion_status'                    => $task_completion_status,
            'daily_view_deatils_intimations'            =>0,
            'daily_view_deatils_intimations_mail'       =>0,
            'monthly_view_deatils_intimations'          =>0,
            'monthly_view_deatils_intimations_mail'     =>0            
    	];

    	if (isset($project_intimation_id))
    	{
    		$intimations_data['updated_by']	= Auth::user()->id;
    	}
    	else
    	{
    		$intimations_data['created_by']	= Auth::user()->id;
    	}

    	$intimations = ProjectIntimations::updateOrCreate([
    		'id'	=> $project_intimation_id,
    		'cmpny_id'	=> Auth::user()->cmpny_id
    	], $intimations_data);
		
		
		
		
			if(Auth::user()->cmpny_id == 15){
					$inti = Intimations::updateorCreate(
					[
					   'status' => config('constant.PROJECT_INTIMATION_STATUS'), 
					   'user_id' => Auth::user()->id, 
					],
					[
					
						'cmpny_id'	=> Auth::user()->cmpny_id,
						'user_id' => Auth::user()->id, 
						'status' => config('constant.PROJECT_INTIMATION_STATUS'), 
						'daily_intimation'	=> $request->post('daily_view_deatils_intimations'),
						'monthly_intimation'	=> $request->post('monthly_view_deatils_intimations'),
						'daily_template'	=> $request->post('daily_view_deatils_intimations_mail'),
						'monthly_template'	=> $request->post('monthly_view_deatils_intimations_mail'),
					]); 
				
			}
				
		

    	if (!$intimations) {
    		$result_arr=array('reset'=>false,'success' => false,'message' => 'Something went wrong');
    	}
    	else
    	{
    		$result_arr=array('reset'=>false,'success' => true,'message' => 'Saved successfully');
    	}

    	return $result_arr;

    }
}
