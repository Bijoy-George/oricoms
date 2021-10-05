<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailFetch;
use App\EmailFetchAttachment;
use App\CommonSmsEmail;
use Auth;
use App\Templates;
use App\Helpers;
use App\CompanyMeta;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\CronLog;
use App\Jobs\EmailFetchJob;

class EmailFetchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		//$this->middleware('check-permission:emailfetch',   ['only' => ['listing','search_emailfetchlist']]);
    }
	
	/*
    * EMAIL FETCH VIEW
    * @author RINKU.E.B.
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return EMAIL FETCH RESULTS
    */
	
	public function listing($read=0,$unread=0,$answered_c=0,$emailid='')
	{ 
		$read_c   =   EmailFetch::select(DB::raw('count(*) as total'))
                    ->where('email_id', '!=', '0')
                    ->where('read_status', '=', '1')
                    ->groupBy('thread_id')->get();
            
        $read_count=count($read_c);
        $unread_c   =   EmailFetch::select(DB::raw('count(*) as total'))
                    ->where('email_id', '!=', '0')
                    ->where('read_status', '=', '0')
                    ->groupBy('thread_id')->get();
        $unread_count=count($unread_c);
        $answered   =   EmailFetch::select(DB::raw('count(*) as total'))
                    ->where('email_id', '!=', '0')
                    ->where('answered', '=', '1')
                    ->groupBy('thread_id')->get();
        $answered=count($answered);
        $total   =   EmailFetch::select(DB::raw('count(*) as total'))
                    ->where('email_id', '!=', '0')
                    ->groupBy('thread_id')->get();
        $total=count($total);
        return view('emailfetch.index',compact('read_count','unread_count','answered','total','read','unread','answered_c','emailid'));
	}
	/*
    * PROFILE LISTING VIEW WITH FILTERS
    * @author RINKU.E.B.
    * @date 01/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return profile list
    */
	public function search_emailfetchlist(Request $request)
	{
		$response           =   $request->all();
        $search_keywords    =   $response['search_keywords']; 
        $read    =   $response['read'];
        $unread    =   $response['unread'];
        $answered    =   $response['answered'];
        
        $results = EmailFetch::selectRaw('count(*) AS cnt, thread_id, max(received_date) as received_date')->groupBy('thread_id')->orderBy('received_date','desc');
        
         if(isset($search_keywords) && !empty($search_keywords) && empty($drop_id)) 
        {
                $results->where('from', 'like', '%' . $search_keywords . '%');
        }
        if(isset($read) && $read !=0) 
        {
                $results->where('email_id', '!=', '0')->where('read_status', '=', '1');
                    
        }
        if(isset($unread) && $unread !=0) 
        {
                $results->where('email_id', '!=', '0')->where('read_status', '=', '0');
                    
        }
        if(isset($answered) && $answered !=0) 
        {
                $results->where('email_id', '!=', '0')->where('answered', '=', '1');
                    
        } 
        $thread_details = $results->paginate(config('constant.pagination_constant'));
        
            $thread_array = array();
            if($thread_details->count() > 0)
            {
                foreach ($thread_details as $value) {
                    $thread_id = $value->thread_id;
                    $thread_array[] = $thread_id;
                    $thread_count[$thread_id] = $value->cnt;
                    $email_details[$thread_id] = EmailFetch::where('thread_id',$thread_id)->orderBy('received_date','asc')->first();
                }
            }
        
        
       // return view('emailfetch.listview',compact('thread_details','email_details','read','unread'));
		//$row_count = count($cust_fields)+count($deflt_fields)+1;
		$list_count = $thread_details->count();
		//$thread_details   =   $thread_details->paginate(config('constant.pagination_constant'));

        $view = 'emailfetch.listview';

		$html =	view($view)->with(compact('thread_details','email_details','read','unread','list_count'))->render();

		$result_arr=array('success' => true,'html' => $html);
		return $result_arr;
	}
	/**
    * @email single mail thread details
    * @author RINKU.E.B 
    * @date 12/10/2018
    * @since version 1.0.0
    */
	public function thread_details(Request $request)
	{ 
        $response = $request->all();
		$email_details = array();
		if(isset($response['thread']) && !empty($response['thread']))
		{
			$thread             =   $response['thread']; 
			$email_details = EmailFetch::where('thread_id',$thread)->orderBy('received_date','asc')->get();
			$email_fetchs_update = EmailFetch::where('thread_id', $thread)->update(['read_status' => config('constant.READ')]);
		}
        return view('emailfetch.email_details', compact('email_details'));
	}
	/*
    * @author RINKU.E.B.
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Loading template
   */
    public function load_mail_template(Request $request)
    {

        $response           =   $request->all();
        $user_email_thread='';
        $cc_required        = '';
        $campaign_type        = '';
        $cc_required		= request('cc_required');  
        $campaign_type    = request('campaign_type');  
        if(isset($response['thread_id']) && !empty($response['thread_id']))
        {
            $user_email_thread =$response['thread_id'];
        }
        $current_cus='';  
        return view('emailfetch.mail_template', compact('user_email_thread','current_cus','cc_required','campaign_type'));
    }
	/*
    * @author RINKU.E.B.
    * @date 21/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Loading sms template
   */
    public function load_sms_template(Request $request)
    {

        $response           =   $request->all();
        $user_mobile='';
            
        if(isset($response['mobile']) && !empty($response['mobile']))
        {
            $user_mobile =$response['mobile'];
        }
        $current_cus='';  
        return view('emailfetch.sms_template', compact('user_mobile','current_cus'));
    }
	
	/*
    * @author RINKU.E.B.
    * @date 26/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Loading push template
   */
    public function load_push_template(Request $request)
    {

        $response           =   $request->all();
        $user_mobile='';
            
        if(isset($response['mobile']) && !empty($response['mobile']))
        {
            $user_mobile =$response['mobile'];
        }
        $current_cus='';  
        return view('emailfetch.push_template', compact('user_mobile','current_cus'));
    }
	/*
    * @author CHINNU.L (implemented for KSFE)
    * @date 06/08/2017
    * @since version 1.0.0
	* @edited by RINKU.E.B.
	* @date 26/11/2018
    * @param NULL
    * @return FETCHING FROM MAIL SERVER
   */
	public function emailfetch(Request $request) 
	{
         		try{	
				$cc_cron_log    = new CronLog;
				$cron_logid           = $cc_cron_log->createLog('email_fetch');
					
				$queueJob = (new EmailFetchJob())->delay(Carbon::now()->addSeconds(10));
				dispatch($queueJob);
				$cc_cron_log->updateLog($cron_logid);
			}
            catch(\Illuminate\Database\QueryException $ex){
				$error      = $ex->getMessage();
				$cc_cron_log->updateLog($cron_logid,$error);
            }
		// 	$company_select = CompanyMeta::select('cmpny_id','id','meta_name')->where('meta_name','like', 'mail_server_host%')->orderBy('updated_at','asc')->first();
		// 	if($company_select)
		// 	{
		// 		$tab_id = $company_select->id;
		// 		$cmpny_id = $company_select->cmpny_id;
		// 		$meta_arr = $company_select->meta_name;
		// 		$meta_arr = explode("_host_",$meta_arr);
				
				
  //           if (function_exists('imap_open')) {
  //                   echo "IMAP functions are available.<br />\n";
  //       // dynamic mail server selection starts
		// $hostname = Helpers::get_company_meta('mail_server_host_'.$meta_arr[1],$cmpny_id);
		// $username = Helpers::get_company_meta('mail_server_username_'.$meta_arr[1],$cmpny_id);
		// $password = Helpers::get_company_meta('mail_server_password_'.$meta_arr[1],$cmpny_id);
		
		// if(isset($hostname) && !empty($hostname) && isset($username) && !empty($username) && isset($password) && !empty($password))
		// {
		// 	$imap = imap_open("{".$hostname."/novalidate-cert}INBOX", $username, $password)or die(imap_last_error())or die("can't connect: ".imap_last_error());
		// dynamic mail server selection ends
		// new server code starts(Roundcube)
		/*$hostname = '{email.ksfe.com:993/imap/ssl}INBOX';
		$username = 'pravasi@ksfe.com';
		$password = 'Ksfe@123';
		$imap = imap_open("{email.ksfe.com:993/imap/ssl/novalidate-cert}INBOX", $username, $password)or die(imap_last_error())or die("can't connect: ".imap_last_error());*/
        // new server code ends   
		
		/* connect to gmail */
		//$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
		//$username = 'oriesmarti@gmail.com';
		//$password = 'orisystest';
                
                //$imap         = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', $username, $password);
		//		$imap = imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX", $username, $password)or die(imap_last_error())or die("can't connect: ".imap_last_error());
                
		/*  $hostname = '{imap.zimbra.com:993/imap/ssl}INBOX';
		$username = 'pravasi@ksfe.com';
		$password = 'ksfepravasi@123';
		//$imap         = imap_open('{117.240.231.201:995/pop3/ssl/novalidate-cert}inbox', $username, $password);
        $imap           = imap_open("{117.240.231.201:993/imap/ssl/novalidate-cert}inbox", $username, $password);// or die('Cannot connect: ' . print_r(imap_errors(), true))        
        */        
                // //code to fetch all thread mails first mail's message id - starts
                // $threadValues = array();
                // $thread = imap_thread($imap);
                // $rootThread = 0;
				//print_r($thread);die;
                //first we find the root (or parent) value for each email in the thread
                //we ignore emails that have no root value except those that are infact
                //the root of a thread

                //we want to gather the message IDs in a way where we can get the details of
                //all emails on one call rather than individual calls ( for performance )

                //foreach thread
                // foreach ($thread as $i => $messageId) {
                    //get sequence and type
                    // list($sequence, $type) = explode('.', $i);

                    //if type is not num or messageId is 0 or (start of a new thread and no next) or is already set
                    // if($type != 'num' || $messageId == 0
                    //    || ($rootThread == 0 && $thread[$sequence.'.next'] == 0)
                    //    || isset($threadValues[$messageId])) {
                    //     //ignore it
                    //     continue;
                    // }

                    //if this is the start of a new thread
                    // if($rootThread == 0) {
                    //     //set root
                    //     $rootThread = $messageId;
                    // }

                    // //at this point this will be part of a thread
                    // //let's remember the root for this email
                    // $threadValues[$messageId] = $rootThread;

                    // //if there is no next
                    // if($thread[$sequence.'.next'] == 0) {
                    //     //reset root
                    //     $rootThread = 0;
                    // }
                // }
                //there is no need to sort, the threads will automagically in chronological order
                //code to fetch all thread mails first mail's message id - ends
				//echo $date = Carbon::now()->subDays(1)->format('d M Y');
                // echo $date = Carbon::now()->format('d M Y');
				//echo  $date = date('d M Y', strtotime(date("Y-m-d H", strtotime("-1 hour"))));

                //$first_date = date('Y-m-d H',strtotime('+'.$first_duration.' hour ',strtotime($cur_date)));
  //               $date_str = 'SINCE "'.$date.'"';
		// 		$email_read = 'UNSEEN';
		// 		$mail_ids = imap_search($imap,$email_read);
		// 		//echo '<pre>'.print_r($mail_ids).'</pre>';die;
  //           if(!empty($mail_ids))
  //           {
  //               $emails = imap_fetch_overview($imap, implode(',', $mail_ids));
				
		// 		$chgflg = imap_setflag_full($imap,implode(",", $mail_ids), "\\Seen \\Flagged"); //IMPORTANT	
				
  //               if(!empty($emails))
  //               {    
  //                   //foreach email
  //                   foreach ($emails as $email) {
  //                       if(isset($email->subject))
  //                       {
  //                               echo "<pre>";print_r($email);echo "</pre>";
  //                               $condition_ar   = array();
  //                               $email_number   = $condition_arr['email_id'] = $email->msgno;
  //                               $subject      = $email->subject;
  //                               $elements = imap_mime_header_decode($subject);
  //                               for ($i=0; $i<count($elements); $i++) {
  //                                   $charset = $elements[$i]->charset;
  //                                   $subject = $elements[$i]->text;
  //                               }
  //                               //echo '<pre>'.print_r($elements).'</pre>';die;
  //                               $condition_arr['subject']       = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $subject));
  //                               $condition_arr['from_name']     = $email->from;
  //                               $condition_arr['received_date'] = date("Y-m-d h:i:s",$email->udate);
  //                               $header                         = imap_headerinfo($imap, $email_number);
  //                               $condition_arr['from']          = $header->from[0]->mailbox . "@" . $header->from[0]->host;
  //                               $exclude_mails_from_list = array('mailer-daemon@googlemail.com');
  //                               if(in_array($condition_arr['from'],$exclude_mails_from_list))continue;
  //                               $condition_arr['thread_id']   = $email_number;
  //                               //if current mail is in a tread
  //                               if(isset($threadValues[$email_number]))
  //                               {
  //                                   $condition_arr['thread_id'] = $threadValues[$email_number];
  //                               }

  //                               $message = imap_fetchbody($imap,$email_number,2, FT_PEEK);
  //                               if ($message == "") 
  //                               {
  //                                   $message = imap_fetchbody($imap, $email_number, 1, FT_PEEK);
  //                               }
		// 						//$condition_arr['message'] = trim(substr(quoted_printable_decode($message), 0, 100));
		// 						//$condition_arr['message'] = trim(quoted_printable_decode($message));
  //                               //$message = trim(imap_qprint($message));
  //                               /*$msg_elements = imap_mime_header_decode($message);
  //                               for($i=0; $i<count($msg_elements); $i++) {
  //                                   $msg_charset = $msg_elements[$i]->charset;
  //                                   $message = $msg_elements[$i]->text;
  //                                   echo '<pre>'.print_r($msg_elements).'</pre>';die;
  //                               }*/

		// 						//$condition_arr['message'] = quoted_printable_decode(trim(imap_qprint($message)));
  //                               $record = EmailFetch::where('email_id',$email_number)->where('cmpny_id',$cmpny_id)->first();
  //                               if (is_null($record)) {
  //                                   $structure = imap_fetchstructure($imap, $email_number);
  //                                   //echo '<pre>'.print_r($structure).'</pre>';

  //                                   if(isset($structure->parts) && is_array($structure->parts) && isset($structure->parts[1])) {
  //                                       $part = $structure->parts[1];
  //                                       $encoding = $part->encoding;

  //                                       switch ($encoding) {
  //                                           # 7BIT
  //                                           case 0:
  //                                               $message = $message;
  //                                               break;
  //                                           # 8BIT
  //                                           case 1:
  //                                               $message =  quoted_printable_decode(imap_8bit($message));
  //                                               break;
  //                                           # BINARY
  //                                           case 2:
  //                                               $message =  imap_binary($message);
  //                                               break;
  //                                           # BASE64
  //                                           case 3:
  //                                             echo  $message =  imap_base64($message);
  //                                               break;
  //                                           # QUOTED-PRINTABLE
  //                                           case 4:
  //           //                                    $message =  (quoted_printable_decode(imap_base64($message)));
  //                                               $message = trim(imap_qprint($message));
  //           //                                    $message = $message;
  //           //                                    $message =  quoted_printable_decode($message);
  //                                               break;
  //                                           # OTHER
  //                                           case 5:
  //                                               break;
  //                                           # UNKNOWN
  //                                           default:
  //                                               break;
  //                                       }



  //                                     /*  if($part->encoding == 3) {
  //                                           $message = utf8_decode(imap_base64($message));
  //                                       } else if($part->encoding == 1) {
  //                                           $message = imap_8bit($message);
  //                                       } else {
  //                                           $message = imap_qprint($message);
  //                                       }*/
  //                                   }
  //                                   echo $updated_arr['message'] = $message;
		// 							$condition_arr['cmpny_id'] = $cmpny_id;
  //                                   $saved = EmailFetch::firstOrCreate($condition_arr,$updated_arr);

  //               /////////////// CODE FOR RESPONSE STARTS HERE
		// 	/*	$cc_email_fetchs_response = EmailFetch::Create([
		// 						'email_id' => null,
		// 						'cmpny_id' => $cmpny_id,
		// 						'subject' => $condition_arr['subject'],
		// 						'from_name' => $username,
		// 						'received_date' => $condition_arr['received_date'],
		// 						'from' => $username,
		// 						'thread_id' => $condition_arr['thread_id'],
		// 						]);*/
		// 				$templ_id = Helpers::get_company_meta('auto_mail_response',$cmpny_id);
		// 				if(isset($templ_id) && !empty($templ_id))
		// 				{
		// 				$cmp_emails = Templates::where('id',$templ_id)->where('cmpny_id',$cmpny_id)->first();
		// 				if(count($cmp_emails)>0)
		// 				{
		// 					$content = $cmp_emails->content;
		// 					$subject = $cmp_emails->subject;
		// 					$fname = $condition_arr['from_name'];
		// 					if(isset($fname) && !empty($fname))
		// 					{
		// 							$content = str_replace('[[ First Name ]]', $fname, $content);
		// 					}
		// 					else
		// 					{
		// 							$fname = 'Customer';
		// 							$content = str_replace('[[ First Name ]]', $fname, $content);
		// 					}
							
		// 							// ADDED FOR TEMPLATES HEADER AND FOOTER
		// 							$email_header_content = '';$email_footer_content = '';
		// 							$email_header = Helpers::get_company_meta('email_header',$cmpny_id);
		// 							$email_footer = Helpers::get_company_meta('email_footer',$cmpny_id);
		// 							if(isset($email_header) && !empty($email_header) && ($email_header>0))
		// 							{
		// 								$email_header_content = Helpers::get_template_content($email_header);
		// 							}
		// 							if(isset($email_footer) && !empty($email_footer) && ($email_footer>0))
		// 							{
		// 								$email_footer_content = Helpers::get_template_content($email_footer);
		// 							}
		// 							$content = $email_header_content.$content.$email_footer_content;
		// 							// ADDED FOR TEMPLATES HEADER AND FOOTER
		// 				$set_crm_source = Helpers::get_company_meta('set_crm_source',$cmpny_id);
		// 				$random_code = str_random(12);
		// 				$mail_arr = CommonSmsEmail::Create(
		// 															[
		// 															'authentication' => '',
		// 															'cmpny_id' => $cmpny_id,
		// 															'source' => $set_crm_source,
		// 															'email' => $condition_arr['from'],
		// 															'customer_id' => null,
		// 															'sent_type' => config('constant.CH_EMAIL'),
		// 															'response' => 'notsent',
		// 															'mail_response' => '',
		// 															'random_code' => $random_code,
		// 															'content' => $content,
		// 															'subject' => $subject,  
		// 															'email_cc' => '',   
		// 															'status' => config('constant.INACTIVE'),
		// 															'created_by' => 0,
		// 															'updated_by' => 0,
		// 															'created_at' => date('Y-m-d H:i:s'),
		// 													   ]);
		// 												}
														
  //                                                       }

  //                                                           ///////////// CODE FOR RESPONSE ENDS HERE

  //                                   $attachments =array();
  //                                   if(isset($structure->parts) && count($structure->parts)) 
  //                                   {
  //                                           for($i = 0; $i < count($structure->parts); $i++) 
  //                                           {
  //                                                   if($structure->encoding == 3) {
  //                                                       $message = imap_base64($message);
  //                                                   } else if($part->encoding == 1) {
  //                                                       $message = imap_8bit($message);
  //                                                   } else {
  //                                                       $message = imap_qprint($message);
  //                                                   }

  //                                                   $attachments[$i] = array(
  //                                                           'is_attachment' => false,
  //                                                           'filename' => '',
  //                                                           'name' => '',
  //                                                           'attachment' => ''
  //                                                   );
  //                                                   if($structure->parts[$i]->ifdparameters) 
  //                                                   {
  //                                                           foreach($structure->parts[$i]->dparameters as $object) 
  //                                                           {
  //                                                                   if(strtolower($object->attribute) == 'filename') 
  //                                                                   {
  //                                                                           $attachments[$i]['is_attachment'] = true;
  //                                                                           $attachments[$i]['filename'] = $object->value;
  //                                                                   }
  //                                                           }
  //                                                   }
  //                                                   if($structure->parts[$i]->ifparameters) 
  //                                                   {
  //                                                           foreach($structure->parts[$i]->parameters as $object) 
  //                                                           {
  //                                                                   if(strtolower($object->attribute) == 'name') 
  //                                                                   {
  //                                                                           $attachments[$i]['is_attachment'] = true;
  //                                                                           $attachments[$i]['name'] = $object->value;
  //                                                                   }
  //                                                           }
  //                                                   }
  //                                                   if($attachments[$i]['is_attachment']) 
  //                                                   {
  //                                                           $attachments[$i]['attachment'] = imap_fetchbody($imap, $email_number, $i+1);

  //                                                           /* 4 = QUOTED-PRINTABLE encoding */
  //                                                           if($structure->parts[$i]->encoding == 3) 
  //                                                           { 
  //                                                                   $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
  //                                                           }
  //                                                           /* 3 = BASE64 encoding */
  //                                                           elseif($structure->parts[$i]->encoding == 4) 
  //                                                           { 
  //                                                                   $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
  //                                                           }
  //                                                   }
  //                                           }
  //                                           foreach($attachments as $attachment)
  //                                           {
  //                                                   $condition_ar = array();
  //                                                   if($attachment['is_attachment'] == 1)
  //                                                   {	
  //                                                           $filename = $attachment['name'];
  //                                                           $data_attach['file_name'] = $email_number . "-" . $filename;
  //                                                           if(empty($filename)) $filename = $attachment['filename'];

  //                                                           if(empty($filename)) $filename = time() . ".dat";

  //                                                           /* prefix the email number to the filename in case two emails
  //                                                            * have the attachment with the same file name.
  //                                                            */
  //                                                           $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/emails/'.$email_number . "-" . $filename, "w+");
  //                                                           fwrite($fp, $attachment['attachment']);
  //                                                           fclose($fp);

  //                                                           $data_attach['attachment_id']=$saved['id'];
  //                                                           $data_attach['created_at']=date("Y-m-d H:i:s");
		// 													$data_attach['cmpny_id']=$cmpny_id;
  //                                                           $attach_res = EmailFetchAttachment::firstOrCreate($data_attach);
  //                                                   }
  //                                           }
  //                                   }

  //                               }
  //                   }
  //               }  

			
            
  //               }
  //           }
  //           imap_close($imap);
  //           echo "Email Fetch Successfully";
		// }
		// else
		// {
		// 	echo "Server credentials missing";
		// }
  //       }
  //           else 
  //           {
  //                echo "IMAP functions are not available.<br />\n";
  //           }
			
		// $updarr = array('updated_at' => date('Y-m-d H:i:s'));
		// CompanyMeta::where('id',$tab_id)->update($updarr);
		// }
	}
   /**
     * @email view mail count to dashboard
     * @author PRANEESHA KP
     * @date 01/03/2019
     * @since version 1.0.0
    */
    public function mail_count_dashboard(Request $request)
    {
            
            $read_c   =   EmailFetch::select(DB::raw('count(*) as total'))
                    ->where('email_id', '!=', '0')
                    ->where('read_status', '=', '1')
                    ->groupBy('thread_id')->get();
            
            $read_count=count($read_c);
            $unread_c   =   EmailFetch::select(DB::raw('count(*) as total'))
                    ->where('email_id', '!=', '0')
                    ->where('read_status', '=', '0')
                    ->groupBy('thread_id')->get();
            $unread_count=count($unread_c);
            $answered_c   =   EmailFetch::select(DB::raw('count(*) as total'))
                    ->where('email_id', '!=', '0')
                    ->where('answered', '=', '1')
                    ->groupBy('thread_id')->get();
            $answered=count($answered_c);
            $total   =   EmailFetch::select(DB::raw('count(*) as total'))
                    ->where('email_id', '!=', '0')
                    ->groupBy('thread_id')->get();
            $total=count($total);
         
            return view('emailfetch.mail_count_dashborad',compact('read_count','unread_count','answered','total','read_c','unread_c','answered_c'));
    }
  
  /**
   * @email download attachment from email
     * @author AKHIL MURUKAN 
     * @date 07/08/2017
     * @since version 1.0.0
    */
  public function download_attachment($filename)
  {
            $this->middleware('auth');
        $download_path = ( public_path() . '/emails/'. $filename);
        return response()->download($download_path); 
  }
  public function unreadmailcount()
  {
    $unread_c   =   EmailFetch::select(DB::raw('count(*) as total'))
                    ->where('email_id', '!=', '0')
                    ->where('read_status', '=', '0')
                    //->groupBy('thread_id')
          ->count();
        echo $unread_c;
  }
  
  
}
