<?php

namespace App;
use Auth;
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
use App\CampaignBatch;
use App\Templates;
use App\CommonSmsEmail;
use App\CustomerProfile;
use App\LeadFollowup;
use App\Helpdesk;
use App\QueryTypes;
use App\CompanyMeta;
use App\CompanyChannel;
use App\Channel;
use App\NotificationsList;
use App\NotificationsRolesRelations;
use App\CustomerProfileField;
use Carbon\Carbon;
use App\AutodialSchedules;
use App\Priority;
use App\LeadSourceType;
use App\LeadSources;
use App\LocationOfficerDetail;
use App\Faq;
use App\PusherList;
use App\FaqCategories;
use App\CampaignMeta;
use App\CustomerFcms;
use App\Tab;
use App\QueryStatus;
use App\UserRole;
use App\User;
use App\Permission;
use App\Designations;
use App\SupplyOffices;
use App\ProjectTask;
use App\Project;
use App\Tracker;
use App\ProjectMeta;
use App\CompanyProfile;
use App\Service;
use App\ServerService;
use App\Serverresource;
use DB;
class Helpers
{
	/*static function checkPermission($permissions=''){
        $permis_array = explode('|', $permissions);
        $access_permission = array();
        
        if(isset(Auth::User()->role_id) && !empty(Auth::User()->role_id))
        {
            $role_id = Auth::User()->role_id;
            $role_data = UserRole::where('id',$role_id)->get();
            if(!empty($role_data) && $role_data->count())
            {
                
                foreach ($role_data as $value)
                {
                    
                    if(!empty($value))
                    {
                        $access_permission = unserialize($value->access_permission);
                        foreach ($access_permission as $row)
                        {
                                $access_perm[]=$row['permission_name'];
                        }
                    }
                    if(!empty($permis_array) && !empty($access_perm))
                    {
                        foreach ($permis_array as $permis)
                        {
                             if(in_array($permis, $access_perm)){return true;}
                        }
                    }
                }
            }
        }
        return false;
	} */
	/*
	Fetch all users based on given permission
	Author: Elavarasi S
	Date: 24-01-2019
	*/
	static function getUserByPermission($permissions = '',$name = false){

		$permis_array = explode('|', $permissions);
		$access_permission = array();
		$res = array();

		$user_data = User::select('id','access_permission','name')->where('cmpny_id',Auth::user()->cmpny_id)->get();
            if(isset($user_data))
            {
                foreach ($user_data as $value)
                {
                    if(!empty($value))
                    {
                        $access_permission = unserialize($value->access_permission);
						if(!empty($access_permission))
						{
							foreach ($access_permission as $row)
							{
									$access_perm[]=$row['permission_name'];
							}
						}
                    }
                    if(!empty($permis_array) && !empty($access_perm))
                    {
                        foreach ($permis_array as $permis)
                        {
                             if(in_array($permis, $access_perm)){
                             	if($name == 'yes'){
                             		$res[] = array('id'=>$value->id,'name'=>$value->name);
                             	}else{
                             		$res[] = $value->id;
                             	}
                             }
                        }
                    }
                }
            }
        return $res;
	}
	static function checkPermission($permissions='',$user_id=''){
        $permis_array = explode('|', $permissions);
        $access_permission = array();
        //$user_id = Auth::User()->id;
		$user_id = ($user_id != '' ? $user_id : Auth::User()->id);
        if(!empty($user_id))
        {
            $user_data = User::where('id',$user_id)->get();
            if(!empty($user_data) && $user_data->count())
            {
                
                foreach ($user_data as $value)
                {
                    
                    if(!empty($value))
                    {
                        $access_permission = unserialize($value->access_permission);
						if(!empty($access_permission))
						{
							foreach ($access_permission as $row)
							{
									$access_perm[]=$row['permission_name'];
							}
						}
                    }
                    if(!empty($permis_array) && !empty($access_perm))
                    {
                        foreach ($permis_array as $permis)
                        {
                             if(in_array($permis, $access_perm)){return true;}
                        }
                    }
                }
            }
        }
        return false;
	} 
	  
	static function checkUserPermission($permissions=''){
        $permis_array = explode('|', $permissions);
        $access_permission = array();
        $user_id = Auth::User()->id;
        if(!empty($user_id))
        {
            $user_data = User::where('id',$user_id)->get();
            if(!empty($user_data) && $user_data->count())
            {
                
                foreach ($user_data as $value)
                {
                    
                    if(!empty($value))
                    {
                        $access_permission = unserialize($value->access_permission);
						if(!empty($access_permission))
						{
							foreach ($access_permission as $row)
							{
									$access_perm[]=$row['permission_name'];
							}
						}
                    }
                    if(!empty($permis_array) && !empty($access_perm))
                    {
                        foreach ($permis_array as $permis)
                        {
                             if(in_array($permis, $access_perm)){return true;}
                        }
                    }
                }
            }
        }
        return false;
	} 
    static function get_date_time($format = TRUE, $time = TRUE) {
		
		date_default_timezone_set('Asia/Calcutta');
		if ($format)
			{
				if ($time) 
					{
						return date('Y-m-d H:i:s');
					} 
				else 
					{
						return date('Y-m-d');
					}
			} 
		else 
			{
				if ($time) 
					{
						return date('d/m/Y H:i:s');
					} 
				else 
					{
						return date('d/m/Y');
					}
			}
	}
    static function common_date_conversion($date, $type = '') {
		
		if (isset($date) && !empty($date) && $date != '0000-00-00 00:00:00' && $date != '0000-00-00' && $date != '00:00:00' && $date != '0'){
			if ($type == 1) 
			{
				return date('Y/m/d', strtotime($date));
			} 
			else if ($type == 2) 
			{
				return date('Y/m/d h:i:s A', strtotime($date));
			}
			else if ($type == 3) 
			{
				return date('d/m/Y h:i:s A', strtotime($date));
			}
			else if ($type == 4) 
			{
				return date('h:i A', strtotime($date));
			}
			else if ($type == 5) 
			{
				return date('H:i A', strtotime($date));
			}
			else if ($type == 6) 
			{
				return date('Y-m-d H:i:s', strtotime($date));
			}
			else 
			{
				return date('d/m/Y', strtotime($date));
			}
		}
		else 
		{
			return '';
		}
	}
	/*
    * @get database time format
    * @author AKHIL MURUKAN
    * @date 13/11/2017
    * @since version 1.0.0
    */ 
		static function get_db_time($date, $type = '') {
			
            if (isset($date) && !empty($date)) {
				if ($type == 1) 
				{
					return date('Y-m-d', strtotime($date));
				} 
				else if ($type == 2) 
				{
					return date('Y-m-d h:i A', strtotime($date));
				}
				 else 
				{
					return date('Y-m-d', strtotime($date));
				}
			} 
		}
	/*
     * @author     ELAVARASI.S
     * @since      Version 1.0
     * Date:       11/10/2018 
     * Description: Get user location
    */
	public static function get_user_location() {  
	
		$ip = self::get_client_ip();
		if (!$ip) {
			return false;
		}
		$result = array('country' => '', 'city' => ''); $loc = '';
		
		$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
		
		if ($ip_data && $ip_data->geoplugin_countryName != null) {
			$result['country'] = $ip_data->geoplugin_countryCode;
			$result['city'] = $ip_data->geoplugin_city;
			$loc = $result['city'].' , '.$result['country'];			
		}
		return $loc;
	}
	/*
     * @author     ELAVARASI.S
     * @since      Version 1.0
     * Date:       11/10/2018 
     * Description: Get Client IP
    */	
	public static function get_client_ip() {
		
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if (isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = false;

		return $ipaddress;
	}
	/*
     * @author     ELAVARASI.S
     * @since      Version 1.0
     * Date:       11/10/2018 
     * Description: Maintain user logs
    */
	public static function set_user_logs($user_id, $related_to, $message) {
		
		User_log::Create([
			'user_id'=> $user_id,
			'related_to'=> $related_to,
			'ipaddress'=> self::get_client_ip(),
			'location'=> self::get_user_location(),
			'message' => $message,
			'created_at' => date('Y-m-d H:i:s')
			]);	
	}
	/*
     * @author     RAHULRAHUL R
     * @since      Version 1.0
     * Date:       11/10/2018 
     * Description: Get current page
    */	
	public static function current_page($uri = "/"){
		if (request()->is($uri))
		{
			return TRUE;
		}
		return strstr(request()->path(), $uri);
	}
	
/*
	 * @author     RINKU.E.B
     * @since      Version 1.0
     * Date:       10/11/2018 
     * Description: automated process actions function with customer id and process id for expiry time
	*/
	public static function auto_process_action($cmpny_id,$id,$complaint_id,$auto_id)
	{
		$process = AutomatedProcess::where('id',$auto_id)->where('cmpny_id',$cmpny_id)->first();
		$action = explode(",",$process->action);
		$content_id = explode(",",$process->content);
		/*$category = $process->category;
		$faq_category = $process->faq_category;
		$query_type = $process->query_type;
		$priority = $process->priority;
		$customer_nature = $process->customer_nature;
		$query_status = $process->query_status;
		$lead_source_id = $process->lead_source_id;
		$action_time = $process->action_time;
		$process_type = $process->process_type;
		$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';*/
		$req_title = $process->process_name;
		$intimation_to_param = $process->intimation_to_param;
		$intimation_to = $process->intimation_to;
		$intimation_cc_to = $process->intimation_cc_to;
		$additional_cc_flag = $process->additional_cc_flag;
		$random_code = str_random(12);
		$set_crm_automation_source = Helpers::get_company_meta('set_crm_automation_source',$cmpny_id);
		for($i=0;$i<count($action);$i++)
		{
		$content_results = Templates::where('id',$content_id[$i])->where('cmpny_id',$cmpny_id)->first();
		if($content_results)
		{
			$content = $content_results->content;
			$subject = $content_results->subject;
			$replc_result = AutomatedProcessRelations::select('mail_field')->where('id',$id)->where('cmpny_id',$cmpny_id)->first();
			if($replc_result)
			{
				$replacements = json_decode($replc_result->mail_field,true);
				if(isset($replacements) && !empty($replacements))
				{
				foreach($replacements as $key=>$value)
				{
					$content = str_replace($key, $value, $content);
				}
				}
			}
			
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
		}
		/*else
		{
			if(($action[$i] == config('constant.CH_SMS'))||($action[$i] == config('constant.CH_EMAIL')))
			{
			$content_missing_mail = Helpers::get_company_meta('content_missing_mail',$cmpny_id);
			if(!empty($content_missing_mail))
			{
			$cmp_emails = Templates::where('id',$content_missing_mail)->where('cmpny_id',$cmpny_id)->first();
			if($cmp_emails)
			{
				$content = $cmp_emails->content;
				$subject = $cmp_emails->subject;
				$content = str_replace('[[ Auto_process ]]', $req_title, $content);
				$content = str_replace('[[ Auto_process_id ]]', $auto_id, $content);
				
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
				
				$mail_arr = CommonSmsEmail::Create(
												[
												'authentication' => '',
												'cmpny_id' => $cmpny_id,
												'source' => $set_crm_automation_source,
												'email' => config('constant.AUTO_PROCESS_FAILURE_MAILID'),
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
												'created_at' => date('Y-m-d H:i:s'),
												'auto_process_id' => $auto_id,
											   ]);
			}
			}
				$time_results = AutomatedProcess::select('action_time','expiry_time')->where('id',$auto_id)->where('cmpny_id',$cmpny_id)->first();
				$action_time = $time_results->action_time;
				$expiry_time = $time_results->expiry_time;		
				$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';
				$expiry_time = date("Y-m-d H:i", strtotime('+'.$expiry_time.' minutes')).':00';
				$upd = array(
				'auto_process_id' => $auto_id,
				'action_created_time' => date('Y-m-d H:i:s'),
				'action_time' => $action_time,
				'action_expiry_time' => $expiry_time
				);
				AutomatedProcessRelations::where('id',$id)->where('cmpny_id',$cmpny_id)->update($upd);
				AutomatedProcessLog::firstOrCreate([
													'complaint_id'=>$complaint_id,
													'cmpny_id'=>$cmpny_id,
													'auto_process_id'=>$auto_id,
													'action_created_time' => date('Y-m-d H:i:s'),
													'action_time' => $action_time,
													'action_expiry_time' => $expiry_time,
													'created_at' => date('Y-m-d H:i:s'),
													]);	
			}
		}*/
		$email = '';
		$email_cc = '';
		$mobile = '';
		$country_code = '';
		$subscription_status = config('constant.ACTIVE');
		
		/// CALCULATION PART OF $email STARTS ///
		
		
			if(isset($intimation_to) && !empty($intimation_to))
			{
				$district_flag = '';
				$department_flag = '';
				$designation_flag = '';
				$taluk_flag = '';
				$district = '';
				$department = '';
				$designation = '';
				$taluk = '';
				$emails = '';
				$intimation_to_arr = explode("||",$intimation_to);
				foreach($intimation_to_arr as $intimation_arr)
				{
					$intimation_res = explode(",",$intimation_arr);
					foreach($intimation_res as $res)
					{
						$response = explode("-",$res);
						switch ($response[0])
						{
							case config('constant.DISTRICT'):
								$district_flag = $response[1];
								break;
							case config('constant.DEPARTMENT'):
								$department_flag = $response[1];
								break;
							case config('constant.DESIGNATION'):
								$designation_flag = $response[1];
								$designation = $response[1];
								break;
							case config('constant.TALUK'):
								$taluk_flag = $response[1];
								break;
						}
					}
					/* echo $district_flag;
					echo $department_flag;
					echo $designation_flag;
					echo $taluk_flag; */ 
					$condn_results = Helpdesk::select('district_id','query_category','taluk_id','taluk_supply_office','district_supply_office')->where('id',$complaint_id)->where('cmpny_id',$cmpny_id)->first();
					if($condn_results)
					{
						$district = $condn_results->district_id;
						$department = $condn_results->query_category;
						$taluk = $condn_results->taluk_id;
						$taluk_supply_office = $condn_results->taluk_supply_office;
						$district_supply_office = $condn_results->district_supply_office;
					}
					$results = User::select('email','phone')->where('status',config('constant.ACTIVE'))->where('cmpny_id',$cmpny_id);
				
					if(isset($district_flag) && !empty($district_flag) && ($district_flag!=0) && isset($district) && !empty($district))
					{
						$results->where('district_id',$district);
					}
					if(isset($department_flag) && !empty($department_flag) && ($department_flag!=0) && isset($department) && !empty($department))
					{
						$results->where('department',$department);
					}
					if(isset($designation_flag) && !empty($designation_flag) && ($designation_flag!=0) && isset($designation) && !empty($designation))
					{
						$results->where('designation',$designation);
					}
					if(isset($taluk_flag) && !empty($taluk_flag) && ($taluk_flag!=0) && isset($taluk) && !empty($taluk))
					{
						$results->where('taluk_id',$taluk);
					}
					$results   = $results->get();
					$email_str = '';
					foreach($results as $data)
					{
						$email_str .= $data->email.',';
					}
					$email_str = rtrim($email_str,",");
					$emails .= $email_str.',';
					if($intimation_to_param==1)
					{
						$emails = '';
					}
				}
				
				if(($intimation_to_param==1) || ($intimation_to_param==2))
				{
					$esc_res = Helpdesk::select('escalate')->where('id',$complaint_id)->where('cmpny_id',$cmpny_id)->first();
					if($esc_res)
					{
						$esc_id = $esc_res->escalate;
						$em_results = User::select('email','phone')->where('id',$esc_id)->where('cmpny_id',$cmpny_id)->first();
						if($em_results)
						{
							$email = $em_results->email;
							$mobile = $em_results->phone;
							$emails .= $email.',';
						}
					}
				}
				$emails = rtrim($emails,",");
				$emails = ltrim($emails,",");
				echo $emails;
				
			}
		
		if(isset($additional_cc_flag) && !empty($additional_cc_flag) && ($additional_cc_flag == config('constant.ACTIVE')))
		{
			$emails_cc = '';
			if(isset($taluk_supply_office) && !empty($taluk_supply_office))
			{
				$s_offices = SupplyOffices::select('email')->where('id',$taluk_supply_office)->first();
				if($s_offices)
				{
					$emails_cc .= $s_offices->email.',';
				}
				
			}
			if(isset($district_supply_office) && !empty($district_supply_office))
			{				
				$s_offices1 = SupplyOffices::select('email')->where('id',$district_supply_office)->first();
				if($s_offices1)
				{
					$emails_cc .= $s_offices1->email.',';
				}
			}
			$emails_cc = rtrim($emails_cc,",");
			$emails_cc = ltrim($emails_cc,",");
		}
		else
		{
			if(isset($intimation_cc_to) && !empty($intimation_cc_to))
			{
				$district_flag_cc = '';
				$department_flag_cc = '';
				$designation_flag_cc = '';
				$taluk_flag_cc = '';
				$district_cc = '';
				$department_cc = '';
				$designation_cc = '';
				$taluk_cc = '';
				$emails_cc = '';
				$intimation_cc_to_arr = explode("||",$intimation_cc_to);
				foreach($intimation_cc_to_arr as $intimation_cc_arr)
				{
					$intimation_cc_res = explode(",",$intimation_cc_arr);
					foreach($intimation_cc_res as $res_cc)
					{
						$response_cc = explode("-",$res_cc);
						switch ($response_cc[0])
						{
							case config('constant.DISTRICT'):
								$district_flag_cc = $response_cc[1];
								break;
							case config('constant.DEPARTMENT'):
								$department_flag_cc = $response_cc[1];
								break;
							case config('constant.DESIGNATION'):
								$designation_flag_cc = $response_cc[1];
								$designation_cc = $response_cc[1];
								break;
							case config('constant.TALUK'):
								$taluk_flag_cc = $response_cc[1];
								break;
						}
					}
					/* echo $district_flag;
					echo $department_flag;
					echo $designation_flag;
					echo $taluk_flag; */ 
					$condn_results_cc = Helpdesk::select('district_id','query_category','taluk_id')->where('id',$complaint_id)->where('cmpny_id',$cmpny_id)->first();
					if($condn_results_cc)
					{
						$district_cc = $condn_results_cc->district_id;
						$department_cc = $condn_results_cc->query_category;
						$taluk_cc = $condn_results_cc->taluk_id;
					}
					$results_cc = User::select('email','phone')->where('status',config('constant.ACTIVE'))->where('cmpny_id',$cmpny_id);
				
					if(isset($district_flag_cc) && !empty($district_flag_cc) && ($district_flag_cc!=0) && isset($district_cc) && !empty($district_cc))
					{
						$results_cc->where('district_id',$district_cc);
					}
					if(isset($department_flag_cc) && !empty($department_flag_cc) && ($department_flag_cc!=0) && isset($department_cc) && !empty($department_cc))
					{
						$results_cc->where('department',$department_cc);
					}
					if(isset($designation_flag_cc) && !empty($designation_flag_cc) && ($designation_flag_cc!=0) && isset($designation_cc) && !empty($designation_cc))
					{
						$results_cc->where('designation',$designation_cc);
					}
					if(isset($taluk_flag_cc) && !empty($taluk_flag_cc) && ($taluk_flag_cc!=0) && isset($taluk_cc) && !empty($taluk_cc))
					{
						$results_cc->where('taluk_id',$taluk_cc);
					}
					$results_cc   = $results_cc->get();
					$email_str_cc = '';
					foreach($results_cc as $data_cc)
					{
						$email_str_cc .= $data_cc->email.',';
					}
					$email_str_cc = rtrim($email_str_cc,",");
					$emails_cc .= $email_str_cc.',';
				}
				$emails_cc = rtrim($emails_cc,",");
				echo $emails_cc;
				
			}
		}
		
		
		
		
		
		
		
		/// CALCULATION PART OF $email ENDS ///
		
		$perms = 0;
		$closed_arr = QueryStatus::select('id')->where('cmpny_id',$cmpny_id)->where('is_close',config('constant.ACTIVE'))->where('status',config('constant.ACTIVE'))->get();
		if(!empty($closed_arr))
		{
			$status_count = Helpdesk::where('id',$complaint_id)->whereNotIn('query_status',$closed_arr)->count();
			if($status_count>0)
			{
				$perms = 1;
			}
		}
		
		$buffer = 'notsent';
		$mail_ref_id = str_random(15);
		if($action[$i] == config('constant.CH_EMAIL'))
		{ 
			if($content_results)
			{ 
				if(!empty($emails))
				{ 	
					if($perms == 1)
					{
						$mail_arr = CommonSmsEmail::Create(
												[
												'authentication' => '',
												'cmpny_id' => $cmpny_id,
												'source' => $set_crm_automation_source,
												'email' => $emails,
												//'customer_id' => $customer_id,
												'sent_type' => config('constant.CH_EMAIL'),
												'response' => $buffer,
												'mail_response' => '',
												'random_code' => $random_code,
												'content' => $content,
												'subject' => $subject,  
												'email_cc' => $emails_cc,   
												'status' => config('constant.INACTIVE'),
												//'communication_type' => $process_type,
												'created_by' => 0,
												'updated_by' => 0,
												'created_at' => date('Y-m-d H:i:s'),
												'auto_process_id' => $auto_id,
											   ]);
					}
				
				}
			}
		}
		
		
		
		}
		
	}
	 
	/*
	 * @author     RINKU.E.B
     * @since      Version 1.0
     * Date:       10/11/2018 
     * Description: common helper for profile updation
	 * Note response will be positive response and the helper is being called from different functions
	*/
	
	public static function auto_process_updation($cmpny_id,$id,$response,$flag)
	{
		
		$datas = AutomatedProcessRelations::select('auto_process_id')->where('complaint_id',$id)->where('cmpny_id',$cmpny_id)->get();
		if(count($datas)>0)
		{
		foreach($datas as $data)
		{ 
		$auto_id = $data->auto_process_id;
		$process = AutomatedProcess::where('id',$auto_id)->where('cmpny_id',$cmpny_id)->first();
		if($response == config('constant.AUTO_PROCESS_RESPONSE_NEGATIVE'))
		{
			$response_neg = $process->response_neg;
			if(isset($response_neg) && !empty($response_neg) && ($response_neg!=''))
			{
			if(is_numeric($response_neg))
			{
			$time_results = AutomatedProcess::select('action_time','expiry_time')->where('id',$response_neg)->where('cmpny_id',$cmpny_id)->first();
				$action_time = $time_results->action_time;
				$expiry_time = $time_results->expiry_time;		
				$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';
				$expiry_time = date("Y-m-d H:i", strtotime('+'.$expiry_time.' minutes')).':00';
				$arr = array(
							'auto_process_id' => $response_neg,
							'action_created_time' => date('Y-m-d H:i:s'),
							'action_time' => $action_time,
							'action_expiry_time' => $expiry_time
							);
				//cc_customer_profile::where('id',$id)->update($arr);
				
				AutomatedProcessRelations::where('id',$flag)->where('cmpny_id',$cmpny_id)->update($arr);
				AutomatedProcessLog::firstOrCreate([
										'complaint_id'=>$id,
										'cmpny_id'=>$cmpny_id,
										'auto_process_id'=>$response_neg,
										'action_created_time' => date('Y-m-d H:i:s'),
										'action_time' => $action_time,
										'action_expiry_time' => $expiry_time,
										'created_at'=> date('Y-m-d H:i:s'),
										]);	
			}
		}	
		}
		else
		{
			$response_pos = $process->response_pos;
			if(isset($response_pos) && !empty($response_pos) && ($response_pos!=''))
			{
			if(is_numeric($response_pos))
			{
				$time_results = AutomatedProcess::select('action_time','expiry_time')->where('id',$response_pos)->where('cmpny_id',$cmpny_id)->first();
				$action_time = $time_results->action_time;
				$expiry_time = $time_results->expiry_time;		
				$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';
				$expiry_time = date("Y-m-d H:i", strtotime('+'.$expiry_time.' minutes')).':00';
				$arr = array(
							'auto_process_id' => $response_pos,
							'action_created_time' => date('Y-m-d H:i:s'),
							'action_time' => $action_time,
							'action_expiry_time' => $expiry_time
							);
				//cc_customer_profile::where('id',$id)->update($arr);
				$add_res = AutomatedProcessRelations::where('complaint_id',$id)->where('cmpny_id',$cmpny_id)->update($arr);
				$add_res = AutomatedProcessRelations::select('id')->where('complaint_id',$id)->where('cmpny_id',$cmpny_id)->first();
				
				AutomatedProcessLog::firstOrCreate([
										'complaint_id'=>$id,
										'cmpny_id'=>$cmpny_id,
										'auto_process_id'=>$response_pos,
										'action_created_time' => date('Y-m-d H:i:s'),
										'action_time' => $action_time,
										'action_expiry_time' => $expiry_time,
										'created_at'=>date('Y-m-d H:i:s'),
										]);	
				/// CODE FOR EFFICIENCY FLAG UPDATION STARTS	
				/*$parent_id = '';				
				if(isset($time_results->parent_id) && !empty($time_results->parent_id))
				{
					$parent_id = $time_results->parent_id;
				}
				if(isset($add_res->id) && !empty($add_res->id))
				{
				$efficiency_array = CommonSmsEmail::select('batch_id','campaign_efficiency','id','goal_stage')->whereNull('campaign_efficiency')->where('auto_process_rel_id',$add_res->id)->where('complaint_id',$id)->get();
				if(count($efficiency_array)>0)
				{
					foreach($efficiency_array as $effcient)
					{
						$cmn_id = $effcient->id;
						$b_id = $effcient->batch_id;
						$goal_stage = $effcient->goal_stage;
						if(isset($b_id) && !empty($b_id))
						{
							$stat = BatchProcess::select('status')->where('id',$b_id)->first();
							if($stat->status==config('constant.ACTIVE'))
							{
								if($goal_stage==$response_pos)
								{
								$cmp_array = array('campaign_efficiency'=>config('constant.ACTIVE'),'converted_process_parent_id'=>$parent_id,'converted_process_id'=>$response_pos,'goal_stage_date'=>date('Y-m-d H:i:s'));
								CommonSmsEmail::where('id',$cmn_id)->update($cmp_array);	
								}
							}
						}
						
						
					}
				}
				}*/
				/// CODE FOR EFFICIENCY FLAG UPDATION ENDS						
										
			}
			else
			{
				$response_arr = explode(",",$response_pos);
				foreach($response_arr as $res)
				{
					$res_array =  explode("-",$res);
					if($res_array[0]==$flag)
					{
						$response_pos = $res_array[1];
						$time_results = AutomatedProcess::select('action_time','expiry_time')->where('id',$response_pos)->where('cmpny_id',$cmpny_id)->first();
							$action_time = $time_results->action_time;
							$expiry_time = $time_results->expiry_time;		
							$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';
							$expiry_time = date("Y-m-d H:i", strtotime('+'.$expiry_time.' minutes')).':00';
							$arr = array(
										'auto_process_id' => $response_pos,
										'action_created_time' => date('Y-m-d H:i:s'),
										'action_time' => $action_time,
										'action_expiry_time' => $expiry_time
										);
							//cc_customer_profile::where('id',$id)->update($arr);
							$add_res = AutomatedProcessRelations::where('complaint_id',$id)->where('cmpny_id',$cmpny_id)->update($arr);
							$add_res = AutomatedProcessRelations::select('id')->where('complaint_id',$id)->where('cmpny_id',$cmpny_id)->first();
							
							AutomatedProcessLog::firstOrCreate([
													'complaint_id'=>$id,
													'cmpny_id'=>$cmpny_id,
													'auto_process_id'=>$response_pos,
													'action_created_time' => date('Y-m-d H:i:s'),
													'action_time' => $action_time,
													'action_expiry_time' => $expiry_time,
													'created_at'=>date('Y-m-d H:i:s')
													]);	
						/// CODE FOR EFFICIENCY FLAG UPDATION STARTS						
						/*$parent_id = '';				
						if(isset($time_results->parent_id) && !empty($time_results->parent_id))
						{
							$parent_id = $time_results->parent_id;
						}
						if(isset($add_res->id) && !empty($add_res->id))
						{
						$efficiency_array = CommonSmsEmail::select('batch_id','campaign_efficiency','id','goal_stage')->whereNull('campaign_efficiency')->where('auto_process_rel_id',$add_res->id)->where('complaint_id',$id)->get();
						if(count($efficiency_array)>0)
						{
							foreach($efficiency_array as $effcient)
							{
								$cmn_id = $effcient->id;
								$b_id = $effcient->batch_id;
								$goal_stage = $effcient->goal_stage;
								if(isset($b_id) && !empty($b_id))
								{
									$stat = BatchProcess::select('status')->where('id',$b_id)->first();
									if($stat->status==config('constant.ACTIVE'))
									{
										if($goal_stage==$response_pos)
										{
										$cmp_array = array('campaign_efficiency'=>config('constant.ACTIVE'),'converted_process_parent_id'=>$parent_id,'converted_process_id'=>$response_pos,'goal_stage_date'=>date('Y-m-d H:i:s'));
										CommonSmsEmail::where('id',$cmn_id)->update($cmp_array);
										}
									}
								}
								
								
							}
						}
						}*/
						/// CODE FOR EFFICIENCY FLAG UPDATION ENDS								
													
					}
				}
			}
		}
		}
		
		}	
		}
	}
	/*
	 * @author     RINKU.E.B
     * @since      Version 1.0
     * Date:       10/11/2018 
     * Description: common helper for getting the action time and expiry time for an automated process id
	*/
	public static function auto_process_params($cmpny_id,$complaint_id,$auto_id)
	{	
		$results = AutomatedProcess::select('action_time','expiry_time','action_time_param','expiry_time_param','expiry_flag')->where('id',$auto_id)->where('cmpny_id',$cmpny_id)->first();
		$action_time = $results->action_time;
		$expiry_time = $results->expiry_time;		
		$action_time_param = $results->action_time_param;		
		$expiry_time_param = $results->expiry_time_param;		
		$expiry_flag = $results->expiry_flag;
			switch ($action_time_param)
				{
					case 1:
						$action_time_param = 'minutes';
						break;
					case 2:
						$action_time_param = 'hours';
						break;
					case 3:
						$action_time_param = 'days';
						break;
					default:
						$action_time_param = 'days';
						break;
				}
			$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' '.$action_time_param)).':00';
		if($expiry_flag==0)
		{
			
			switch ($expiry_time_param)
				{
					case 1:
						$expiry_time_param = 'minutes';
						break;
					case 2:
						$expiry_time_param = 'hours';
						break;
					case 3:
						$expiry_time_param = 'days';
						break;
					default:
						$expiry_time_param = 'days';
						break;
				}
			
			$expiry_time = date("Y-m-d H:i", strtotime('+'.$expiry_time.' '.$expiry_time_param)).':00';
			//echo $action_time.'<br>';echo $expiry_time;die;
		}
		else
		{
			$exp_results = Helpdesk::select('escalation_due_date')->where('id',$complaint_id)->first();
			if($exp_results)
			{
				$expiry_time = $exp_results->escalation_due_date;
				$expiry_time = date("Y-m-d H:i", strtotime($expiry_time)).':00';
			}
		}
		$mail_arr_res = Helpdesk::select('docket_number')->where('id',$complaint_id)->first();
		if($mail_arr_res)
		{
			$dock_no = $mail_arr_res->docket_number;
		}
		else
		{
			$dock_no = '---';
		}
		if(!isset($dock_no) || empty($dock_no))
		{
			$dock_no = '---';
		}
		$mail_arr = array('[[ docket_no ]]' => $dock_no );
		$rel = AutomatedProcessRelations::firstOrCreate(
										[
										'complaint_id'=>$complaint_id,
										'cmpny_id'=>$cmpny_id],
										['auto_process_id'=>$auto_id,
										'action_created_time'=>date('Y-m-d H:i:s'),
										'action_time'=>$action_time,
										'action_expiry_time'=>$expiry_time,
										'mail_field'=>json_encode($mail_arr),
										]);	
		$log = AutomatedProcessLog::firstOrCreate(
										[
										'complaint_id'=>$complaint_id,
										'cmpny_id'=>$cmpny_id],
										['auto_process_id'=>$auto_id,
										'action_created_time'=>date('Y-m-d H:i:s'),
										'action_time'=>$action_time,
										'action_expiry_time'=>$expiry_time,
										'created_at'=>date('Y-m-d H:i:s'),
										'mail_field'=>json_encode($mail_arr),
										]);
		
	}

	
	/*
	 * @author     RINKU.E.B
     * @since      Version 1.0
     * Date:       13/11/2018 
     * Description: mail content table for escalation report
	 * $typ = 1 sms, $typ = 2 email, $categ indicates daily, weekly or monthy
	*/
	public static function escalate_report_mail_content($cmpny_id,$user_id,$categ,$typ)
	{
		$qry = QueryTypes::orderBy('query_type')->where('type',config('constant.TICKET'))->where('cmpny_id',$cmpny_id)->pluck('query_type', 'id')->all();
		$query_arr ="";
        foreach($qry as $key => $value)
			{
				$query_value_type = $value;
				$query_value = $key;
		    	$master_querytype[$query_value]['id'] = $query_value;
		    	$master_querytype[$query_value]['name'] = $query_value_type;
		    	$query_value_type = str_replace(" ","_",$query_value_type);
				$master_querytype[$query_value][$query_value_type.'total_cont'] = 0;
		    	$master_querytype_check[$query_value_type] = $query_value;
				$query_arr .=$query_value.',';
			}
		$query_arr=rtrim($query_arr,",");
		if(isset($query_type) && !empty($query_type)) 
            {
                $query_types = array($query_type);    
            } 
            else
			{
				if(isset($query_arr) && !empty($query_arr))
				{
					$query_arr_status1 = explode(',', $query_arr);
					$query_types = $query_arr_status1;
				}
			}
		
		
		/*$query_types = array(1,3,4);
		$qry = config('constant.query_type_help_desk');
        foreach($qry as $key => $value)
			{
				$query_value_type = $value;
				$query_value = $key;
		    	$master_querytype[$query_value]['id'] = $query_value;
		    	$master_querytype[$query_value]['name'] = $query_value_type;
			}*/
		/***** my task *******/
		$my_task = Helpdesk::select(DB::raw('count(query_status) as counts'),'query_status','query_type')
								->where('ori_helpdesk.status',config('constant.ACTIVE'))
								->whereIn('ori_helpdesk.query_type', $query_types)
								->Where('ori_helpdesk.escalate',$user_id)
								->Where('ori_helpdesk.escalation_status', '!=', 0)
								->where('ori_helpdesk.cmpny_id',$cmpny_id)
								->groupBy('query_status')
								->groupBy('query_type')
								->orderBy('query_status')
								->orderBy('query_type')
								->get();
			$ss = QueryStatusRelation::select('ori_mast_query_status.id','ori_mast_query_status.name')
		                    ->leftjoin('ori_mast_query_status','ori_mast_query_status.id','=','ori_mast_query_status_relation.query_status_id')
							->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
							->whereIn('ori_mast_query_status_relation.query_type_id', $query_types)
							->where('ori_mast_query_status_relation.status',config('constant.ACTIVE'))
							->groupBy('ori_mast_query_status.id')
							->groupBy('ori_mast_query_status.name')
							->where('ori_mast_query_status_relation.deleted_at', '=', Null)
							->get();		
						
	   foreach($ss as $values)
			{
				$key = $values->name;
				$value_d = $values->id;
		    	$master_status['Total'] = 'Total';
		    	$master_status[$value_d] = $key;
			}						
								
		/***** my task end  *******/
		if($categ==config('constant.INTIMATION_DAILY'))
		{
		$my_task = Helpdesk::select(DB::raw('count(query_status) as counts'),'query_status','query_type')
								->where('ori_helpdesk.status',config('constant.ACTIVE'))
								->whereIn('ori_helpdesk.query_type', $query_types)
								->Where('ori_helpdesk.escalate',$user_id)
								->Where('ori_helpdesk.escalation_status', '!=', 0)
								->where('created_at','>=',date('Y-m-d').' 00:00:01')
								->where('created_at','<=',date('Y-m-d').' 23:59:59')
								->where('ori_helpdesk.cmpny_id',$cmpny_id)
								->groupBy('query_status')
								->groupBy('query_type')
								->orderBy('query_status')
								->orderBy('query_type')
								->get();	
		}
		else if($categ==config('constant.INTIMATION_WEEKLY'))
		{
			$dt1 = date("Y-m-d", strtotime('-7 days'));
			$dt2 = date("Y-m-d");
			$my_task = Helpdesk::select(DB::raw('count(query_status) as counts'),'query_status','query_type')
								->where('ori_helpdesk.status',config('constant.ACTIVE'))
								->whereIn('ori_helpdesk.query_type', $query_types)
								->Where('ori_helpdesk.escalate',$user_id)
								->Where('ori_helpdesk.escalation_status', '!=', 0)
								->where('ori_helpdesk.cmpny_id',$cmpny_id)
								->where('created_at','>=',$dt1.' 00:00:01')
								->where('created_at','<=',$dt2.' 23:59:59')
								->groupBy('query_status')
								->groupBy('query_type')
								->orderBy('query_status')
								->orderBy('query_type')
								->get();
			
		}
		else if($categ==config('constant.INTIMATION_MONTHLY'))
		{
			$dt1 = date('Y-m-d', strtotime('first day of last month'));
			$dt2 = date('Y-m-d', strtotime('last day of previous month'));
			$my_task = Helpdesk::select(DB::raw('count(query_status) as counts'),'query_status','query_type')
								->where('ori_helpdesk.status',config('constant.ACTIVE'))
								->whereIn('ori_helpdesk.query_type', $query_types)
								->Where('ori_helpdesk.escalate',$user_id)
								->Where('ori_helpdesk.escalation_status', '!=', 0)
								->where('ori_helpdesk.cmpny_id',$cmpny_id)
								->where('created_at','>=',$dt1.' 00:00:01')
								->where('created_at','<=',$dt2.' 23:59:59')
								->groupBy('query_status')
								->groupBy('query_type')
								->orderBy('query_status')
								->orderBy('query_type')
								->get();
		}
		 if(count($my_task) >0)
		 {
			$table = '<table style="border:1px solid #000;width:100%;">';$str = '';
			$table .= '<tr><th> # Status</th>';
						
			foreach ($master_querytype as $value)
			{
				$table .= '<th align="center">'.$value['name'].'</th>'; 				
			}		
			$table .= '</tr>'; 
						$all_escalation1[]='';
						$conts1 = 0; $conts_c1 = 0; $conts_p1 = 0;
						$conts2 = 0; $conts_c2 = 0;  $conts_p2 = 0;
						$conts3 = 0; $conts_c3 = 0;  $conts_p3 = 0;
			
			foreach ($my_task as $value1)
			{
				$cnt =$value1->counts;
				$ty =$value1->query_type;
				$lead =$value1->query_status;
				$nm =$master_querytype[$ty]['name'];
				$name = str_replace(" ","_",$nm);
							
							
							if(isset($master_status[$lead]) && !empty($master_status[$lead])) 
							{
							foreach ($master_querytype as $total_mast_val)
								{
									$total_mast_nme = str_replace(" ","_",$total_mast_val['name']);
									if($name == $total_mast_nme)
									{
										$master_querytype[$ty][$name.'total_cont'] = $master_querytype[$ty][$name.'total_cont'] + $cnt;
										$all_escalation['Total'][$total_mast_nme]= $master_querytype[$ty][$name.'total_cont'];
									}
								}
								$val = $all_escalation[$lead][$name]=$cnt;
							}
							/*if($my_name == 'General_Enquiry')
							{
								$conts1 = $conts1 + $my_cnts;
								$all_escalation1['100']['General_Enquiry']['t']=$conts1;
								if($my_lead == 3 || $my_lead == 65)
								{
									$conts_c1 = $conts_c1 + $my_cnts;
									$all_escalation1['100']['General_Enquiry']['c']=$conts_c1;
								}
								else
								{
									$conts_p1 = $conts_p1 + $my_cnts;
									$all_escalation1['100']['General_Enquiry']['p']=$conts_p1;
								}
							}
							if($my_name == 'Service_Request')
							{
								$conts2 = $conts2 + $my_cnts;
								$all_escalation1['100']['Service_Request']['t']=$conts2;
								if($my_lead == 3 || $my_lead == 65)
								{
									$conts_c2 = $conts_c2 + $my_cnts;
									$all_escalation1['100']['Service_Request']['c']=$conts_c2;
								}
								else
								{
									$conts_p2 = $conts_p2 + $my_cnts;
									$all_escalation1['100']['Service_Request']['p']=$conts_p2;
								}
							}
							if($my_name == 'Complaints')
							{
								$conts3 = $conts3 + $my_cnts;
								$all_escalation1['100']['Complaints']['t']=$conts3;
								if($my_lead == 3 || $my_lead == 65)
								{
									$conts_c3 = $conts_c3 + $my_cnts;
									$all_escalation1['100']['Complaints']['c']=$conts_c3;
								}
								else
								{
									$conts_p3 = $conts_p3 + $my_cnts;
									$all_escalation1['100']['Complaints']['p']=$conts_p3;
								}
							}*/
							
							
							
			}
			
			foreach ($all_escalation as $key=>$valued)
			{
				$table .= '<tr>';
				if($key != '0')
				{
						
					/*if(isset($value['General_Enquiry']['t']) && !empty($value['General_Enquiry']['t'])) { $param1 = $value['General_Enquiry']['t'];} else {  $param1 = 0;}
					
					if(isset($value['Service_Request']['t']) && !empty($value['Service_Request']['t'])) {  $param2 = $value['Service_Request']['t'];} else {  $param2 = 0;}
					
					if(isset($value['Complaints']['t']) && !empty($value['Complaints']['t'])) {  $param3 = $value['Complaints']['t'];} else {  $param3 = 0;}
					
					if(isset($value['General_Enquiry']['p']) && !empty($value['General_Enquiry']['p'])) {  $param4 = $value['General_Enquiry']['p'].'-Processing';} else {  $param4 = '0-Processing';}
					
					if(isset($value['General_Enquiry']['c']) && !empty($value['General_Enquiry']['c'])) {  $param5 = $value['General_Enquiry']['c'].'-Closed';} else {  $param5 = '0-Closed';}
					
					if(isset($value['Service_Request']['p']) && !empty($value['Service_Request']['p'])) {  $param6 = $value['Service_Request']['p'].'-Processing';} else {  $param6 = '0-Processing';}
					
					if(isset($value['Service_Request']['c']) && !empty($value['Service_Request']['c'])) {  $param7 = $value['Service_Request']['c'].'-Closed';} else {  $param7 = '0-Closed';}
					
					if(isset($value['Complaints']['p']) && !empty($value['Complaints']['p'])) {  $param8 = $value['Complaints']['p'].'-Processing';} else {  $param8 = '0-Processing';}
					
					if(isset($value['Complaints']['c']) && !empty($value['Complaints']['c'])) {  $param9 = $value['Complaints']['c'].'-Closed';} else {  $param9 = '0-Closed';}
					
					$table .= '<tr style="border:1px solid #000;"><th rowspan="2" scope="row" style="border:1px solid #000;"> Tasks</th><td colspan="2" align="center" style="border:1px solid #000;">General Enquiry<br>'.$param1.'</td><td colspan="2" align="center" style="border:1px solid #000;">Service Request<br>'.$param2.'</td><td colspan="2" align="center" style="border:1px solid #000;">Complaints<br>'.$param3.'</td></tr>';
					$table .= '<tr><td align="center" style="border:1px solid #000;">'.$param4.'</td><td align="center" style="border:1px solid #000;">'.$param5.'</td><td align="center" style="border:1px solid #000;">'.$param6.'</td><td align="center" style="border:1px solid #000;">'.$param7.'</td><td align="center" style="border:1px solid #000;">'.$param8.'</td><td align="center" style="border:1px solid #000;">'.$param9.'</td></tr>';
					$str = 'General_Enquiry '.$param4.', '.$param5.'- Service Request '.$param6.', '.$param7.'- Complaints '.$param8.', '.$param9;*/
					$data = array();
					if($master_status[$key] != '0') { $table .= '<th>'.$master_status[$key].'</th>'; } 
						foreach ($master_querytype as $mast_value){ 
						$nme = str_replace(" ","_",$mast_value['name']);
						$str .= $nme.' - ';
						$qname[] = $nme;
						$new_str = '';
						if(isset($master_querytype_check[$nme]) && !empty($master_querytype_check[$nme]))
						{ 
							
							if(isset($valued[$nme]) && !empty($valued[$nme])) 
							{ 
								$table .= '<td align="center">'.$valued[$nme].'</td>';
								$str .= $master_status[$key].'('.$valued[$nme].'), ';
								//$data[$nme][$master_status[$key]] = $valued[$nme];
							}
							else 
							{ 
								$table .= '<td align="center">0</td>';
								$str .= $master_status[$key].'(0), ';$valued[$nme]=0;
								//$data[$nme][$master_status[$key]] = '0';
							}
				//echo $master_status[$key].'--'.$valued[$nme].'<br>';
				$test[$master_status[$key]][] = $valued[$nme];
						} 
					}
					
					
					
					
				}
				$table .= '</tr>';
			}
			
			if(count($qname)>0)
			{
				$qname = array_unique($qname);
				$res_count = count($qname);
				foreach($test as $key2=>$value2)
				{
					$status_arr[] = $key2;
				}
				if(count($status_arr)>0)
				{				
					for($i=0;$i<$res_count;$i++)
					{
						$new_str .= $qname[$i].'-';
						foreach($status_arr as $arr)
						{
							//echo $test[$arr][$i];
							//echo $test[$arr[$i]];
							$new_str .= $arr.'('.$test[$arr][$i].'), ';
						}
					}	
				}
			}
			$table .= '</table>';
			print_r($table);die;
			$str = rtrim($new_str,", ");
			if($typ==1)
			{
				return $str;
			}
			else if($typ==2)
			{
				return $table;
			}
			
		 }
		 else
		 {
			 return 1;
		 }
	}
	
	/*
	 * @author     RINKU.E.B
     * @since      Version 1.0
     * Date:       13/11/2018 
     * Description: immediate intimation of escalation common function
	*/
	public static function enquiry_mail_to_customer($cmpny_id,$user_id,$customer_id,$docket_no,$new_content,$subject)
	{
		$set_crm_source = Helpers::get_company_meta('set_crm_source',$cmpny_id);
		$details = CustomerProfile::select('first_name', 'mobile','email')->where('cmpny_id',$cmpny_id)->find($customer_id);
		$name = $details->first_name;
		$phone = $details->mobile;
		$email = $details->email;
		$random_code = str_random(12); 
		$content = "your query has been taken by our system. Please use this ticket number $docket_no for future referene.";
		$subject = "Enquiry Taken Email";
		$title = '';
		if (!empty($docket_no))
		{
			$helpdesk = Helpdesk::where('docket_number', $docket_no)->first();
			if ($helpdesk)
			{
				$title = $helpdesk->req_title;
			}
			else
			{
				$followup = LeadFollowup::where('docket_number', $docket_no)->first();

				if ($followup)
				{
					$title = $followup->req_title;
				}
			}
		}



		$enquiry_email = Helpers::get_company_meta('enquiry_email',$cmpny_id);
						   if(!empty($enquiry_email))
						   {
							   $contents = Templates::find($enquiry_email);
							   if(isset($contents) && !empty($contents))
							   {
								   $content = $contents->content;
								   $subject = $contents->subject;
								   $content = str_replace('[[ Docket Number ]]', $docket_no, $content);
								   $content = str_replace('[[ First Name ]]', $name, $content);
								   $content = str_replace('[[ Title ]]', $title, $content);
								   
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
								}
							}


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
					'communication_type' => config('constant.NOTIFICATION'),
					'email_cc' => '',   
					'status' => config('constant.INACTIVE'),
					'created_by' => 0,
					'updated_by' => 0,
					'created_at' => date('Y-m-d H:i:s')
				   ]);
	}
	public static function enquiry_sms_to_customer($cmpny_id,$user_id,$customer_id,$docket_no,$new_content,$subject)
	{
		$set_crm_source = Helpers::get_company_meta('set_crm_source',$cmpny_id);
		$details = CustomerProfile::select('first_name', 'mobile','email')->where('cmpny_id',$cmpny_id)->find($customer_id);
		$name = $details->first_name;
		$phone = $details->mobile;
		$email = $details->email;
		$mail_ref_id = str_random(15);
		$random_code = str_random(12); 
		$content = "your query has been taken by our system. Please use this ticket number $docket_no for future referene.";
		$subject = "Enquiry Taken sms";




		$enquiry_sms = Helpers::get_company_meta('enquiry_sms',$cmpny_id);
						   if(!empty($enquiry_sms))
						   {
							   $contents = Templates::find($enquiry_sms);
							   if(isset($contents) && !empty($contents))
							   {
								   $content = $contents->content;
								   $subject = $contents->subject;
								   $content = str_replace('[[ Docket Number ]]', $docket_no, $content);
								}
							}



		$sms_arr = CommonSmsEmail::Create(
					[
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
					'communication_type' => config('constant.NOTIFICATION'),
					'email_cc' => '',   
					'status' => config('constant.INACTIVE'),
					'created_by' => 0,
					'updated_by' => 0,
					'created_at' => date('Y-m-d H:i:s')
				   ]);
				  
	}
	/*
	 * @author     RINKU.E.B
     * @since      Version 1.0
     * Date:       13/11/2018 
     * Description: immediate intimation of escalation common function
	*/
	public static function escalate_immediate_action($cmpny_id,$user_id,$customer_id,$docket_no,$new_content,$subject,$emailcontent)
	{
		$results = Intimations::select('channel','time_interval')->where('user_id',$user_id)->where('cmpny_id',$cmpny_id)->where(function ($query) {
			$query->where('time_interval',config('constant.INTIMATION_IMMEDIATE_INTERNAL'))->orWhere('time_interval',config('constant.INTIMATION_IMMEDIATE'));
		})->get();
		$emails_cc = '';
		$helpdesk_res = Helpdesk::select('taluk_supply_office','district_supply_office')->where('id',$docket_no)->first();
		if($helpdesk_res)
		{
			$taluk_supply_office = $helpdesk_res->taluk_supply_office;
			$district_supply_office = $helpdesk_res->district_supply_office;
			if(isset($taluk_supply_office) && !empty($taluk_supply_office))
			{
				$s_offices = SupplyOffices::select('email')->where('id',$taluk_supply_office)->first();
				if($s_offices)
				{
					$emails_cc .= $s_offices->email.',';
				}
			}
			if(isset($district_supply_office) && !empty($district_supply_office))
			{
				$s_offices1 = SupplyOffices::select('email')->where('id',$district_supply_office)->first();
				if($s_offices1)
				{
					$emails_cc .= $s_offices1->email.',';
				}	
			}
			$emails_cc = rtrim($emails_cc,",");
			$emails_cc = ltrim($emails_cc,",");
		}
		
		
		
		$set_crm_source = Helpers::get_company_meta('set_crm_source',$cmpny_id);
		$details = User::select('name','phone','email')->where('cmpny_id',$cmpny_id)->find($user_id);
		$phone = $details->phone;
		$email = $details->email;
		$name = $details->name;
		if(count($results)>0)
		{
			foreach($results as $result)
			{
				$channel = $result->channel;
				$time_interval = $result->time_interval;
				if($time_interval==config('constant.INTIMATION_IMMEDIATE'))
				{
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
						   $content = str_replace('[[ table ]]', $new_content, $content);
						   $content = str_replace('[[ First Name ]]', $name, $content);
						   
								
									
									
						   $sms_arr = CommonSmsEmail::Create([
													'authentication' => '',
													'cmpny_id' => $cmpny_id,
													'follow_id' => $docket_no,
													'source' => $set_crm_source,
													'mobile' => $phone,
													'sent_type' => config('constant.CH_SMS'),
													'response' => 'notsent',
													'mail_response' => '',
													'mail_ref_id' => $mail_ref_id,
													'random_code' => $random_code,
													'content' => $content,
													'subject' => $subject,
													'communication_type' => config('constant.NOTIFICATION'),
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
						   $content = str_replace('[[ table ]]', $emailcontent, $content);
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
						   
						   $mail_arr = CommonSmsEmail::Create(
													[
													'authentication' => '',
													'cmpny_id' => $cmpny_id,
													'follow_id' => $docket_no,
													'source' => $set_crm_source,
													'email' => $email,
													'sent_type' => config('constant.CH_EMAIL'),
													'response' => 'notsent',
													'mail_response' => '',
													'random_code' => $random_code,
													'content' => $content,
													'subject' => $subject,  
													'communication_type' => config('constant.NOTIFICATION'),
													'email_cc' => $emails_cc,   
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
				/*else if($time_interval==config('constant.INTIMATION_IMMEDIATE_INTERNAL'))
				{
					if($channel==config('constant.INTIMATION_INTERNAL'))
					{ 
						$fpath = url('/profile/0').'/'.$docket_no.'/0/0/'.$customer_id;
							$ins_arr = array(
							  'title' => "Escalation Intimation",
							  'comment' => '<a href="'.$fpath.'" target="_blank">View</a> Created At '.date('d-m-Y H:i:s'),
							  'from_date' => date('Y-m-d h:i:s'),
							//'to_date' => $to_date,
							  'created_by' => 0,
							  'created_at' => date('Y-m-d h:i:s'),
							  'updated_at' => date('Y-m-d h:i:s')
							  );
						    $insert = cc_notifications_list::firstOrCreate($ins_arr);
						    $arr = array(
									 'user_id' => $user_id,
									 'notification_id' => $insert->id,
									 'status' => config('constant.INACTIVE'),
									 'created_at' => date('Y-m-d h:i:s'),
									 'updated_at' => date('Y-m-d h:i:s'),
									 );
							cc_notifications_roles_relations::firstOrCreate($arr);
					}
				}*/
			}
		}
		$title = 'Escalation Intimations';
		$comment = 'View';	
		$fpath = url('/profile/0').'/'.$customer_id.'/0/0/0/'.$docket_no;
		$link = $fpath;
		$created_by = 0;
		$flag = config('constant.INACTIVE');
		Helpers::add_notifications($user_id,$title,$comment,$link,$created_by,$flag,$cmpny_id);
							/* $ins_arr = array(
							  'title' => "Escalation Intimation",
							  'comment' => '<a href="'.$fpath.'" target="_blank">View</a> Created At '.date('d-m-Y H:i:s'),
							  'from_date' => date('Y-m-d h:i:s'),
							//'to_date' => $to_date,
							  'created_by' => 0,
							  'created_at' => date('Y-m-d h:i:s'),
							  'updated_at' => date('Y-m-d h:i:s')
							  );
						    $insert = NotificationsList::firstOrCreate($ins_arr);
						    $arr = array(
									 'user_id' => $user_id,
									 'notification_id' => $insert->id,
									 'status' => config('constant.INACTIVE'),
									 'created_at' => date('Y-m-d h:i:s'),
									 'updated_at' => date('Y-m-d h:i:s'),
									 );
							NotificationsRolesRelations::firstOrCreate($arr); */
			
		return 0;
	}
	
	/**
    * escalated task closed intimations
    * @author RINKU.E.B
    * @date 19/09/2018
    * @return 
   */
	public static function close_escalation_by_docket($cmpny_id,$docket)
	{ 
		$results = HelpdeskLog::select('updated_by','escalate')->where('docket_number',$docket)->Where('escalation_status','!=',0)->where('status',config('constant.ACTIVE'))->where('cmpny_id',$cmpny_id)->groupBy('updated_by')->get();
		if(count($results)>0)
		{
			foreach($results as $data)
			{
				$superior = $data->updated_by;
				$person = $data->escalate;
				$details = User::select('phone','email','name')->find($superior);
			    $phone = $details->phone;
			    $email = $details->email;
			    $name = $details->name;
				$details1 = User::select('name')->find($person);
				$fname = '';
				// MAIL FOR PARTICULAR AGENT WITH CONSOLIDATED DOCKET NUMBERS STARTS
				/* $perms = Intimations::where('user_id',$superior)->where('channel',config('constant.INTIMATION_MAIL'))->where('time_interval',config('constant.INTIMATION_SUPERIOR'))->where('cmpny_id',$cmpny_id)->first();
				if($perms)
				{ */
					$esc_close_mail = Helpers::get_company_meta('esc_close_mail',$cmpny_id);
					$set_crm_source = Helpers::get_company_meta('set_crm_source',$cmpny_id);
					if(!empty($esc_close_mail))
					{
				    $contents = Templates::find($esc_close_mail);
				    if(isset($contents) && !empty($contents))
				    {
					   $content = $contents->content;
					   $subject = $contents->subject;
					   $random_code = str_random(12);
					   $content = str_replace('[[ table ]]', $fname.'-'.$docket, $content);
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
												'cmpny_id' => Auth::User()->cmpny_id,
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
				//	}
				   // MAIL FOR PARTICULAR AGENT WITH CONSOLIDATED DOCKET NUMBERS ENDS
			}
		}
		
	}

	/**
    * GET COMPANY META
    * @author ELAVARASI S
    * @date 13/11/2018
    * @return 
   */
	public static function get_company_meta($meta_name = false, $cmpny_id = false)
	{ 
		/*if($meta_name AND $meta_value){
			$res = CompanyMeta::select('*')->where('meta_name',$meta_name)->where('meta_value',$meta_value)->get();
		}elseif($meta_name AND !$meta_value){
			$res = CompanyMeta::select('meta_value')->where('meta_name',$meta_name)->where('cmpny_id',Auth::User()->cmpny_id)->first();
			if(!empty($res)){
				$res = $res->meta_value;
			}else{
				$res = '';
			}
		}elseif(!$meta_name AND $meta_value){
			$res = CompanyMeta::select('*')->where('cmpny_id',Auth::User()->cmpny_id)->where('meta_value',$meta_value)->get();
		}else{
			$res = CompanyMeta::select('*')->get();
		}*/
		//$res ='';
		if($meta_name){
			$res = CompanyMeta::select('meta_value')->where('meta_name',$meta_name);
			if($cmpny_id){
				$res = $res->where('cmpny_id',$cmpny_id);
			}else{
				$res = $res->where('cmpny_id',Auth::User()->cmpny_id);
			}
			$res = $res->first();
			if(!empty($res)){
				$res = $res->meta_value;
			}else{
				$res = '';
			}
		}
		return $res;
	}
	
	/**
    * Auto process channel display in listing page
    * @author RINKU.E.B
    * @date 13/11/2018
    * @return 
    */
	public static function get_auto_process_action($action)
	{
		$channels = CompanyChannel::pluck('channel_id')->all();
		foreach($channels as $channel)
		{
			if($channel==$action)
			{
				$channel_name = Channel::select('name')->find($channel);
				if($channel_name)
				{
					echo $channel_name->name;
				}
			}
		}
		
	}
	
	/**
    * Template id with subject on auto process list
    * @author RINKU.E.B
    * @date 13/11/2018
    * @return 
    */
	public static function get_template_subject($id)
	{ 
		$results = Templates::select('subject')->find($id);
		if($results)
		{
			echo $id.' - '.$results->subject;	
		}
		
		//return 1;
	}
	
	/**
    * Basic master data entry
    * @author PRANEESHA KP
    * @date 16/11/2018
    * @return 
   */
	public static function add_basic_master_data($cmpny_id)
	{ 	
		if(isset($cmpny_id))
		{
			$query_type	= config('constant.QUERY_TYPES');
			$query_category	= config('constant.QUERY_CATEGORY');
			$query_status	= config('constant.QUERY_STATUS');
			$roles	= config('constant.BASIC_ROLES');
			$cus_natures	= config('constant.CUSTOMER_NATURE');
			$cus_priority	= config('constant.CUSTOMER_PRIORITY');
			$source_types	= config('constant.SOURCE_TYPE');
			
			


			Faq::create(
						[
							'cmpny_id' => $cmpny_id,
							'query_title_lang1' => config('constant.query_title_lang1'),
							'question_lang1' => config('constant.question_lang1'),
							'answer_lang1' => config('constant.answer_lang1'),
							'query_title_lang2' => config('constant.query_title_lang2'),
							'question_lang2' => config('constant.question_lang2'),
							'answer_lang2' => config('constant.answer_lang2'),
							'answer_lang1_short' => config('constant.answer_lang1_short'),
							'answer_lang2_short' => config('constant.answer_lang2_short'),						
							'keywords' => config('constant.query_title_lang1'),
							'status' => config('constant.ACTIVE'),
							'sort_order' => 1
						])->id;


			/*** create source_types***/
			foreach($source_types as $source_type){
					$st_create['source_type'] = $source_type;
					$st_create['status'] = config('constant.ACTIVE');
					$st_create['cmpny_id'] = $cmpny_id;
					$lead_source_type_id = LeadSourceType::create($st_create)->id;

					$lead_sources = config("constant.$source_type");

					foreach($lead_sources as $lead_source){
						$ls_create['name'] = $lead_source;
						$ls_create['lead_source_type_id'] = $lead_source_type_id;
						$ls_create['status'] = config('constant.ACTIVE');
						$ls_create['cmpny_id'] = $cmpny_id;
						$ls_create['source_key'] = Helpers::unique_random('ori_mast_lead_sources','source_key','16');
						$lead_source_id = LeadSources::create($ls_create)->id;
					}

			}
			/*** create cus_natures***/
			foreach($cus_natures as $cus_nature){
					$cn_create['customer_nature'] = $cus_nature;
					$cn_create['sort_order'] = 0;
					$cn_create['status'] = config('constant.ACTIVE');
					$cn_create['cmpny_id'] = $cmpny_id;
					$create_role = CustomerNature::create($cn_create);
			}
			/*** create cus_natures***/
			foreach($cus_priority as $priority){
					$cp_create['name'] = $priority;
					$cp_create['sort_order'] = 0;
					$cp_create['status'] = config('constant.ACTIVE');
					$cp_create['cmpny_id'] = $cmpny_id;
					$create_priority = Priority::create($cp_create);
			}
			/*** create role***/
			foreach($roles as $role){
					$r_create['role'] = $role;
					$r_create['access_permission'] = '';
					$r_create['created_by'] = config('constant.ORICOM_ADMIN');
					$r_create['updated_by'] = config('constant.ORICOM_ADMIN');
					$r_create['cmpny_id'] = $cmpny_id;
					$create_role = UserRole::create($r_create);
			}
			
			foreach($query_type as $type_key=>$type)
			{
				$type_id = QueryTypes::updateOrCreate(
				[
					'query_type' => $type,
					'cmpny_id' => $cmpny_id,
				],
				[
					'cmpny_id' => $cmpny_id,
					'query_type' => $type,
					'type' 		=> (($type == 'Followup')? config('constant.FOLLOWUPS'): config('constant.TICKET')), 
					'created_by'	=> config('constant.ORICOM_ADMIN'),
					'updated_by'	=> config('constant.ORICOM_ADMIN'),
				])->id;
				
				/**** Query-Status Details ****/
							
				foreach($query_status as $stat_key=>$stat)
				{ 
					$stat_id = QueryStatus::updateOrCreate(
					[
						'name' => $stat,
						'cmpny_id' => $cmpny_id,
					],
					[
						'cmpny_id' => $cmpny_id,
						'name' => $stat,
						'is_close' => (($stat == 'Closed')? config('constant.IS_CLOSE'): config('constant.NOT_CLOSE')),
						'status' => (($stat == 'Re-open')? config('constant.INACTIVE'): config('constant.ACTIVE')),
						'created_by'	=> config('constant.ORICOM_ADMIN'),
						'updated_by'	=> config('constant.ORICOM_ADMIN'),
					])->id; 
					
					if($stat_key == 1)
					{
						$cmp_meta	= CompanyMeta::updateOrCreate(
						[
							'meta_name'	=> 'open_status',
							'cmpny_id' => $cmpny_id,
						],[
							'cmpny_id' => $cmpny_id,
							'meta_name'	=> 'open_status',
							'meta_value'	=> $stat_id,
							'created_by'	=> config('constant.ORICOM_ADMIN'),
							'updated_by'	=> config('constant.ORICOM_ADMIN'),
						]);
						$cmp_meta	= CompanyMeta::updateOrCreate(
						[
							'meta_name'	=> 're_open_status',
							'cmpny_id' => $cmpny_id,
						],[
							'cmpny_id' => $cmpny_id,
							'meta_name'	=> 're_open_status',
							'meta_value'	=> $stat_id,
							'created_by'	=> config('constant.ORICOM_ADMIN'),
							'updated_by'	=> config('constant.ORICOM_ADMIN'),
						]);
					}
					if($stat_key == 2)
					{
						$cmp_meta	= CompanyMeta::updateOrCreate(
						[
							'meta_name'	=> 'after_re_open',
							'cmpny_id' => $cmpny_id,
						],[
							'cmpny_id' => $cmpny_id,
							'meta_name'	=> 'after_re_open',
							'meta_value'	=> $stat_id,
							'created_by'	=> config('constant.ORICOM_ADMIN'),
							'updated_by'	=> config('constant.ORICOM_ADMIN'),
						]);
					}
					
					$status = QueryStatusRelation::updateOrCreate(
					[
					    'cmpny_id' => $cmpny_id,
						'query_type_id' => $type_id,
						'query_status_id' => $stat_id,
					],[
						'cmpny_id' => $cmpny_id,
						'query_type_id' => $type_id,
						'query_status_id' => $stat_id,
						'created_by'	=> config('constant.ORICOM_ADMIN'),
						'updated_by'	=> config('constant.ORICOM_ADMIN'),
					]);
				}	
							/**** Query-Category Details ****/
				
				foreach($query_category as $cat_key=>$cat)
				{
					$catid = FaqCategories::updateOrCreate(
					[
						'category_name' => $cat,
						'cmpny_id' => $cmpny_id,
					],
					[
						'cmpny_id' => $cmpny_id,
						'category_name' => $cat,
						'created_by'	=> config('constant.ORICOM_ADMIN'),
						'updated_by'	=> config('constant.ORICOM_ADMIN'),
					])->id;
					
					if($type == 'Followup' && $cat != 'Security'){
						
						$stats = QueryCategoryRelation::updateOrCreate(
						[
							'cmpny_id' => $cmpny_id,
							'query_type_id' => $type_id,
							'category_id' => $catid,
						],
						[
							'cmpny_id' => $cmpny_id,
							'query_type_id' => $type_id,
							'category_id' => $catid,
							'created_by'	=> config('constant.ORICOM_ADMIN'),
							'updated_by'	=> config('constant.ORICOM_ADMIN'),
						]);
					}
					else if($type != 'Followup' && ($cat == 'Registration' || $cat == 'Security')){
						
						$statuss = QueryCategoryRelation::updateOrCreate(
						[
							'cmpny_id' => $cmpny_id,
							'query_type_id' => $type_id,
							'category_id' => $catid,
						],
						[
							'cmpny_id' => $cmpny_id,
							'query_type_id' => $type_id,
							'category_id' => $catid,
							'created_by'	=> config('constant.ORICOM_ADMIN'),
							'updated_by'	=> config('constant.ORICOM_ADMIN'),
						]);
					}
					
					else{} 
				}            
			} 
			$current_time = Carbon::now()->toDateTimeString();

			$tab_data=array('cmpny_id' => $cmpny_id,'name' => 'Basic Details','type' => 3,'status'=>config('constant.ACTIVE'),'sort_order'=>0);

			
			
					
			$tab_result = Tab::Create($tab_data);
			$tabid = $tab_result->id;
			$data = array(
					array('cmpny_id' => $cmpny_id,'field_name' => 'first_name','type' => 1,'required' => 2,'label' => 'First Name','report_field' => 1,'is_unique' => 2,'field_id' => 1,'status' => config('constant.ACTIVE'),'created_by'=> config('constant.ORICOM_ADMIN'),'updated_by' => config('constant.ORICOM_ADMIN'),'created_at'=>$current_time,'updated_at'=>$current_time,'tab_id'=>$tabid,'field_type'=>1),

					array('cmpny_id' => $cmpny_id,'field_name' => 'middle_name','type' => 1,'required' => 2,'label' => 'Middle Name','report_field' => 2,'is_unique' => 2,'field_id' => 7,'status' => config('constant.ACTIVE'),'created_by' => config('constant.ORICOM_ADMIN'),
				    'updated_by' => config('constant.ORICOM_ADMIN'),'created_at'=>$current_time,'updated_at'=>$current_time,'tab_id'=>$tabid,'field_type'=>1),

					array('cmpny_id' => $cmpny_id,'field_name' => 'last_name','type' => 1,'required' => 2,'label' => 'Last Name','report_field' => 2,'is_unique' => 2,'field_id' => 2,'status' => config('constant.ACTIVE'),'created_by' => config('constant.ORICOM_ADMIN'),
				    'updated_by' => config('constant.ORICOM_ADMIN'),'created_at'=>$current_time,'updated_at'=>$current_time,'tab_id'=>$tabid,'field_type'=>1),
					
					array('cmpny_id' => $cmpny_id,'field_name' => 'email','type' => 1,'required' => 2,'label' => 'Email','report_field' => 1,'is_unique' => 1,'field_id' => 3,'status' => config('constant.ACTIVE'),'created_by' => config('constant.ORICOM_ADMIN'),'updated_by' => config('constant.ORICOM_ADMIN'),'created_at'=>$current_time,'updated_at'=>$current_time,'tab_id'=>$tabid,'field_type'=>4),
					
					array('cmpny_id' => $cmpny_id,'field_name' => 'mobile','type' => 1,'required' => 1,'label' => 'Mobile',
					'report_field' => 1,'is_unique' => 1,'field_id' => 4,'status' => config('constant.ACTIVE'),'created_by' => config('constant.ORICOM_ADMIN'),'updated_by' => config('constant.ORICOM_ADMIN'),'created_at'=>$current_time,'updated_at'=>$current_time,'tab_id'=>$tabid,'field_type'=>3),
					
					array('cmpny_id' => $cmpny_id,'field_name' => 'address','type' => 1,'required' => 2,'label' => 'Address','report_field' => 2,'is_unique' => 2,'field_id' => 6,'status' => config('constant.ACTIVE'),'created_by' => config('constant.ORICOM_ADMIN'),'updated_by' => config('constant.ORICOM_ADMIN'),'created_at'=>$current_time,'updated_at'=>$current_time,'tab_id'=>$tabid,'field_type'=>8),

					array('cmpny_id' => $cmpny_id,'field_name' =>'profile_status','type' => 1,'required' => 2,'label' => 'Profile Status','report_field' => 2,'is_unique' => 2,'field_id' => 17,'status' => config('constant.ACTIVE'),'created_by' => config('constant.ORICOM_ADMIN'),'updated_by' => config('constant.ORICOM_ADMIN'),'created_at'=>$current_time,'updated_at'=>$current_time,'tab_id'=>$tabid,'field_type'=>NULL),
					
					array('cmpny_id' => $cmpny_id,'field_name' =>'source','type' => 1,'required' => 2,'label' => 'Lead Source','report_field' => 2,'is_unique' => 2,'field_id' => 18,'status' => config('constant.ACTIVE'),'created_by' => config('constant.ORICOM_ADMIN'),'updated_by' => config('constant.ORICOM_ADMIN'),'created_at'=>$current_time,'updated_at'=>$current_time,'tab_id'=>$tabid,'field_type'=>NULL),


					array('cmpny_id' => $cmpny_id,'field_name' =>'hide_details','type' => 1,'required' => 2,'label' => 'Hide Profile Details','report_field' => 2,'is_unique' => 2,'field_id' => 17,'status' => config('constant.ACTIVE'),'created_by' => config('constant.ORICOM_ADMIN'),'updated_by' => config('constant.ORICOM_ADMIN'),'created_at'=>$current_time,'updated_at'=>$current_time,'tab_id'=>$tabid,'field_type'=>NULL)
				);
					
			$fields = CustomerProfileField::insert($data);
			
			
		}
		return 1;
	}
	
	/**
    * Notifications entry to ori_notifications table
    * @author RINKU.E.B.
    * @date 20/11/2018
    * @return 
   */
   public static function add_notifications($user_id,$title,$comment,$link,$created_by,$flag,$cmpny_id='')
   {
	   if(isset($cmpny_id) && !empty($cmpny_id))
	   {
		   $company = $cmpny_id;
	   }
	   else
	   {
		   if(isset(Auth::user()->cmpny_id))
		   {
			   $company = Auth::user()->cmpny_id;
		   }
		   else
		   {
			  $company = NULL; 
		   }
		   
	   }
	    $ins_arr = array(
			  'cmpny_id' => $company,
			  'title' => $title,
			  'comment' => $comment,
			  'link' => $link,
			  'download_flag' => $flag,
			  'created_by' => $created_by,
			  'created_at' => date('Y-m-d h:i:s'),
			  'updated_at' => date('Y-m-d h:i:s')
			  );
		$results = NotificationsList::firstOrCreate($ins_arr);
		$arr = array(
			'cmpny_id' => $company,
			'user_id' => $user_id,
			'notification_id' => $results->id,
			'status' => config('constant.INACTIVE'),
			'created_by' => $created_by,
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s'),
			);
		NotificationsRolesRelations::firstOrCreate($arr);
			  
   }
   
   /**
     * Auto dial schedule list in drop down
     * @author RINKU.E.B.
     * @date 22/11/2018
     * @since version 1.0.0
    */
    public static function get_autodial_schedule()
    {
        $currentdate = date('Y-m-d');
        $schedules   =   AutodialSchedules::select('id','name','daytime_init','daytime_end')
                    ->where('status',config('constant.ACTIVE'))
                    ->where('datetime_init','<=', $currentdate)
                    ->where('datetime_end','>=', $currentdate)
                    ->get();    
        if(count($schedules)>0)
		{
			foreach($schedules as $data)
			{
				echo "<option value='".$data->id."'>".$data->name." (".$data->daytime_init."-".$data->daytime_end.")</option>";
			}
		}
    }
	/**
     * query type in drop down
     * @author RINKU.E.B.
     * @date 23/11/2018
     * @since version 1.0.0
    */
    public static function get_query_type($type=null)
	{
		$type = (int)$type;
		$query_types = QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('sort_order')->select('query_type', 'id','type');
		if (!empty($type))
		{
			$query_types->where('ori_mast_query_type.type', $type);
		}
		$query_types = $query_types->get();
		if(count($query_types)>0)
		{
			foreach($query_types as $data)
			{
				echo "<option value='".$data->id."'>".$data->query_type."</option>";
			}
		}
	}
	
	/**
     * query type in drop down
     * @author RINKU.E.B.
     * @date 24/11/2018
     * @since version 1.0.0
    */
    public static function get_priority()
	{
		$priorities = Priority::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('sort_order')->select('id','name')->get();
		 if(count($priorities)>0)
		{
			foreach($priorities as $data)
			{
				echo "<option value='".$data->id."'>".$data->name."</option>";
			}
		}
	}
	
	
	/**
     * query category in drop down
     * @author RINKU.E.B.
     * @date 25/11/2018
     * @since version 1.0.0
    */
    public static function get_query_category()
	{
		$set_manual_call_query_type = Helpers::get_company_meta('set_manual_call_query_type');
		if(isset($set_manual_call_query_type) && !empty($set_manual_call_query_type))
		{
		$results =  FaqCategories::select('ori_mast_faq_categories.category_name', 'ori_mast_faq_categories.id')
		->join('ori_mast_query_category_relation', 'ori_mast_query_category_relation.category_id', '=', 'ori_mast_faq_categories.id')
		->where('ori_mast_query_category_relation.cmpny_id',Auth::user()->cmpny_id)
		->where('ori_mast_query_category_relation.query_type_id',$set_manual_call_query_type)
		->where('ori_mast_faq_categories.cmpny_id',Auth::user()->cmpny_id)
		->whereNull('ori_mast_faq_categories.parent_category_id')
		->orderBy('ori_mast_faq_categories.category_name')
		->get();
		if(count($results)>0)
		{
			foreach($results as $data)
			{
				echo "<option value='".$data->id."'>".$data->category_name."</option>";
			}
		}
		}
	}
	
	/**
     * get campaign source from a campaign_id
     * @author RINKU.E.B.
     * @date 27/11/2018
     * @since version 1.0.0
    */
	public static function get_campaign_source($campaign_id,$cmpny_id)
	{
		$source_res = CampaignMeta::select('source_id')->where('campaign_id',$campaign_id)->where('cmpny_id',$cmpny_id)->first();
		if($source_res)
		{
			$source = $source_res->source_id;
			echo $source;
		}
		else
		{
			echo 0;
		}
		
	}
	
	/* 
     * @author          RINKU.E.B.
     * @since           Version 1.0
     * Date:            27/11/2018 
     * Description:     Sending push notification
    */
    
    public static function sending_push_notification($cmpny_id,$fcm_id,$message,$title,$authentication)
    {
           
		if(!empty($fcm_id) && !empty($message))
		{
			foreach ($fcm_id as  $fid) 
			{
				$arr = array(
						'title' => $title,
						'body' => $message,
						'sound' => "default",
						'click_action' => "FCM_PLUGIN_ACTIVITY",
						);

                            $url = 'https://fcm.googleapis.com/fcm/send';
                            $fields = array(
                            "to"=>$fid,
							"notification" => $arr,
							"priority"=>"high",
							"restricted_package_name"=>"",
                            );
				
				/*$headers = array('Content-Type:application/json',
'Authorization:key=AAAAwVMaAlU:APA91bGJ4Ns9wP3bQbBMYOOcSK2HycmpCSTGytHvBar74UlVkjiCcWcU4N5fJLBixgRwiEJpBpiAe3uloYihFd4Zu09o0Brf63NnwfKlwwNYsZn4J3HGMsnMA4YGiNh2ziMZPsG-xvWE');*/

$push_key = Helpers::get_company_meta('push_key',$cmpny_id);
$headers = array('Content-Type:application/json',
'Authorization:key='.$push_key);
					 
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
						$result = curl_exec($ch);  
						if ($result === FALSE) {
							die('Curl failed: ' . curl_error($ch));
						}
						curl_close($ch);
						echo $result;
			}
			   
		}
            
    }
	
	/*
	 * @author     RINKU.E.B.
     * @since      Version 1.0
     * Date:       27/11/2018 
     * Description:   map responce code from provider to crm status code
	*/
	public static function sms_response_code_mapping($error='')
	{
		if($error==0 || $error == '0' || $error == '000')
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['DELIVERED'];
                }
                else if($error== 1 || $error == '1' || $error == '001')
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['INVALID_NUMBER'];
                }
                else if($error== 2 || $error == '2' || $error == '002')
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['ABSENT_SUBSCRIBER'];
                }
                else if($error== 3 || $error == '3' || $error == '003')
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['MEMORY_EXCEEDED'];
                }
                else if($error== 4 || $error == '4' || $error == '004')
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['MOBILE_EQUIPMENT_ERROR'];
                }
                else if($error== 5 || $error == '5' || $error == '005')
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['NETWORK_ERROR'];
                }
                else if($error== 6 || $error == '6' || $error == '006')
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['BARRED'];
                }
                else if($error== 7 || $error == '7' || $error == '007')
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['INVALID_SENDER_ID'];
                }
                else if($error== 9 || $error == '9' || $error == '009')
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['NDNC_FAILURE'];
                }
                else if($error== 10 || $error == '10' || $error == '100')
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['UNKNOWN_ERROR'];
                }
                else 
                {
                    $current_status = config('constant.SMS_DELIVERY_STATUS')['MOVED'];
                }
                return $current_status;
	}
	/*
    * @random string generator
    * @author AKHIL MURUKAN
    * @date 04/12/2018
    * @since version 1.0.0
    * @param NULL
    */ 
	
	static function random_string($type = 'alnum', $len = 8)
	{
		switch ($type)
		{
			case 'basic':
				return mt_rand();
			case 'alnum':
			case 'numeric':
			case 'nozero':
			case 'alpha':
				switch ($type)
				{
					case 'alpha':
						$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'alnum':
						$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'numeric':
						$pool = '0123456789';
						break;
					case 'nozero':
						$pool = '123456789';
						break;
				}
				return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
			case 'unique': // todo: remove in 3.1+
			case 'md5':
				return md5(uniqid(mt_rand()));
			case 'encrypt': // todo: remove in 3.1+
			case 'sha1':
				return sha1(uniqid(mt_rand(), TRUE));
		}
	}
	

	/**
     * query status in drop down except open status
     * @author RINKU.E.B.
     * @date 07/12/2018
     * @since version 1.0.0
    */
    public static function get_query_status()
	{
		$query_status = QueryStatus::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('sort_order')->select('name', 'id')->get();
		$cmpny_id = Auth::User()->cmpny_id;
		$status_id = Helpers::get_company_meta('open_status',$cmpny_id);
		if(count($query_status)>0)
		{
			foreach($query_status as $data)
			{
				if($status_id != $data->id)
				{
					echo "<option value='".$data->id."'>".$data->name."</option>";
				}
				
			}
		}
	}
    	/**
     * @author AKHIL MURUKAN
     * @date 10/01/2019
     * @since version 1.0.0
    */
    public static function get_role_name($id)
	{
		$role_name = UserRole::select('role')->where('id',$id)->first();
		
		if(isset($role_name->role) && !empty($role_name->role))
		{
			echo $role_name->role;
		}
		else
		{
			echo "";
		}
	}
	/**
     * get initial stage for specific department
     * @author RINKU.E.B.
     * @date 09/01/2019
     * @since version 1.0.0
    */
	public static function initial_stage_department($cmpny_id,$department)
	{
		$results = AutomatedProcess::select('id')->where('cmpny_id',$cmpny_id)->where('is_first',config('constant.ACTIVE'))->where('department',$department)->first();
		if($results)
		{
			$stage_id = $results->id;
			echo $stage_id;
		}
	}
	/**
     * get_location_details
     * @author RESHMA
     * @date 09/01/2019
     * @since version 1.0.0
    */
	public static function get_location_details($formid,$id)
	{
		if($formid == '#form-profile' || $formid == '#enquiry_form')
        {
            $details=CustomerProfile::find($id);
        }else if($formid == '#frm_reg_edit')
		{
			$details=User::find($id);
		}
		else{
        	$details=[];
        }
        return $details;
	}
	/**
     * @author PRANEESHA KP
     * @date 16/01/2019
     * @since version 1.0.0
    */
	public static function unique_random($table, $col, $chars = 16){

        $unique = false;
		$tested = [];

        do{
			// Generate random string of characters
            $random = str_random($chars);
			// Check if it's already testing
            // If so, don't query the database again
            if( in_array($random, $tested) ){
                continue;
            }
			// Check if it is unique in the database
            $count = DB::table($table)->where($col, '=', $random)->count();
			$tested[] = $random;

            // String appears to be unique
            if( $count == 0){
                $unique = true;
            }

            // If unique is still false at this point
            // it will just repeat all the steps until
            // it has generated a random string of characters

        }
        while(!$unique);
		return $random;
    }
	
		/**
    * Auto process channel display in listing page
    * @author RINKU.E.B
    * @date 13/11/2018
    * @return 
    */
	public static function get_auto_process_department($id)
	{
		$departments = FaqCategories::select('category_name')->where('cmpny_id',Auth::User()->cmpny_id)->where('id',$id)->first();
		if($departments)
		{
			echo $departments->category_name;
		}
		
	}
	/**
     * number of mail server hosts saved in company meta
     * @author RINKU.E.B.
     * @date 31/01/2019
     * @since version 1.0.0
    */
    public static function get_host_count()
	{
		$host_count = CompanyMeta::where('meta_name','like','mail_server_host_%')->count();
		return $host_count;
	}
	
	/**
     * department in drop down
     * @author RINKU.E.B.
     * @date 01/02/2018
     * @since version 1.0.0
    */
    public static function get_department()
	{
		$departments = FaqCategories::whereNull('parent_category_id')->where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->select('category_name', 'id','type')->get();
		$dept = '';
		if(count($departments)>0)
		{
			$dept .= '<option value="">Select Department</option>';
			foreach($departments as $data)
			{
				if(!empty($data->category_name))
				{
					$category_name  = preg_replace('/[^a-zA-Z0-9_ -]/s','',$data->category_name);
					$dept .= '<option value="'.$data->id.'">'.$category_name.'</option>';
				}
				
			}
			echo $dept;
		}
	}
	/**
     * designation in drop down
     * @author RINKU.E.B.
     * @date 01/02/2018
     * @since version 1.0.0
    */
    public static function get_designation()
	{
		$designations = Designations::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('sort_order')->select('designation', 'id')->get();
		$desg = '';
		if(count($designations)>0)
		{
			$desg .= '<option value="">Select Designation</option>';
			foreach($designations as $data)
			{
				if(!empty($data->designation))
				{
					$designation  = preg_replace('/[^a-zA-Z0-9_ -]/s','',$data->designation);
					$desg .= '<option value="'.$data->id.'">'.$designation.'</option>';
				}
			}
			echo $desg;
		}
	}
	
	/**
     * get a template content from id
     * @author RINKU.E.B.
     * @date 13/02/2019
     * @since version 1.0.0
    */
	public static function get_template_content($id)
	{
		$results = Templates::select('content')->where('id',$id)->first();
		if($results)
		{
			return $results->content;
		}
	}
	/**
     * Docket number generation
     * @author Elavarasi.S
     * @date 19/02/2019
     * @since version 1.0.0
    */
	public static function generate_doc_no($type = null, $query_type_id = null, $cat_id = null)
	{
		$doc_cmpny_name = Helpers::get_company_meta('doc_cmpny_name',Auth::user()->cmpny_id);
    	$doc_short_code = Helpers::get_company_meta('doc_short_code',Auth::user()->cmpny_id);
    	$doc_date_format = Helpers::get_company_meta('doc_date_format',Auth::user()->cmpny_id);
    	$doc_number_format = Helpers::get_company_meta('doc_number_format',Auth::user()->cmpny_id);
    	$doc_no_of_digits = Helpers::get_company_meta('doc_no_of_digits',Auth::user()->cmpny_id);
    	$doc_separator = Helpers::get_company_meta('doc_separator',Auth::user()->cmpny_id);
    	$doc_no_of_digits = $doc_no_of_digits ?? 8; 
    	$doc_separator = $doc_separator ?? "/"; 

    	$docket = '';
    	if($doc_cmpny_name != ''){ $docket .= $doc_cmpny_name.$doc_separator; }
    	if($doc_short_code != ''){ 
    		if($doc_short_code == 'query_type' AND $query_type_id != null){
    			$query_type = QueryTypes::find($query_type_id);
    			if($query_type->short_code != ''){
	    			$docket .= $query_type->short_code.$doc_separator; 
    			}
    		}elseif($doc_short_code == 'category' AND $cat_id != null){
    			$cat = FaqCategories::find($cat_id);
    			if($cat->short_code != ''){
	    			$docket .= $cat->short_code.$doc_separator; 
	    		}
    		}
    	}
    	if($doc_date_format != ''){ 
    		$docket .= date($doc_date_format).$doc_separator; 
    	}
    	if($doc_number_format != ''){ 
    		if($doc_number_format == 'numeric_order'){
    			if($type == "ticket"){
    				$num = Helpdesk::select('id')->where('cmpny_id',Auth::user()->cmpny_id)->orderBy('id','desc')->first();
    			}else{
    				$num = LeadFollowup::select('id')->where('cmpny_id',Auth::user()->cmpny_id)->orderBy('id','desc')->first();
    			}
				if(!$num){	$id_num = 1; }else{	$id_num = $num->id+1; }
				$final_no = str_repeat('0',($doc_no_of_digits-(int)strlen($id_num))).$id_num;
				$docket .= $final_no;
    		}elseif($doc_number_format == 'rand'){
	    		$docket .= rand();
    		} 
    	}

    	if($docket == ''){ $docket = rand(); }
    	return $docket;
	}
		/*
	 * @author     RINKU.E.B
     * @since      Version 1.0
     * Date:       10/11/2018 
     * Description: automated process actions function with customer id and process id for expiry time
	*/
	public static function auto_process_action_customer($cmpny_id,$id,$customer_id,$auto_id)
	{
		$process = AutomatedProcessCustomer::where('id',$auto_id)->where('cmpny_id',$cmpny_id)->first();
		$action = explode(",",$process->action);
		$content_id = explode(",",$process->content);
		$category = $process->category;
		$faq_category = $process->faq_category;
		$query_type = $process->query_type;
		$priority = $process->priority;
		$customer_nature = $process->customer_nature;
		$query_status = $process->query_status;
		$lead_source_id = $process->lead_source_id;
		$action_time = $process->action_time;
		$process_type = $process->process_type;
		$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';
		$req_title = $process->process_name;
		$random_code = str_random(12);
		$set_crm_automation_source = Helpers::get_company_meta('set_crm_automation_source',$cmpny_id);
		for($i=0;$i<count($action);$i++)
		{
		$content_results = Templates::where('id',$content_id[$i])->where('cmpny_id',$cmpny_id)->first();
		if($content_results)
		{
			$content = $content_results->content;
			$subject = $content_results->subject;
			$replc_result = AutomatedProcessRelationsCustomer::select('mail_field')->where('id',$id)->where('cmpny_id',$cmpny_id)->first();
			if($replc_result)
			{
				$replacements = json_decode($replc_result->mail_field,true);
				if(isset($replacements) && !empty($replacements))
				{
				foreach($replacements as $key=>$value)
				{
					$content = str_replace($key, $value, $content);
				}
				}
			}
		}
		else
		{
			if(($action[$i] == config('constant.CH_SMS'))||($action[$i] == config('constant.CH_EMAIL')))
			{
			$content_missing_mail = Helpers::get_company_meta('content_missing_mail',$cmpny_id);
			if(!empty($content_missing_mail))
			{
			$cmp_emails = Templates::where('id',$content_missing_mail)->where('cmpny_id',$cmpny_id)->first();
			if($cmp_emails)
			{
				$content = $cmp_emails->content;
				$subject = $cmp_emails->subject;
				$content = str_replace('[[ Auto_process ]]', $req_title, $content);
				$content = str_replace('[[ Auto_process_id ]]', $auto_id, $content);
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
				$mail_arr = CommonSmsEmail::Create(
												[
												'authentication' => '',
												'cmpny_id' => $cmpny_id,
												'source' => $set_crm_automation_source,
												'email' => config('constant.AUTO_PROCESS_FAILURE_MAILID'),
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
												'created_at' => date('Y-m-d H:i:s'),
												'auto_process_id' => $auto_id,
											   ]);
			}
			}
				$time_results = AutomatedProcessCustomer::select('action_time','expiry_time')->where('id',$auto_id)->where('cmpny_id',$cmpny_id)->first();
				$action_time = $time_results->action_time;
				$expiry_time = $time_results->expiry_time;		
				$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';
				$expiry_time = date("Y-m-d H:i", strtotime('+'.$expiry_time.' minutes')).':00';
				$upd = array(
				'auto_process_id' => $auto_id,
				'action_created_time' => date('Y-m-d H:i:s'),
				'action_time' => $action_time,
				'action_expiry_time' => $expiry_time
				);
				AutomatedProcessRelationsCustomer::where('id',$id)->where('cmpny_id',$cmpny_id)->update($upd);
				AutomatedProcessLogCustomer::firstOrCreate([
													'customer_id'=>$customer_id,
													'cmpny_id'=>$cmpny_id,
													'auto_process_id'=>$auto_id,
													'action_created_time' => date('Y-m-d H:i:s'),
													'action_time' => $action_time,
													'action_expiry_time' => $expiry_time,
													'created_at' => date('Y-m-d H:i:s'),
													]);	
		}
		}
		$email = '';
		$mobile = '';
		$country_code = '';
		$subscription_status = config('constant.ACTIVE');
		//$data = cc_customer_profile::select('email','mobile','subscription_status','country_code')->where('id',$customer_id)->withTrashed()->first();
		$data=CustomerProfile::with('profile_details')->where('id',$customer_id)->where('cmpny_id',$cmpny_id)->withTrashed()->first();
		if($data)
		{
			if(isset($data->email) && !empty($data->email))
			{
				$email = $data->email;
			}
			if(isset($data->mobile) && !empty($data->mobile))
			{
				$mobile = $data->mobile;
			}
			if(isset($data->country_code) && !empty($data->country_code))
			{
				$country_code = $data->country_code;
			}
			
		}
		//echo $action;
		$buffer = 'notsent';
		$mail_ref_id = str_random(15);
		if($action[$i] == config('constant.CH_SMS'))
		{	if($content_results)
			{
			if(!empty($mobile))
			{
				if(isset($country_code)&&!empty($country_code))
				{
					$mobile = $country_code.$mobile;
				}
				/* if(strlen($mobile)>8 )
				{
                    $mobile = communication_Helpers::sanitize_uae_number($mobile);
				} */
                //$sms_channel = Helpers::get_smsgateway_countrycode($mobile);
			$sms_arr = CommonSmsEmail::Create([
												'authentication' => '',
												'cmpny_id' => $cmpny_id,
												'source' => $set_crm_automation_source,
												'mobile' => $mobile,
												'customer_id' => $customer_id,
												'sent_type' => config('constant.CH_SMS'),
												'sms_type' => config('constant.TRANSACTION'),
												'response' => $buffer,
                                                //'sms_channel' => $sms_channel,
												'mail_response' => '',
                                                'mail_ref_id' => $mail_ref_id,
												'random_code' => $random_code,
												'content' => $content,
												'subject' => $subject,
												'email_cc' => '',
												'communication_type' => $process_type,											
												'status' => config('constant.INACTIVE'),
												'created_by' => 0,
												'updated_by' => 0,
												'created_at' => date('Y-m-d H:i:s'),
												'auto_process_id' => $auto_id,
											]);
											
						if($category == config('constant.AUTO_PROCESS_MAIL_SMS_OPEN_CATEGORY'))
						{
							$arr = array(
							'field3' => $sms_arr->id,
							);
							AutomatedProcessRelationsCustomer::where('id',$id)->where('cmpny_id',$cmpny_id)->update($arr);
						}
			}
			else
			{
				/////////// AUTOMATED PROCESS CODES STARTS HERE ////////////
				$response = config('constant.AUTO_PROCESS_RESPONSE_NEGATIVE');
				$flag = null;
				Helpers::auto_process_updation_customer($cmpny_id,$customer_id,$response,$flag);
				/////////// AUTOMATED PROCESS CODES ENDS HERE ////////////
			}
			}
		}
		else if($action[$i] == config('constant.CH_EMAIL'))
		{ 
			if($content_results)
			{ 
			if(!empty($email))
			{
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
				
				$mail_arr = CommonSmsEmail::Create(
												[
												'authentication' => '',
												'cmpny_id' => $cmpny_id,
												'source' => $set_crm_automation_source,
												'email' => $email,
												'customer_id' => $customer_id,
												'sent_type' => config('constant.CH_EMAIL'),
												'response' => $buffer,
												'mail_response' => '',
												'random_code' => $random_code,
												'content' => $content,
												'subject' => $subject,  
												'email_cc' => '',   
												'status' => config('constant.INACTIVE'),
												'communication_type' => $process_type,
												'created_by' => 0,
												'updated_by' => 0,
												'created_at' => date('Y-m-d H:i:s'),
												'auto_process_id' => $auto_id,
											   ]);
											   
						if($category == config('constant.AUTO_PROCESS_MAIL_SMS_OPEN_CATEGORY'))
						{
							$arr = array(
							'field4' => $mail_arr->id,
							);
							AutomatedProcessRelationsCustomer::where('id',$id)->where('cmpny_id',$cmpny_id)->update($arr);
						}
				
				
			}
			else
			{
				/////////// AUTOMATED PROCESS CODES STARTS HERE ////////////
				$response = config('constant.AUTO_PROCESS_RESPONSE_NEGATIVE');
				$flag = null;
				Helpers::auto_process_updation_customer($cmpny_id,$customer_id,$response,$flag);
				/////////// AUTOMATED PROCESS CODES ENDS HERE ////////////
			}
			}
		}
		else if($action[$i] == config('constant.CH_MANUAL_CALL'))
		{	
			//if(count($content_results)>0)
			//{
			if(!empty($mobile))
			{	
					$call_arr = LeadFollowup::Create(
											   [
										 		'docket_number' => str_random(5),
												'customer_id' => $customer_id,
												'cmpny_id' => $cmpny_id,
												'remainder_date' => $action_time,
												'req_title' => $req_title,
												'query_category' => $faq_category,
												'query_type' => $query_type,
												'priority' => $priority,
												'customer_nature' => $customer_nature,
												'query_status' => $query_status,
												'status' => config('constant.ACTIVE'),
												//'lead_source_id' => $set_crm_automation_source,
												'outbound_calls' => config('constant.ACTIVE'),
												'created_by' => 0,
												'updated_by' => 0,
												'created_at' => date('Y-m-d H:i:s'),
											   ]);
					if($category == config('constant.AUTO_PROCESS_MAIL_SMS_OPEN_CATEGORY'))
						{
							$arr = array(
							'field5' => $call_arr->id,
							);
							AutomatedProcessRelationsCustomer::where('id',$id)->where('cmpny_id',$cmpny_id)->update($arr);
						}							   
						
			}
			else
			{
				/////////// AUTOMATED PROCESS CODES STARTS HERE ////////////
				$response = config('constant.AUTO_PROCESS_RESPONSE_NEGATIVE');
				$flag = null;
				Helpers::auto_process_updation_customer($cmpny_id,$customer_id,$response,$flag);
				/////////// AUTOMATED PROCESS CODES ENDS HERE ////////////
			}
			//}
		}
		else if($action[$i] == config('constant.CH_AUTODIAL'))
		{	
			if($content_results)
			{
			if(!empty($mobile))
			{
				if(isset($country_code)&&!empty($country_code))
				{
					$mobile = $country_code.$mobile;
				}
				/* if(strlen($mobile)>8 )
				{
                    $mobile = communication_Helpers::sanitize_uae_number($mobile);
				} */
                //$sms_channel = Helpers::get_smsgateway_countrycode($mobile);
			$sms_arr = CommonSmsEmail::Create([
												'authentication' => '',
												'cmpny_id' => $cmpny_id,
												'source' => $set_crm_automation_source,
												'mobile' => $mobile,
												'customer_id' => $customer_id,
												'sent_type' => config('constant.CH_AUTODIAL'),
												'response' => $buffer,
                                                //'sms_channel' => $sms_channel,
												'mail_response' => '',
                                                'mail_ref_id' => $mail_ref_id,
												'random_code' => $random_code,
												'content' => $content,
												'subject' => $subject,
												'email_cc' => '',
												'communication_type' => $process_type,											
												'status' => config('constant.INACTIVE'),
												'created_by' => 0,
												'updated_by' => 0,
												'created_at' => date('Y-m-d H:i:s'),
												'auto_process_id' => $auto_id,
											]);
											
			}
			else
			{
				/////////// AUTOMATED PROCESS CODES STARTS HERE ////////////
				$response = config('constant.AUTO_PROCESS_RESPONSE_NEGATIVE');
				$flag = null;
				Helpers::auto_process_updation_customer($cmpny_id,$customer_id,$response,$flag);
				/////////// AUTOMATED PROCESS CODES ENDS HERE ////////////
			}
			}
		}
		else if($action[$i] == config('constant.CH_PUSH_MESSAGES'))
		{
			if($content_results)
			{
			$fcm_results = CustomerFcms::where('customer_id',$customer_id)->where('cmpny_id',$cmpny_id)->first();
			if($fcm_results)
			{
					  CommonSmsEmail::Create(
                                            [
                                                'customer_id' => $customer_id,
												'cmpny_id' => $cmpny_id,
                                                'source' => $set_crm_automation_source,
                                                'sent_type' => config('constant.CH_PUSH_MESSAGES'),
                                                'response' => 'not sent',
												'subject' => $subject,
                                                'content' => $content,
                                                'status' => config('constant.INACTIVE'),
                                                'created_by' => 0,
                                                'updated_by' => 0,
                                                'created_at' => date('Y-m-d H:i:s'),
												'auto_process_id' => $auto_id,
                                            ]);
			}
			}
		}
		}
		
	}
	 
	/*
	 * @author     RINKU.E.B
     * @since      Version 1.0
     * Date:       10/11/2018 
     * Description: common helper for profile updation
	 * Note response will be positive response and the helper is being called from different functions
	*/
	
	public static function auto_process_updation_customer($cmpny_id,$id,$response,$flag)
	{
		
		$datas = AutomatedProcessRelationsCustomer::select('auto_process_id')->where('customer_id',$id)->where('cmpny_id',$cmpny_id)->get();
		if(count($datas)>0)
		{
		foreach($datas as $data)
		{
		$auto_id = $data->auto_process_id;
		$process = AutomatedProcessCustomer::where('id',$auto_id)->where('cmpny_id',$cmpny_id)->first();
		if($response == config('constant.AUTO_PROCESS_RESPONSE_NEGATIVE'))
		{
			$response_neg = $process->response_neg;
			if(isset($response_neg) && !empty($response_neg) && ($response_neg!=''))
			{
			if(is_numeric($response_neg))
			{
			$time_results = AutomatedProcessCustomer::select('action_time','expiry_time')->where('id',$response_neg)->where('cmpny_id',$cmpny_id)->first();
				$action_time = $time_results->action_time;
				$expiry_time = $time_results->expiry_time;		
				$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';
				$expiry_time = date("Y-m-d H:i", strtotime('+'.$expiry_time.' minutes')).':00';
				$arr = array(
							'auto_process_id' => $response_neg,
							'action_created_time' => date('Y-m-d H:i:s'),
							'action_time' => $action_time,
							'action_expiry_time' => $expiry_time
							);
				//cc_customer_profile::where('id',$id)->update($arr);
				
				AutomatedProcessRelationsCustomer::where('id',$flag)->where('cmpny_id',$cmpny_id)->update($arr);
				AutomatedProcessLogCustomer::firstOrCreate([
										'customer_id'=>$id,
										'cmpny_id'=>$cmpny_id,
										'auto_process_id'=>$response_neg,
										'action_created_time' => date('Y-m-d H:i:s'),
										'action_time' => $action_time,
										'action_expiry_time' => $expiry_time,
										'created_at'=> date('Y-m-d H:i:s'),
										]);	
			}
		}	
		}
		else
		{
			$response_pos = $process->response_pos;
			if(isset($response_pos) && !empty($response_pos) && ($response_pos!=''))
			{
			if(is_numeric($response_pos))
			{
				$time_results = AutomatedProcessCustomer::select('action_time','expiry_time','parent_id')->where('id',$response_pos)->where('cmpny_id',$cmpny_id)->first();
				$action_time = $time_results->action_time;
				$expiry_time = $time_results->expiry_time;		
				$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';
				$expiry_time = date("Y-m-d H:i", strtotime('+'.$expiry_time.' minutes')).':00';
				$arr = array(
							'auto_process_id' => $response_pos,
							'action_created_time' => date('Y-m-d H:i:s'),
							'action_time' => $action_time,
							'action_expiry_time' => $expiry_time
							);
				//cc_customer_profile::where('id',$id)->update($arr);
				$add_res = AutomatedProcessRelationsCustomer::where('customer_id',$id)->where('cmpny_id',$cmpny_id)->update($arr);
				$add_res = AutomatedProcessRelationsCustomer::select('id')->where('customer_id',$id)->where('cmpny_id',$cmpny_id)->first();
				
				AutomatedProcessLogCustomer::firstOrCreate([
										'customer_id'=>$id,
										'cmpny_id'=>$cmpny_id,
										'auto_process_id'=>$response_pos,
										'action_created_time' => date('Y-m-d H:i:s'),
										'action_time' => $action_time,
										'action_expiry_time' => $expiry_time,
										'created_at'=>date('Y-m-d H:i:s'),
										]);	
				/// CODE FOR EFFICIENCY FLAG UPDATION STARTS	
				/*$parent_id = '';				
				if(isset($time_results->parent_id) && !empty($time_results->parent_id))
				{
					$parent_id = $time_results->parent_id;
				}
				if(isset($add_res->id) && !empty($add_res->id))
				{
				$efficiency_array = CommonSmsEmail::select('batch_id','campaign_efficiency','id','goal_stage')->whereNull('campaign_efficiency')->where('auto_process_rel_id',$add_res->id)->where('customer_id',$id)->get();
				if(count($efficiency_array)>0)
				{
					foreach($efficiency_array as $effcient)
					{
						$cmn_id = $effcient->id;
						$b_id = $effcient->batch_id;
						$goal_stage = $effcient->goal_stage;
						if(isset($b_id) && !empty($b_id))
						{
							$stat = BatchProcess::select('status')->where('id',$b_id)->first();
							if($stat->status==config('constant.ACTIVE'))
							{
								if($goal_stage==$response_pos)
								{
								$cmp_array = array('campaign_efficiency'=>config('constant.ACTIVE'),'converted_process_parent_id'=>$parent_id,'converted_process_id'=>$response_pos,'goal_stage_date'=>date('Y-m-d H:i:s'));
								CommonSmsEmail::where('id',$cmn_id)->update($cmp_array);	
								}
							}
						}
						
						
					}
				}
				}*/
				/// CODE FOR EFFICIENCY FLAG UPDATION ENDS						
										
			}
			else
			{
				$response_arr = explode(",",$response_pos);
				foreach($response_arr as $res)
				{
					$res_array =  explode("-",$res);
					if($res_array[0]==$flag)
					{
						$response_pos = $res_array[1];
						$time_results = AutomatedProcessCustomer::select('action_time','expiry_time','parent_id')->where('id',$response_pos)->where('cmpny_id',$cmpny_id)->first();
							$action_time = $time_results->action_time;
							$expiry_time = $time_results->expiry_time;		
							$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';
							$expiry_time = date("Y-m-d H:i", strtotime('+'.$expiry_time.' minutes')).':00';
							$arr = array(
										'auto_process_id' => $response_pos,
										'action_created_time' => date('Y-m-d H:i:s'),
										'action_time' => $action_time,
										'action_expiry_time' => $expiry_time
										);
							//cc_customer_profile::where('id',$id)->update($arr);
							$add_res = AutomatedProcessRelationsCustomer::where('customer_id',$id)->where('cmpny_id',$cmpny_id)->update($arr);
							$add_res = AutomatedProcessRelationsCustomer::select('id')->where('customer_id',$id)->where('cmpny_id',$cmpny_id)->first();
							
							AutomatedProcessLogCustomer::firstOrCreate([
													'customer_id'=>$id,
													'cmpny_id'=>$cmpny_id,
													'auto_process_id'=>$response_pos,
													'action_created_time' => date('Y-m-d H:i:s'),
													'action_time' => $action_time,
													'action_expiry_time' => $expiry_time,
													'created_at'=>date('Y-m-d H:i:s')
													]);	
						/// CODE FOR EFFICIENCY FLAG UPDATION STARTS						
						/*$parent_id = '';				
						if(isset($time_results->parent_id) && !empty($time_results->parent_id))
						{
							$parent_id = $time_results->parent_id;
						}
						if(isset($add_res->id) && !empty($add_res->id))
						{
						$efficiency_array = CommonSmsEmail::select('batch_id','campaign_efficiency','id','goal_stage')->whereNull('campaign_efficiency')->where('auto_process_rel_id',$add_res->id)->where('customer_id',$id)->get();
						if(count($efficiency_array)>0)
						{
							foreach($efficiency_array as $effcient)
							{
								$cmn_id = $effcient->id;
								$b_id = $effcient->batch_id;
								$goal_stage = $effcient->goal_stage;
								if(isset($b_id) && !empty($b_id))
								{
									$stat = BatchProcess::select('status')->where('id',$b_id)->first();
									if($stat->status==config('constant.ACTIVE'))
									{
										if($goal_stage==$response_pos)
										{
										$cmp_array = array('campaign_efficiency'=>config('constant.ACTIVE'),'converted_process_parent_id'=>$parent_id,'converted_process_id'=>$response_pos,'goal_stage_date'=>date('Y-m-d H:i:s'));
										CommonSmsEmail::where('id',$cmn_id)->update($cmp_array);
										}
									}
								}
								
								
							}
						}
						}*/
						/// CODE FOR EFFICIENCY FLAG UPDATION ENDS								
													
					}
				}
			}
		}
		}
		
		}	
		}
	}
	/*
	 * @author     RINKU.E.B
     * @since      Version 1.0
     * Date:       10/11/2018 
     * Description: common helper for getting the action time and expiry time for an automated process id
	*/
	public static function auto_process_params_customer($cmpny_id,$customer_id,$auto_id)
	{	
		$results = AutomatedProcessCustomer::select('action_time','expiry_time')->where('id',$auto_id)->where('cmpny_id',$cmpny_id)->first();
		$action_time = $results->action_time;
		$expiry_time = $results->expiry_time;		
		$action_time = date("Y-m-d H:i", strtotime('+'.$action_time.' minutes')).':00';
		$expiry_time = date("Y-m-d H:i", strtotime('+'.$expiry_time.' minutes')).':00';
		$rel = AutomatedProcessRelationsCustomer::firstOrCreate(
										[
										'customer_id'=>$customer_id,
										'cmpny_id'=>$cmpny_id],
										['auto_process_id'=>$auto_id,
										'action_created_time'=>date('Y-m-d H:i:s'),
										'action_time'=>$action_time,
										'action_expiry_time'=>$expiry_time,
										]);	
		$log = AutomatedProcessLogCustomer::firstOrCreate(
										[
										'customer_id'=>$customer_id,
										'cmpny_id'=>$cmpny_id],
										['auto_process_id'=>$auto_id,
										'action_created_time'=>date('Y-m-d H:i:s'),
										'action_time'=>$action_time,
										'action_expiry_time'=>$expiry_time,
										'created_at'=>date('Y-m-d H:i:s'),
										]);
		
	}
   /*
	 * @author     RINKU.E.B
     * Date:       23/09/2019 
     * Description:     find channels of campaign
	*/
	
	public static function find_channels($id)
	{
		$list = CampaignBatch::select('channel_type')->where('campaign_id',$id)->distinct()->get();
		$items = '';
		foreach($list as $li)
		{
			if($li->channel_type == config('constant.CH_SMS'))
			{
				$items .= "SMS, ";
			}
			else if($li->channel_type == config('constant.CH_EMAIL'))
			{
				$items .= "EMAIL, ";
			}
			else if($li->channel_type == config('constant.CH_MANUAL_CALL'))
			{
				$items .= "MANUAL CALL, ";
			}
			else if($li->channel_type == config('constant.CH_AUTODIAL'))
			{
				$items .= "AUTODIAL, ";
			}
			else if($li->channel_type == config('constant.CH_PUSH_MESSAGES'))
			{
				$items .= "PUSH, ";
			}
			else
			{
				$items .= "";
			}
		}
		echo rtrim($items,", ");
		
	}
	
	public static function get_username_by_id($id)
	{
		$user_data = User::select('id','name')->where('cmpny_id',Auth::user()->cmpny_id)->where('id',$id)->first();
		$name = '';
		if($user_data)
		{
			$name = $user_data->name;
		}
		return $name;
	}
	/*
    * get members based on a project id
    * @author RINKU.E.B.
    * @date 04/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public static function get_members_by_project_id($pjct_id)
	{
		$results = Project::select('members')->where('id',$pjct_id)->first();//echo "<pre>";print_r($results);die;
		$pass_arr = array();
		if($results)
		{
			$members = $results->members;
			$members_arr = unserialize($members);
			foreach($members_arr as $data)
			{
				$mem_id = $data;
				$mem_name = Helpers::get_username_by_id($mem_id);
				$pass_arr[$mem_id] = $mem_name;
			}
		}
		return $pass_arr;
	}
	/*
    * task details from a task id common function
    * @author RINKU.E.B.
    * @date 05/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public static function get_task_details($task_id)
	{
		$results = ProjectTask::select('title','description','project_id','due_date','required_time','version','priority','category','members','status')->where('id',$task_id)->first();
		return $results;
	}
	/*
    * get project details based on a project id
    * @author RINKU.E.B.
    * @date 09/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public static function get_project_details($pjct_id)
	{
		$pass_arr = array();
		$pass_arr = Project::select('prjt_name','description','due_date','budget','members','created_by','created_at','updated_at','status')->where('id',$pjct_id)->first();//echo "<pre>";print_r($results);die;
		return $pass_arr;
	}
	/*
    * unserialize and get member names
    * @author RINKU.E.B.
    * @date 09/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public static function get_unserialized_member_names($data)
	{  
		$name_str = '';		
		if(isset($data) && !empty($data))
		{
			
		$serial_arr = unserialize($data);
		if(is_array($serial_arr))
			foreach($serial_arr as $val)
			{
				$name_str .= '<input type="button" class="btn btn-default ml-2" value="'.Helpers::get_username_by_id($val).'">';
			}
		}
		echo $name_str;

	}
	/*
    * get master values
    * @author RINKU.E.B.
    * @date 09/12/2019
    * @since version 1.0.0
    * @param NULL
    */
    public static function get_master_values($id)
	{ 
		$result = PmMaster::select('name')->where('id',$id)->first();
		if($result)
		{
			return $result->name;
		}
		
	}
	/*
	 * @author     Elavarasi S
     * Date:       04/12/2019 
     * Description:Get user by ID
	*/
	
	public static function get_user($id)
	{
		return User::find($id);
	} 
	
	
	/*
	 * @author RINKU.E.B.
     * Date: 27/01/2020
     * Description:GET TIME LEFT FOR THE TASK FROM TASK ID
	*/
	public static function get_tasktime_left($task_id)
	{
		$req_time = 0;
		$task_results = ProjectTask::select('due_date','required_time')->where('id',$task_id)->first();
		if($task_results)
		{
			$req_time = $task_results->required_time;
		}	//$req_time = 900;
		$taken_time = 0;
		$tracker_results = Tracker::select('from_time','to_time')->where('task_id',$task_id)->get();
		if(count($tracker_results)>0)
		{
			foreach($tracker_results as $results)
			{
				$from = Carbon::parse($results->from_time);
				$to = Carbon::parse($results->to_time);
				$diff_in_mins = $to->diffInMinutes($from);//echo $diff_in_mins.'-';
				$taken_time = $taken_time + $diff_in_mins;//return $taken_time;
			}
		}//return $taken_time;die;
		$eficiency_param = ($req_time*60) - $taken_time;//echo $eficiency_param;
		$eficiency_param = $eficiency_param/60;
		$eficiency_param = round($eficiency_param,1);
		if($eficiency_param < 0)
		{
			$return_val = '<span style="color:#F40029;background-color:rgb(251, 232, 4);">';
			$return_val .= $return_val.'Extra '.ltrim($eficiency_param,'-').' hours worked';
			$return_val .= '</span>';
			echo $return_val;
		}
		else
		{
			$return_val = '<span style="color:rgb(58, 197, 90);">';
			$return_val .= $return_val.$eficiency_param.' Hours left';
			$return_val .= '</span>';
			echo $return_val;
		}

	}
	/*
	 * @author RINKU.E.B.
     * Date: 27/01/2020
     * Description:GET TIME LEFT FOR THE PROJECT FROM A TASK ID
	*/
	public static function get_projecttime_left()
	{
		
	}
	
	public static function get_contact_count($project_id)
	{
		$results = ProjectMeta::select('contact_details')->where('project_id',$project_id)->first();
		if($results)
		{
			$contact_serilaized = $results->contact_details;
			$var1 = unserialize($contact_serilaized);
			return count($var1);
		}
	}
	
	public static function get_company_dets($id)
	{
		$results = CompanyProfile::where('id',$id)->first();
		if($results)
		{
			return $results;
		}
	}
	public static function get_workhours_period()
	{
		$user_id = Auth::User()->id;
		$current_month = date('Y-m');//echo $current_month;
		$tracker_results = Tracker::where('user_id',$user_id)->where('from_time','like','%'.$current_month.'%')->get();
		$taken_time = 0;
		if(count($tracker_results)>0)
		{
			foreach($tracker_results as $results)
			{
				$from = Carbon::parse($results->from_time);
				$to = Carbon::parse($results->to_time);
				$diff_in_mins = $to->diffInMinutes($from);//echo $diff_in_mins.'-';
				$taken_time = $taken_time + $diff_in_mins;//return $taken_time;
			}
		}
		$taken_time = $taken_time/60;
		$taken_time = round($taken_time,1);
		$current_date = date('d');
		$return_val = '';
		if((($current_date >= 5) &&($current_date <= 10) && ($taken_time < 25))||(($current_date >= 10) &&($current_date <= 15) && ($taken_time < 50))||(($current_date >= 15) &&($current_date <= 20) && ($taken_time < 75))||(($current_date >= 20) &&($current_date <= 25) && ($taken_time < 100))||(($current_date >= 25) &&($current_date <= 30) && ($taken_time < 125)))
		{
			$return_val = '<span style="color:#F40029;background-color:rgb(251, 232, 4);">';
			$return_val .= $return_val.'You have worked only '.$taken_time.' hours for this month and is not satisfiable';
			$return_val .= '</span>';
			echo $return_val;
		}
		else
		{
			$return_val = '<span >';
			$return_val .= $return_val.'You have worked '.$taken_time.' hours for this month';
			$return_val .= '</span>';
			echo $return_val;
		}
			
		
	}

	/*
	 * @author PRAJITH KUMAR KB.
     * Date: 2/03/2020
     * Description:REMOVE P_TAG
	*/
	public static function remove_p_tag($title)
   {
	$text=str_ireplace('<p>','',$title); 
	$text=str_ireplace('</p>','',$text);
	return $text;
	
    }
	/**
     * get_officer_details
     * @author RINKU.E.B.
     * @date 28/03/2020
     * @since version 1.0.0
    */
	public static function get_officer_details($loc_id)
	{
		$res_array = array();
		$res_array = LocationOfficerDetail::where('location_id',$loc_id)->get();
		echo json_encode($res_array);
	}
	/**
     * get_officer_details
     * @author RINKU.E.B.
     * @date 28/03/2020
     * @since version 1.0.0
    */
	public static function get_projectids_from_task_array($task_array)
	{
		$projects = array();
		$prjct_names = array();
		if(isset($task_array) && !empty($task_array))
		{
			$projects_id = ProjectTask::select('project_id')->whereIn('id',$task_array)->distinct('project_id')->get();
			if(count($projects_id)>0)
			{
				$prjct_names = Project::whereIn('id',$projects_id)->pluck('prjt_name')->toArray();
			}
		}
		//$prjct_names = array_map(function($val){ return $val.','; },$prjct_names);//echo "<pre>";print_r($prjct_names);
		echo implode(",",$prjct_names);
		
	}

	/*
	 * @author PRAJITH KUMAR KB.
     * Date: 2/04/2020
     * Description:REMOVE P_TAG
	*/

	 public static function service_name($service_id)
   {
	$service =Service::select('service_name','service_flag')->where('id',$service_id)->first();
	return $service->service_name;
	
    }
    public static function service_type($service_id)
   {
	$service =Service::select('service_name','service_flag')->where('id',$service_id)->first();
	$service_type =config('constant.service_flag')[$service->service_flag];
	return $service_type;
	
    }
    public static function check_server($server_id)
    {
    	$check = ServerService::select('id')->where('server_id',$server_id)->first();
    	return $check;
    }

    public static function service_status($server_id,$service_id)
   {
	$service =ServerService::select('status')->where('server_id',$server_id)->where('service_id',$service_id)->orderBy('created_at','desc')->first();
	$status_name_array = array();
	$check =$service->status;
	if($check!= null)
	{
	$service_status =config('constant.service_status')[$service->status];
	$service_status_no = $service->status;
	$status_name_array[] = Array('service_status_no'=>$service_status_no,'service_status'=>$service_status);
	}
	return $status_name_array;
	
    }

    public static function server_cpu($server_id)
    {
    	$server_cpu = Serverresource::select('resource1')->where('server_id',$server_id)->orderBy('created_at','desc')->first();
    	return $server_cpu->resource1;
    }

    public static function server_ram($server_id)
    {
    	$server_ram = Serverresource::select('resource2')->where('server_id',$server_id)->orderBy('created_at','desc')->first();
    	return $server_ram->resource2;
    }

    public static function hdd_used($server_id)
    {
    	$server_hdd = Serverresource::select('resource3')->where('server_id',$server_id)->orderBy('created_at','desc')->first();
    	return unserialize($server_hdd->resource3);
    }
	
	 public static function add_pusher($title,$comment,$link,$created_by,$cmpny_id)
   {
	   if(isset($cmpny_id) && !empty($cmpny_id))
	   {
		   $company = $cmpny_id;
	   }
	   else
	   {
		   if(isset(Auth::user()->cmpny_id))
		   {
			   $company = Auth::user()->cmpny_id;
		   }
		   else
		   {
			  $company = NULL; 
		   }
		   
	   }
	   
	    $ins_arr = array(
			  'cmpny_id' => $company,
			  'title' => $title,
			  'comment' => $comment,
			  'link' => $link,
			  'created_by' => $created_by,
			  'updated_by' => $created_by,
			  'created_at' => date('Y-m-d h:i:s'),
			  'updated_at' => date('Y-m-d h:i:s')
			  );
		$results = PusherList::firstOrCreate($ins_arr);
		
			  
   }
   public static function get_pusher()
    {
    	$pusher_tab = array();
    	$pusher_tab = PusherList::query()->limit(5)->orderBy('created_at','desc')->get();
    	return $pusher_tab;
    }
	
		public static function get_service_flag($service_id)
	{
		$serv_flg = '';
		$result = Service::select('service_flag')->where('id',$service_id)->first();
		if($result)
		{
			$serv_flg = $result->service_flag;
		}
		return $serv_flg;
		
	}
	public static function get_service_types($service_array)
	{
		
		$serv_flg = array();
		$serv_flg = Service::select('service_flag')->whereIn('id',$service_array)->distinct('service_flag')->get();
		
		return $serv_flg;
	}
	public static function get_daily_report_status($server_id,$service_id,$time,$date,$service_flag,$service_name)
	{
		// $date = '2020-04-28';

		$serv_flg = Service::select('service_name')->where('id',$service_id)->first();
		if($service_flag == 9)
		{
			$resource_val = Serverresource::select('resource1')->where('server_id',$server_id)->where('created_at','like','%'.$date.'%')->where('time',$time)->first();
			if($resource_val)
			{
				$return_val =  $resource_val->resource1;
				return $return_val;
			}
		}
		else if($service_flag == 10)
		{
			$resource_val1 = Serverresource::select('resource2')->where('server_id',$server_id)->where('created_at','like','%'.$date.'%')->where('time',$time)->first();
			if($resource_val1)
			{
				$return_val1 =  $resource_val1->resource2;
				return $return_val1;
			}
		}
		else if($service_flag == 11)
		{
			$resource_val2 = Serverresource::select('resource3')->where('server_id',$server_id)->where('created_at','like','%'.$date.'%')->where('time',$time)->first();
			if($resource_val2)
			{
				$return_val2 = unserialize($resource_val2->resource3);
				
				// $drive = array();
				foreach($return_val2 as $res)
				{
					$drive =$res['drive'];
				if($service_name == $drive)
				{

				return $res['used'];
			}
			
			
				
			
			}
			// dd($drive);
			}
		}

	if($service_flag != 11)
	{
		$result_arr = Serverresource::select('ori_server_service_details.status')
		->join('ori_server_service_details','ori_server_service_details.server_resource_id','=','ori_server_resource_details.id')
		->where('ori_server_resource_details.server_id',$server_id)->where('ori_server_resource_details.created_at','like','%'.$date.'%')->where('time',$time)->first();
	    

		if($result_arr)
		{
		return $result_arr->status;
		} else { return "--"; }
	}
	}
	
	public static function get_daily_report_resourcestatus($server_id,$resource,$time)
	{
		$date = '2020-05-04';
		$return_val = '-';
		if($resource == 1)
		{
			$resource_val = Serverresource::select('resource1')->where('server_id',$server_id)->where('created_at','like','%'.$date.'%')->where('time',$time)->first();
			if($resource_val)
			{
				$return_val =  $resource_val->resource1;
			}
		}
		else if($resource == 2)
		{
			$resource_val = Serverresource::select('resource2')->where('server_id',$server_id)->where('created_at','like','%'.$date.'%')->where('time',$time)->first();
			if($resource_val)
			{
				$return_val =  $resource_val->resource2;
			}
		} 
	    else if($resource == 3)
		{
			$resource_val = Serverresource::select('resource3')->where('server_id',$server_id)->where('created_at','like','%'.$date.'%')->where('time',$time)->first();
			if($resource_val)
			{
				$return_val = $resource_val->resource3;
			}
		}
		return $return_val;
		
		
	}
		
	public static function get_pusher_cretor($userid)
    {   	
    	$creator = User::select('name')->where('id',$userid)->first();
    	return $creator->name;
    }
	
	/*
	 * @author     Veena S Das
	 * @since      Version 1.0
     * Date:       29/04/2020 
     * Description: mail content table for escalation report
	 * $typ = 1 sms, $typ = 2 email, $categ indicates daily, weekly or monthy
	*/
	public static function get_username_by_id_intimation($id)
	{
		$user_data = User::select('id','name')->where('id',$id)->first();
		$name = '';
		if($user_data)
		{
			$name = $user_data->name;
		}
		return $name;
	}

public static function escalate_projecttaskhour_mail_content($cmpny_id,$user_id,$categ)
{
		
	
		
		if($categ==config('constant.INTIMATION_DAILY'))
		{
			
   			           $out_array = array();
						$res_array = array();
						$users = User::where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('name')->pluck('id');//echo "<pre>";print_r($users);die;
						if(count($users)>0)
						{
							$i = 0;
							foreach($users as $user)
							{
								$taken_time = 0;
								$task_arr = array();
								$out_array[$i]['user_id'] = $user;

								$res_array = Tracker::select('ori_tracker.id','ori_tracker.task_id','ori_tracker.from_time','ori_tracker.to_time')
										   ->where('ori_tracker.user_id',$user)
										   ->where('ori_tracker.from_time','>=',date('Y-m-d').' 00:00:01')
										   ->where('ori_tracker.from_time','<=',date('Y-m-d').' 23:59:59');
							
								 if(isset($project_id) && !empty($project_id)) 
								 {
									 $res_array =  $res_array->join('ori_project_tasks','ori_project_tasks.id','=','ori_tracker.task_id')->where('ori_project_tasks.project_id',$project_id);
								 }
								// dd($res_array);           
								$results = $res_array;//print_r($res_array);
								$res_array = $res_array->get();//print_r($res_array);
								
								if(count($res_array)>0)
								{
									foreach($res_array as $res)//echo $res_array->from_time;die;
									{
										$from = Carbon::parse($res->from_time);

										$to = Carbon::parse($res->to_time);
										$diff_in_mins = $to->diffInMinutes($from);//echo $diff_in_mins.'-';
										$taken_time = $taken_time + $diff_in_mins;//return $taken_time;
										$task_arr[] = $res->task_id;//echo $diff_in_mins.'---';
									}
								}
								$out_array[$i]['taken_time'] = round($taken_time/60,1);//echo $taken_time.'takennnn'.$user.'<br>';
								$out_array[$i]['task_ids'] = array_unique($task_arr);
								$i++;

							}
						}
						
		}
		
		else if($categ==config('constant.INTIMATION_MONTHLY'))
		{
						$dt1 = date('Y-m-d', strtotime('first day of last month'));
						$dt2 = date('Y-m-d', strtotime('last day of previous month'));
						$out_array = array();
						$res_array = array();
						$users = User::where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('name')->pluck('id');//echo "<pre>";print_r($users);die;
						if(count($users)>0)
						{
							$i = 0;
							foreach($users as $user)
							{
								$taken_time = 0;
								$task_arr = array();
								$out_array[$i]['user_id'] = $user;

								$res_array = Tracker::select('ori_tracker.id','ori_tracker.task_id','ori_tracker.from_time','ori_tracker.to_time','ori_tracker.description')
										   ->where('ori_tracker.user_id',$user)
										   ->where('ori_tracker.from_time','>=',$dt1.' 00:00:01')
										   ->where('ori_tracker.from_time','<=',$dt2.' 23:59:59');
							
								 if(isset($project_id) && !empty($project_id)) 
								 {
									 $res_array =  $res_array->join('ori_project_tasks','ori_project_tasks.id','=','ori_tracker.task_id')->where('ori_project_tasks.project_id',$project_id);
								 }
								// dd($res_array);           
								$results = $res_array;//print_r($res_array);
								$res_array = $res_array->get();//print_r($res_array);
								
								if(count($res_array)>0)
								{
									foreach($res_array as $res)//echo $res_array->from_time;die;
									{
										$from = Carbon::parse($res->from_time);

										$to = Carbon::parse($res->to_time);
										$diff_in_mins = $to->diffInMinutes($from);//echo $diff_in_mins.'-';
										$taken_time = $taken_time + $diff_in_mins;//return $taken_time;
										$task_arr[] = $res->task_id;//echo $diff_in_mins.'---';
									}
								}
								$out_array[$i]['taken_time'] = round($taken_time/60,1);//echo $taken_time.'takennnn'.$user.'<br>';
								$out_array[$i]['task_ids'] = array_unique($task_arr);
								$i++;

							}
		            }
		
		}
	if(count($out_array) >0)
	{
            $table = '<table style="border:1px solid #000;width:50%;">';$str = '';
			$table .= '<tr>';
			$table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Members</th>'; 				
			$table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Spent Time</th>'; 				
			$table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Projects</th>'; 
            $table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Tasks</th>';
            $table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Descriptions</th>';
            
           	
			$table .= '</tr>';
            
           
		foreach ($out_array as $value)
		{ 
			$table .= '<tr>';
			$member_name = Helpers::get_username_by_id_intimation($value['user_id']);
			$pid = array();	
			$task_title = array();	
			$description = array();	
			$pname = array();
			$result = array();
			$tt = array();
			$project = array();
			$task = array();
			$project_new[] = array();
                        $des = "";
                        $descr = array();
					
            foreach($value['task_ids'] as $tsk_id){
							
						$pass_arr = "";
						$prjt_name = "";    
                        $project_id = Helpers::get_task_details($tsk_id)->project_id;
                        $pid[] = Helpers::get_task_details($tsk_id)->project_id;
						$task_title[] = Helpers::get_task_details($tsk_id)->title;
						$description[] = Helpers::get_task_details($tsk_id)->description;
						$pass_arr = Project::select('prjt_name','description','due_date','budget','members','created_by','created_at','updated_at','status')->where('id',$project_id)->first();
						if(isset($pass_arr) && !empty($pass_arr)) {
                        $pname[] = $pass_arr->prjt_name;}
						if(isset($pass_arr) && !empty($pass_arr)) {
                        $prjt_name = $pass_arr->prjt_name;}
                        $task[] = array('pid'=>$project_id,'task'=>Helpers::get_task_details($tsk_id)->title);
						$project[] = array('pid'=>$project_id,'prjt_name'=>$prjt_name);
						$des = Helpers::get_task_details($tsk_id)->description;
						$descr[] = array('pid'=>$project_id,'desn'=>$des);
						
			}
			//print_r($task);
//print_r($descr);
			    if($project){
				    $table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$member_name.'</td>';
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$value['taken_time'].'</td>';
				    $prjct_count = count($project);
					
					for($i=0;$i<$prjct_count;$i++){
						if($i == 0){
							$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
							$tt =array();
							$ds =array();
							$table .=  '<table ><tr align="center" style="border-bottom:1pt solid black ">'.$project[$i]['prjt_name'].'</tr></table>'; 		
							$table .=	'</td>';
							
							$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
						
							foreach($task as $tsk){
								if($tsk['pid'] == $project[$i]['pid'])
								{
								$tt[] = $tsk['task'];
								}
							}
					
							$tt = implode(",",$tt);
							$table .= '<table><tr>'.$tt.'</tr></table>';
							$table .= '</td>';
							
							$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
						   
							 foreach($descr as $des){if($des){
								if($des['pid'] == $project[$i]['pid'])
								{
								$ds[] = $des['desn'];
								}
							 }}
					
							$ds = implode(",",$ds);
							$table .= '<table><tr>'.$ds.'</tr></table>'; 
							$table .= '</td>';
							$table .= '</tr>';
							
						    
						}
						else{
							    $flag = 0;
								for($j=$i-1;$j>=0;$j--){
									if($project[$i]['prjt_name'] == $project[$j]['prjt_name'])
									{
										$flag = 1;
									}
								}
							
							if($flag == 0){
								$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>';
								$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>';
								$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
								$tt =array();
								$ds =array();
								$table .=  '<table ><tr align="center" style="border-bottom:1pt solid black ">'.$project[$i]['prjt_name'].'</tr></table>'; 		
								$table .=	'</td>';
								
								$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
							
								foreach($task as $tsk){
									if($tsk['pid'] == $project[$i]['pid'])
									{
									$tt[] = $tsk['task'];
									}
								}
						
								$tt = implode(",",$tt);
								$table .= '<table><tr>'.$tt.'</tr></table>';
								$table .= '</td>';
								$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
							
								foreach($descr as $des){if($des){
									if($des['pid'] == $project[$i]['pid'])
									{
									$ds[] = $des['desn'];
									}
								}}
						
								$ds = implode(",",$ds);
								$table .= '<table><tr>'.$ds.'</tr></table>'; 
								$table .= '</td>';
								
							}
						    $table .= '</tr>';
					    }
					}
				}
				else{
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$member_name.'</td>';
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$value['taken_time'].'</td>';
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>';
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>';
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>';
					
					$table .= '</tr>';
				}
			
		}		
					
		$table .= '</table>';
        print_r($table);die;
			return $table;
			
    }
	else
    {
	    return 1;
	}
}	
public static function escalate_projecttaskhour_mail_content1($cmpny_id,$user_id,$categ)
	{
		
	
		
		if($categ==config('constant.INTIMATION_DAILY'))
		{
			
   			           $out_array = array();
						$res_array = array();
						$users = User::where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('name')->pluck('id');//echo "<pre>";print_r($users);die;
						if(count($users)>0)
						{
							$i = 0;
							foreach($users as $user)
							{
								$taken_time = 0;
								$task_arr = array();
								$out_array[$i]['user_id'] = $user;

								$res_array = Tracker::select('ori_tracker.id','ori_tracker.task_id','ori_tracker.from_time','ori_tracker.to_time')
										   ->where('ori_tracker.user_id',$user)
										   ->where('ori_tracker.from_time','>=',date('Y-m-d').' 00:00:01')
										   ->where('ori_tracker.from_time','<=',date('Y-m-d').' 23:59:59');
							
								 if(isset($project_id) && !empty($project_id)) 
								 {
									 $res_array =  $res_array->join('ori_project_tasks','ori_project_tasks.id','=','ori_tracker.task_id')->where('ori_project_tasks.project_id',$project_id);
								 }
								// dd($res_array);           
								$results = $res_array;//print_r($res_array);
								$res_array = $res_array->get();//print_r($res_array);
								
								if(count($res_array)>0)
								{
									foreach($res_array as $res)//echo $res_array->from_time;die;
									{
										$from = Carbon::parse($res->from_time);

										$to = Carbon::parse($res->to_time);
										$diff_in_mins = $to->diffInMinutes($from);//echo $diff_in_mins.'-';
										$taken_time = $taken_time + $diff_in_mins;//return $taken_time;
										$task_arr[] = $res->task_id;//echo $diff_in_mins.'---';
									}
								}
								$out_array[$i]['taken_time'] = round($taken_time/60,1);//echo $taken_time.'takennnn'.$user.'<br>';
								$out_array[$i]['task_ids'] = array_unique($task_arr);
								$i++;

							}
						}
						
		}
		
		else if($categ==config('constant.INTIMATION_MONTHLY'))
		{
						$dt1 = date('Y-m-d', strtotime('first day of last month'));
						$dt2 = date('Y-m-d', strtotime('last day of previous month'));
						$out_array = array();
						$res_array = array();
						$users = User::where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('name')->pluck('id');//echo "<pre>";print_r($users);die;
						if(count($users)>0)
						{
							$i = 0;
							foreach($users as $user)
							{
								$taken_time = 0;
								$task_arr = array();
								$out_array[$i]['user_id'] = $user;

								$res_array = Tracker::select('ori_tracker.id','ori_tracker.task_id','ori_tracker.from_time','ori_tracker.to_time')
										   ->where('ori_tracker.user_id',$user)
										   ->where('ori_tracker.from_time','>=',$dt1.' 00:00:01')
										   ->where('ori_tracker.from_time','<=',$dt2.' 23:59:59');
							
								 if(isset($project_id) && !empty($project_id)) 
								 {
									 $res_array =  $res_array->join('ori_project_tasks','ori_project_tasks.id','=','ori_tracker.task_id')->where('ori_project_tasks.project_id',$project_id);
								 }
								// dd($res_array);           
								$results = $res_array;//print_r($res_array);
								$res_array = $res_array->get();//print_r($res_array);
								
								if(count($res_array)>0)
								{
									foreach($res_array as $res)//echo $res_array->from_time;die;
									{
										$from = Carbon::parse($res->from_time);

										$to = Carbon::parse($res->to_time);
										$diff_in_mins = $to->diffInMinutes($from);//echo $diff_in_mins.'-';
										$taken_time = $taken_time + $diff_in_mins;//return $taken_time;
										$task_arr[] = $res->task_id;//echo $diff_in_mins.'---';
									}
								}
								$out_array[$i]['taken_time'] = round($taken_time/60,1);//echo $taken_time.'takennnn'.$user.'<br>';
								$out_array[$i]['task_ids'] = array_unique($task_arr);
								$i++;

							}
		            }
		
		}
		 if(count($out_array) >0)
		 {
            $table = '<table style="border:1px solid #000;width:50%;">';$str = '';
			$table .= '<tr>';
			$table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Members</th>'; 				
			$table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Spent Time</th>'; 				
			$table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Projects</th>'; 				
			$table .= '</tr>';
            
                       foreach ($out_array as $value)
			{ 			
			$table .= '<tr>';
			$member_name = Helpers::get_username_by_id_intimation($value['user_id']);
			$pname = array();
                        $p_name = "";
                        foreach($value['task_ids'] as $tsk_id){
                        $pid = Helpers::get_task_details($tsk_id)->project_id;
                        $pass_arr = array();
		        $pass_arr = Project::select('prjt_name','description','due_date','budget','members','created_by','created_at','updated_at','status')->where('id',$pid)->first();//echo "<pre>";print_r($results);die;
                        if(isset($pass_arr) && !empty($pass_arr)) {
                        $pname[] = $pass_arr->prjt_name;}
                        }
                        $pname = array_unique($pname);
			$p_name = implode(",",$pname);
			
			$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$member_name.'</td>';
			$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$value['taken_time'].'</td>';
			$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$p_name.'</td>';
			$table .= '</tr>'; }		
						
			$table .= '</table>';
                         
			//print_r($table);die;
			return $table;
			
		 }
		 else
		 {
			 return 1;
		 }
	}
public static function vvvescalate_projecttaskhour_mail_content1($cmpny_id,$user_id,$categ)
{
		
	
		
		if($categ==config('constant.INTIMATION_DAILY'))
		{
			
   			           $out_array = array();
						$res_array = array();
						$users = User::where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('name')->pluck('id');//echo "<pre>";print_r($users);die;
						if(count($users)>0)
						{
							$i = 0;
							foreach($users as $user)
							{
								$taken_time = 0;
								$task_arr = array();
								$out_array[$i]['user_id'] = $user;

								$res_array = Tracker::select('ori_tracker.id','ori_tracker.task_id','ori_tracker.from_time','ori_tracker.to_time')
										   ->where('ori_tracker.user_id',$user)
										   ->where('ori_tracker.from_time','>=',date('Y-m-d').' 00:00:01')
										   ->where('ori_tracker.from_time','<=',date('Y-m-d').' 23:59:59');
							
								 if(isset($project_id) && !empty($project_id)) 
								 {
									 $res_array =  $res_array->join('ori_project_tasks','ori_project_tasks.id','=','ori_tracker.task_id')->where('ori_project_tasks.project_id',$project_id);
								 }
								// dd($res_array);           
								$results = $res_array;//print_r($res_array);
								$res_array = $res_array->get();//print_r($res_array);
								
								if(count($res_array)>0)
								{
									foreach($res_array as $res)//echo $res_array->from_time;die;
									{
										$from = Carbon::parse($res->from_time);

										$to = Carbon::parse($res->to_time);
										$diff_in_mins = $to->diffInMinutes($from);//echo $diff_in_mins.'-';
										$taken_time = $taken_time + $diff_in_mins;//return $taken_time;
										$task_arr[] = $res->task_id;//echo $diff_in_mins.'---';
									}
								}
								$out_array[$i]['taken_time'] = round($taken_time/60,1);//echo $taken_time.'takennnn'.$user.'<br>';
								$out_array[$i]['task_ids'] = array_unique($task_arr);
								$i++;

							}
						}
						
		}
		
		else if($categ==config('constant.INTIMATION_MONTHLY'))
		{
						$dt1 = date('Y-m-d', strtotime('first day of last month'));
						$dt2 = date('Y-m-d', strtotime('last day of previous month'));
						$out_array = array();
						$res_array = array();
						$users = User::where('cmpny_id',$cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('name')->pluck('id');//echo "<pre>";print_r($users);die;
						if(count($users)>0)
						{
							$i = 0;
							foreach($users as $user)
							{
								$taken_time = 0;
								$task_arr = array();
								$out_array[$i]['user_id'] = $user;

								$res_array = Tracker::select('ori_tracker.id','ori_tracker.task_id','ori_tracker.from_time','ori_tracker.to_time','ori_tracker.description')
										   ->where('ori_tracker.user_id',$user)
										   ->where('ori_tracker.from_time','>=',$dt1.' 00:00:01')
										   ->where('ori_tracker.from_time','<=',$dt2.' 23:59:59');
							
								 if(isset($project_id) && !empty($project_id)) 
								 {
									 $res_array =  $res_array->join('ori_project_tasks','ori_project_tasks.id','=','ori_tracker.task_id')->where('ori_project_tasks.project_id',$project_id);
								 }
								// dd($res_array);           
								$results = $res_array;//print_r($res_array);
								$res_array = $res_array->get();//print_r($res_array);
								
								if(count($res_array)>0)
								{
									foreach($res_array as $res)//echo $res_array->from_time;die;
									{
										$from = Carbon::parse($res->from_time);

										$to = Carbon::parse($res->to_time);
										$diff_in_mins = $to->diffInMinutes($from);//echo $diff_in_mins.'-';
										$taken_time = $taken_time + $diff_in_mins;//return $taken_time;
										$task_arr[] = $res->task_id;//echo $diff_in_mins.'---';
									}
								}
								$out_array[$i]['taken_time'] = round($taken_time/60,1);//echo $taken_time.'takennnn'.$user.'<br>';
								$out_array[$i]['task_ids'] = array_unique($task_arr);
								$i++;

							}
		            }
		
		}
	if(count($out_array) >0)
	{
            $table = '<table style="border:1px solid #000;width:50%;">';$str = '';
			$table .= '<tr>';
			$table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Members</th>'; 				
			$table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Spent Time</th>'; 				
			$table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Projects</th>'; 
            $table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Tasks</th>';
            $table .= '<th align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">Descriptions</th>';
            
           	
			$table .= '</tr>';
            
           
		foreach ($out_array as $value)
		{ 
			$table .= '<tr>';
			$member_name = Helpers::get_username_by_id_intimation($value['user_id']);
			$pid = array();	
			$task_title = array();	
			$description = array();	
			$pname = array();
			$result = array();
			$tt = array();
			$project = array();
			$task = array();
			$project_new[] = array();
                        $des = "";
                        $descr = array();
					
            foreach($value['task_ids'] as $tsk_id){
							
						$pass_arr = "";
						$prjt_name = "";    
                        $project_id = Helpers::get_task_details($tsk_id)->project_id;
                        $pid[] = Helpers::get_task_details($tsk_id)->project_id;
						$task_title[] = Helpers::get_task_details($tsk_id)->title;
						$description[] = Helpers::get_task_details($tsk_id)->description;
						$pass_arr = Project::select('prjt_name','description','due_date','budget','members','created_by','created_at','updated_at','status')->where('id',$project_id)->first();
						if(isset($pass_arr) && !empty($pass_arr)) {
                        $pname[] = $pass_arr->prjt_name;}
						if(isset($pass_arr) && !empty($pass_arr)) {
                        $prjt_name = $pass_arr->prjt_name;}
                        $task[] = array('pid'=>$project_id,'task'=>Helpers::get_task_details($tsk_id)->title);
						$project[] = array('pid'=>$project_id,'prjt_name'=>$prjt_name);
						$des = Helpers::get_task_details($tsk_id)->description;
						$descr[] = array('pid'=>$project_id,'desn'=>$des);
						
			}
			//print_r($task);
//print_r($descr);
			    if($project){
				    $table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$member_name.'</td>';
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$value['taken_time'].'</td>';
				    $prjct_count = count($project);
					
					for($i=0;$i<$prjct_count;$i++){
						if($i == 0){
							$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
							$tt =array();
							$ds =array();
							$table .=  '<table ><tr align="center" style="border-bottom:1pt solid black ">'.$project[$i]['prjt_name'].'</tr></table>'; 		
							$table .=	'</td>';
							
							$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
						
							foreach($task as $tsk){
								if($tsk['pid'] == $project[$i]['pid'])
								{
								$tt[] = $tsk['task'];
								}
							}
					
							$tt = implode(",",$tt);
							$table .= '<table><tr>'.$tt.'</tr></table>';
							$table .= '</td>';
							
							$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
						   
							 foreach($descr as $des){if($des){
								if($des['pid'] == $project[$i]['pid'])
								{
								$ds[] = $des['desn'];
								}
							 }}
					
							$ds = implode(",",$ds);
							$table .= '<table><tr>'.$ds.'</tr></table>'; 
							$table .= '</td>';
							$table .= '</tr>';
							
						    
						}
						else{
							    $flag = 0;
								for($j=$i-1;$j>=0;$j--){
									if($project[$i]['prjt_name'] == $project[$j]['prjt_name'])
									{
										$flag = 1;
									}
								}
							
							if($flag == 0){
								$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>';
								$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>';
								$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
								$tt =array();
								$ds =array();
								$table .=  '<table ><tr align="center" style="border-bottom:1pt solid black ">'.$project[$i]['prjt_name'].'</tr></table>'; 		
								$table .=	'</td>';
								
								$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
							
								foreach($task as $tsk){
									if($tsk['pid'] == $project[$i]['pid'])
									{
									$tt[] = $tsk['task'];
									}
								}
						
								$tt = implode(",",$tt);
								$table .= '<table><tr>'.$tt.'</tr></table>';
								$table .= '</td>';
								$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">';
							
								foreach($descr as $des){if($des){
									if($des['pid'] == $project[$i]['pid'])
									{
									$ds[] = $des['desn'];
									}
								}}
						
								$ds = implode(",",$ds);
								$table .= '<table><tr>'.$ds.'</tr></table>'; 
								$table .= '</td>';
								
							}
						    $table .= '</tr>';
					    }
					}
				}
				else{
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$member_name.'</td>';
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;">'.$value['taken_time'].'</td>';
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>';
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>';
					$table .= '<td align="center" style="border: 1px solid #dddddd;text-align: left; padding: 8px;"></td>';
					
					$table .= '</tr>';
				}
			
		}		
					
		$table .= '</table>';
        //print_r($table);die;
			return $table;
			
    }
	else
    {
	    return 1;
	}
}	
/**
     * get_officer_details
     * @author RINKU.E.B.
     * @date 28/03/2020
     * @since version 1.0.0
    */
	public static function get_doctors_list()
	{
		$res_array = array();
		$res_array = DB::table('ori_doctors')->get();
		echo json_encode($res_array);
	}
/**
     * get_officer_details
     * @author RINKU.E.B.
     * @date 28/03/2020
     * @since version 1.0.0
    */
	public static function get_major_detail($loc_id)
	{
		$res_array = array();
		$res_array = DB::table('major_contacts')->where('district_id',$loc_id)->get();
		echo json_encode($res_array);
	}
/*latest task details from a task id common function
    * @author Veena S Das
    * @date 19/09/2020
    * @since version 1.0.0
    * @param NULL
    */
    public static function get_latest_task_details($task_id)
	{
		$results = Tracker::where('task_id',$task_id)->orderBy('id','desc')->first();		
                
 
                //print_r($results);
                 return $results;
	}
/*Get customer name common function
    * @author Prajith Kumar
    * @date 05/10/2020
    * @since version 1.0.0
    * @param NULL
    */
    public static function get_customer_name($customer_id)
	{
		$results = CustomerProfile::select('first_name')->where('id',$customer_id)->first();		
                
 
                //print_r($results);
                 return $results->first_name;
	}

	

	

	
	
}