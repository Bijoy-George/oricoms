<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Auth;
use App\ApiCallLog;
use App\CustomerProfile;
use App\LeadSources;
use App\ChatThread;
use App\UserRole;
use App\ChatThreadLog;
use App\CompanyProfile;
use App\ChatFeedbackCount;
use App\Jobs\ChatReportExportJob; 
use App\Exports\ChatExport;
use Maatwebsite\Excel\Facades\Excel;
use App\AutoReplyCategory;
use App\AutoReply;
use App\FaqCategories;
use App\Faq;
use App\Helpers;
use App\Templates;
use App\CronLog;
use App\CommonSmsEmail;

class ApiChat extends Controller
{
    public function __construct() {
		
        header('Access-Control-Allow-Origin: *');
		date_default_timezone_set("Asia/Kolkata");
	}
	
	/**
     * @Chat API
     * @author Loraine Varghese
     * @date 12-10-2018
     * @since version 1.0.0
    */
	function chat_api(Request $request)
    {
		$ori_api_call_logs    = 	new ApiCallLog;
		$apilogid             = 	$ori_api_call_logs->createLog($request);
		try
		{
			$response 			 =  $request->all();
			$authentication 	 = 	request('authentication_key');
			$first_name 		 = 	request('first_name');
			$email 				 = 	request('email');
			$customer_id 		 = 	request('customer_id');
			$mobile_number       =  request('mobile_number');
			$mobile_country_code =  request('country_code');
			$agent_chat_name     =  '';
			$agent_name          =  '';
			$lead_source_id      =  '';
			$source_key_present  = LeadSources::where('source_key',$authentication)
												->where('status',config('constant.ACTIVE'))
												->first();
			if(isset($source_key_present) && !empty($source_key_present))
			{
				$lead_source_id = $source_key_present->id;
				$cmpny_id       = $source_key_present->cmpny_id;
				$cmpny_profile = CompanyProfile::where('id',$cmpny_id)
												->first();
				if(isset($cmpny_profile) && !empty($cmpny_profile))
				{
					$cmpny_plan = $cmpny_profile->ori_cmp_org_plan;
				}
				else
				{
					$cmpny_plan = 0;
				}
		
				$chatagent_roleid_result = UserRole::where('role','Chat-Agent')
											->where('cmpny_id',$cmpny_id)
											->first();
				//print_r($chatagent_roleid_result->id);die;
				
				if($chatagent_roleid_result)
				{
					$chatagent_roleid    = $chatagent_roleid_result->id;
				}
				else
				{
					$chatagent_roleid    = 0;
				}
				/* print_r("company id : ".$cmpny_id)."\n";
				print_r(" chatagent roleid: ".$chatagent_roleid);
				print_r ("\n")*/

				$freeagentcount = User::where('role_id','like','%:"' . $chatagent_roleid . '";%')
									   ->where('cmpny_id',$cmpny_id)
									   ->where('status',1)
									   ->where('logged_in',1)
									   ->where('chat_flag',1);
				$checkforfreeagentcount=$freeagentcount->count();
				//print_r("Chatagent count ".$checkforfreeagentcount);die;
				if($checkforfreeagentcount==1)
				{
					// Single agent is free for live chat
					$random_free_agent = $freeagentcount->first();
					if($random_free_agent)
					{
						$agent_id        = $random_free_agent->id;
						$agent_chat_name = $random_free_agent->chat_name;
						$agent_name      = $random_free_agent->name;
						$agent_username  = $random_free_agent->username;
					}
				}
				else if($checkforfreeagentcount>1)
				{
				  // Multiple agents are free for live chat
				  $random_free_agent = $freeagentcount->orderBy('chat_login_time','asc')
													  ->first();
				  if($random_free_agent)
				  {
					$agent_id        = $random_free_agent->id;
					$agent_chat_name = $random_free_agent->chat_name;
					$agent_name      = $random_free_agent->name;
					$agent_username  = $random_free_agent->username;
				  }
				}
				else if($checkforfreeagentcount==0)
				{
					// No agents are free for live chat
					$busyagentcountUsers = User::select('id','name','email','username','chat_name','phone','current_chat_count','chat_login_time')
											 ->where('role_id','like','%:"' . $chatagent_roleid . '";%')
											 ->where('status','1')
											 ->where('logged_in','1')
											 ->where('chat_flag','0')
											 ->where('cmpny_id',$cmpny_id)
											 ->orderBy('current_chat_count','asc')
											 ->orderBy('chat_login_time','asc')
											 ->first();
					if(isset($busyagentcountUsers) && !empty($busyagentcountUsers))
				    {
						$agent_id        = $busyagentcountUsers->id;
						$agent_chat_name = $busyagentcountUsers->chat_name;
						$agent_name      = $busyagentcountUsers->name;
						$agent_username  = $busyagentcountUsers->username;
				    }
					else
					{
						// No agents have logged in for live chat
						// if no chat agent is online, choose agent with lesser tickets
						
						$fetch_any_agent   = User::select('id','name','email','username','chat_name','phone','current_chat_count','chat_login_time')
											 ->where('role_id','like','%:"' . $chatagent_roleid . '";%')
											 ->where('status','1')
											 ->where('cmpny_id',$cmpny_id)
											 ->orderBy('current_chat_count','asc')
											 ->orderBy('chat_login_time','asc')
											 ->first();
						
						/* $fetch_any_agent    = User::select('cc_admin_users.name', 'cc_admin_users.chat_name', DB::raw("COUNT(*) AS ticket_count"))
                                                       ->leftJoin('cc_tickets', function ($join) {
                                                           $join->on('cc_tickets.agent_id', '=', 'cc_admin_users.id')
                                                               ->where('cc_tickets.ticket_status', '=', 1);
                                                       })
                                                       ->where('cc_admin_users.role_id', config('constant.USER_ROLE_CHAT_AGENT'))
                                                       ->where('cc_admin_users.status', config('constant.ACTIVE'))
                                                       ->groupBy('cc_admin_users.id')
                                                       ->orderBy('ticket_count', 'asc')
                                                       ->orderBy('cc_tickets.ticket_status', 'asc')
                                                       ->first();
						*/
						if(!empty($fetch_any_agent))
						{
							$agent_id        = $fetch_any_agent->id;
							$agent_chat_name = $fetch_any_agent->chat_name;
							$agent_name      = $fetch_any_agent->name;
							$agent_username  = $fetch_any_agent->username;
						} 
					}
				}
				
				if(isset($first_name) && $first_name !='' && isset($mobile_number) && $mobile_number !='' && isset($email) && $email !='')
				{
					$user_email_exist  = CustomerProfile::where('email',$email)->first();					
					$user_mobile_exist = CustomerProfile::where('mobile',$mobile_number)
														->where('country_code',$mobile_country_code)
					                                    ->first();
					if(isset($user_mobile_exist) && !empty($user_mobile_exist)) 
					{
						$thread_result=ChatThread::where('cust_id',$user_mobile_exist->id)
												  ->where('agent_id',$agent_id)
												  ->where('lead_source_id',$lead_source_id)
												  ->where('cmpny_id',$cmpny_id)
												  ->first();
						if(isset($thread_result) && !empty($thread_result))
						{
							$tid=$thread_result->id;
						}
						else
						{
						    $insert_thread_arr['cmpny_id']       = $cmpny_id;
							$insert_thread_arr['cust_id']        = $user_mobile_exist->id;
							$insert_thread_arr['lead_source_id'] = $lead_source_id;
							$insert_thread_arr['agent_id']       = $agent_id;
							$thread_creation = ChatThread::create($insert_thread_arr);
							$tid=$thread_creation->id;
						}
						$result = array('status'=>config('constant.API_EXIST'),'reg_id'=>$user_mobile_exist->id,'message'=>'success','name'=>$user_mobile_exist->first_name,'admin'=>$agent_username,'thread_id'=>$tid,'agent_name'=>$agent_name,'cmpny_id'=>$cmpny_id,'agent_id'=>$agent_id,'cmpny_plan'=>$cmpny_plan);
						$ori_api_call_logs->updateLog($apilogid,$cmpny_id,$result);
						echo json_encode($result);die;
					}
					else if(isset($user_email_exist) && !empty($user_email_exist))
					{
						$thread_result=ChatThread::where('cust_id',$user_email_exist->id)
												  ->where('agent_id',$agent_id)
												  ->where('lead_source_id',$lead_source_id)
												  ->where('cmpny_id',$cmpny_id)
												  ->first();
						if(isset($thread_result) && !empty($thread_result))
						{
							$tid=$thread_result->id;
						}
						else
						{
						    $insert_thread_arr['cmpny_id']       = $cmpny_id;
							$insert_thread_arr['cust_id']        = $user_email_exist->id;
							$insert_thread_arr['lead_source_id'] = $lead_source_id;
							$insert_thread_arr['agent_id']       = $agent_id;
							$thread_creation = ChatThread::create($insert_thread_arr);
							$tid=$thread_creation->id;
						}
						$result = array('status'=>config('constant.API_EXIST'),'reg_id'=>$user_email_exist->id,'message'=>'success','name'=>$user_email_exist->first_name,'admin'=>$agent_username,'thread_id'=>$tid,'agent_name'=>$agent_name,'cmpny_id'=>$cmpny_id,'agent_id'=>$agent_id,'cmpny_plan'=>$cmpny_plan);
						$ori_api_call_logs->updateLog($apilogid,$cmpny_id,$result);
						echo json_encode($result);die;
					}
					else
					{
						$insert_arr = array();
						if(isset($first_name))
						{
							$first_name 	          =	trim($first_name);
							$insert_arr['first_name'] = $first_name;
						}
						if(isset($mobile_number))
						{
							$mobile_number 	            = trim($mobile_number);
							$insert_arr['mobile']       = $mobile_number;
							$insert_arr['country_code'] = $mobile_country_code;
						}
						if(isset($email))
						{
							$email 	             = trim($email);
							$insert_arr['email'] = $email;
						}
						$insert_arr['status']   = config('constant.ACTIVE');
						$insert_arr['source']   = $lead_source_id;
						$insert_arr['cmpny_id'] = $cmpny_id ;
						$insertion              = CustomerProfile::create($insert_arr);
                        $user_id                = $insertion->id;
						
						// Chat thread creation
						$insert_thread_arr['cmpny_id']      = $cmpny_id;
						$insert_thread_arr['cust_id']       = $user_id;
						$insert_thread_arr['agent_id']      = $agent_id;
						$insert_thread_arr['lead_source_id']= $lead_source_id;
						$thread_creation                    = ChatThread::create($insert_thread_arr);
						$thread_id                          = $thread_creation->id;
						
						/////////// AUTOMATED PROCESS CODES STARTS HERE ///////////
						//														 //
						//														 //
						//														 //
						/////////// AUTOMATED PROCESS CODES ENDS HERE /////////////
						
						$result= array('status'=>config('constant.API_ACTIVE'),'reg_id'=>$user_id,'message'=>'success','name'=>$first_name,'admin'=>$agent_username,'thread_id'=>$thread_id,'agent_name'=>$agent_name,'cmpny_id'=>$cmpny_id,'agent_id'=>$agent_id,'cmpny_plan'=>$cmpny_plan);
                        $ori_api_call_logs->updateLog($apilogid,$cmpny_id,$result);
                        echo json_encode($result);die;
					}
				}
			}
			else
			{
				$result= array('status'=>'AUTH_FAILURE');
				$ori_api_call_logs->updateLog($apilogid,$cmpny_id,$result);
				echo json_encode($result);die;
			}
		}
		catch(\Illuminate\Database\QueryException $ex)
		{
			$error      = $ex->getMessage();
			$data       = array('status'=>'DB_ERROR');
			$ori_api_call_logs->updateLog($apilogid,$cmpny_id,$data,$error);
			return $data;
		}
	}
	
	/**
      * Update chat login time of the assigned agent when
      * the clients logs in
      * @author Loraine Varghese
      * @date 12/10/2018
      * @since version 1.0.0
      * @param NULL
      * @return
     */
	function update_chat_time(Request $request)
	{
		$agent_id=request('agent_username');
		$cmpny_id=request('cmpny_id');
        $current_date=date('Y-m-d H:i:s');
        $update_agent_chat_login_time=User::where('username',$agent_id)
										   ->where('cmpny_id',$cmpny_id)
                                           ->update(['chat_login_time'=>$current_date]);
        $result = array('status'=>$update_agent_chat_login_time);
        echo json_encode($result);die;
	}
	
	/**
	  * @Chat API - saving chat
	  * @author Loraine Varghese
	  * @date 15-10-2018
	  * @since version 1.0.0
	 */
	function send_message()
	{
		$thread_id=request('thread_id');
		$client_id=request('client_id');
		$agent_id=strtolower(request('agent_id'));
		$msg_src=request('msg_src');
		$current_date=date('Y-m-d H:i:s');
		/* $update_agent=cc_chat_thread::where(['id'=>$thread_id])->where(['agent_id'=>NULL])->update(['agent_id'=>$agent_id]); */
		$message=request('message');
		$cmpny_id=request('cmpny_id');
		/* print_r($thread_id . ", ".$client_id.", ".$agent_id." and ".$message. " and cmpny_id ".$cmpny_id);die; */
		$arr= array($client_id,$agent_id);
		$is_first_message=request('isFirstMessage');
		if($is_first_message==1 && $msg_src!="INCOMING")
		{
			$agent_current_chat_count=User::select('current_chat_count')
										   ->where('username',$agent_id)
										   ->first();
			$count = $agent_current_chat_count->current_chat_count+1;
			$update_current_chat_count=User::where('username',$agent_id)
										   ->update(['current_chat_count'=>$count,'chat_flag'=>'0']);
		}
		$threadId =$thread_id;
        $insert_msg_arr['thread_id']=$threadId;
		$insert_msg_arr['cmpny_id']=$cmpny_id;
		if($msg_src=="INCOMING")
		{
			$update_agent_chat_login_time=User::where('username',$client_id)->update(['chat_login_time'=>$current_date]);
			$agent_current_chat_count=User::select('id')
										   ->where('username',$client_id)
										   ->first();
			$insert_msg_arr['chat_from']=$agent_current_chat_count->id;
			$insert_msg_arr['chat_to']=strtolower($agent_id);
			$insert_msg_arr['chat_from_type']=2;
		}
		else
		{
			$update_agent_chat_login_time=User::where('username',$agent_id)->update(['chat_login_time'=>$current_date]);
			$insert_msg_arr['chat_from']=strtolower($client_id);
			$agent_current_chat_count=User::select('id')
										   ->where('username',$agent_id)
										   ->first();
			$insert_msg_arr['chat_to']=$agent_current_chat_count->id;
			$insert_msg_arr['chat_from_type']=1;
		}
        $insert_msg_arr['chat_body']=$message;
        $create_new_thread = ChatThreadLog::create($insert_msg_arr);
        $result_arr= array('thread_id'=>$threadId,'chat_time'=>$current_date);
        echo json_encode($result_arr);die;
	}
	
	/**
	  * Update current no. of users assigned to agent for chatting
	  * @author Loraine Varghese
	  * @date 15/10/2018
	  * @since version 1.0.0
	  * @param NULL
	  * @return
     */
	function update_chat_count(Request $request)
	{
		$agent_username=request('agent_username');
		$cmpny_id = request('cmpny_id');
        $agent_current_chat_count=User::select('current_chat_count','chat_flag','logged_in')
                                                ->where('username',$agent_username)
                                                ->where('cmpny_id',$cmpny_id)
                                                ->first();
		if(isset($agent_current_chat_count) && !empty($agent_current_chat_count))
		{
			$chat_flag = $agent_current_chat_count->chat_flag;
			$current_count = $agent_current_chat_count->current_chat_count;
			if($current_count>0)
			{
			  $count = $agent_current_chat_count->current_chat_count-1;
			}
			else {
			  $count = $current_count;
			}

			if($count==0)
			{
			  $update_chat_count=User::where('username',$agent_username)
									->update(['current_chat_count'=>$count,'chat_flag'=>'1']);
			}
			else {
			  $update_chat_count=User::where('username',$agent_username)
									->update(['current_chat_count'=>$count]);
			}
			$result = array('status'=>$update_chat_count);
		}
		else
		{
			$result = array('status'=>0);
		}
        echo json_encode($result);die;
	}
	
	/**
     * @author Loraine varghese
     * @date 12/11/2018
     * @since version 2.0.0
	 * Replacing the registration id (Ex: 22@localhost) with user name on chat roster
    */
    public function push_customer_name(Request $request)
    {
        $result= array('status'=>config('constant.API_INACTIVE'),'reg_id'=>'','name'=>'');
        $response = $request->all();
        if(isset($response) && !empty($response))
		{
            if(isset($response['reg_id']) && !empty($response['reg_id']))
			{
                $customer_bid_id=$response['reg_id'];
				$customer_id=explode('@',$customer_bid_id);
				$cus_id=$customer_id[0];
                $user_details = CustomerProfile::where('id', $cus_id)->first();
				if(isset($user_details->id) && !empty($user_details->id))
				{
                    $cust_id = $user_details->id;
                    $name = $user_details->first_name;
                    $cmpny_id = $user_details->cmpny_id;
                    $result= array('status'=>config('constant.API_ACTIVE'),'reg_id'=>$cust_id,'message'=>'','name'=>$name,'cmpny_id'=>$cmpny_id);
                } 
			}
        }
       return  $result;
    }

	/**
	* checking for the entered keyword whether it starts with the required text
	* @author Loraine Varghese
	* @date 18-01-2019
	* @since version 1.0.0
	*/
    public function startsWithCheck($string=null, $startString=null) 
  	{ 
    	$len = strlen($startString); 
    	return (substr($string, 0, $len) === $startString); 
 	} 

	/**
	* @Chat API - Sending chat history via mail after closing chat
	* @author Loraine Varghese
	* @date 1-6-2018
	* @since version 1.0.0
	*/
	function chat_transcript(Request $request)
	{
		$buffer="notsent";
		try
		{
			$customer_id=request('customer_id');
			$agent_id=request('agent_id');
			$cmpny_id=request('cmpny_id');
			$thread_id=request('thread_id');
			$chat_date  = date('Y-m-d');

			$customer_details = CustomerProfile::where('id',$customer_id)
			                    ->where('cmpny_id',$cmpny_id)
			                    ->first();
			if(isset($customer_details) && !empty($customer_details))
			{
				$name = $customer_details->first_name;
				$email = $customer_details->email;
			}

			$chat_date_create = date_create($chat_date);
			date_sub($chat_date_create,date_interval_create_from_date_string("24 hours"));
			$chat_start_date = date_format($chat_date_create,'Y-m-d');

			$chat_history=ChatThreadLog::with('ChatThread.LeadSource', 'ChatThread.Customer', 'ChatThread.Agent')
										->where('thread_id',$thread_id)
										->where('created_at','>=',$chat_date." 00:00:00")
										->where('created_at','<=',$chat_date." 23:59:59")
										->orderBy('id','desc')->get();

			$get_chattranscript_template_id = Helpers::get_company_meta('chat_transcript_mail',$cmpny_id);
			$template_data = Templates::where('id',$get_chattranscript_template_id)
									->where('cmpny_id',$cmpny_id)->first();
			if(isset($template_data)  && !empty($template_data))
			{
				$content = $template_data->content;
				$bodycontent="<div>";
				$current_date=date('d-m-Y');

				if(isset($chat_history) && !empty($chat_history))
				{
					foreach($chat_history as $row)
					{
						if($row->chat_from_type==1)
						{
							$from = $row->ChatThread->Customer->first_name;
							$to = $row->ChatThread->Agent->name;
						}
						else
						{
							$to = $row->ChatThread->Customer->first_name;
							$from = $row->ChatThread->Agent->name;
						}
						$message = $row->chat_body;
						if($this->startsWithCheck($row->chat_body,"Sending|"))
                  		{
                    		$explodeMessage = explode("|",$row->chat_body);
                    		$message = $explodeMessage[2];
                    		$message = " has shared the file ";
                    		$message .= "<a target='_blank' href='".url('/uploads/chat_documents')."/".$explodeMessage[1]."'>".$explodeMessage[2]."</a>";
                    	}
						$date = $row->created_at;

						$bodycontent.="<span>".$date." ".$from.": ".$message."</span><br>";
					}
					$bodycontent.="</div>";	
				}
				$subject = $template_data->subject;
				$content = str_replace('[[ First Name ]]', strtoupper($name), $content);
		      	$content = str_replace('[[ content ]]', $bodycontent, $content);
				
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

		      	$result = CommonSmsEmail::Create(
		        [
		        'authentication' => '',
		        'cmpny_id' => $cmpny_id,
		        'email' => $email,
		        'customer_id' => $customer_id,
		        'sent_type'=> config('constant.CH_EMAIL'),
		        'response' => $buffer,
		        'content' => $content,
		        'subject' => $subject,
		        'email_cc' => '',
		        'status' => config('constant.INACTIVE'),
		        'created_at' => $chat_date,
		        ]);

		        return $result->id;
			}
		}
		catch(\Illuminate\Database\QueryException $ex)
        {
            $cc_cron_log    = new CronLog;
            $cron_logid     = $cc_cron_log->createLog('process_campaign_email_batches');
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
	}
	
	/**
    * For chat upload
    * @author Rahul R
    * @date 26/06/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
    function chat_file_upload(Request $request)
    {
        $file = request('file');
        $files_array  = array(
            'status'    => 2, // 1 for success, 2 for failure
            'success'   => array(),
            'error'     => array()
        );
        $allowed_file_types = config('constant.upload_allowed_mime_types');
        $max_upload_size    = config('constant.max_file_upload_size');

        $original_file_name  = $file->getClientOriginalName();
        $file_ext            = strtolower($file->getClientOriginalExtension());
        $new_file_name       = md5(str_random(40).time()).'.'.$file->getClientOriginalExtension();
        $valid_file         = 0;

        do
        {
            if (!array_key_exists($file_ext, $allowed_file_types))
            {
                $files_array['error'] = [
                    'fileName' => $original_file_name,
                    'message'   => "This type of files are not allowed."
                ];
                break;
            }
            if ($file->getMimeType() != $allowed_file_types[$file_ext])
            {
                $files_array['error'] = [
                    'fileName' => $original_file_name,
                    'message'   => "The file type does not match its mime type."
                ];
                break;
            }
            if ($file->getClientSize() > $max_upload_size)
            {
                $max_file_upload_size_mb    = $max_upload_size / (1024 * 1024);
                $max_file_upload_size_mb    = round($max_file_upload_size_mb, 2);
                $files_array['error'] = [
                    'fileName' => $original_file_name,
                    'message'   => "Files with size greater than $max_file_upload_size_mb are not allowed"
                ];
                break;
            }

            $valid_file = 1;
        }
        while(FALSE);

        if ($valid_file)
        {
            $file->move(
                public_path('uploads/chat_documents/'),$new_file_name
            );
			if (file_exists(public_path('/uploads/chat_documents/'.$new_file_name)))
			{
				$files_array['success'] = [
					'originalFileName'  => $original_file_name,
					'savedFileName'     => $new_file_name,
				];
				$files_array['status']  = 1;
			}
			else
			{
				$files_array['error'] = [
                    'fileName' => $original_file_name,
                    'message'   => "The File could not be uploaded."
                ];
			}
        }
        return json_encode($files_array);
    }
	
	/**
     * Function save chat logs
     * @author Rejeesh K.Nair
     * @date 13/12/2017
     * @since version 1.0.0
    */
    function save_chat_logs(Request $request)
	{
		
    }
	
	/**
    * Chat History Section
    * @author Loraine Varghese
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
	public function chat_reports_listing($customerid=null)
	{
		if(isset($customerid) && $customerid !=null)
		{
			$customerid=$customerid;
		}else{
			$customerid=0;
		}
		
		$chat_src_list = LeadSources::with('GetLeadSourceType')
									->where('cmpny_id',Auth::User()->cmpny_id);
									
		$chat_src_list->where(function ($q4) use ($customerid)
		{
			$q4->orWhereHas('GetLeadSourceType', function($q5) use($customerid) 
			{
				$q5->where('source_type','Chat Application');
			});
		}); 
		$chat_src_list = $chat_src_list->get();	
		
									
		$agent_role_list = UserRole::orWhere('role','Chat-Agent')
								->orWhere('role','Agent')
								->where('cmpny_id',Auth::User()->cmpny_id)
								->get();
		
		if(isset($agent_role_list) && !empty($agent_role_list))
		{
			$role_list = $agent_role_list->pluck('id')->all();
		}
		else
		{
			$role_list = 0;
		}

		$agents_list = User::where('cmpny_id',Auth::User()->cmpny_id);

		$agents_list->where(function($q2) use ($role_list){
			foreach ($role_list as $role) 
			{
				$q2->orWhere('role_id','like','%:"' . $role . '";%');
			}
		});
		
		$agent_list = $agents_list->get();

		return view('chat_history_index',compact('customerid','chat_src_list','agent_list'));
	}
	
	/**
    * Search keyword in Chat History Page
    * @author Loraine Varghese
    * @date 15/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
	public function search_list(Request $request)
	{
		$response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
		$customer_id        =   $response['customer_id'];
		$lead_src_id        =   $response['lead_src_list'];
		$agent_id   	    =   $response['agent_list'];
		$start_date   	    =   $response['start_date'];
		$end_date   	    =   $response['end_date'];
		$date_format_sdate  =   explode('/', $start_date);
		$date_format_edate  =   explode('/', $end_date);
		$s_date ='';
		$e_date='';
		
		if(isset($date_format_sdate[2]) && !empty($date_format_sdate[2]) && isset($date_format_sdate[1]) && !empty($date_format_sdate[1]) && isset($date_format_sdate[0]) && !empty($date_format_sdate[0]) )
		{

			$sdate  =   $date_format_sdate[2].'-'.$date_format_sdate[0].'-'.$date_format_sdate[1];
			//$s_date=date("Y-m-d", strtotime($sdate));
			$s_date = $sdate;
		}
		
		if(isset($date_format_edate[2]) && !empty($date_format_edate[2]) && isset($date_format_edate[1]) && !empty($date_format_edate[1]) && isset($date_format_edate[0]) && !empty($date_format_edate[0]) )
		{

			$edate    =   $date_format_edate[2].'-'.$date_format_edate[0].'-'.$date_format_edate[1];
			//e_date=date("Y-m-d", strtotime($edate));
			$e_date = $edate;
		}
        $results = array();	
		if($customer_id != "")
		{
			$results=ChatThreadLog::with('ChatThread.LeadSource', 'ChatThread.Customer', 'ChatThread.Agent')
										->orderBy('id','desc');
										
			if(isset($search_keywords) && !empty($search_keywords)) 
            {
                $results->where('chat_body', 'like', '%' . $search_keywords . '%');
            }
			
			if(isset($lead_src_id) && !empty($lead_src_id))
			{
				$results->where(function ($q1) use ($lead_src_id)
				{
					$q1->orWhereHas('ChatThread', function($q2) use($lead_src_id) 
					{
						$q2->where('lead_source_id', $lead_src_id);
					});
				}); 
			}
			
			if(isset($agent_id) && !empty($agent_id))
			{
				$results->where(function ($q1) use ($agent_id)
				{
					$q1->orWhereHas('ChatThread', function($q2) use($agent_id) 
					{
						$q2->where('agent_id', $agent_id);
					});
				}); 
			}
			
			if(isset($e_date) && !empty($e_date) && ($e_date!='1970-01-01') && isset($s_date) && !empty($s_date) && ($s_date!='1970-01-01'))
			{
				$results->where(function($results) use ($s_date,$e_date)
				{
                    $results->orWhere('created_at', '>=', $s_date . ' 00:00:00');
					$results->where('created_at', '<=', $e_date . ' 23:59:59');
					
                });
			}
			else if(isset($s_date) && !empty($s_date) && ($s_date!='1970-01-01'))
			{
				$results->where(function($results) use ($s_date)
				{
                    $results->orWhere('created_at', '>=', $s_date . ' 00:00:00');
					
                });
			}
	
			$results->where(function ($q4) use ($customer_id)
			{
				$q4->orWhereHas('ChatThread', function($q5) use($customer_id) 
				{
					$q5->where('cust_id', $customer_id);
				});
			}); 
			//$results = $results->get();
			//$results = ChatThread::with(['ChatThreadLogs' => function ($q) { $q->orderBy('id', 'desc'); }])->where('cust_id', $customer_id);
			
			/* $results->where(function ($q2) use ($search_keywords)
			{
				$q2->orWhereHas('ChatThreadLogs', function($q3) use($search_keywords) 
				{
					$q3->where('chat_body', 'like', '%' . $search_keywords . '%');
				});
			});  */
			$list_count = $results->count();
			$results    = $results->paginate(config('constant.pagination_constant'));
			
			$html 		= view('chat_history_listview')
						->with(compact('results','list_count'))->render();
			$result_arr=array('success' => true,'html' => $html);
			return $result_arr;
		}
	}

	public function export_chat_report(Request $request)
	{
		$file_name=request('file_name').str_random(5).'.xlsx';
		$path='/chat_report/'.$file_name;

		//(new ChatExport($request))->store($path);
		$details=array('cmpny_id'=>Auth::user()->cmpny_id,'user_id'=>Auth::user()->id);
		$details['path']=$path;
        $details['file_name']=$file_name;
        
        if(request('customerid'))
        {
            $details['customer_id']=request('customerid');
        }
        if(request('search_keywords'))
        {
            $details['search_keywords']=request('search_keywords');
        }
        if(request('source_type'))
        {
            $details['source_type']=request('source_type');
        }
        if(request('agentid'))
        {
            $details['agentid']=request('agentid');
        }
        if(request('start_date'))
        {
            $details['start_date']=request('start_date');
        }
        if(request('end_date'))
        {
            $details['end_date']=request('end_date');
        }

        // (new ChatExport($details))->store($path);
        (new ChatExport($details))->queue($path)->chain([
            new ChatReportExportJob($details),
        ]);
	}

	function download_chatreport($path_name)
    {
       $path = storage_path('app/chat_report/'.$path_name);
       return response()->download($path);
    }

    function updatecreate_chatfb_count(Request $request)
    {
    	$response = $request->all();
      	$rating = request('rating');
      	$agent_id = request('agent_id');
      	$cur_date = date('Y-m-d');
      	$rating_status = [1 => 'very_bad', 2 => 'bad', 3 => 'average', 4 => 'good', 5 => 'excellent'];
      	//$rating_status = config('constant.FB_RATING');
      	//print_r(config('constant.FB_RATING'));die;
      	foreach($rating_status as $rating_no => $rating_name)
	    {
	    	if($rating_no == $rating)
	    	{
	    		$rating_curr_count = ChatFeedbackCount::select($rating_name)
                              ->where("date","=",$cur_date)
                              ->where("agent_id","=",$agent_id)
                              ->first();
	            if(isset($rating_curr_count) && !empty($rating_curr_count))
	            {
	                // print_r($rating_curr_count->$rating_name);die;
	            	$rating_new_count = $rating_curr_count->$rating_name + 1;
	          	}
          		else 
          		{
            		$rating_curr_count=0;
            		$rating_new_count = $rating_curr_count + 1;
          		}

          		$update_create_count = ChatFeedbackCount::updateOrCreate([
            		'date'=>$cur_date,
            		'agent_id'=>$agent_id,
          		],
          		[
            		$rating_name=>$rating_new_count
          		]);
          		$upid=$update_create_count->id;
          		// print_r($update_create_count->id);die;
          		if(isset($upid) && !empty($upid))
          		{
            		$status=config('constant.API_ACTIVE');
            		$result_arr=array('status'=>$status);
          		}
          		else
          		{
            		$status=config('constant.API_INACTIVE');
            		$result_arr=array('status'=>$status);
          		}
          		echo json_encode($result_arr);die;
	    	}
	    }
    }

    function get_auto_reply_category(Request $request)
    {
    	$response = $request->all();
      	$cmpny_id = request('cmpny_id');
      	$parent_category_id = request('parent_cat');

  		$auto_reply_categories = AutoReplyCategory::where('cmpny_id',$cmpny_id)
  							->where('status',1)
  							->get();
  		$faq_categories = FaqCategories::with('getFaqList')
  							->where('cmpny_id',$cmpny_id)
  							->where('status',1);
  		$faq_categories->where(function ($q1)
		{
			$q1->orWhereHas('getFaqList', function($q2)  
			{
				$q2->where('show_in_chat_auto_reply', 1);
			});
		});
  		$faq_categories=$faq_categories->get();
  		$result = array('auto_reply_cat'=>$auto_reply_categories,'faq_cat'=>$faq_categories);
        echo json_encode($result);die;
    }

    function get_auto_replies(Request $request)
    {
    	$response = $request->all();
      	$cmpny_id = request('cmpny_id');
      	$cat_id   = request('cat_id');

      	$auto_reply = AutoReply::where('cmpny_id',$cmpny_id)
      						->where('auto_reply_category_id',$cat_id)
      						->where('status',1)
  							->get();
  		$result = array('auto_reply'=>$auto_reply);
        echo json_encode($result);die;
    }

    function get_faq_replies(Request $request)
    {
    	$response = $request->all();
      	$cmpny_id = request('cmpny_id');
      	$cat_id   = request('cat_id');

      	$faq_questions_list = Faq::where('cmpny_id',$cmpny_id)
      						->where('faq_cat_id',$cat_id)
      						->where('status',1)
      						->where('show_in_chat_auto_reply',1)
  							->get();
  		$result = array('faq'=>$faq_questions_list);
        echo json_encode($result);die;
    }
}
