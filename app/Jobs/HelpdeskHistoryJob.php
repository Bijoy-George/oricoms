<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Helpers;
use App\CronLog;
use App\BatchProcess;
use App\FeedbackDetail;

class HelpdeskHistoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $details;
    
    public function __construct($details) {

      
      $this->details  = $details;
     
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		try{
                     
          
          $report_details=$this->details;
          $comment= 'Please use the below link to download Helpdesk History Report';
          $link=url('/download_helpdeskhistory/'.$report_details['file_name']);
          Helpers::add_notifications($report_details['user_id'],'Helpdesk History Report has been completed',$comment,$link,$report_details['user_id'],2,$report_details['cmpny_id']);

         
            }
            catch(\Illuminate\Database\QueryException $ex){
               $cc_cron_log    = new CronLog;
                $cron_logid           = $cc_cron_log->createLog('Helpdesk_history_report');
                $error      = $ex->getMessage();
                $cc_cron_log->updateLog($cron_logid,$error);
            }
	}
}
