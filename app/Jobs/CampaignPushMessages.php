<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\CommonSmsEmail;  
use App\CustomerFcms;
use App\Helpers;
use App\CronLog;

class CampaignPushMessages implements ShouldQueue
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
			$cmp_notfs = CommonSmsEmail::select('id', 'customer_id', 'campaign_id', 'content', 'subject', 'batch_id', 'cmpny_id')
                        ->where('status', config('constant.INACTIVE'))
						->where('sent_type', config('constant.CH_PUSH_MESSAGES'))
						->limit(50)
						->get();
		$authentication = '';
		if(count($cmp_notfs)>0)
		{
			foreach($cmp_notfs as $notfs)
			{
				$fcm_id = array();
				$id = $notfs->id;echo $id.'<br>';
				$campaign_id = $notfs->campaign_id;
				$batch_id = $notfs->batch_id;
				$customer_id = $notfs->customer_id;
				$content = $notfs->content;
				$subject = $notfs->subject;
				$cmpny_id = $notfs->cmpny_id;
				
				if(isset($customer_id) && !empty($customer_id))
				{
				// PUSH MESSAGE STARTS
						$pushmsg=$content;
						$fcm_results = CustomerFcms::where('customer_id',$customer_id)->where('cmpny_id',$cmpny_id)->get();
						if(count($fcm_results)>0)
						{

							foreach ($fcm_results as $value) {
								$fcm_id[]=$value->fcmRegId;
							}
						if(!empty($fcm_id)){
						
								$message = $content;
							
			                    $sending_push = Helpers::sending_push_notification($cmpny_id,$fcm_id,$message,$subject,$authentication);
			                    // print_r($sending_push);
			                    // echo 'dd';
								echo $sending_push.'--';
								$ar = json_decode($sending_push, true);
								$status_fcm = $ar['success'];echo $status_fcm.'---';
												if($status_fcm >= 1)
												{
													$new_array = array(
													'status' => config('constant.ACTIVE'),
													'response' => 'sent',
													'push_response' => $sending_push,
													);
												}
												else
												{
													$new_array = array(
													'status' => config('constant.FCM_MISMATCH'),
													'response' => 'fcm mismatches',
													'push_response' => $sending_push,
													);
												}
												CommonSmsEmail::where('id',$id)->where('cmpny_id',$notfs->cmpny_id)->update($new_array);
							}					

						}
						else
						{
												$new_array = array(
												'status' => 4,
												'response' => 'no fcm for customer',
												);
												CommonSmsEmail::where('id',$id)->where('cmpny_id',$notfs->cmpny_id)->update($new_array);
												
						}
											
				// PUSH MESSAGE ENDS	
				}
				
			}
			
		}
		}
            catch(\Illuminate\Database\QueryException $ex){
                        $cc_cron_log    = new CronLog;
                        $cron_logid           = $cc_cron_log->createLog('campaign_push_messages');
                        $error      = $ex->getMessage();
                        $cc_cron_log->updateLog($cron_logid,$error);
            }
    }
}
