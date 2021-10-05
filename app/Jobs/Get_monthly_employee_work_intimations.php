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
use App\Tracker;
use Carbon\Carbon;
use DB; 
use App\Intimations;
use App\User;
use App\CommonSmsEmail;
use App\Templates;
use App\ProjectIntimations;


class Get_monthly_employee_work_intimations implements ShouldQueue
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
				$intimation_settings   = Intimations::where('status',config('constant.PROJECT_INTIMATION_STATUS'))->get();
				
				foreach($intimation_settings as $int){
				if (!empty($int->monthly_intimation) && !empty($int->monthly_template))
				{
						$mail_template  = Templates::find($int->monthly_template);
						if ($mail_template)
						{
							
				   
								$cmpny_id = $int->cmpny_id;
								$user_id = $int->user_id;
								
								 $user   = User::where('id', $user_id)
										->where('status', config('constant.ACTIVE'))
										->first();
								$subject    = $mail_template->subject;
								$content    = $mail_template->content;
								$table = Helpers::escalate_projecttaskhour_mail_content($cmpny_id,$user_id,config('constant.INTIMATION_MONTHLY'));
								$content = str_replace('[[ table ]]', $table, $content);
								$content = str_replace('[[ First Name ]]', $user->name, $content);
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
								$random_code    = str_random(12);

								$mail_arr = CommonSmsEmail::create(
													[
													'authentication' => '',
													'cmpny_id' => $cmpny_id,
													'email' => $user->email,
													'customer_id' => '',
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
				}}
			}		
				 catch(\Illuminate\Database\QueryException $ex){
					$cc_cron_log    = new CronLog;
					$cron_logid           = $cc_cron_log->createLog('get_daily_escalate_intimations');
					$error      = $ex->getMessage();
					 $cc_cron_log->updateLog($cron_logid,$error);
				} 
				
    }

}