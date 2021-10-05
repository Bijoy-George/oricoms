<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyProjectOverDue implements ShouldQueue
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
        $projects = Project::select('id', 'cmpny_id', 'due_date', 'members')
                                ->where('due_date', '<' date('Y-m-d'))
                                ->where('overdue_intimated', '!=', config('constant.ACTIVE'))
                                ->where('never_due', '!=', config('constant.ACTIVE'))
                                ->where('status', config('constant.ACTIVE'))
                                ->get();

        foreach ($projects as $project)
        {
            $cmpny_id   = $project->cmpny_id;
            $intimation_settings    = ProjectIntimations::where('cmpny_id', $cmpny_id)->first();
            $overdue_interval  = (isset($intimation_settings->project_overdue_intimation_period) && ($intimation_settings->project_overdue_intimation_period !== NULL)) ? (int)$intimation_settings->project_overdue_intimation_period : config('constant.project_overdue_default_interval');

            if (date('Y-m-d', strtotime($project->due_date . ' +'.$overdue_interval.' days') > date('Y-m-d'))
            {
                continue;
            }

            //Project Over Due Members Intimation
            $members = $project->members;
            if (!empty($members))
            {
                $members = unserialize($members);
            }

            if ($intimation_settings && $intimation_settings->project_overdue_intimations_members && !empty($intimation_settings->project_overdue_intimations_members_mail) && isset($members) && !empty($members))
            {
                $mail_template  = Templates::find($intimation_settings->project_overdue_intimations_members_mail);
                if ($mail_template)
                {
                    $subject    = $mail_template->subject;
                    $content    = $mail_template->content;
                    $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);

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
            }

            //Project Over Due Lead Intimation
            $project_lead   = $project->project_lead;
            $project_lead   = User::where('id', $project_lead)
                                ->where('status', config('constant.ACTIVE'))
                                ->first();
            if ($intimation_settings && $intimation_settings->project_overdue_intimations_lead && !empty($intimation_settings->project_overdue_intimations_lead_mail) && isset($project_lead) && !empty($project_lead->email))
            {
                $mail_template  = Templates::find($intimation_settings->project_overdue_intimations_lead_mail);
                if ($mail_template)
                {
                    $subject    = $mail_template->subject;
                    $content    = $mail_template->content;
                    $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
                    $content    = str_replace('[[ Name ]]', $project_lead->name, $content);

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

            //Project Over Due Creator Intimation
            $project_creator = $project->created_by;
            $project_creator   = User::where('id', $project_creator)
                                ->where('status', config('constant.ACTIVE'))
                                ->first();
            if ($intimation_settings && $intimation_settings->project_overdue_intimations_creator && !empty($intimation_settings->project_overdue_intimations_creator_mail) && isset($project_creator) && !empty($project_creator->email))
            {
                $mail_template  = Templates::find($intimation_settings->project_overdue_intimations_creator_mail);
                if ($mail_template)
                {
                    $subject    = $mail_template->subject;
                    $content    = $mail_template->content;
                    $content    = str_replace('[[ Project Name ]]', $project->prjt_name, $content);
                    $content    = str_replace('[[ Name ]]', $project_creator->name, $content);

                    $random_code    = str_random(12);

                    $mail_arr = CommonSmsEmail::create(
                                        [
                                        'authentication' => '',
                                        'cmpny_id' => $cmpny_id,
                                        'email' => $project_creator->email,
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

            $project->overdue_intimated = config('constant.ACTIVE');
            $project->save();
        }
    }
}
