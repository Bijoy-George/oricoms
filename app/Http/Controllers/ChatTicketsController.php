<?php

namespace App\Http\Controllers;

use App\CustomerProfile;
use App\User;
use App\ChatThread;
use App\Helpdesk;
use App\HelpdeskLog;
use App\Helpers;
use App\QueryStatus;
use App\Templates;
use App\CommonSmsEmail;
use Illuminate\Http\Request;

class ChatTicketsController extends Controller
{
    /**
    * Save chat ticket to followup
    * @author Rahul Raveendran
    * @date 30/06/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function save_ticket(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        $response   = $request->all();

        $email              = trim($response['customer_email']);
        $mobile_number      = trim($response['customer_phone_no']);
        $mobile_country_code= trim($response['mobile_country_code']);
        $query_title        = trim($response['subject']);
        $query_description  = $response['query'];
        $agent_username     = trim($response['agent_username']);
        $thread_id          = (int)$response['thread_id'];
		$cmpny_id           = $response['cmpny_id'];
		$authentication_key = $response['authentication_key'];

        $return = array(
            'status'    => 0,
            'ticket_id' => ""
        );

        do {
            if ((empty($email) && empty($mobile_number)) || empty($query_description) || empty($agent_username) || empty($thread_id))
            {
                break;
            }

            $customer   = CustomerProfile::select('id', 'first_name', 'email')
										->where('email', $email)
										->where('mobile', $mobile_number)
                                        ->where('country_code', '+' . $mobile_country_code)
										->where('cmpny_id',$cmpny_id)
										->first();

            if ((!isset($customer->id) || empty($customer->id)) && !empty($mobile_number) && !empty($mobile_country_code))
            {
                $customer   = CustomerProfile::select('id', 'first_name', 'email')
                                            ->where('mobile', $mobile_number)
                                            ->where('country_code', '+' . $mobile_country_code)->first();
            }
            else
            {
                $customer   = CustomerProfile::select('id', 'first_name', 'email')
                                            ->where('email', $email)->first();
            }

            if (!isset($customer->id) || empty($customer->id))
            {
                break;
            }

            $agent  = User::select('id')
                        ->where('username', $agent_username)
						->first();

            if (!isset($agent->id) || empty($agent->id))
            {
                break;
            }
			
            $thread     = ChatThread::select('id', 'lead_source_id')
                                        ->where('cust_id', $customer->id)
                                        ->where('id', $thread_id)
                                        ->where('agent_id', $agent->id)
                                        ->first();
            
            if (!isset($thread->id) || empty($thread->id))
            {
                break;
            }
            // //Check for spam if a customer has already submitted the same query title and description within 10 minutes.
            // $ticket_count   = cc_ticket::where('customer_id', $customer->id)
            //                             ->where('query_title', $query_title)
            //                             ->where('query_description', $query_description)
            //                             ->where('created_at', '>=', date('Y-m-d H:i:s', time() - (10 * 60)))
            //                             ->count();

            // if ($ticket_count > 0)
            // {
            //     $return['status']   = 3;
            //     break;
            // }

            $ticket_number  = $this->generate_ticket_number();
            if (!isset($ticket_number) || empty($ticket_number))
            {
                break;
            }
            
			$chat_query_type_id = Helpers::get_company_meta('chat_ticket',$cmpny_id);
			if(isset($chat_query_type_id) && !empty($chat_query_type_id))
			{
				$chat_query_type_id = $chat_query_type_id;
			}
			else
			{
				$chat_query_type_id = 0;
			}
            $chat_query_status_id = Helpers::get_company_meta('open_status',$cmpny_id);
			$query_status_open_id = QueryStatus::select('id')
												->where('id',$chat_query_status_id)
												->where('cmpny_id',$cmpny_id)
												->first();
			if(isset($query_status_open_id) && !empty($query_status_open_id))
			{
				$query_status_open_id = $query_status_open_id->id;
			}
			else
			{
				$query_status_open_id = 0;
			}
			
			$ticket     = Helpdesk::create([
                'docket_number'     => $ticket_number,
                'customer_id'       => $customer->id,
				'cmpny_id'			=> $cmpny_id,
                //'agent_id'          => $agent->id,
                'req_title'         => $query_title,
                'question'          => $query_description,
                'query_type'        => $chat_query_type_id,
                'query_status'      => $query_status_open_id,
                'lead_source_id'    => $thread->lead_source_id,
                'need_followup'     => 1,
                'status'            => config('constant.ACTIVE'),
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'        => $customer->id,
            ]);
            $ticket_log = HelpdeskLog::create([
                'docket_number'     => $ticket_number,
                'customer_id'       => $customer->id,
				'cmpny_id'			=> $cmpny_id,
                //'agent_id'          => $agent->id,
                'req_title'         => $query_title,
                'question'          => $query_description,
                'query_type'        => $chat_query_type_id,
                'query_status'      => $query_status_open_id,
                'lead_source_id'    => $thread->lead_source_id,
                'need_followup'     => 1,
                'status'            => config('constant.ACTIVE'),
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'        => $customer->id,
            ]);

            if (!isset($ticket->id) || empty($ticket->id))
            {
                break;
            }

            $return = array(
                'status'    => 1,
                'ticket_id' => $ticket_number
            );

            //Send Open Ticket Mail
			$chat_open_ticket_id = Helpers::get_company_meta('chat_ticket_open_mail',$cmpny_id);
			if(isset($chat_open_ticket_id) && !empty($chat_open_ticket_id))
			{
				$chat_open_ticket_id= $chat_open_ticket_id;

			}
			else
			{
				$chat_open_ticket_id = 0;
			}
            $mail_template  = Templates::where('id', $chat_open_ticket_id)->first();

            if (!isset($mail_template->id) || empty($mail_template->id))
            {
                break;
            }

            $mail_content   = $mail_template->content;
            $mail_content = str_replace('[[ First Name ]]', $customer->first_name, $mail_content);
            $mail_content = str_replace('[[ Docket number ]]', $ticket->id, $mail_content);
			
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
									$mail_content = $email_header_content.$mail_content.$email_footer_content;
									// ADDED FOR TEMPLATES HEADER AND FOOTER
            $buffer='notsent'; 
            $email_cc ='';
            $mail_subject =$mail_template->subject;
			
			$open_ticket_mail  = CommonSmsEmail::create([
                'authentication'    => $authentication_key,
				'cmpny_id'			=> $cmpny_id,
                'source'            => $thread->lead_source_id,
                'email'             => $customer->email,
                'customer_id'       => $customer->id,
                'sent_type'         => config('constant.CH_EMAIL'),
                //'sms_type'          => config('constant.TRANSACTION'),
                'response'          => $buffer,
                'content'           => $mail_content,
                'subject'           => $mail_subject,
                'email_cc'          => $email_cc,
                'status'            => config('constant.INACTIVE'),
                'created_by'        => 0,
                'updated_by'        => 0,
                'created_at'        => date('Y-m-d H:i:s'),
             ]);
        }
        while(false);

        return json_encode($return);
    }
	
	
	public function generate_ticket_number($length = 9)
    {
    	//$length			= (int)$length;
    	$unique			= false;

    	do 
		{
    		//$ticket_number 	= str_random($length);
            $ticket_number = 'GCC/CHAT/'.date('dmY').'/'.rand();
    		$ticket_count 	= Helpdesk::where('docket_number', $ticket_number)->count();

			if ($ticket_count < 1)
			{
				$unique	= true;
			}
    	}
    	while(!$unique);

    	return $ticket_number;
    }
}
