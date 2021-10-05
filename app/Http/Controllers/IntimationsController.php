<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Mail;
use Auth;
use App\Intimations;
use App\User;
use App\CommonSmsEmail;
use App\Templates;
use App\Helpdesk;
use App\LeadStatus;
use App\Helpers;
use App\QueryStatus;
use App\CompanyMeta;
use App\CompanyProfile;
//use App\cc_user_reporting_relation;
use Carbon\Carbon;
use App\CronLog;
use App\Jobs\Get_daily_escalate_intimations;
use App\Jobs\Get_weekly_escalate_intimations;
use App\Jobs\Get_monthly_escalate_intimations;
use App\Jobs\Going_to_expire_escalate_deadline;
use App\Jobs\Escalate_deadline_expired;
use App\Jobs\Get_daily_employee_work_intimations;
use App\Jobs\Get_monthly_employee_work_intimations;

 /**
    * Intimations  Controller
    * @author RINKU.E.B
    * @date 13/09/2018
    * @since version 1.0.0
    * @param NULL
    * @return 
   */ 

class IntimationsController extends Controller
{
	public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('check-permission:intimation settings create', ['only' => ['index']]);
       $this->middleware('check-permission:intimation settings edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:intimation settings edit|intimation settings create',   ['only' => ['store']]);
    }
	
	/**
    * IntimationsController  Controller
    * @author RINKU.E.B
    * @date 12/09/2018
    * @param NULL
    * @return 
   */ 
   public function index()
   { 
   		$user_id = Auth::User()->id;
   		$channels = Intimations::select('channel')->where('user_id',$user_id)->where('status',config('constant.ACTIVE'))->distinct()->get();
		$intervals = Intimations::select('time_interval')->where('user_id',$user_id)->where('status',config('constant.ACTIVE'))->distinct()->get();
		return view('masters.intimationSettings.create', compact('channels','intervals','user_id'));
	    
    }
	/*
    * Function for intimation settings
    * @author RINKU.E.B.
    * @date 16/11/2018
    * @since version 1.0.0
    * @param NULL
    */
	public function create()
    { 
		return view('masters.intimationSettings.create', compact(''));
    }

	public function inti_create($user_id = '')
    {
		if($user_id == ''){ $user_id = Auth::User()->id; }
		$channels = Intimations::select('channel')->where('user_id',$user_id)->where('status',config('constant.ACTIVE'))->distinct()->get();
		$intervals = Intimations::select('time_interval')->where('user_id',$user_id)->where('status',config('constant.ACTIVE'))->distinct()->get();
		return view('masters.intimationSettings.create', compact('channels','intervals','user_id'));
    }
	/*
    * Update function for settings intimations
    * @author RINKU.E.B.
    * @date 16/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for settings intimations
    */
	public function edit($id)
    {   
            $intimations = Intimations::where('user_id',$id)->get();
			//echo "<pre>";print_r($results);die;
            return view('masters.intimationSettings.create', compact('intimations'));
    }
	
	  /*
    * Save function for intimations Add&Update
    * @author RINKU.E.B. 
    * @date 16/11/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    { 
		$response = $request->all();
		$channel = $response['channel'];
		$time_interval = $response['interval'];
		$user_id = $response['user_id'];
		$condn_arr['user_id'] = $user_id;
		$condn_arr['cmpny_id'] = Auth::user()->cmpny_id;
	    $updarr = array('status' => config('constant.INACTIVE'));
		Intimations::whereNotIn('time_interval',$time_interval)->where('user_id',$user_id)->where('status',config('constant.ACTIVE'))->update($updarr);
		Intimations::whereNotIn('channel',$channel)->where('user_id',$user_id)->where('status',config('constant.ACTIVE'))->update($updarr);
		if(isset($channel) && !empty($channel))
		{
			foreach($channel as $chnl)
			{
				$condn_arr['channel'] = $chnl;
				if(isset($time_interval) && !empty($time_interval))
				{
					foreach($time_interval as $inter)
					{
						if($condn_arr['channel']==config('constant.INTIMATION_INTERNAL'))
						{
							$condn_arr['time_interval'] = config('constant.INTIMATION_IMMEDIATE_INTERNAL');
						}
						else
						{
							$condn_arr['time_interval'] = $inter;
						}
						$upd_arr['status'] = config('constant.ACTIVE');
						Intimations::updateOrCreate($condn_arr,$upd_arr);
					}
				}
			} 
		}
		if(!isset($channel) && empty($channel) && !isset($time_interval) && empty($time_interval))
		{
			Intimations::where('user_id',$user_id)->where('status',config('constant.ACTIVE'))->update($updarr);
		}
		$result_arr=array('success' => true,'message' => 'Successfuly updated');
		return $result_arr;		
	}

	   
   /**
    * Set Escalate report settings
    * @author RINKU.E.B
    * @date 13/09/2018
    * @param NULL
    * @return 
   */ 
   public function set_escalate_reports(Request $request)
   {
	    $response = $request->all();
	    $user_id = $response['user_id'];
	    //$channel = $response['channel'];
		if(isset($response['channel']) && !empty($response['channel']))
		{
			$channel = $response['channel'];
		}
		else
		{
			$channel = array();
		}
		if(isset($response['interval']) && !empty($response['interval']))
		{
			$time_interval = $response['interval'];
		}
		else
		{
			$time_interval = array(config('constant.INTIMATION_INTERNAL'));
		}
	    
		$condn_arr['user_id'] = $user_id;
		Intimations::whereNotIn('time_interval',$time_interval)->where('user_id',$user_id)->delete();
		Intimations::whereNotIn('channel',$channel)->where('user_id',$user_id)->delete();
	    if(isset($channel) && !empty($channel))
		{
			foreach($channel as $chnl)
			{
				$condn_arr['channel'] = $chnl;
				if(isset($time_interval) && !empty($time_interval))
				{
					foreach($time_interval as $inter)
					{
						if($condn_arr['channel']==config('constant.INTIMATION_INTERNAL'))
						{
							$condn_arr['time_interval'] = config('constant.INTIMATION_IMMEDIATE_INTERNAL');
						}
						else
						{
							$condn_arr['time_interval'] = $inter;
						}
						Intimations::updateOrCreate($condn_arr);
					}
				}
			} 
		}
		if(!isset($channel) && empty($channel) && !isset($time_interval) && empty($time_interval))
		{
			Intimations::where('user_id',$user_id)->delete();
		}
		
   }
   
   /**
    * get_daily_escalate_intimations
    * @author RINKU.E.B
    * @date 13/09/2018
    * @param NULL
    * @return 
   */ 
   public function get_daily_escalate_intimations()
   {
		$cc_cron_log    = new CronLog;
        $cron_logid           = $cc_cron_log->createLog('get_daily_escalate_intimations');
        try
		{	
			$queueJob = (new Get_daily_escalate_intimations())->delay(Carbon::now()->addSeconds(5));
			dispatch($queueJob);
			$cc_cron_log->updateLog($cron_logid);
        }
        catch(\Illuminate\Database\QueryException $ex)
		{
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
	   
	/* $results = Intimations::select('user_id','channel','cmpny_id')->where('time_interval',config('constant.INTIMATION_DAILY'))->where('status',config('constant.ACTIVE'))->get();
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
					   $esc_intimations_sms = Helpers::get_company_meta('esc_intimations_sms',$cmpny_id);
					   if(!empty($esc_intimations_sms))
					   {
					   
					   $contents = Templates::find($esc_intimations_sms);
					   if(isset($contents) && !empty($contents))
					   {
					   $content = $contents->content;
					   $subject = $contents->subject;
					   $table = Helpers::escalate_report_mail_content($cmpny_id,$user_id,config('constant.INTIMATION_DAILY'),config('constant.INTIMATION_SMS'));//use sms content as another one
					   $content = str_replace('[[ table ]]', $table, $content);
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
					   $esc_intimations_mail = Helpers::get_company_meta('esc_intimations_mail',$cmpny_id);
					   if(!empty($esc_intimations_mail))
					   {
												   
					   $contents = Templates::find($esc_intimations_mail);
					   if(isset($contents) && !empty($contents))
					   {
					   $content = $contents->content;
					   $subject = $contents->subject;
					   $table = Helpers::escalate_report_mail_content($cmpny_id,$user_id,config('constant.INTIMATION_DAILY'),config('constant.INTIMATION_MAIL'));
					   $content = str_replace('[[ table ]]', $table, $content);
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
	   }*/
   }
    /**
    * get_weekly_escalate_intimations
    * @author RINKU.E.B
    * @date 13/09/2018
    * @param NULL
    * @return 
   */ 
   public function get_weekly_escalate_intimations()
   {
	    $cc_cron_log    = new CronLog;
        $cron_logid           = $cc_cron_log->createLog('get_weekly_escalate_intimations');
        try
		{	
			$queueJob = (new Get_weekly_escalate_intimations())->delay(Carbon::now()->addSeconds(5));
			dispatch($queueJob);
			$cc_cron_log->updateLog($cron_logid);
        }
        catch(\Illuminate\Database\QueryException $ex)
		{
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
	  /* $results = Intimations::select('user_id','channel','cmpny_id')->where('time_interval',config('constant.INTIMATION_WEEKLY'))->where('status',config('constant.ACTIVE'))->get();
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
					   $esc_intimations_sms = Helpers::get_company_meta('esc_intimations_sms',$cmpny_id);
					   if(!empty($esc_intimations_sms))
					   {
												   
					   $contents = Templates::find($esc_intimations_sms);
					   if(isset($contents) && !empty($contents))
					   {
					   $content = $contents->content;
					   $subject = $contents->subject;
					   $table = Helpers::escalate_report_mail_content($cmpny_id,$user_id,config('constant.INTIMATION_WEEKLY'),config('constant.INTIMATION_SMS'));
					   $content = str_replace('[[ table ]]', $table, $content);
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
					   $esc_intimations_mail = Helpers::get_company_meta('esc_intimations_mail',$cmpny_id);
					   if(!empty($esc_intimations_mail))
					   {
												   
					   $contents = Templates::find($esc_intimations_mail);
					   if(isset($contents) && !empty($contents))
					   {
					   $content = $contents->content;
					   $subject = $contents->subject;
					   $table = Helpers::escalate_report_mail_content($cmpny_id,$user_id,config('constant.INTIMATION_WEEKLY'),config('constant.INTIMATION_MAIL'));
					   $content = str_replace('[[ table ]]', $table, $content);
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
	   }*/
   }
   /**
    * get_monthly_escalate_intimations
    * @author RINKU.E.B
    * @date 13/09/2018
    * @param NULL
    * @return 
   */ 
   public function get_monthly_escalate_intimations()
   {
	    $cc_cron_log    = new CronLog;
        $cron_logid           = $cc_cron_log->createLog('get_monthly_escalate_intimations');
        try
		{	
			$queueJob = (new Get_monthly_escalate_intimations())->delay(Carbon::now()->addSeconds(5));
			dispatch($queueJob);
			$cc_cron_log->updateLog($cron_logid);
        }
        catch(\Illuminate\Database\QueryException $ex)
		{
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
	   
	  /* $results = Intimations::select('user_id','channel','cmpny_id')->where('time_interval',config('constant.INTIMATION_MONTHLY'))->where('status',config('constant.ACTIVE'))->get();
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
					   $esc_intimations_sms = Helpers::get_company_meta('esc_intimations_sms',$cmpny_id);
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
					   $esc_intimations_mail = Helpers::get_company_meta('esc_intimations_mail',$cmpny_id);
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
	   }*/
   }
   /**
    * escalated deadline going to expire 
    * @author RINKU.E.B
    * @date 17/09/2018
    * @return 
   */ 
   public function going_to_expire_escalate_deadline()
   {
	    $cc_cron_log    = new CronLog;
        $cron_logid           = $cc_cron_log->createLog('going_to_expire_escalate_deadline');
        try
		{	
			$queueJob = (new Going_to_expire_escalate_deadline())->delay(Carbon::now()->addSeconds(5));
			dispatch($queueJob);
			$cc_cron_log->updateLog($cron_logid);
        }
        catch(\Illuminate\Database\QueryException $ex)
		{
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
	 /*   $dt = date('Y-m-d', strtotime('+2 days'));
	   $companies = CompanyProfile::select('id')->where('status',config('constant.ACTIVE'))->get();
		if(count($companies)>0)
		{
			foreach($companies as $company)
			{
			$cmpny_id = $company->id;
			$set_crm_source = Helpers::get_company_meta('set_crm_source',$cmpny_id);
	   $status_res = QueryStatus::select('id')->where('is_close',1)->where('cmpny_id',$cmpny_id)->get();
	   $results = Helpdesk::where('escalation_due_date','like','%'.$dt.'%')->where('cmpny_id',$cmpny_id)->whereNotIn('query_status',$status_res)->get();
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
			   $to_data[] = $to; */
			   /*$reporting_users = cc_user_reporting_relation::select('reporting_user_id')->where('user_id',$to)->where('cmpny_id',$cmpny_id)->get();
			   if(count($reporting_users)>0)
			   { 
				   foreach($reporting_users as $rusers)
				   {
					   $reporting[] = $rusers->reporting_user_id;
				   }
				   
			   }*/
	/* 		   
		   }
	   }
	  // echo "<pre>";print_r($reporting);
	   $to_data = array_unique($to_data);
	 //  $reporting = array_unique($reporting);//echo "<pre>";print_r($reporting);
	   if(count($to_data)>0)
	   {
		   foreach($to_data as $to)
		   {
			   echo $to.'<br>';
			   $details = User::select('phone','email','name')->where('cmpny_id',$cmpny_id)->find($to);
			   $phone = $details->phone;
			   $email = $details->email;
			   $name = $details->name;
			   $docketsresults = Helpdesk::select('docket_number','id')->where('escalation_due_date','like','%'.$dt.'%')->whereNotIn('query_status',$status_res)->where('escalate',$to)->where('cmpny_id',$cmpny_id)->get();
			   if(count($docketsresults)>0)
			   {
				   foreach($docketsresults as $docket)
				   {
					   $dockets .= $docket->id.',';
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
	   } */
	   
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
					   $docketsresults = Helpdesk::select('docket_number')->where('escalation_due_date','like','%'.$dt.'%')->whereNotIn('query_status',$status_res)->where('escalate',$userid->user_id)->where('cmpny_id',$cmpny_id)->get();
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
		/* 	}
		} */
   }
   /**
    * escalated deadline expired
    * @author RINKU.E.B
    * @date 19/09/2018
    * @return 
   */
 
   public function escalate_deadline_expired()
   {
	    $cc_cron_log    = new CronLog;
        $cron_logid           = $cc_cron_log->createLog('escalate_deadline_expired');
        try
		{	
			$queueJob = (new Escalate_deadline_expired())->delay(Carbon::now()->addSeconds(5));
			dispatch($queueJob);
			$cc_cron_log->updateLog($cron_logid);
        }
        catch(\Illuminate\Database\QueryException $ex)
		{
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
	   /* $dt = date('Y-m-d');
	    $companies = CompanyProfile::select('id')->where('status',config('constant.ACTIVE'))->get();
		if(count($companies)>0)
		{
			foreach($companies as $company)
			{
			$cmpny_id = $company->id;
			$set_crm_source = Helpers::get_company_meta('set_crm_source',$cmpny_id);
	   $status_res = QueryStatus::select('id')->where('is_close',1)->where('cmpny_id',$cmpny_id)->get();
	   $results = Helpdesk::where('escalation_due_date','like','%'.$dt.'%')->whereNotIn('query_status',$status_res)->where('cmpny_id',$cmpny_id)->get();
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
			   $to_data[] = $to; */
			  /* $reporting_users = cc_user_reporting_relation::select('reporting_user_id')->where('user_id',$to)->where('cmpny_id',$cmpny_id)->get();
			   if(count($reporting_users)>0)
			   { 
				   foreach($reporting_users as $rusers)
				   {
					   $reporting[] = $rusers->reporting_user_id;
				   }
				   
			   }*/
			   
		  /*  }
	   }
	  // echo "<pre>";print_r($reporting);
	   $to_data = array_unique($to_data);
	//   $reporting = array_unique($reporting);//echo "<pre>";print_r($reporting);
	   if(count($to_data)>0)
	   {
		   foreach($to_data as $to)
		   {
			   echo $to.'--';
			   $details = User::select('phone','email','name')->where('cmpny_id',$cmpny_id)->find($to);
			   $phone = $details->phone;
			   $email = $details->email;
			   $name = $details->name;
			   $docketsresults = Helpdesk::select('docket_number','id')->where('escalation_due_date','like','%'.$dt.'%')->whereNotIn('query_status',$status_res)->where('escalate',$to)->where('cmpny_id',$cmpny_id)->get();
			   if(count($docketsresults)>0)
			   {
				   foreach($docketsresults as $docket)
				   {
					   $dockets .= $docket->id.',';
				   }
				   $dockets = rtrim($dockets,',');
				   echo $dockets.'<br>';
				   
				   // MAIL FOR PARTICULAR AGENT WITH CONSOLIDATED DOCKET NUMBERS STARTS
				   $esc_expired_mail = Helpers::get_company_meta('esc_expired_mail',$cmpny_id);
				   if(!empty($esc_expired_mail))
				   {
										   
				   $contents = Templates::find($esc_expired_mail);
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
				   $esc_expired_sms = Helpers::get_company_meta('esc_expired_sms',$cmpny_id);
				   if(!empty($esc_expired_sms))
				   {
										   
				   $contents2 = Templates::find($esc_expired_sms);
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
	    */
	   /*if(count($reporting)>0)
	   {
		   foreach($reporting as $report)
		   { echo 'sup-'.$report.'<br>';
			   $details1 = User::select('phone','email','name')->where('cmpny_id',$cmpny_id)->find($report);
			   $phone1 = $details1->phone;
			   $email1 = $details1->email;
			   $name1 = $details1->name;
			   $userids = cc_user_reporting_relation::select('user_id')->where('cmpny_id',$cmpny_id)->where('reporting_user_id',$report)->get();
			   if(count($userids)>0)
			   {	$table = '';$str = '';
		       $table .= "<table border='1' style='border:1px solid #ddd;text-align:center;border-spacing: 0px;' width='100%'><tr><th>Agent Name</th><th>Pending Docket Numbers</th></tr>";
				   foreach($userids as $userid)
				   {
					  // echo $userid->user_id.'<br>';
					   $docketsresults = Helpdesk::select('docket_number')->where('escalation_due_date','like','%'.$dt.'%')->whereNotIn('query_status',$status_res)->where('escalate',$userid->user_id)->where('cmpny_id',$cmpny_id)->get();
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
				   $perms = Intimations::where('user_id',$report)->where('channel',config('constant.INTIMATION_SMS'))->where('time_interval',config('constant.INTIMATION_SUPERIOR'))->where('cmpny_id',$cmpny_id)->first();
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
		/* 	}
		} */
   }
   
      public function get_daily_employee_work_intimations()
   {
		$cc_cron_log    = new CronLog;
        $cron_logid           = $cc_cron_log->createLog('get_daily_employee_work_intimations');
        try
		{	
			$queueJob = (new Get_daily_employee_work_intimations())->delay(Carbon::now()->addSeconds(5));
			dispatch($queueJob);
			$cc_cron_log->updateLog($cron_logid);
        }
        catch(\Illuminate\Database\QueryException $ex)
		{
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
    } 
    
    public function get_monthly_employee_work_intimations()
   {
		$cc_cron_log    = new CronLog;
        $cron_logid           = $cc_cron_log->createLog('get_monthly_employee_work_intimations');
        try
		{	
			$queueJob = (new Get_monthly_employee_work_intimations())->delay(Carbon::now()->addSeconds(5));
			dispatch($queueJob);
			$cc_cron_log->updateLog($cron_logid);
        }
        catch(\Illuminate\Database\QueryException $ex)
		{
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
    }    
	

	
	
}