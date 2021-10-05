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
use App\AutomatedProcessBatchExpiry;
use App\AutomatedProcessRelations;

class AutomatedProcessExpiry implements ShouldQueue
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
			$batch = AutomatedProcessBatchExpiry::limit(5)->get();
		if(count($batch)>0)
		{
			foreach($batch as $batch)
			{
				$cmpny_id = $batch->cmpny_id;
				$batch_id = $batch->last_relation_id;
				$action_expiry_time = $batch->action_expiry_time;
				$results = AutomatedProcessRelations::where('action_expiry_time',$action_expiry_time)->where('id','>',$batch_id)->where('cmpny_id',$cmpny_id)->orderBy('id','asc')->limit(25)->get();
					if(count($results)>0)
					{	
						foreach($results as $result)
						{
							$id = $result->complaint_id;echo 'Relation Id - '.$result->id.'<br>';
							$auto_id = $result->auto_process_id;
							$response = config('constant.AUTO_PROCESS_RESPONSE_NEGATIVE');
							$flag = $result->id;
							Helpers::auto_process_updation($cmpny_id,$id,$response,$flag);
							$arr = array('last_relation_id' => $flag);
							AutomatedProcessBatchExpiry::where('action_expiry_time',$action_expiry_time)->where('cmpny_id',$cmpny_id)->update($arr);
						}
					}
					else
					{
						AutomatedProcessBatchExpiry::where('action_expiry_time',$action_expiry_time)->where('cmpny_id',$cmpny_id)->delete();
					}
					
			}
			
		}
		}
            catch(\Illuminate\Database\QueryException $ex){
                        $cc_cron_log    = new CronLog;
                        $cron_logid           = $cc_cron_log->createLog('automated_process_expiry');
                        $error      = $ex->getMessage();
                        $cc_cron_log->updateLog($cron_logid,$error);
            }
    }
}
