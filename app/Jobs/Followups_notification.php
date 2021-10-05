<?php

namespace App\Jobs;
use App\CronLog;
use App\Helpers;
use App\Helpdesk;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Followups_notification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        try {
			$today = date('Y-m-d 00:00:00');
			$followups   = Helpdesk::
			               //where('query_type',config('constant.SERVICE_REQUEST'))
			               where('remainder_date',$today)
			               ->get();
			
			foreach($followups as $followup){
			//print_r($followup);die;
            $docketnumber  = $followup->docket_number ?? '';
            $customer_id    = $followup->customer_id ?? '';
            $user_id    = $followup->escalate ?? $followup->created_by;
            $cmpny_id    = $followup->cmpny_id ?? '';
            $comment= "You have a followup on docket number $docketnumber today.View customer details";
            if (empty($docketnumber))
            {
                return false;
            }

            $link=url('/profile/0/'.$customer_id);
            Helpers::add_notifications($user_id,"Today's Task",$comment,$link,$user_id,2,$cmpny_id);}
        }
        catch(\Exception $ex)
        {
            $cc_cron_log    = new CronLog;
            $cron_logid     = $cc_cron_log->createLog('followups_notification');
            $error          = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
        
    }
}
