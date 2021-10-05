<?php

namespace App\Jobs;

use App\CommonSmsEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\CronLog;
use CommunicationHelper;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            //echo "mail"; exit;
            $mails  = CommonSmsEmail::whereNotNull('email')
                        ->where('status', config('constant.INACTIVE'))
                        ->where('sent_type', config('constant.CH_EMAIL'))
                        ->with('campaign', 'attachments', 'batch.attachments')
                        ->orderBy('communication_type', 'desc')
                        ->orderBy('id','asc')
                        ->limit(15)
                        ->get();
           

            
           


            do {

                if (count($mails) < 1)
                {
                    break;
                }

                $unique_mails   = $mails->unique(function ($mail) {
                    return $mail['email'] . '-' . $mail['subject'];
                });

                $unique_mails   = collect($unique_mails->values()->all());
                $unique_mail_ids    = $unique_mails->pluck('id')->all();

                //Update status of repeated mails

                $mails = $mails->filter(function ($mail, $key) use ($unique_mail_ids) {
                    if (!in_array($mail->id, $unique_mail_ids))
                    {
                        $mail->status = config('constant.EMAIL_DELIVERY_STATUS.REPEAT');
                        $mail->response = 'sent';
                        $mail->save();
                        return false;
                    }

                    return true;
                });

                if (count($mails) < 1)
                {
                    break;
                }

                $fail_count_prev = 0;
                foreach ($mails as $mail)
                {
                    //echo $mail->email; 
                   // $emails = $mail->email;
                    $emails = str_replace(" ","",explode(',', $mail->email));
					$cc_emails = array();
                    $cc_emails_var  = $mail->email_cc;
					if(isset($cc_emails_var) && !empty($cc_emails_var) && ($cc_emails_var != ' '))
					{
						$cc_emails  = explode(',', $cc_emails_var);
						$cc_emails  = str_replace(" ","",$cc_emails);
					}                    
                    $attachments    = NULL;
                    if (isset($mail->batch->attachments) && count($mail->batch->attachments))
                    {
                        $attachments    = $mail->batch->attachments;
                    }
                    if (empty($attachments) && isset($mail->attachments) && count($mail->attachments))
                    {
                        $attachments    = $mail->attachments;
                    }
		$reply_to = '';
					if(isset($mail->from) && !empty($mail->from))
					{
						$reply_to = $mail->from;
					}
                    try { 
                        $data['category_name']      = $mail->campaign->name ?? '';
                        $data['email']              = $emails;
			             $data['from']               = $reply_to;  
                        $data['message_id']         = str_replace(" ","",$mail->message_id);
                        $data['cc_emails']          = $cc_emails;
                        $data['subject']            = $mail->subject;
                        $data['content']            = $mail->content;
                        $data['mail_ref_id']        = str_random(15);
                        $data['saved_attachments']  = $attachments;
                        $data['cmpny_id']           = $mail->cmpny_id;
                        $data['communication_type'] = $mail->communication_type;
                        
                        $ress = CommunicationHelper::getCmpChannel($data);
    
                        
                        //Mail::to($email)->send(new CommonMail($data));
                        //$failure_count  = count(Mail::failures());
                        if($ress == 0){
                            $fail_count_prev++;
                                                 //  echo "There was one or more failures. They were: <br />";
                           $mail->status    = config('constant.EMAIL_DELIVERY_STATUS.FAILED');
                           $mail->save();
                           break;
                        }

                        //exit;
                        $mail->status   = config('constant.EMAIL_DELIVERY_STATUS.MOVED');
                        $mail->response = 'sent';
                        $mail->mail_ref_id  = $data['mail_ref_id'];
                        $mail->save();
                    }
                    catch(\Exception $e)
                    {
                        $cc_cron_log    = new CronLog;
                        $cron_logid     = $cc_cron_log->createLog('send_email');
                        $error      = $e->getMessage();
                        $cc_cron_log->updateLog($cron_logid,$error);
                        $mail->status    = config('constant.EMAIL_DELIVERY_STATUS.EXCEPTION_OCCURED');
                        $mail->save();
                    }
                }
            }
            while(false);


        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $cc_cron_log    = new CronLog;
            $cron_logid           = $cc_cron_log->createLog('send_email');
            $error      = $ex->getMessage();
            $cc_cron_log->updateLog($cron_logid,$error);
        }
    }
}
