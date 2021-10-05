<?php

namespace App\Http\Controllers;
use App\AutomatedProcess;
use App\AutomatedProcessCustomer;
use App\Channel;
use App\CompanyChannel;
use App\CompanyChannelGateway;
use App\CompanyMeta;
use App\FaqCategories;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\LeadSourceType;
use App\LeadSources;
use App\LocationSettings;
use App\QueryStatus;
use App\QueryTypes;
use App\Templates;
use App\UserRole;
use Auth;
use CommunicationHelper;
use Config;
use DB;
use Illuminate\Http\Request;
use Mail;
class CompanyMetaController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       /* $this->middleware('check-permission:company meta create', ['only' => ['create']]);
       $this->middleware('check-permission:company meta edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:company meta edit|company meta create',   ['only' => ['store']]);
       $this->middleware('check-permission:company meta list',   ['only' => ['index','search_list']]);
       $this->middleware('check-permission:company meta delete',   ['only' => ['destroy']]); */
    }
	/*
    * Company meta 
    * @author PRANEESHA KP
    * @date 13/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return meta_details & communication channels
    */
	public function getCmpChannel(){

		//$ress = CommunicationHelper::getCmpChannel(Auth::user()->cmpny_id, 'transcation_email');
		//var_dump($ress);
		$cmpid = Auth::user()->cmpny_id;
		$res = 	CompanyMeta::select('meta_value')->where('meta_name','transcation_email')->where('cmpny_id',$cmpid)->first();

		$val = explode('_', $res->meta_value);
		$gateway = $val[0];
		$account_no = $val[1];
		$res = CompanyMeta::select('meta_name','meta_value')->where('meta_name','like',"$gateway%_$account_no")->where('cmpny_id',$cmpid)->get();


		foreach ($res as $key => $value) {
			$meta_name = $value->meta_name;
			$meta_name = str_replace("_$account_no", "",$meta_name);
			$$meta_name = $value->meta_value;
		}


		// Create the Transport
		if($gateway == 'smtp'){
			$transport = (new \Swift_SmtpTransport($smtp_host, $smtp_port))
		  		->setUsername($smtp_user_name)
		  		->setPassword($smtp_password);
		  	$from_name = $smtp_from_name;
		  	$from_email = $smtp_from_email;
		}
		// Create the Transport
		if($gateway == 'gmail'){
			$transport = (new \Swift_SmtpTransport($gmail_host, $gmail_port))
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
		

		// Create the Mailer using your created Transport
		$mailer = new \Swift_Mailer($transport);

		// Create a message
		$message = (new \Swift_Message('Test Subject'))
		  ->setFrom([$from_email => $from_name])
		  ->setTo(['elavarasi.s@orisys.in' => "Ela"])
		  ->setBody('test message.....');

		
		// Send the message
		$result = $mailer->send($message);
		var_dump($result);
		exit;



		$res = 	CompanyMeta::select('meta_name','meta_value')->where('meta_name','like','smtp%')->where('cmpny_id',Auth::user()->cmpny_id)->get();

		$k = 1;
		foreach ($res as $key => $value) {
			$meta_name = $value->meta_name;
			$meta_name = str_replace("_$k", "",$meta_name);
			$$meta_name = $value->meta_value;
		}

		$config = array(
                    'driver'     => "smtp",
                    'host'       => $smtp_host,
                    'port'       => $smtp_port,
                    'from'       => array('address' => $from_email, 'name' => $from_name),
                    'encryption' => $smtp_encryption,
                    'username'   => $smtp_user_name,
                    'password'   => $smtp_password,
                );
                Config::set('mail', $config);

                //var_dump(Config::get('mail')); exit;

        $content = "hello test email";
        $to = "elavarasi.s@orisys.in";

        var_dump(Mail::send('mails.commonmail', ['content' => $content], function ($message) use ($smtp_from_email, $smtp_from_name, $to)
        {

            $message->from($smtp_from_email,$smtp_from_name);

            $message->to($to);

        }));

        exit;

	}

	public function show($tabid=null)
    {

        $query_status   		=   ['' => 'Select Status'] + QueryStatus::orderBy('name')->/*where('status',config('constant.ACTIVE'))->*/where('cmpny_id',Auth::user()->cmpny_id)->pluck('name', 'id')->all();

        $roles   				=   ['' => 'Select Role'] + UserRole::orderBy('role')->where('cmpny_id',Auth::user()->cmpny_id)->pluck('role', 'id')->all();

		$templates 				= 	['' => 'Select Template'] + Templates::pluck('subject','id')->all();

		$query_types   			=   ['' => 'Select Query Type'] + QueryTypes::orderBy('query_type')->where('status',config('constant.ACTIVE'))->pluck('query_type', 'id')->all();
		
		$query_category   			=   ['' => 'Select Query Category'] + FaqCategories::orderBy('category_name')->pluck('category_name', 'id')->all();
		
		$lead_sources			=	['' => 'Select Lead Source'] + LeadSources::pluck('name', 'id')->all();
		$lead_source_types       =   ['' => 'Select Lead Source Type'] + LeadSourceType::pluck('source_type', 'id')->all();
        $res 					= 	CompanyMeta::select('*')->where('cmpny_id',Auth::user()->cmpny_id)->get();

		$active_channels 		= 	CompanyChannel::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->pluck('channel_id', 'channel_id')->all();

		$communication_channels = 	Channel::pluck('name', 'id')->all();
		$countries	= ['' => 'Select Country'] + LocationSettings::where('type', 'country')->pluck('name', 'id')->all();
		$states	= ['' => 'Select State'] + LocationSettings::where('parent', 1)->pluck('name', 'id')->all();
		$auto_process_stages	=	['' => 'Select First Stage On Leads'] + AutomatedProcessCustomer::pluck('process_name', 'id')->all();
		$host_count = CompanyMeta::where('meta_name','like','mail_server_host_%')->count();
        return view('masters.companyMeta.create', compact('roles','res','query_status','templates',
		'active_channels','communication_channels','query_types','lead_sources','auto_process_stages','lead_source_types','query_category','host_count','tabid','states','countries'));

    }
	/*
    * Company meta 
    * @author PRANEESHA KP
    * @date 13/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return meta_details & communication channels
    */
	public function channel_gateway()
    {

        
        $res 					= 	CompanyMeta::select('*')->where('cmpny_id',Auth::user()->cmpny_id)->get();

		$active_channels 		= 	CompanyChannel::where('cmpny_id',Auth::user()->cmpny_id)->pluck('channel_id', 'channel_id')->all();
		$cpm_gateways		= 	CompanyChannelGateway::where('cmpny_id',Auth::user()->cmpny_id)->pluck('gateway_id')->all();

		$channels 		= 	CompanyChannel::select('channel_id')->where('cmpny_id',Auth::user()->cmpny_id)->get();

		$communication_channels = 	Channel::pluck('name', 'id')->all();
		
        return view('masters.companyMeta.channel_gateway', compact('cpm_gateways','res','active_channels','channels','communication_channels'));

    }
	
	
	/*
    * Save function for meta Add&Update
    * @author PRANEESHA KP
    * @date 13/11/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    { 
        $response = $request->all();
		$cmpny_id = Auth::user()->cmpny_id;
		
		$channels_to_remove = 	CompanyChannel::where('cmpny_id',$cmpny_id)->forcedelete();
		$gateways_to_remove = 	CompanyChannelGateway::where('cmpny_id',$cmpny_id)->forcedelete();

		foreach($response as $key => $value)
		{
			if($key != '_token' AND $key != 'id'){
					if($key == 'check_list')
					{
						foreach($value as $val)
						{	
							$status	= CompanyChannel::Create(
							[
								'cmpny_id' 		=> Auth::user()->cmpny_id,
								'channel_id' 	=> $val,
								'status' 		=> config('constant.ACTIVE'),
							]); 
						}
					}
					elseif($key == 'gateway_list')
					{
						foreach($value as $val)
						{	
							$status	= CompanyChannelGateway::Create(
							[
								'cmpny_id' 		=> Auth::user()->cmpny_id,
								'gateway_id' 	=> $val,
								'status' 		=> config('constant.ACTIVE'),
							]); 
						}
					}
					else
					{
						if($key == 'transcation_email_group' || $key == 'promotion_email_group' || $key == 'notification_email_group')
						{	
							if(!$value == null){
								$value = serialize($value);
							}else{
								$value = '';
							}
						}

						$res = CompanyMeta::updateOrCreate(
						[
								'meta_name' 	=> $key,
								'cmpny_id' 		=> $cmpny_id,
						],
						[
								'cmpny_id' 		=> $cmpny_id,
								'meta_name' 	=> $key,
								'meta_value' 	=> $value,
								'status' 		=> config('constant.ACTIVE'),
						]);
					}
				}
		}

		$result_arr=array('reset' => false,'success' => true,'message' => 'Successfuly updated');
		return $result_arr;
	}
	/*
    * remove mail server data from company meta
    * @author RINKU.E.B.
    * @date 31/01/2019
    * @since version 1.0.0
    * @param NULL
    */
	public function remove_mail_server(Request $request)
	{
		$response = $request->all();
		$id = $response['res'];
		CompanyMeta::where(function($q) use ($id) {
					  $q->orWhere('meta_name', 'mail_server_username_'.$id)
						->orWhere('meta_name', 'mail_server_password_'.$id)
						->orWhere('meta_name','mail_server_host_'.$id);
					})->delete();
	}
}
