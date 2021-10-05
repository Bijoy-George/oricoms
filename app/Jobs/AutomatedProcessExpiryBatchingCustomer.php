<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Helpers;
use App\CronLog;
use App\CompanyProfile;
use App\AutomatedProcessRelationsCustomer;
use App\AutomatedProcessBatchExpiryCustomer;

class AutomatedProcessExpiryBatchingCustomer implements ShouldQueue
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
			$companies = CompanyProfile::select('id')->where('status',config('constant.ACTIVE'))->get();
		if(count($companies)>0)
		{
			foreach($companies as $company)
			{
			$cmpny_id = $company->id;
					$results = AutomatedProcessRelationsCustomer::select('id')->where('action_expiry_time',date('Y-m-d H:i').':00')->where('cmpny_id',$cmpny_id)->first();
					if($results)
					{
					
					AutomatedProcessBatchExpiryCustomer::Create([
												'last_relation_id' => 0,
												'cmpny_id' => $cmpny_id,
												'action_expiry_time' => date('Y-m-d H:i').':00',
												'created_at' => date('Y-m-d H:i:s'),
												]);	

					}
			}
		}
		}
            catch(\Illuminate\Database\QueryException $ex){
                        $cc_cron_log    = new CronLog;
                        $cron_logid           = $cc_cron_log->createLog('automated_process_expiry_batching_customer');
                        $error      = $ex->getMessage();
                        $cc_cron_log->updateLog($cron_logid,$error);
            }
    }
}
