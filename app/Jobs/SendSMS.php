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
use Helpers;
use CommunicationHelper;

class SendSMS implements ShouldQueue
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
				
				$ar = array();
				$campaign_sms = CommonSmsEmail::select('id','content','contact_id','sent_type','mobile','encoding_type','cmpny_id','communication_type')
											->where('status', '=' , config('constant.INACTIVE'))
											->where('sent_type', '=' , config('constant.CH_SMS'))
											->where('created_at','>=','2018-07-18 16:00:00')
											->orderBy('communication_type', 'desc')
											->orderBy('id','asc')
											->limit(50)->get();

				$unique_sms = $campaign_sms->unique(function($sms) {
					return $sms['mobile'] . '-' . $sms['content'];
				});

				$unique_sms = collect($unique_sms->values()->all());
				$unique_sms_ids    = $unique_sms->pluck('id')->all();

				//Update status of repeated mails

				$results = $campaign_sms->filter(function($sms,$key) use ($unique_sms_ids) {
					if (!in_array($sms->id, $unique_sms_ids))
					{
						$sms->status = config('constant.REPEAT_STATUS');
						$sms->response = 'sent';
						$sms->save();
						return false;
					}

					return true;
				});

				$results = collect($results->all());
		
		
		
    	if(count($results) > 0){
    	foreach ($results as $value) {
    		$contact_id=$value->contact_id;
    		$type=$value->sent_type; 
    		$id=$value->id;
			$category=$value->communication_gateway;
    		$email='';
    		$mobile_number=$value->mobile; 
			$encoding_type=$value->encoding_type;
			if(!isset($encoding_type) || ($encoding_type==''))
			{
				$encoding_type = 0;
			}	
    		if(!empty($value->content))
			{
			 	$content=$value->content;
			}else
			{
			 	$content='';
			}

                $arr11=array('status'=>90);
                $upArry11  = CommonSmsEmail::where('id',$id)->where('cmpny_id',$value->cmpny_id)->update($arr11);
				if(!empty($type) && $type == config('constant.CH_SMS')){
					
                    try{
						if(!empty($mobile_number) && !empty($content))
						{
							
							$receipientno = $mobile_number;
							$smscontent = $content;

								//$category = helpers::get_smsgateway_countrycode($receipientno);
								//$buffer = CommunicationHelper::common_sms_response_multiple_channel($receipientno,$smscontent,$category,$encoding_type);
								$buffer = array();
								$buffer = CommunicationHelper::common_sms_response($receipientno,$smscontent,$value->cmpny_id,$value->communication_type);
											//	$buffer = array();
												$guid = '';
												$error = '';
												foreach ($buffer as $value1) {
														   $guid =  $value1['guid'];
														   $error =  $value1['error'];
														   $type =  $value1['type'];
												} 
												$current_status = Helpers::sms_response_code_mapping($error,$type);
												$arr=array('response'=>'sent','status'=>$current_status,'mail_ref_id' => $guid); 
												CommonSmsEmail::where('id',$id)->where('cmpny_id',$value->cmpny_id)->update($arr);
						}
					}
					catch(\Exception $e)
					{
						$cc_cron_log    = new CronLog;
						$cron_logid           = $cc_cron_log->createLog('send_sms_error');
						$error      = $e->getMessage();
						$cc_cron_log->updateLog($cron_logid,$error);
						$arr22=array('status'=>89);
						$upArry22  = CommonSmsEmail::where('id',$id)->where('cmpny_id',$value->cmpny_id)->update($arr22);
					}
    			
    		}
    		

    	}
		}

        }
		catch(\Illuminate\Database\QueryException $ex){
					$cc_cron_log    = new CronLog;
					$cron_logid           = $cc_cron_log->createLog('send_sms');
					$error      = $ex->getMessage();
					$cc_cron_log->updateLog($cron_logid,$error);
		}
        
    
    }
}
