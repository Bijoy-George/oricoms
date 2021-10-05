<?php

namespace App\Http\Controllers;

use App\AutomatedProcess;
use App\AutomatedProcessBatch;
use App\AutomatedProcessBatchExpiry;
use App\AutomatedProcessLog;
use App\AutomatedProcessRelations;
use App\AutomatedProcessCustomer;
use App\AutomatedProcessBatchCustomer;
use App\AutomatedProcessBatchExpiryCustomer;
use App\AutomatedProcessLogCustomer;
use App\AutomatedProcessRelationsCustomer;
use App\BatchProcess;
use App\CmpSubscriptions;
use App\CommonSmsEmail;
use App\CompanyProfile;
use App\CronLog;
use App\FeedbackRequest;
use App\Helpers;
use App\Jobs\AutomatedProcessAction;
use App\Jobs\AutomatedProcessBatching;
use App\Jobs\AutomatedProcessExpiry;
use App\Jobs\AutomatedProcessExpiryBatching;
use App\Jobs\AutomatedProcessActionCustomer;
use App\Jobs\AutomatedProcessBatchingCustomer;
use App\Jobs\AutomatedProcessExpiryCustomer;
use App\Jobs\AutomatedProcessExpiryBatchingCustomer;
use App\Jobs\CampaignPushMessages;
use App\Jobs\FbReportExport;
use App\Jobs\GroupLeadsBatchImport;
use App\Jobs\Outboundcalls_batchwise_insertion;
use App\Jobs\ProcessCampaignAutodialBatches;
use App\Jobs\ProcessCampaignEmailBatches;
use App\Jobs\ProcessCampaignManualCallBatches;
use App\Jobs\ProcessCampaignPushBatches;
use App\Jobs\ProcessCampaignSmsBatches;
use App\Jobs\ReassignCampaignContacts;
use App\Jobs\SendEmail;
use App\Jobs\SendSMS;
use App\Jobs\SendingFeedbackNotification;
use App\Jobs\SubscriptionExpirationStatusUpdation;
use App\Jobs\Get_daily_employee_work_intimations;
use App\Jobs\Get_monthly_employee_work_intimations;
use App\Jobs\Test_job;
use Auth;
use Carbon\Carbon;
use CommunicationHelper;
use Illuminate\Http\Request;
 /**
    * Cron  Controller
    * @author Reshma Rajan
    * @date 12/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return 
   */ 

class CronController extends Controller
{
     public function __construct() {
		date_default_timezone_set("Asia/Kolkata");
                header('Access-Control-Allow-Origin: *');
                ini_set('memory_limit', '-1');
	}
	
	/**
        * Function for Sending feedback
        * @author Reshma rajan
        * @date 12/11/2018
        * @since version 1.0.0
    */
    public function sending_feedback_notification()
    {

        $cron_log    = new CronLog;
        $cron_logid           = $cron_log->createLog('sending_feedback_notification');
        try{
	        $cur_date=date('Y-m-d H:i');
	        $fb_det=FeedbackRequest::where('status',config('constant.INACTIVE'))
	        //->where('action_time','like', '%'.$cur_date.'%')
	        ->get();
			if(count($fb_det) > 0)
	        {
	            $queueJob = (new SendingFeedbackNotification());
	                        dispatch($queueJob);

			}
			$cron_log->updateLog($cron_logid);
        }
        catch(\Illuminate\Database\QueryException $ex){
                    $error      = $ex->getMessage();
                    $cron_log->updateLog($cron_logid,$error);
        }
	
	
	}
	
	
		
	/**
    * @author RINKU.E.B.
    * @date 12/11/2018
    * @since version 1.0.0
    * AUTOMATED PROCESS FOR EXPIRY
    */ 
	public function automated_process_expiry()
	{
		//Helpers::auto_process_params_customer(2,2,1);die;
		//Helpers::auto_process_updation(2,1,1,$flag=null);die;
		//Helpers::auto_process_action(2,1,1,1);die;
		//Helpers::initial_stage_department(2,1);die;
		 /*$data['cmpny_id'] = 2;
			$data['communication_type'] = 3;
			$data['email'] = 'rinku.eb@orisys.in';
			$data['cc_emails'] = array('rinku.eb@orisys.in');
			$data['subject'] = "Test";
			$data['content'] = "Demos";
			$transport = (new \Swift_SmtpTransport('smtp.sendgrid.net', 587))->setUsername('oricoms')
          ->setPassword('orisys@1a');
			$mailer = new \Swift_Mailer($transport);
		$message = (new \Swift_Message($data['subject']))
				  ->setFrom('oricomscrm@gmail.com')
				  ->setTo($data['email'])
				  ->setCc($data['cc_emails'])
				  ->setBody('test message.....')
				  ->addPart($data['content'],"text/html");
				  $result = $mailer->send($message);
				  die;*/
		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('automated_process_expiry');
		try {	
                $queueJob = (new AutomatedProcessExpiry())->delay(Carbon::now()->addSeconds(10));
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
		/*$batch = AutomatedProcessBatchExpiry::limit(5)->get();
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
			
		}*/
		
	}
	
	/**
    * @author RINKU.E.B.
    * @date 12/11/2018
    * @since version 1.0.0
    * AUTOMATED PROCESS FOR ACTION(send sms/email/call)
    */ 
	public function automated_process_action()
	{
		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('automated_process_action');
		try {	
                $queueJob = (new AutomatedProcessAction())->delay(Carbon::now()->addSeconds(10));
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
		/*$batch = AutomatedProcessBatch::limit(3)->get();
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
			
			}*/
			
	}
	
		/**
    * @author RINKU.E.B.
    * @date 12/11/2018
    * @since version 1.0.0
    * AUTOMATED PROCESS BATCHING ACTION FOR CUSTOMERS
    */
	public function automated_process_batching()
	{
		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('automated_process_batching');
		try {	
                $queueJob = (new AutomatedProcessBatching())->delay(Carbon::now()->addSeconds(10));
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }
		/*$companies = CompanyProfile::select('id')->where('status',config('constant.ACTIVE'))->get();
		if(count($companies)>0)
		{
		foreach($companies as $company)
		{
		$cmpny_id = $company->id;
		$results = AutomatedProcessRelations::select('id')->where('action_time',date('Y-m-d H:i').':00')->where('cmpny_id',$cmpny_id)->first();
		if($results)
		{	
			AutomatedProcessBatch::Create([
									'last_relation_id' => 0,
									'cmpny_id' => $cmpny_id,
									'action_time' => date('Y-m-d H:i').':00',
									'created_at' => date('Y-m-d H:i:s'),
									]);
		}
		}
		}*/
            
	}
	
		/**
    * @author RINKU.E.B.
    * @date 12/11/2018
    * @since version 1.0.0
    * AUTOMATED PROCESS BATCHING EXPIRY ACTION FOR CUSTOMERS
    */
	public function automated_process_expiry_batching()
	{	
		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('automated_process_expiry_batching');
		try {	
                $queueJob = (new AutomatedProcessExpiryBatching())->delay(Carbon::now()->addSeconds(10));
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }
		/*$companies = CompanyProfile::select('id')->where('status',config('constant.ACTIVE'))->get();
		if(count($companies)>0)
		{
		foreach($companies as $company)
		{
		$cmpny_id = $company->id;
				$results = AutomatedProcessRelations::select('id')->where('action_expiry_time',date('Y-m-d H:i').':00')->where('cmpny_id',$cmpny_id)->first();
				if($results)
				{
				
				AutomatedProcessBatchExpiry::Create([
											'last_relation_id' => 0,
											'cmpny_id' => $cmpny_id,
											'action_expiry_time' => date('Y-m-d H:i').':00',
											'created_at' => date('Y-m-d H:i:s'),
											]);	

				}
		}
		}*/
			
	}

	/**
    * @author RAHUL R.
    * @date 13/11/2018
    * @since version 1.0.0
    * GROUP CUSTOMER BATCH IMPORT
    */
	public function group_customer_batch_import()
	{
	     		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('group_customer_batch_import');
		try{	
                $queueJob = (new GroupLeadsBatchImport());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
	
	}

	/**
    * @author RAHUL R.
    * @date 13/11/2018
    * @since version 1.0.0
    * REASSIGN CAMPAIGN CONTACTS
    */
	public function reassign_campaign_contacts()
	{
	     		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('reassign_campaign_contacts');
		try{	
                $queueJob = (new ReassignCampaignContacts());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
	
	}

	/**
    * @author Reshma Rajan
    * @date 16/11/2018
    * @since version 1.0.0
    * Cron for feedback report batchwise excel export
    */
	public function export_fb_report()
	{
		$cron_log    = new CronLog;
        $cron_logid           = $cron_log->createLog('export_fb_report');
		try{	
	          
              $batch_results = BatchProcess::select('id','searched_criteria','processed_count')
                        ->where('process_type',config('constant.BP_FB_REPORT'))->where('status',config('constant.INACTIVE'))->count();
					if($batch_results >0)
					{
                        $queueJob = (new FbReportExport());
                        dispatch($queueJob);
					}
				 $cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                       // dd($error);
                         $cron_log->updateLog($cron_logid,$error);
            }	
	
	}

	/**
    * @author RAHUL R.
    * @date 13/11/2018
    * @since version 1.0.0
    * GROUP CUSTOMER BATCH IMPORT
    */
	public function process_campaign_email_batches()
	{
	     		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('process_campaign_email_batches');
		try{	
                $queueJob = (new ProcessCampaignEmailBatches());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
	
	}
	
	/**
    * @author RINKU.E.B.
    * @date 21/11/2018
    * @since version 1.0.0
    * save into common_sms_email from campaign batches
    */
	public function process_campaign_sms_batches()
	{
	     		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('process_campaign_sms_batches');
		try{	
                $queueJob = (new ProcessCampaignSmsBatches());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
	
	}
	
	/**
    * @author RINKU.E.B.
    * @date 24/11/2018
    * @since version 1.0.0
    * save into common_sms_email from campaign batches
    */
	public function process_campaign_autodial_batches()
	{
	     		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('process_campaign_autodial_batches');
		try{	
                $queueJob = (new ProcessCampaignAutodialBatches());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
	
	}
	/**
    * @author RINKU.E.B.
    * @date 24/11/2018
    * @since version 1.0.0
    * save into common_sms_email from campaign batches
    */
	public function process_campaign_push_batches()
	{
	     		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('process_campaign_push_batches');
		try{	
                $queueJob = (new ProcessCampaignPushBatches());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
	
	}
	
	/**
    * @author RINKU.E.B.
    * @date 26/11/2018
    * @since version 1.0.0
    * save into common_sms_email from campaign batches
    */
	public function process_campaign_manual_call_batches()
	{
	     		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('process_campaign_manual_call_batches');
		try{	
                $queueJob = (new ProcessCampaignManualCallBatches());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
	
	}
	
	/*
	 * @author     		RINKU.E.B
     * @since           Version 1.0
     * Date:            21/11/2018 
     * Description:     Autodial API PULL by PBX
	*/
    public function autodial_schedules()
    {	
		$result = CommonSmsEmail::select('id', 'customer_id','contact_id', 'batch_id','sent_type','autodial_schedule_id','mobile','mail_ref_id','follow_id','cmpny_id')
				->where('sent_type', '=' , config('constant.CH_AUTODIAL'))
				->where('status',config('constant.INACTIVE'))
				->whereNotNull('mobile')
				->limit(25)
				->get();
        if(count($result) > 0){
			foreach ($result as $value)
			{
            $contact_id=$value->contact_id;

            $customer_id=$value->customer_id;
            $type=$value->sent_type; 
            $id=$value->id;
                    $schedule_id=$value->autodial_schedule_id;
                    $mobile=$value->mobile;
                    $mail_ref_id=$value->mail_ref_id;
                    $batch_id = $value->batch_id;
                    $follow_id = $value->follow_id;
					$cmpny_id = $value->cmpny_id;

                            $results[] =  array('mobile' => $mobile, 'contactlist_id' => $contact_id, 'profile_id' => $customer_id, 'autodial_schedule_id' => $schedule_id, 'mail_ref_id' => $mail_ref_id, 'batch_id' => $batch_id, 'follow_id' => $follow_id);
                            $arr=array('status'=>config('constant.ACTIVE'));
                            CommonSmsEmail::where('id',$id)->limit(1)->update($arr);

			}

            $data 	= array('status'=>config('constant.API_ACTIVE'),'results'=>$results); 
            return json_encode($data);

        }

    }
	
	/**
    * @author RINKU.E.B.
    * @date 27/11/2018
    * @since version 1.0.0
    * push from common_sms_email table
    */
	public function campaign_push_messages()
	{
	     		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('campaign_push_messages');
		try{	
                $queueJob = (new CampaignPushMessages());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
	
	}

	/**
    * @author RAHUL R.
    * @date 07/12/2018
    * @since version 1.0.0
    * send email from common_sms_email table
    */
	public function send_email()
	{ 
	    $cron_log    = new CronLog;
		$cron_logid           = $cron_log->createLog('send_email');
		try{	
                $queueJob = (new SendEmail())->delay(Carbon::now()->addSeconds(10))->onConnection('email')->onQueue('email');
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }
	
	}
	
	/**
    * @author RINKU.E.B.
    * @date 27/11/2018
    * @since version 1.0.0
    * send sms from common_sms_email table
    */
	public function send_sms()
	{ 
	     		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('send_sms');
		try{	
                $queueJob = (new SendSMS())->delay(Carbon::now()->addSeconds(10))->onConnection('sms')->onQueue('sms');
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
	
	}
	/**
    * @author AKHIL MURUKAN
    * @date 06/12/2018
    * @since version 1.0.0
    * outboundcalls batchwise insertion
    */
	function outboundcalls_batchwise_insertion()
    {
		try{	
		$cc_cron_log    = new CronLog;
                $cron_logid           = $cc_cron_log->createLog('outboundcalls_batchwise_insertion');

                $queueJob = (new Outboundcalls_batchwise_insertion());
                dispatch($queueJob);

		$cc_cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cc_cron_log->updateLog($cron_logid,$error);
            }
	
	}
	
	
	/**
    * @author Elavarasi S
    * @date 06/12/2018
    * @since version 1.0.0
    * send sms from common_sms_email table
    */
	public function send_test_email()
	{ 
	   // $res = CommunicationHelper::getCmpChannel('hi'); exit;

	     		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('cron');
		try{	
                $queueJob = (new SendEmail());
                dispatch($queueJob);

				$queueJob = (new Test_job());
                dispatch($queueJob);

                $queueJob = (new Test_job())->onConnection('email')->onQueue('email');
                dispatch($queueJob);

                $queueJob = (new Test_job())->onConnection('sms')->onQueue('sms');
                
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
	
	}
	
	/**
        * Function for status upadtion on expiry
        * @author PRANEESHA KP
        * @date 24/12/2018
        * @since version 1.0.0
    */
    public function expiration_status_updation()
    {
		$cron_log    = new CronLog;
        $cron_logid  = $cron_log->createLog('expiration_status_updation');
		try{
	        $cur_date		 = date('Y-m-d H:i');
			$expired_sbcrptn = CmpSubscriptions::where('extended_expiry_date','like','%'.$cur_date.'%') 
									->get();
			if(count($expired_sbcrptn) > 0)
	        {
	            $queueJob = (new SubscriptionExpirationStatusUpdation());
	                        dispatch($queueJob);

			}
			$cron_log->updateLog($cron_logid);
        }
        catch(\Illuminate\Database\QueryException $ex){
			$error       = $ex->getMessage();
            $cron_log->updateLog($cron_logid,$error);
        }
	}
	
	
	/**
    * @author RINKU.E.B.
    * @date 12/11/2018
    * @since version 1.0.0
    * AUTOMATED PROCESS FOR EXPIRY
    */ 
	public function automated_process_expiry_customer()
	{
		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('automated_process_expiry_customer');
		try {	
                $queueJob = (new AutomatedProcessExpiryCustomer());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
			
	}
	
	/**
    * @author RINKU.E.B.
    * @date 12/11/2018
    * @since version 1.0.0
    * AUTOMATED PROCESS FOR ACTION(send sms/email/call)
    */ 
	public function automated_process_action_customer()
	{
		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('automated_process_action_customer');
		try {	
                $queueJob = (new AutomatedProcessActionCustomer());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }	
			
	}
	
		/**
    * @author RINKU.E.B.
    * @date 12/11/2018
    * @since version 1.0.0
    * AUTOMATED PROCESS BATCHING ACTION FOR CUSTOMERS
    */
	public function automated_process_batching_customer()
	{
		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('automated_process_batching_customer');
		try {	
                $queueJob = (new AutomatedProcessBatchingCustomer());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }
            
	}
	
		/**
    * @author RINKU.E.B.
    * @date 12/11/2018
    * @since version 1.0.0
    * AUTOMATED PROCESS BATCHING EXPIRY ACTION FOR CUSTOMERS
    */
	public function automated_process_expiry_batching_customer()
	{	
		$cron_log    = new CronLog;
				$cron_logid           = $cron_log->createLog('automated_process_expiry_batching_customer');
		try {	
                $queueJob = (new AutomatedProcessExpiryBatchingCustomer());
                dispatch($queueJob);
				$cron_log->updateLog($cron_logid);
            }
            catch(\Illuminate\Database\QueryException $ex){
                        $error      = $ex->getMessage();
                        $cron_log->updateLog($cron_logid,$error);
            }
			
	}
		/**
   
    * @date 30/04/2020
    * @since version 1.0.0
    * GET DAILY WORK INTIMATION
    */
	
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
	
		/**
   
     * @date 30/04/2020
    * @since version 1.0.0
    * GET MONTHLY WORK INTIMATION
    */
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
