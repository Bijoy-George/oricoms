<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\CmpSubscriptions;  

class SubscriptionExpirationStatusUpdation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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
		try{
			$sbcryptn_status= config('constant.SUBSCRIPTION_STATUS');
		
			$cur_date		 = date('Y-m-d H:i');
			 
			$expired_sbcrptn = CmpSubscriptions::where('extended_expiry_date','like','%'.$cur_date.'%') 
									->where('status',$sbcryptn_status[1])
									->get();
			if(count($expired_sbcrptn) > 0)
			{
				foreach($expired_sbcrptn as $subcryptn)
				{
					$cmpny_id	= $subcryptn->cmpny_id;
					$update 	= CmpSubscriptions::where('cmpny_id', $cmpny_id)
									->update(array('status' => $sbcryptn_status[2]));
				}				

			}				
		}
        catch(\Illuminate\Database\QueryException $ex){
			$cc_cron_log    = new CronLog;
            $cron_logid    = $cc_cron_log->createLog('expiration_status_updation');
            $error         = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
	}
}
