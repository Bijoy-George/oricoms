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
use App\CompanyProfile;
use App\QueryStatus;
use App\Helpdesk;
use App\User;
use App\Templates;
use App\CommonSmsEmail;

class Going_to_expire_escalate_deadline implements ShouldQueue
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
			
			$dt = date('Y-m-d', strtotime('+2 days'));
	   $companies = CompanyProfile::select('id')->where('status',config('constant.ACTIVE'))->get();
		if(count($companies)>0)
		{
			foreach($companies as $company)
			{
			$cmpny_id = $company->id;
			$set_crm_source = Helpers::get_company_meta('set_crm_source',$cmpny_id);
	   $status_res = QueryStatus::select('id')->where('is_close',1)->where('cmpny_id',$cmpny_id)->get();
	   $results = Helpdesk::where('escalation_due_date','like','%'.$dt.'%')->where('cmpny_id',$cmpny_id)->whereNotIn('query_status',$status_res)->where('escalation_status',1)->get();
	   $reporting = array();
	   $to_data = array();
	   $dockets = '';
	   if(count($results)>0)
	   {
		   foreach($results as $data)
		   {
			   $to = $data->escalate;
			   // echo $to.'<br>';
			   $id = $data->id;
			   $to_data[] = $to;
			   /*$reporting_users = cc_user_reporting_relation::select('reporting_user_id')->where('user_id',$to)->where('cmpny_id',$cmpny_id)->get();
			   if(count($reporting_users)>0)
			   { 
				   foreach($reporting_users as $rusers)
				   {
					   $reporting[] = $rusers->reporting_user_id;
				   }
				   
			   }*/
			   
		   }
	   }
	  // echo "<pre>";print_r($reporting);
	   $to_data = array_unique($to_data);
	 //  $reporting = array_unique($reporting);//echo "<pre>";print_r($reporting);
	   if(count($to_data)>0)
	   {
		   foreach($to_data as $to)
		   {
			   if(isset($to) && !empty($to))
			   {
			   echo $to.'<br>';
			   $details = User::select('phone','email','name')->where('cmpny_id',$cmpny_id)->find($to);
			   $phone = $details->phone;
			   $email = $details->email;
			   $name = $details->name;
			   $docketsresults = Helpdesk::select('docket_number','id')->where('escalation_due_date','like','%'.$dt.'%')->whereNotIn('query_status',$status_res)->where('escalate',$to)->where('escalation_status',1)->where('cmpny_id',$cmpny_id)->get();
			   if(count($docketsresults)>0)
			   {
				   foreach($docketsresults as $docket)
				   {
					   $dockets .= $docket->docket_number.',';
				   }
				   $dockets = rtrim($dockets,',');
				  // echo $dockets;
				   
				   // MAIL FOR PARTICULAR AGENT WITH CONSOLIDATED DOCKET NUMBERS STARTS
				   $esc_going_to_expire_mail = Helpers::get_company_meta('esc_going_to_expire_mail',$cmpny_id);
				   if(!empty($esc_going_to_expire_mail))
				   {
										   
				   $contents = Templates::find($esc_going_to_expire_mail);
				   if(isset($contents) && !empty($contents))
				   {
					   $content = $contents->content;
					   $subject = $contents->subject;
					   $random_code = str_random(12);
					   $content = str_replace('[[ table ]]', $dockets, $content);
					   $content = str_replace('[[ First Name ]]', $name, $content);
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
					   if(isset($email) && !empty($email))
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
				   // MAIL FOR PARTICULAR AGENT WITH CONSOLIDATED DOCKET NUMBERS ENDS
				   
				   // SMS FOR PARTICULAR AGENT WITH CONSOLIDATED DOCKET NUMBERS STARTS
				   $esc_going_to_expire_sms = Helpers::get_company_meta('esc_going_to_expire_sms',$cmpny_id);
				   if(!empty($esc_going_to_expire_sms))
				   {
										   
				   $contents2 = Templates::find($esc_going_to_expire_sms);
				   if(isset($contents2) && !empty($contents2))
				   {
					   $content2 = $contents2->content;
					   $subject2 = $contents2->subject;
					   $random_code = str_random(12);
					   $mail_ref_id = str_random(15);
					   $content2 = str_replace('[[ table ]]', $dockets, $content2);
					   $content2 = str_replace('[[ First Name ]]', $name, $content2);
					   if(isset($phone) && !empty($phone))
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
												'content' => $content2,
												'subject' => $subject2,
												'email_cc' => '', 
												'status' => config('constant.INACTIVE'),
												'created_by' => 0,
												'updated_by' => 0,
												'created_at' => date('Y-m-d H:i:s')
											]);
						}
				   }
				   }
				   // SMS FOR PARTICULAR AGENT WITH CONSOLIDATED DOCKET NUMBERS ENDS
			   }
			   $dockets = '';
			  // echo '<br>';
		   }
		   }
	   }
	   
	   /*if(count($reporting)>0)
	   {
		   foreach($reporting as $report)
		   { echo 'sup-'.$report.'<br>';
			   $details1 = User::select('phone','email','name')->where('cmpny_id',$cmpny_id)->find($report);
			   $phone1 = $details1->phone;
			   $email1 = $details1->email;
			   $name1 = $details1->name;
			   $userids = cc_user_reporting_relation::select('user_id')->where('reporting_user_id',$report)->where('cmpny_id',$cmpny_id)->get();
			   if(count($userids)>0)
			   {	$table = '';$str = '';
		       $table .= "<table border='1' style='border:1px solid #ddd;text-align:center;border-spacing: 0px;' width='100%'><tr><th>Agent Name</th><th>Pending Docket Numbers</th></tr>";
				   foreach($userids as $userid)
				   {
					  // echo $userid->user_id.'<br>';
					   $docketsresults = Helpdesk::select('docket_number')->where('escalation_due_date','like','%'.$dt.'%')->whereNotIn('query_status',$status_res)->where('escalate',$userid->user_id)->where('escalation_status',1)->where('cmpny_id',$cmpny_id)->get();
					   $assg_name = User::select('name')->where('cmpny_id',$cmpny_id)->find($userid->user_id);
						   if(count($docketsresults)>0)
						   {
							   foreach($docketsresults as $docket)
							   {
								   $dockets .= $docket->docket_number.',';
							   }
							   $dockets = rtrim($dockets,',');
							  // echo $dockets;
							   $table .= '<tr><td>'.$assg_name->name.'</td><td>'.$dockets.'</td></tr>';
							   $str.= $assg_name->name.'--'.$dockets.', ';
					$dockets = '';
							   
						   } //echo "<br>";
						   
				   }
				    
			   }
					
					$table .= '</table>';
					echo $table;echo $str;
					// MAIL FOR SUPERIOR OFFICER WITH CONSOLIDATED CONTENT STARTS
				   $perms = Intimations::where('user_id',$report)->where('channel',config('constant.INTIMATION_MAIL'))->where('time_interval',config('constant.INTIMATION_SUPERIOR'))->where('cmpny_id',$cmpny_id)->first();
				   if(count($perms)>0)
				   {
					
				   $contents1 = Templates::find(10);
				   if(isset($contents1) && !empty($contents1))
				   {
					   $content1 = $contents1->content;
					   $subject1 = $contents1->subject;
					   $random_code1 = str_random(12);
					   $content1 = str_replace('[[ table ]]', $table, $content1);
					   $content1 = str_replace('[[ First Name ]]', $name1, $content1);
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
						$content1 = $email_header_content.$content1.$email_footer_content;
						// ADDED FOR TEMPLATES HEADER AND FOOTER
					   if(isset($email1) && !empty($email1))
					   {
									$mail_arr = CommonSmsEmail::Create(
												[
												'authentication' => '',
												'cmpny_id' => $cmpny_id,
												'source' => $set_crm_source,
												'email' => $email1,
												'sent_type' => config('constant.CH_EMAIL'),
												'response' => 'notsent',
												'mail_response' => '',
												'random_code' => $random_code1,
												'content' => $content1,
												'subject' => $subject1,  
												'email_cc' => '',   
												'status' => config('constant.INACTIVE'),
												'created_by' => 0,
												'updated_by' => 0,
												'created_at' => date('Y-m-d H:i:s')
											   ]);
						}
				   }
				      
				   }
				    // MAIL FOR SUPERIOR OFFICER WITH CONSOLIDATED CONTENT ENDS
					
					// SMS FOR SUPERIOR OFFICER WITH CONSOLIDATED CONTENT STARTS
				   $perms = Intimations::where('user_id',$report)->where('channel',config('constant.INTIMATION_SMS'))->where('time_interval',config('constant.INTIMATION_SUPERIOR'))->first();
				   if(count($perms)>0)
				   {
					
				   $contents3 = Templates::find(10);
				   if(isset($contents3) && !empty($contents3))
				   {
					   $content3 = $contents3->content;
					   $subject3 = $contents3->subject;
					   $random_code1 = str_random(12);
					   $mail_ref_id = str_random(15);
					   $str = rtrim($str,',');
					   $content3 = str_replace('[[ table ]]', $str, $content3);
					   $content3 = str_replace('[[ First Name ]]', $name1, $content3);
					   if(isset($phone1) && !empty($phone1))
					   {
									$sms_arr = CommonSmsEmail::Create([
												'authentication' => '',
												'cmpny_id' => $cmpny_id,
												'source' => $set_crm_source,
												'mobile' => $phone1,
												'sent_type' => config('constant.CH_SMS'),
												'response' => 'notsent',
												'mail_response' => '',
                                                'mail_ref_id' => $mail_ref_id,
												'random_code' => $random_code,
												'content' => $content3,
												'subject' => $subject3,
												'email_cc' => '', 
												'status' => config('constant.INACTIVE'),
												'created_by' => 0,
												'updated_by' => 0,
												'created_at' => date('Y-m-d H:i:s')
											]);
						}
				   }
				      
				   }
				    // SMS FOR SUPERIOR OFFICER WITH CONSOLIDATED CONTENT ENDS
					$table = '';$str = '';
		   }
		   
	   }*/
			}
		}
			
		}
            catch(\Illuminate\Database\QueryException $ex){
                        $cc_cron_log    = new CronLog;
                        $cron_logid           = $cc_cron_log->createLog('going_to_expire_escalate_deadline');
                        $error      = $ex->getMessage();
                        $cc_cron_log->updateLog($cron_logid,$error);
            }
    }
}
