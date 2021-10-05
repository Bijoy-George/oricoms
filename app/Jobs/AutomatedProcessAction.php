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
use App\AutomatedProcessBatch;
use App\AutomatedProcessRelations;

class AutomatedProcessAction implements ShouldQueue
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
			$batch = AutomatedProcessBatch::limit(3)->get();
		if(count($batch)>0)
		{
				foreach($batch as $batch)
				{
					$cmpny_id = $batch->cmpny_id;
					$batch_id = $batch->last_relation_id;
					$action_time = $batch->action_time;
					$results = AutomatedProcessRelations::where('action_time',$action_time)->where('id','>',$batch_id)->where('cmpny_id',$cmpny_id)->orderBy('id','asc')->limit(25)->get();
					if(count($results)>0)
					{
						foreach($results as $result)
						{
							$id = $result->id;echo 'Relation Id - '.$id.'<br>';
							$complaint_id = $result->complaint_id;
							$auto_id = $result->auto_process_id;
							Helpers::auto_process_action($cmpny_id,$id,$complaint_id,$auto_id);
							$arr = array('last_relation_id' => $id);
							AutomatedProcessBatch::where('action_time',$action_time)->where('cmpny_id',$cmpny_id)->update($arr);
						}
					}
					else
					{
						AutomatedProcessBatch::where('action_time',$action_time)->where('cmpny_id',$cmpny_id)->delete();
					}	
				}
			
			}
		}
            catch(\Illuminate\Database\QueryException $ex){
                        $cc_cron_log    = new CronLog;
                        $cron_logid           = $cc_cron_log->createLog('automated_process_action');
                        $error      = $ex->getMessage();
                        $cc_cron_log->updateLog($cron_logid,$error);
            }
    }
}
