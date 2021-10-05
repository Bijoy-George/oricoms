<?php

namespace App\Jobs;

use App\CronLog;
use App\Helpers;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyHelpdeskReportCompletion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $file_name  = $this->data['file_name'] ?? '';
            $user_id    = $this->data['user_id'] ?? '';
            $cmpny_id    = $this->data['cmpny_id'] ?? '';
            $comment= 'Please use the below link to download Helpdesk Report';
            if (empty($file_name))
            {
                return false;
            }

            $link=url('/download_helpdesk_report/'.$file_name);
            Helpers::add_notifications($user_id,'Helpdesk Report has been completed',$comment,$link,$user_id,1,$cmpny_id);
        }
        catch(\Exception $ex)
        {
            $cc_cron_log    = new CronLog;
            $cron_logid     = $cc_cron_log->createLog('notify_helpdesk_report_completion');
            $error          = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
    }
}
