<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

use Auth;
use App\CronLog;
use App\BatchProcess;
use App\ChatThreadLog;
use App\NotificationsList;
use App\NotificationsRolesRelations;
use App\Helpers;

class ChatReportExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $details;
    
    public function __construct($details) 
    {    
      $this->details  = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try
        {            
            $report_details=$this->details;
            $comment= 'Please use the link to download the report';
        
            $link=url('/download_chatreport/'.$report_details['file_name']);
            $user_id = $report_details['user_id'];
            $cmpny_id = $report_details['cmpny_id'];
        
            Helpers::add_notifications($user_id,'Chat History Report has been completed',$comment,$link,$user_id,1,$cmpny_id);      
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $cc_cron_log    = new CronLog;
            $cron_logid     = $cc_cron_log->createLog('sending_feedback_notification');
            $error          = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
	}
}
