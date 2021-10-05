<?php

namespace App\Jobs;

use App\CommonSmsEmail;
use App\Project;
use App\ProjectIntimations;
use App\ProjectTask;
use App\Templates;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyProjectTaskOverDue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $project_tasks = ProjectTask::select('id', 'cmpny_id', 'project_id', 'due_date', 'members')
                                ->where('due_date', '<' date('Y-m-d'))
                                ->where('overdue_intimated', '!=', config('constant.ACTIVE'))
                                ->where('status', config('constant.ACTIVE'))
                                ->get();

        foreach ($project_tasks as $task)
        {
            $cmpny_id   = $task->cmpny_id;
            $intimation_settings    = ProjectIntimations::where('cmpny_id', $cmpny_id)->first();
            $overdue_interval  = (isset($intimation_settings->task_overdue_intimation_period) && ($intimation_settings->task_overdue_intimation_period !== NULL)) ? (int)$intimation_settings->task_overdue_intimation_period : config('constant.project_task_overdue_default_interval');

            if (date('Y-m-d', strtotime($task->due_date . ' +'.$overdue_interval.' days') > date('Y-m-d'))
            {
                continue;
            }

            //Project Task Over Due Members Intimation
            $members = $task->members;
            if (!empty($members))
            {
                $members = unserialize($members);
            }

            $project_id     = $task->project_id;
            $project = NULL;
            if (isset($task) && !empty($task))
            {
                $project        = Project::find($project_id);
            }

            if ($intimation_settings && $intimation_settings->task_overdue_intimations_members && !empty($intimation_settings->task_overdue_intimations_members_mail) && isset($members) && !empty($members))
            {
                $mail_template  = Templates::find($intimation_settings->task_overdue_intimations_members_mail);
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

                    foreach ($members as $member)
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
                                                'cmpny_id' => $cmpny_id,
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

            //Project Task Over Due Lead Intimation
            $project_id     = $task->project_id;
            $project        = Project::find($project_id);
            
            if ($project)
            {
                $project_lead   = $project->project_lead;
                $project_lead   = User::where('id', $project_lead)
                                    ->where('status', config('constant.ACTIVE'))
                                    ->first();
                if ($intimation_settings && $intimation_settings->task_overdue_intimations_lead && !empty($intimation_settings->task_overdue_intimations_lead_mail) && isset($project_lead) && !empty($project_lead->email))
                {
                    $mail_template  = Templates::find($intimation_settings->task_overdue_intimations_lead_mail);
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

            //Project Task Over Due Creator Intimation
            $task_creator = $task->created_by;
            $task_creator   = User::where('id', $task_creator)
                                ->where('status', config('constant.ACTIVE'))
                                ->first();
            if ($intimation_settings && $intimation_settings->task_overdue_intimations_creator && !empty($intimation_settings->task_overdue_intimations_creator_mail) && isset($task_creator) && !empty($task_creator->email))
            {
                $mail_template  = Templates::find($intimation_settings->task_overdue_intimations_creator_mail);
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

            $task->near_due_intimated = config('constant.ACTIVE');
            $task->save();
        }
    }
}
