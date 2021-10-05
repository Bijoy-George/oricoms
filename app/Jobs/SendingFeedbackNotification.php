<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\CommonSmsEmail;  
use App\FeedbackRequest;
use App\Templates;
use App\CronLog;
use App\Helpdesk; 
use App\CustomerProfile;
use App\LeadSources;
use App\CompanyMeta;
use App\Helpers;


class SendingFeedbackNotification implements ShouldQueue
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
                     
                    echo $cur_date=date('Y-m-d H:i');
                    $fb_det=FeedbackRequest::where('status',config('constant.INACTIVE'))
                    ->where('action_time','like', '%'.$cur_date.'%')
                    ->get();

                    foreach ($fb_det as $key => $value) {
                    $user_id=$value->customer_id;
                    $req_id=$value->id;
                     $fo_id=$value->helpdesk_id;
                    $fb_type=$value->fb_type;
                    $ins_arr=array();
                    $condtn_arr=array();
                    $ins_arr['follow_id']=$fo_id;
                    $ins_arr['customer_id']=$user_id;
                    $ins_arr['status'] = config('constant.INACTIVE');
                    $ins_arr['process'] = 1;
                     if($fb_type == config('constant.CH_EMAIL'))
                     {
                        $meta_data=CompanyMeta::where('meta_name','feedback_mail')->first();
                        
                    }else if($fb_type == config('constant.CH_SMS')){
                        $meta_data=CompanyMeta::where('meta_name','feedback_sms')->first();
                    }
                    else {
                        $meta_data=array();
                    }
                    $new_content    ='';
                    $subject='';
                    if($meta_data){
                        $cmp_emails = Templates::where('id',$meta_data->meta_value)->first(); 
                        if(isset($cmp_emails->content) && !empty($cmp_emails->content)){
                        $new_content    =  $cmp_emails->content;
                        $subject    =  $cmp_emails->subject;
                        }
                    }
                   
                    $follow_dets=Helpdesk::where('id',$fo_id)->first();
                    if(isset($follow_dets->docket_number))
                    {
                       $docket_number=$follow_dets->docket_number;
                    }else{
                        $docket_number='';
                    }
                                $ins_arr['sent_type']=NULL;
                                $fb_user      =   CustomerProfile::where('id',$user_id)->first();
                                $random_no = str_random(10);
                                if(!empty($fb_user) && !empty($new_content))
                                {
                                    $auth=LeadSources::where('cmpny_id',$fb_user->cmpny_id)
                                        ->where('status',config('constant.ACTIVE'))->orderBy('id','desc')->first();
                                    $authentication=$auth->source_key;

                                    if(isset($fb_user->first_name) && !empty($fb_user->first_name)){
                                         $name = trim($fb_user->first_name);
                                     }else{
                                        $name ='Customer';
                                     }

                                    if($fb_type == config('constant.CH_EMAIL') && !empty($fb_user->email)){
                                        $str=$fo_id.'_'.config('constant.LANG_ENG').'_'.$random_no.'_'.$authentication.'_'.config('constant.CH_EMAIL');
                                        $str_mala=$fo_id.'_'.config('constant.LANG_MALA').'_'.$random_no.'_'.$authentication.'_'.config('constant.CH_EMAIL');
                                        $encoded = urlencode( base64_encode( trim($str) ) );
                                        $encoded_mala = urlencode( base64_encode( trim($str_mala) ) );
                                        $fb_url=url('/feedbackform/'.$encoded);
                                        $fb_url_mala=url('/feedbackform/'.$encoded_mala);
                                        // REOPEN & CLOSED LINK //
                                        $str_open=$fo_id.'_2';
                                        $str_close=$fo_id.'_1';
                                        $encoded_open = urlencode( base64_encode( $str_open ) );
                                        $encoded_close = urlencode( base64_encode( $str_close ) );
                                        $reopen_url=url('/FeedbackConfirmation/'.$encoded_open);
                                        $close_url=url('/FeedbackConfirmation/'.$encoded_close);
                                        
                                        echo $email = trim($fb_user->email);
                                        $ins_arr['email']=$email;
                                        echo $content    =   '<a href='.$fb_url.'>For English Feedback</a><br><a href='.$fb_url_mala.'>For Malayalam Feedback</a>';
                                        /* $content    =   'Dear '.$name.',<br> Please click on the links below to add your feedback for docket number <b>'.$fo_id.'</b>.<br><a href='.$fb_url.'>For English Feedback</a><br><a href='.$fb_url_mala.'>For Malayalam Feedback</a> </br><br> Are you satisfied with our respond Please close otherwise Re-open the same <br><a style="padding: 1px 6px; border: 1px solid #d43525;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;border-radius: 4px;background-color:#d43525" href='.$reopen_url.'>RE-OPEN</a>  <a style="padding: 1px 6px; border: 1px solid #9dcc24;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;border-radius: 4px;background-color:#0a8440" href='.$close_url.'>CLOSED</a></br>';*/


                                        $new_content = str_replace('[[ Mail_Content ]]', $content, $new_content);
                                        $new_content = str_replace('[[ First Name ]]', $name, $new_content);
                                        $new_content = str_replace('\r\n', '<br>', $new_content);
                                        $new_content = str_replace('\n', '<br>', $new_content);
                                        $content = $new_content;
						// ADDED FOR TEMPLATES HEADER AND FOOTER
						$email_header_content = '';$email_footer_content = '';
						$email_header = Helpers::get_company_meta('email_header',$fb_user->cmpny_id);
						$email_footer = Helpers::get_company_meta('email_footer',$fb_user->cmpny_id);
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
                                        $ins_arr['content']=$content;
                                         $ins_arr['random_code']=$random_no;
                                        $ins_arr['subject']=$subject;
                                        $ins_arr['sent_type']= config('constant.CH_EMAIL');
                                        $condtn_arr['sent_type']= config('constant.CH_EMAIL');
                                    }
                                   
                                    if($fb_type == config('constant.CH_SMS') && !empty($fb_user->mobile)){
                                        
                                        $str1=$fo_id.'_'.config('constant.LANG_ENG').'_'.$random_no.'_'.$authentication.'_'.config('constant.CH_SMS');
                                        $str1_mala=$fo_id.'_'.config('constant.LANG_MALA').'_'.$random_no.'_'.$authentication.'_'.config('constant.CH_SMS');
                                        $encoded1 = urlencode( base64_encode( trim($str1) ) );
                                        $encoded1_mala = urlencode( base64_encode( trim($str1_mala) ) );
                                        $fb_url_s=url('/feedbackform/'.$encoded1);
                                        $fb_url_s_mala=url('/feedbackform/'.$encoded1_mala);


                                        echo $mobile_number1 = trim($fb_user->mobile);
                                        if(isset($fb_user->country_code) && !empty($fb_user->country_code) && ($fb_user->country_code!='NULL'))
                                        {
                                            $mobile_number = $fb_user->country_code.$mobile_number1;
                                        }
                                        else
                                        {
                                            $mobile_number=$mobile_number1;
                                        }

                                        $ins_arr['mobile']=$mobile_number;
                                        echo $content    =   'Dear '.$name.',\n Please click on the links below to add your feedback for docket number '.$fo_id.'.\n For English Feedback :'.$fb_url_s.'\n For Malayalam Feedback:'.$fb_url_s_mala;

                                        $ins_arr['content']=$content;
                                         $ins_arr['random_code']=$random_no;
                                        $ins_arr['sent_type']= config('constant.CH_SMS');
                                        $condtn_arr['sent_type']= config('constant.CH_SMS');
                                    }
                                    if($fb_type == config('constant.CO_FEEDBACK_CALL')){
                                        
                                       /* echo $mobile_number1 = trim($fb_user->mobile_number);
                                        if(isset($fb_user->country_code) && !empty($fb_user->country_code) && ($fb_user->country_code!='NULL'))
                                        {
                                            $mobile_number = $fb_user->country_code.$mobile_number1;
                                        }
                                        else
                                        {
                                            $mobile_number=$mobile_number1;
                                        }
                                        $ins_arr['mobile']=$mobile_number;
                                        $ins_arr['content']='';
                                        $ins_arr['sent_type']= config('constant.CO_FEEDBACK_CALL');
                                        $condtn_arr['sent_type']= config('constant.CO_FEEDBACK_CALL');*/
                                    }
                                    $condtn_arr['follow_id']=$fo_id;
                                    $condtn_arr['customer_id']=$user_id;
                                    $ins_arr['cmpny_id']=$fb_user->cmpny_id; 
                                    $ex_count=CommonSmsEmail::where('sent_type',$ins_arr['sent_type'])->where('follow_id',$fo_id)->count();
                                    
                                    if($ex_count == 0){
                                    $inserted_id=CommonSmsEmail::Create($ins_arr);
                                    $result_id=$inserted_id->id;
                                    $up_arr=array('common_id'=>$result_id);
                                    FeedbackRequest::where('id',$req_id)->update($up_arr);
                                    }
                                }
                                


                     }           

            }
            catch(\Illuminate\Database\QueryException $ex){
               $cc_cron_log    = new CronLog;
                $cron_logid           = $cc_cron_log->createLog('sending_feedback_notification');
                $error      = $ex->getMessage();
                $cc_cron_log->updateLog($cron_logid,$error);
            }
	}
}
