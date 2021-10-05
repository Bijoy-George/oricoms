<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\cc_common_sms_email;  
use App\Helpers;
use DB;
use Carbon\Carbon;
use App\CronLog;
use App\CompanyMeta;
use App\EmailFetch;
use App\Templates;
use App\CommonSmsEmail;
use App\EmailFetchAttachment;

class EmailFetchJob implements ShouldQueue
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

		try
		{	
			$company_select = CompanyMeta::select('cmpny_id','id','meta_name')->where('meta_name','like', 'mail_server_host%')->orderBy('updated_at','asc')->first();
			if($company_select)
			{
				$tab_id = $company_select->id;
				$cmpny_id = $company_select->cmpny_id;
				$meta_arr = $company_select->meta_name;
				$meta_arr = explode("_host_",$meta_arr);
				
				
            if (function_exists('imap_open')) {
                    echo "IMAP functions are available.<br />\n";
        // dynamic mail server selection starts
        
		// $hostname = Helpers::get_company_meta('mail_server_host_'.$meta_arr[1],$cmpny_id);
		// $username = Helpers::get_company_meta('mail_server_username_'.$meta_arr[1],$cmpny_id);
		// $password = Helpers::get_company_meta('mail_server_password_'.$meta_arr[1],$cmpny_id);
		$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
			$username = 'rogerme166@gmail.com';
			$password = 'godwinsimon661';
		
		if(isset($hostname) && !empty($hostname) && isset($username) && !empty($username) && isset($password) && !empty($password))
		{
			$imap = imap_open($hostname, $username, $password)or die(imap_last_error())or die("can't connect: ".imap_last_error());

			// mb_internal_encoding("UTF-8");
			// $imap = imap_open("{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX", $username, $password)or die(imap_last_error())or die("can't connect: ".imap_last_error());
			
			$threadValues = array();
            $thread = imap_thread($imap);
            $rootThread = 0;
			foreach ($thread as $i => $messageId) {
				list($sequence, $type) = explode('.', $i);
				if($type != 'num' || $messageId == 0 || ($rootThread == 0 && $thread[$sequence.'.next'] == 0) || isset($threadValues[$messageId])) {
                        continue;
                }
				if($rootThread == 0) {
                    $rootThread = $messageId;//set root
                }
				if($thread[$sequence.'.next'] == 0) {
                    $rootThread = 0;//reset root
                }
			}

			$date = Carbon::now()->format('d M Y');
			$date_str = 'SINCE "'.$date.'"';
			$email_read = 'UNSEEN';
			$mail_ids = imap_search($imap,$email_read);
			if(!empty($mail_ids))
            {
				$emails = imap_fetch_overview($imap, implode(',', $mail_ids));
				$chgflg = imap_setflag_full($imap,implode(",", $mail_ids), "\\Seen \\Flagged"); //IMPORTANT	
				if(!empty($emails))
                {
					foreach ($emails as $email) {
					$subt = '';
						if(isset($email->subject)) {
							$condition_ar   = array();
                            $email_number   = $condition_arr['email_id'] = $email->msgno;
							$subject      = $email->subject;
                            $elements = imap_mime_header_decode($subject);
							for ($i=0; $i<count($elements); $i++) {
                                $charset = $elements[$i]->charset;
                                $subject = $elements[$i]->text;
				$subt .= $elements[$i]->text;
                            }
							$condition_arr['subject']       = trim(preg_replace("/Re\:|re\:|RE\:|Fwd\:|fwd\:|FWD\:/i", '', $subt));
							$condition_arr['from_name']     = $email->from;
                            $condition_arr['received_date'] = date("Y-m-d H:i:s",$email->udate);
                            $header                         = imap_headerinfo($imap, $email_number);
							$condition_arr['from']          = $header->from[0]->mailbox . "@" . $header->from[0]->host;
							$condition_arr['message_id']=$header->message_id;
							$to=imap_fetchheader($imap, $email_number);
                            $to=imap_rfc822_parse_headers($to);
                            $to_array=array();
                                          if(isset($to->to) && count($to->to)>0){
                                          for ($to_count=0; $to_count<count($to->to); $to_count++)
                                          {
                                              $arr=$to->to[$to_count]->mailbox . "@" . $to->to[$to_count]->host;
                                              if($arr!=$username)
                                              {
                                                $to_array[$to_count]=$arr;
                                              }

                                          }
                                          $condition_arr['to']=join(',',$to_array);

                                }
							
                            $cc_array=array();
                            if(isset($header->cc) && !empty($header->cc))
                            {
	                            for ($cc_count=0; $cc_count<count($header->cc); $cc_count++)
	                            	
	                            {
	                                $cc_arr=$header->cc[$cc_count]->mailbox . "@" . $header->cc[$cc_count]->host;
									if($cc_arr!=$username)
									{
									  $cc_array[$cc_count]=$cc_arr;
									}
	                                
	                            }
	                            $condition_arr['Cc_email']=join(',',$cc_array);
                            }

							 $exclude_mails_from_list = array('mailer-daemon@googlemail.com');
							if(in_array($condition_arr['from'],$exclude_mails_from_list))continue;
							$condition_arr['thread_id']   = $email_number;
							if(isset($threadValues[$email_number]))
                            {
                                $condition_arr['thread_id'] = $threadValues[$email_number];
                            }
							$record = EmailFetch::where('email_id',$email_number)->where('cmpny_id',$cmpny_id)->first();
							if (is_null($record)) {
								$structure = imap_fetchstructure($imap, $email_number);
								$ptype = '';
								if(isset($structure->parts)){
								$part = $structure->parts;
								$ptype = $part[0]->type;
								}			
								if($ptype == 0) {
									$message = imap_fetchbody($imap,$email_number,2, FT_PEEK);
									if (base64_decode($message, true)) {
										$message = base64_decode($message);
										echo 123;echo "<pre>";print_r($message);echo "</pre>";
									} 
									if(quoted_printable_decode($message))
									{
										$message = quoted_printable_decode($message);
										echo 456;echo "<pre>";print_r($message);echo "</pre>";
									}
									if ($message == "") {
										$message = imap_fetchbody($imap, $email_number, 1, FT_PEEK);
										echo 789;echo "<pre>";print_r($message);echo "</pre>";
									}echo "mes11 - ".$message;
								} elseif($ptype == 1) {
                                    
                                    if($part[0]->subtype=="ALTERNATIVE")//condition for inline content and message
                                    {

                                        if($part[0]->parts[0]->encoding==3)//condition for inline image and malayalam message  
                                        {
                                          $message=imap_fetchbody($imap,$email_number,1.2);
                                          
                                            if (base64_decode($message, true)) {
                                            $message = base64_decode($message);
                                            } 
                                            if(quoted_printable_decode($message))
                                            {
                                                
                                                $message = quoted_printable_decode($message);
                                            }
                                          
                                          
                                        }
                                        else{
                                           $message=imap_fetchbody($imap,$email_number,"1.2"); //for fetching inline image and english message
                                        }
                                    }

									
                                    elseif($part[0]->subtype=="RELATED")//inline content,message and attachment
                                    {
                                        
                                       
                                        if($part[0]->parts[0]->subtype=="ALTERNATIVE")
                                        {   
                                           
                                            if($part[0]->parts[0]->parts[1]->encoding==4)
                                            {
                                                $message=imap_fetchbody($imap,$email_number,"1.1",FT_PEEK );

                                                if (base64_decode($message, true)) {
                                                    $message = base64_decode($message);
                                                } 
                                                if(quoted_printable_decode($message))
                                                {
                                                    
                                                    $message = quoted_printable_decode($message);
                                                }

                                                
                                                $x=explode('quoted-printable',$message);
                                                $message=$x[1];
                                               

                                            }
                                            elseif ($part[0]->parts[0]->parts[1]->encoding==3) {
                                                //condition for inline image,malayalam content and attachment
                                                 $message=imap_fetchbody($imap,$email_number,2,FT_INTERNAL);
                                                
                                                if (base64_decode($message, true)) {
                                                    $message = base64_decode($message);
                                                    
                                                } 
                                                if(quoted_printable_decode($message))
                                                {
                                                    
                                                    $message = quoted_printable_decode($message);
                                                }
                                                
                                               
                                            }
                                            else
                                            {
                                            //when there is only inline image and no message     
                                            $message=imap_fetchbody($imap,$email_number,"1.1");
                                            $x=explode("UTF-8",$message);
                                            $message=$x[2];
                                                
                                            }
                                        }
                                    }
                                    elseif(empty($message)) {
                                        $message = imap_fetchbody($imap,$email_number,1);
                                    }

								}
                                
								$message = trim(imap_qprint($message));

								$updated_arr['message'] = $message;
								if(empty($updated_arr['message']))
								{	
									$updated_arr['message'] = $message;
								}
								$condition_arr['cmpny_id'] = $cmpny_id;
								$saved = EmailFetch::firstOrCreate($condition_arr,$updated_arr);
								/////////////// CODE FOR RESPONSE STARTS HERE
			/*	$cc_email_fetchs_response = EmailFetch::Create([
								'email_id' => null,
								'cmpny_id' => $cmpny_id,
								'subject' => $condition_arr['subject'],
								'from_name' => $username,
								'received_date' => $condition_arr['received_date'],
								'from' => $username,
								'thread_id' => $condition_arr['thread_id'],
								]);*/
						$templ_id = Helpers::get_company_meta('auto_mail_response',$cmpny_id);
						if(isset($templ_id) && !empty($templ_id))
						{
						$cmp_emails = Templates::where('id',$templ_id)->where('cmpny_id',$cmpny_id)->first();
						if(count($cmp_emails)>0)
						{
							$content = $cmp_emails->content;
							$subject = $cmp_emails->subject;
							$fname = $condition_arr['from_name'];
							if(isset($fname) && !empty($fname))
							{
									$content = str_replace('[[ First Name ]]', $fname, $content);
							}
							else
							{
									$fname = 'Customer';
									$content = str_replace('[[ First Name ]]', $fname, $content);
							}
						$set_crm_source = Helpers::get_company_meta('set_crm_source',$cmpny_id);
						$random_code = str_random(12);
						$mail_arr = CommonSmsEmail::Create(
																	[
																	'authentication' => '',
																	'cmpny_id' => $cmpny_id,
																	'source' => $set_crm_source,
																	'email' => $condition_arr['from'],
																	'customer_id' => null,
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
															   ]);
														}
														
                                                        }

                                                            ///////////// CODE FOR RESPONSE ENDS HERE
								$attachments =array();
                                if(isset($structure->parts) && count($structure->parts)) {
									echo "<pre>";print_r($structure->parts);
									for($i = 1; $i < count($structure->parts); $i++) {
										$attachments[$i] = array(
                                            'is_attachment' => false,
                                            'filename' => '',
                                            'name' => '',
                                            'attachment' => ''
                                        );
										if($structure->parts[$i]->ifdparameters) {
                                            foreach($structure->parts[$i]->dparameters as $object) {
                                                if(strtolower($object->attribute) == 'filename') {
                                                    $attachments[$i]['is_attachment'] = true;
                                                    $attachments[$i]['filename'] = $object->value;
                                                }
                                            }
                                        }
										if($structure->parts[$i]->ifparameters) {
                                            foreach($structure->parts[$i]->parameters as $object) {
                                                if(strtolower($object->attribute) == 'name') {
                                                    $attachments[$i]['is_attachment'] = true;
                                                    $attachments[$i]['name'] = $object->value;
                                                }
                                            }
                                        }
										if($attachments[$i]['is_attachment']) {
                                            $attachments[$i]['attachment'] = imap_fetchbody($imap, $email_number, $i+1);
                                            /* 4 = QUOTED-PRINTABLE encoding */
                                            if($structure->parts[$i]->encoding == 3) { 
                                                $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                                            }
                                            /* 3 = BASE64 encoding */
                                            elseif($structure->parts[$i]->encoding == 4) { 
                                                $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                                            }
                                        }
									}
									$count_array=$i;
                                    
                                    if($part[0]->subtype == "RELATED")
                                    {
                                       if(isset($structure->parts[0]->parts[1]) && count($structure->parts[0]->parts));
                                       {
                                        
                                        print_r($structure->parts[0]->parts);
                                        
                                        for($i = 1; $i < count($structure->parts[0]->parts); $i++) {
                                            
                                           
                                        $attachments[$count_array] = array(
                                            'is_attachment' => false,
                                            'filename' => '',
                                            'name' => '',
                                            'attachment' => ''
                                        );
                                        
                                        
                                        if($structure->parts[0]->parts[$i]->ifdparameters) {

                                            foreach($structure->parts[0]->parts[$i]->dparameters as $object) {
                                                if(strtolower($object->attribute) == 'filename') {
                                                    
                                                    $attachments[$count_array]['is_attachment'] = true;
                                                    $attachments[$count_array]['filename'] = $object->value;
                                                    
                                                }
                                            }
                                        }
                                        if($structure->parts[0]->parts[$i]->ifparameters) {
                                            foreach($structure->parts[0]->parts[$i]->parameters as $object) {
                                                if(strtolower($object->attribute) == 'name') {
                                                    $attachments[$count_array]['is_attachment'] = true;
                                                    $attachments[$count_array]['name'] = $object->value;
                                                    
                                                }
                                            }
                                        }
                                        if($attachments[$count_array]['is_attachment']) {
                                            $attachments[$count_array]['attachment'] = imap_fetchbody($imap, $email_number, $i+1);

                                            /* 4 = QUOTED-PRINTABLE encoding */
                                            if($structure->parts[0]->parts[$i]->encoding == 3) { 
                                                $attachments[$count_array]['attachment'] = base64_decode($attachments[$count_array]['attachment']);

                                            }
                                            /* 3 = BASE64 encoding */
                                            elseif($structure->parts[0]->parts[$i]->encoding == 4) { 
                                                $attachments[$count_array]['attachment'] = quoted_printable_decode($attachments[$count_array]['attachment']);

                                            }
                                        }
                                        $count_array++;
                                        
                                    
                                    }
                                     
                                       }
                                   }
									
									
									foreach($attachments as $attachment) {
										echo "<pre>";print_r($attachments);echo "</pre>";
                                        $condition_ar = array();
                                        if($attachment['is_attachment'] == 1) {	
                                            $filename = $attachment['name'];
                                            $data_attach['file_name'] = $email_number . "-" . $filename;
                                            if(empty($filename)) $filename = $attachment['filename'];

                                            if(empty($filename)) $filename = time() . ".dat";

                                            /* prefix the email number to the filename in case two emails
                                            * have the attachment with the same file name.*/
                                            $fp = fopen(base_path().'/public/emails/'.$email_number . "-" . $filename, "w+");
                                            fwrite($fp, $attachment['attachment']);
                                            fclose($fp);

                                            $data_attach['attachment_id']=$saved['id'];
                                            $data_attach['created_at']=date("Y-m-d H:i:s");
											$data_attach['cmpny_id']=$cmpny_id;
											$attach_res = EmailFetchAttachment::firstOrCreate($data_attach);
                                        }
                                    }
								}
							}
						}
					}
				}
			}
			imap_close($imap);
            echo "Email Fetch Successfully";
		}
		else
		{
			echo "Server credentials missing";
		}
        }
            else 
            {
                 echo "IMAP functions are not available.<br />\n";
            }
			
		$updarr = array('updated_at' => date('Y-m-d H:i:s'));
		CompanyMeta::where('id',$tab_id)->update($updarr);
		}
		
		}
		catch(\Illuminate\Database\QueryException $ex){
			$cc_cron_log    = new CronLog;
			$cron_logid           = $cc_cron_log->createLog('email_fetch');
			$error      = $ex->getMessage();
			$cc_cron_log->updateLog($cron_logid,$error);
		}
    }
}
