<?php

namespace App;
use Auth;
use Carbon\Carbon;
use App\AutodialSchedules;

class CommunicationHelper
{
  /********************** general functions start *********************/
  /*
    * @return profile details 
    * @author AKHIL MURUKAN
    * @date 20/02/2018
    * @since version 1.0.0
    * @param NULL
    */ 
  static function get_profile_details($crm_profile_id = '',$select_values = '*',$ksfe_id = '')
  {
                $user_details = cc_customer_profile::select($select_values);
    if(isset($crm_profile_id) && !empty($crm_profile_id))
                {
                        $user_details->where('id', $crm_profile_id);
                }
                if(!empty($ksfe_id) && $ksfe_id != '')
                {
                        $user_details->where('ksfe_cust_id', $ksfe_id);
                }
                $result = $user_details->first();

                if(!empty($result) && count($result)>0)
                {
                    return $result;
                }
                else 
                {
                    return FALSE;
                }
  }
  /*
    * @Mail Template Conversion commen function
    * @author Chinnu L
    * @date 20/02/2018
    * @since version 1.0.0
    * @param NULL
    @edited by Ela - 23-11-2018
    */ 
    public static function mail_template_convert($templateId='',$crm_profile_id='',$customer_id='',$template_arguments = '')
    {
        if($templateId !='')
        {
            $customer_id_arg = '';
            $profile_details = FALSE;
            $email_template = cc_mail_categories::where('id',$templateId)->first();
            if(!empty($email_template) && count($email_template)>0)
            {
                $content        =  $email_template->content;
                $subject        = $email_template->subject;
                if($template_arguments!='')
                {
                    $convertion_arr = json_decode($template_arguments);
                }
                if(!empty($convertion_arr))
                {
                        foreach ($convertion_arr as $key => $value) {
                            if($key=='customer_id')
                                $customer_id_arg = $value; 
                            $content = str_replace('[[ '.$key.' ]]', $value, $content);
                        }
                }

                if($crm_profile_id != '')
                {
                        $profile_details = communication_helpers::get_profile_details($crm_profile_id);

                }
                else if(!empty ($customer_id) && $customer_id != '')
                {
                        $profile_details = communication_helpers::get_profile_details('','*',$customer_id);
                        
                        //return json_encode($profile_details);
                }
                if( !$profile_details && !empty($customer_id_arg) && $customer_id_arg != '')
                {
                    $profile_details = communication_helpers::get_profile_details('','*',$customer_id_arg);
                }
                if($profile_details)
                {
                       $greeting_arr = config('constant.greeting_arr');
                        foreach ($greeting_arr as $key => $value) {
                            $content = str_replace('[[ '.$value.' ]]', $profile_details->$key, $content);
                        }
                }
                return $converted = json_encode(array('subject' =>$customer_id_arg.$subject,'content' =>$content));
            }
        }
        return FALSE;
    }
	/* 
  For SMS
  */
   public static function common_sms_response($receipientno = '', $smscontent ='', $cmpid ='', $communication_type='')
	{
			$receipientno = $receipientno;
			$smscontent = $smscontent;
      
			if(isset($receipientno) && !empty($receipientno) && isset($smscontent) && !empty($smscontent))
			{
				
        /*$user_name = 'orysishttp';
				$pswd = 'oryhtss8';
				$frm = 'YIPKER';
				$url = "http://203.212.70.200/smpp/sendsms?";
        $responce_url = url('save_sms_response');
				$responcefull_url = "&udh=&dlr-mask=19&dlr-url=$responce_url?myid=%255%26status=%25d%26reciever=%25p%26updated_on=%25t%26res=%252";*/


        if(!empty($cmpid)){ 

          $meta_name = "transcation_sms";
          if($communication_type == 3){
            $meta_name = "transcation_sms";
          }elseif($communication_type == 2){
            $meta_name = "promotion_sms";
          }elseif($communication_type == 1){
            $meta_name = "notification_sms";
          }else{}


          $res =  CompanyMeta::select('meta_value')->where('meta_name',$meta_name)->where('cmpny_id',$cmpid)->first();

            $val = explode('_', $res->meta_value);
            $gateway = $val[0];
            $account_no = $val[1];
            $res = CompanyMeta::select('meta_name','meta_value')->where('meta_name','like',"$gateway%_$account_no")->where('cmpny_id',$cmpid)->get();

            foreach ($res as $key => $value) {
              $meta_name = $value->meta_name;
              $meta_name = str_replace("_$account_no", "",$meta_name);
              $meta_name = str_replace("$gateway"."_", "",$meta_name);

              $$meta_name = $value->meta_value;
            }
            // Create the Transport
            // Create the Transport
        if($gateway == 'valuefirst'){
          /**************** START VALUEFIRST ******************/
          $ch = curl_init();
          curl_setopt($ch,CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$user_name&password=$password&to=$receipientno&from=$from_name&text=$smscontent&category=bulk$responcefull_url");
          $buffer = curl_exec($ch);
             // $buffer = "guid=ki1sd1500087g1b13001c697ck47KSFEHTTP&errorcode=0&seqno=919995381265";
              //$buffer = "guid=ki1sd1604959g1b13001c5i4giaaKSFEHTTP&errorcode=3,0&seqno=919995381265,919633662214";
              $res = explode('&', $buffer);
              curl_close($ch);
              $result = array();
              if(is_array($res))
              {
                  $guid_str = $res[0];
                  $guid_str_arr = explode('=', $guid_str);
                  $guid = $guid_str_arr[1];

                  $errorcode_str = $res[1];
                  $errorcode_str_arr = explode('=', $errorcode_str);
                  $errorcode = $errorcode_str_arr[1];
                  $errorcode_sequ = explode(',', $errorcode);

                  if(isset($res[2]) && $res[2]!='')
                  {
                      $seqno_str = $res[2];
                      $seqno_str_arr = explode('=', $seqno_str);
                      $seqno = $seqno_str_arr[1];
                      $seqno_sequ = explode(',', $seqno);
                      
                      $i =0;
                      foreach ($seqno_sequ as $value) {
                          if($errorcode_sequ[$i]==0)
                          {
                             // $errorcode_sequ[$i] = 11;
                          }
                          $arry[] = array('guid'=>$guid,'mobile'=>$seqno_sequ[$i],'error'=>$errorcode_sequ[$i],'url'=>$responcefull_url,'type'=>'valuefirst');
                      }
                      
                  }
                  else 
                  {

                      $i =0;
                      foreach ($errorcode_sequ as $value) {
                          $arry[] = array('guid'=>$guid,'mobile'=>'','error'=>$errorcode_sequ[$i],'url'=>$responcefull_url,'type'=>'valuefirst');
                      }
                  }
                  
                return  $result = $arry;
                  
              }
          /************************ END VALUEFIRST *********************/
        }
        elseif($gateway == 'esms'){
          /**************** START ESMS ***********************************/

          $buffer =  file_get_contents("http://api.esms.kerala.gov.in/fastclient/SMSclientdr.php?username=$user_name&password=$password&message=".$smscontent."&numbers=".$receipientno."&senderid=$from_name");
    
           $res = explode(',', $buffer);
           $result = array();
           $guid = '';
           $status = '';
           $type = '';
           if(is_array($res))
           {
               if(isset($res[0]) && $res[0]!='')
               {
                   $status = $res[0];
               }
               if(isset($res[2]) && $res[2]!='')
               {
                   $guid = $res[2];   
               }
            $type = 'esms';   
           }
            $arry[] = array('guid'=>$guid,'error'=>$status,'type'=>$type);
            return  $result = $arry;

          /**************** END ESMS ***********************************/
        }

        }

			}
			else	
			{	
				$buffer='not sent';
				return $buffer;die;
			}
	}




  /*
    * Set dynamic communication channel
    * @author Elavarasi S
    * @date 06/12/2018
    * @since version 1.0.0
    * @param cmpid, meta_name
    * @return communication channel settings
    */
  public static function getCmpChannel($data){

   /* $data['cmpny_id'] = 2;
    $data['communication_type'] = 3;
    $data['email'] = 'elavarasi.s@orisys.in';
    $data['subject'] = "Test";
    $data['content'] = "Demos";*/

   
    try{

    $cmpid = $data['cmpny_id'];
    $communication_type = $data['communication_type'];

    $multiple_communication_type = explode('-', $communication_type);

    if(count($multiple_communication_type) > 1){
      
        $val = explode('_', $multiple_communication_type[1]);
        $gateway = $val[0];
        $account_no = $val[1];

    }else{

        /* set meta name as transcation_email if no communication_type was mentioned. */
        $meta_name = "transcation_email";

        if($communication_type == 3){
          $meta_name = "transcation_email";
        }elseif($communication_type == 2){
          $meta_name = "promotion_email";
        }elseif($communication_type == 1){
          $meta_name = "notification_email";
        }else{}

        /* Fetch email communication channel based on company id and communication type */
        $res =  CompanyMeta::select('meta_value')->where('meta_name',$meta_name)->where('cmpny_id',$cmpid)->first();

        /* Get gateway name and account number in separate variable from meta value */
        $val = explode('_', $res->meta_value);
        $gateway = $val[0];
        $account_no = $val[1];
    }
    /* Based on gateway and account number fetch details from meta table. */
    $res = CompanyMeta::select('meta_name','meta_value')->where('meta_name','like',"$gateway%_$account_no")->where('cmpny_id',$cmpid)->get();

    /* Using below loop and $$ concept we can set values as per our need */
    foreach ($res as $key => $value) {
      $meta_name = $value->meta_name;
      $meta_name = str_replace("_$account_no", "",$meta_name);
      $$meta_name = $value->meta_value;
    }

    // Create the Transport
    if($gateway == 'smtp'){
      $transport = (new \Swift_SmtpTransport($smtp_host, $smtp_port, $smtp_encryption))
          ->setUsername($smtp_user_name)
          ->setPassword($smtp_password);
        $from_name = $smtp_from_name;
        $from_email = $smtp_from_email;
    }
    // Create the Transport
    if($gateway == 'gmail'){
      $transport =   (new \Swift_SmtpTransport($gmail_host, $gmail_port))
          ->setUsername($gmail_user_name)
          ->setPassword($gmail_password);
        $from_name = $gmail_from_name;
        $from_email = $gmail_from_email;
    }
    // Create the Transport
    if($gateway == 'mailchimp'){
      $transport = (new \Swift_SmtpTransport($mailchimp_host, $mailchimp_port))
          ->setUsername($mailchimp_user_name)
          ->setPassword($mailchimp_password);
        $from_name = $mailchimp_from_name;
        $from_email = $mailchimp_from_email;
    }
    // Create the Transport
    if($gateway == 'mailgun'){
      $transport = (new \Swift_SmtpTransport($mailgun_host, $mailgun_port))
          ->setUsername($mailgun_user_name)
          ->setPassword($mailgun_password);
        $from_name = $mailgun_from_name;
        $from_email = $mailgun_from_email;
    }
    // Create the Transport
    if($gateway == 'sendgrid'){
      $transport = (new \Swift_SmtpTransport($sendgrid_host, $sendgrid_port))
          ->setUsername($sendgrid_user_name)
          ->setPassword($sendgrid_password);
        $from_name = $sendgrid_from_name;
        $from_email = $sendgrid_from_email;
    }
    if(isset($data['from_email_id']) && !empty($data['from_email_id']))
	{
		$from_email = $data['from_email_id'];
	}
	if(isset($data['from_email_name']) && !empty($data['from_email_name']))
	{
		$from_name = $data['from_email_name'];
	}
    // Create the Mailer using your created Transport
    $mailer = new \Swift_Mailer($transport);

	$message_id = array();
        
    if(!empty($data['message_id'])){
    $message_id = ltrim($data['message_id'],'<');
    $message_id = rtrim($message_id,'>');
	}


  $reply[]=$data['email'][0];
	if($data['from'] != ''){
    $reply[]=$data['from'];
    }

    $message = (new \Swift_Message($data['subject']))
      ->setFrom([$from_email => $from_name])
      ->setTo($reply)
      ->setCc($data['cc_emails'])
      ->setBody('test message.....')
      ->addPart($data['content'],"text/html")
      ->setId($message_id);

    if($gateway == 'sendgrid'){
      $args = array(
          'unique_args' => array('mail_ref_id' => $data['mail_ref_id'],),
      );
      $message->getHeaders()->addTextHeader('X-SMTPAPI', json_encode($args));
    }

      if (isset($data['saved_attachments']) && !empty($data['saved_attachments']))
      {
            $saved_attachments  = $data['saved_attachments'];
            foreach ($saved_attachments as $attachment)
            {
                $attachment_file_name       = $attachment->attachment_file_name;
                $attachment_original_name   = $attachment->attachment_original_name;
                $attachment_mime_type       = $attachment->attachment_mime_type;
                $attachment_file_path       = storage_path().'/app/attachments/'.$attachment_file_name;

                if (file_exists($attachment_file_path))
                {

                     $attachment = \Swift_Attachment::fromPath($attachment_file_path, $attachment_mime_type)->setFilename($attachment_original_name);

                      $message->attach($attachment);  
                }
            }
        }
    
    // Send the message

    $result = $mailer->send($message);


  } catch(\Exception $e){
          //$error = $ex->getMessage();
          //$result = $transcation_email;
          $result = 0;
  }
     return $result;
  }

  public static function sanitize_uae_number($mobile,$need_country_code=TRUE)
    {
        $mobile = preg_replace('/\s+/', '', $mobile);
        $mobile = preg_replace('/\+/', '', $mobile);
        $mobile = ltrim($mobile,"00");
        $mobile = ltrim($mobile,"0");
        $code_array = array(
                        array("country_code"=>"91","range_from"=>"10","range_to"=>"13"),
                        array("country_code"=>"971","range_from"=>"9","range_to"=>"9"),
                        array("country_code"=>"968","range_from"=>"7","range_to"=>"9"),
                        array("country_code"=>"965","range_from"=>"8","range_to"=>"10"),
                        array("country_code"=>"966","range_from"=>"8","range_to"=>"10"),
                        array("country_code"=>"973","range_from"=>"8","range_to"=>"10"),
                        array("country_code"=>"974","range_from"=>"8","range_to"=>"10"),
                        
                    );
        foreach ($code_array as $value) {
                $country_code = $value['country_code'];
                $regexcode1 = "/^(".$country_code.")";
                $regexcode2 = "/^(".$country_code.$country_code.")";
                $regexcode3 = "/^(00".$country_code.")";
                $regexcode4 = "/^(".$country_code."00".$country_code.")";
                $regexcode5 = "/^(".$country_code."0".$country_code.")";
                $regexcode6 = "/^(00".$country_code.$country_code.")";
                $regexcode7 = "/^(0".$country_code.$country_code.")";
                $regex = "(\d{".$value['range_from'].",".$value['range_to']."})$/";
                if(!$need_country_code)
                {
                    $country_code = '';
                }
                if(Preg_match($regexcode1.$regex, $mobile))
                {
                    $matches = preg_replace($regexcode1."/", '', $mobile, 1);
                    $mobile = $country_code.$matches;
                   break;
                }
                elseif(Preg_match($regexcode2.$regex, $mobile))
                {
                    $matches = preg_replace($regexcode2."/", '', $mobile, 1);
                    $mobile = $country_code.$matches;
                   break;
                }
                elseif(Preg_match($regexcode3.$regex, $mobile))
                {
                    $matches = preg_replace($regexcode3."/", '', $mobile, 1);
                    $mobile = $country_code.$matches;
                   break;
                }
                elseif(Preg_match($regexcode4.$regex, $mobile))
                {
                    $matches = preg_replace($regexcode4."/", '', $mobile, 1);
                    $mobile = $country_code.$matches;
                   break;
                }
                elseif(Preg_match($regexcode5.$regex, $mobile))
                {
                    $matches = preg_replace($regexcode5."/", '', $mobile, 1);
                    $mobile = $country_code.$matches;
                   break;
                }
                elseif(Preg_match($regexcode6.$regex, $mobile))
                {
                    $matches = preg_replace($regexcode6."/", '', $mobile, 1);
                    $mobile = $country_code.$matches;
                   break;
                }
                elseif(Preg_match($regexcode7.$regex, $mobile))
                {
                    $matches = preg_replace($regexcode7."/", '', $mobile, 1);
                    $mobile = $country_code.$matches;
                   break;
                }
            
        }
         return $mobile;
	}
}
