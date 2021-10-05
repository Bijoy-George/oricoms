<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\CronLog;
use App\Helpers;
use DB;
use App\Intimations;
use App\User;
use App\CommonSmsEmail;
use App\Templates; 

class Get_monthly_escalate_intimations implements ShouldQueue
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
		$results = Intimations::select('user_id','channel','cmpny_id')->where('time_interval',config('constant.INTIMATION_MONTHLY'))->where('status',config('constant.ACTIVE'))->get();
	   if(count($results)>0)
	   {
		   foreach($results as $data)
		   {
			   $user_id = $data->user_id;echo $user_id.'<br>';
			   $channel = $data->channel;
			   $cmpny_id = $data->cmpny_id;
			   $set_crm_source = Helpers::get_company_meta('set_crm_source',$cmpny_id);
			   $details = User::select('phone','email','name')->where('cmpny_id',$cmpny_id)->find($user_id);
			   $phone = $details->phone;
			   $email = $details->email;
			   $name = $details->name;
			   if($channel==config('constant.INTIMATION_SMS'))
			   {
				   if(isset($phone) && !empty($phone))
				   {
					   $mail_ref_id = str_random(15);
					   $random_code = str_random(12); 
					   $esc_intimations_sms = Helpers::get_company_meta('esc_summary_sms',$cmpny_id);
					   if(!empty($esc_intimations_sms))
					   {
											   
					   $contents = Templates::find($esc_intimations_sms);
					   if(isset($contents) && !empty($contents))
					   {
					   $content = $contents->content;
					   $subject = $contents->subject;
					   $table = Helpers::escalate_report_mail_content($cmpny_id,$user_id,config('constant.INTIMATION_MONTHLY'),config('constant.INTIMATION_SMS'));
					   $content = str_replace('[[ table ]]', $table, $content);
					   $content = str_replace('[[ First Name ]]', $name, $content);
					   $content = str_replace('[[ period ]]', "monthly", $content);
					   if($table!=1)
					   {
					   $sms_arr = CommonSmsEmail::Create([
												'authentication' => '',
												'cmpny_id' => $cmpny_id,
												'source' => $set_crm_source,
												'mobile' => $phone,
												'sent_type' => config('constant.CH_SMS'),
												'response' => 'notsent',
												'mail_response' => '',
                                                'mail_ref_id' => $mail_ref_id,
												'random_code' => $random_code,
												'content' => $content,
												'subject' => $subject,
												'email_cc' => '', 
												'status' => config('constant.INACTIVE'),
												'created_by' => 0,
												'updated_by' => 0,
												'created_at' => date('Y-m-d H:i:s')
											]);
						}
						}
						}
				   }
				   
			   }
			   else if($channel==config('constant.INTIMATION_MAIL'))
			   {
				   if(isset($email) && !empty($email))
				   {
					   $mail_ref_id = str_random(15);
					   $random_code = str_random(12); 
					   $esc_intimations_mail = Helpers::get_company_meta('esc_summary_mail',$cmpny_id);
					   if(!empty($esc_intimations_mail))
					   {
												   
					   $contents = Templates::find($esc_intimations_mail);
					   if(isset($contents) && !empty($contents))
					   {
					   $content = $contents->content;
					   $subject = $contents->subject;
					   $table = Helpers::escalate_report_mail_content($cmpny_id,$user_id,config('constant.INTIMATION_MONTHLY'),config('constant.INTIMATION_MAIL'));
					   $content = str_replace('[[ table ]]', $table, $content);
					   $content = str_replace('[[ First Name ]]', $name, $content);
					   $content = str_replace('[[ period ]]', "monthly", $content);
					   // ADDED FOR TEMPLATES HEADER AND FOOTER
						$email_header_content = '';$email_footer_content = '';
						$email_header = Helpers::get_company_meta('email_header',$cmpny_id);
						$email_footer = Helpers::get_company_meta('email_footer',$cmpny_id);
						if(isset($email_header) && !empty($email_header) && ($email_header>0))
						{
							$email_header_content = Helpers::get_template_content($email_header);
						}
						if(isset($email_footer) && !empty($email_footer) && ($email_footer>0))
						{
							$email_footer_content = Helpers::get_template_content($email_footer);
						}
						$content = $email_header_content.$content.$email_footer_content;
						// ADDED FOR TEMPLATES HEADER AND FOOTER
					   if($table!=1)
					   {
					   $mail_arr = CommonSmsEmail::Create(
												[
												'authentication' => '',
												'cmpny_id' => $cmpny_id,
												'source' => $set_crm_source,
												'email' => $email,
												'sent_type' => config('constant.CH_EMAIL'),
												'response' => 'notsent',
												'mail_response' => '',
												'random_code' => $random_code,
												'content' => $content,
												'subject' => $subject,  
												'email_cc' => '',   
												'status' => config('constant.INACTIVE'),
												'created_by' => 0,
												'updated_by' => 0,
												'created_at' => date('Y-m-d H:i:s')
											   ]);
						}
					   }
					   }
				   }
			   }
		   }
	   }	
	   
		}
            catch(\Illuminate\Database\QueryException $ex){
                        $cc_cron_log    = new CronLog;
                        $cron_logid           = $cc_cron_log->createLog('get_monthly_escalate_intimations');
                        $error      = $ex->getMessage();
                        $cc_cron_log->updateLog($cron_logid,$error);
            }
    }
}
