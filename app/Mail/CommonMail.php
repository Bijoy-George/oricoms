<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommonMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject    = $this->data['subject'];
        $content    = $this->data['content'];
        $cc_emails  = $this->data['cc_emails'];
        $category_name  = $this->data['category_name'];
        $mail_ref_id    = $this->data['mail_ref_id'];
        $from       = config('constant.mail_send_from');
        $from_name  = config('constant.mail_send_from_name');
    /*if(isset($this->data['from']) && !empty($this->data['from']))
        {
                $from = $this->data['from'];
        }else
        {
                $from       = config('constant.mail_send_from');
        }
        if(isset($this->data['from_name']) && !empty($this->data['from_name']))
        {
                $from_name = $this->data['from_name'];
        }else
        {
                $from_name  = config('constant.mail_send_from_name');
        }*/
        if(isset($cc_emails) && !empty($cc_emails)){
                $this->cc($cc_emails);
        }           
                        
        $headerData = array();
        if(isset($category_name) && $category_name!=''){
            
               $headerData['category'] = $category_name;
        }
        if(isset($mail_ref_id) && $mail_ref_id != ''){
               $headerData['unique_args'] = [
                'mail_ref_id' => $mail_ref_id
                ];
        }

        if (isset($this->data['saved_attachments']) && !empty($this->data['saved_attachments']))
        {
            $saved_attachments  = $this->data['saved_attachments'];
            foreach ($saved_attachments as $attachment)
            {
                $attachment_file_name       = $attachment->attachment_file_name;
                $attachment_original_name   = $attachment->attachment_original_name;
                $attachment_mime_type       = $attachment->attachment_mime_type;
                $attachment_file_path       = storage_path().'/app/attachments/'.$attachment_file_name;

                if (file_exists($attachment_file_path))
                {
                    $this->attach($attachment_file_path, array('as' => $attachment_original_name, 'mime' => $attachment_mime_type));
                }
            }
        }

    /*$headerData = [
            'category' => 'category',
            'unique_args' => [
            'variable_1' => 'abc'
            ]
        ];*/
        if(!empty($headerData))
        {
        $header = $this->asString($headerData);

        $this->withSwiftMessage(function ($message) use ($header) {
            $message->getHeaders()
                    ->addTextHeader('X-SMTPAPI', $header);
        });
    }
        
        return $this->view('mails.commonmail')
                    ->from($from, $from_name)
                    ->replyTo($from, $from_name)
                    ->subject($subject)
                    ->with([ 'content' => $content ]);
    }

    private function asJSON($data)
    {
        $json = json_encode($data);
        $json = preg_replace('/(["\]}])([,:])(["\[{])/', '$1$2 $3', $json);

        return $json;
    }


    private function asString($data)
    {
        $json = $this->asJSON($data);

        return wordwrap($json, 76, "\n   ");
    }
}
