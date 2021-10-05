<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\CommonSmsEmail;  
use App\CronLog;


class Test_job implements ShouldQueue
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
    {	echo "test<br>"; 
		/* sleep(1);
        $cc_cron_log    = new cc_cron_log;
        $cron_logid           = $cc_cron_log->createLog('Test_job');
        $cc_cron_log->updateLog($cron_logid); */
		
		//sleep(30);
        $cc_cron_log    = new CronLog;
		//for($i = 1; $i <=10; $i++){
			$cron_logid           = $cc_cron_log->createLog('Ela test EMAIL');
			$cc_cron_log->updateLog($cron_logid); 
		//}
        

    }
}
