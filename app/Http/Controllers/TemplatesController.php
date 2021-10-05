<?php

namespace App\Http\Controllers;
use App\Attachment;
use App\Campaign;
use App\CampaignBatch;
use App\CampaignBatchGroup;
use App\CampaignQueryStatus;
use App\Channel;
use App\CommonSmsEmail;
use App\CompanyChannel;
use App\CompanyMeta;
use App\CustomerProfile;
use App\CustomerProfileField;
use App\CustomerProfileMeta;
use App\EmailFetch;
use App\Helpers;
use App\Http\Controllers\Controller;
use App\Templates;
use Auth;
use Illuminate\Http\Request;

class TemplatesController extends Controller
{
	public function __construct()
    {
       $this->middleware('auth');
	   $this->middleware('check-permission:template create', ['only' => ['create']]);
       $this->middleware('check-permission:template edit',   ['only' => ['edit']]);
       $this->middleware('check-permission:template edit|template create',   ['only' => ['store']]);
       $this->middleware('check-permission:template list',   ['only' => ['index','search_list','search_mailcategory','load_selected_template']]);
    }
	/*
    * Templates
    * @author PRANEESHA KP
    * @date 8/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return index page
    */
	public function index()
    {
		$channels 	= ['' => 'Select'] + CompanyChannel::join('ori_channels', 					'ori_company_channels.channel_id', '=', 'ori_channels.id')
					->pluck('ori_channels.name', 'ori_channels.id')
					->all();
        return view('masters.Templates.index', compact('channels'));
    }
	/*
    * Templates Listing 
    * @author PRANEESHA KP
    * @date 08/10/2018
    * @since version 1.0.0
    */
	public function search_list(Request $request)
    {	
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords'];
        $search_type  		=   $response['type'];
		$results 			= 	array();
		
        $results = Templates::orderBy('id', 'asc')->orderBy('sort_order','asc');
		if(isset($search_keywords) && !empty($search_keywords)) 
        {
				$results->where(function($results) use ($search_keywords){
                    $results->orWhere('subject', 'like', '%' . $search_keywords . '%');
					$results->orWhere('title', 'like', '%' . $search_keywords . '%');
                });
        }
		if(isset($search_type) && !empty($search_type)) 
        {
                $results->where(function($results) use ($search_type){
                    $results->where('type',$search_type);
                });
        }
		
		$list_count 	= 	$results->count();
		$results   		=   $results->paginate();
		$html = view('masters.Templates.listview')->with(compact('results','list_count'))->render();
		$result_arr=array('success' => true,'html' => $html);
		
		return $result_arr;		
		
	}
	/*
    * Function for creating new template
    * @author PRANEESHA KP
    * @date 08/10/2018
    * @since version 1.0.0
    * @return view for adding new category
    */
	public function create()
    {  
		$channels 	= ['' => 'Select'] + CompanyChannel::join('ori_channels', 					'ori_company_channels.channel_id', '=', 'ori_channels.id')
					->pluck('ori_channels.name', 'ori_channels.id')
					->all();
		return view('masters.Templates.create', compact('channels'));
    }
	
	/*
    * Update function for Query Types 
    * @author PRANEESHA KP
    * @date 03/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return view for editings query_types
    */
	public function edit($id)
    {   
		$cat_results = Templates::findOrFail($id);
		$channels 	 = ['' => 'Select'] + CompanyChannel::join('ori_channels', 					'ori_company_channels.channel_id', '=', 'ori_channels.id')
					->pluck('ori_channels.name', 'ori_channels.id')
					->all();
        return view('masters.Templates.create', compact('catid','cat_results','id','channels'));
	}


    /*
    * Save function for category updates
    * @author PRANEESHA KP
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    */
    public function store(Request $request)
    {
		$this->validate($request,[
            'title' => 'required|max:500',
            'subject' => 'required|string|max:500',
            'type' => 'required|string|max:50',
			'push_content' => 'required_if:type,'.config('constant.CH_PUSH_MESSAGES'),
			'sms_content' => 'required_if:type,'.config('constant.CH_SMS'),
			'content' => 'required_if:type,'.config('constant.CH_EMAIL'),
           ],[
			'push_content.required_if' => ' The Push message content field is required.',
    		'sms_content.required_if' => ' The sms content field is required.',
    		'content.required_if' => ' The email content field is required.',
    	]);
		
		$form_data  = array();
    	$form_data  = $request->all();
		$type       = $form_data['type'];
		
		if($type == config('constant.CH_SMS'))
		{
			$content    =   $form_data['sms_content'];
		}else if($type == config('constant.CH_EMAIL'))
		{
			$content   = $form_data['content'];
		}
		else if($type == config('constant.CH_PUSH_MESSAGES'))
		{
			$content   =  $form_data['push_content'];
        }else{
			$content   ='';
        }
		if(isset($form_data['is_show']) && $form_data['is_show'] == 'on')
		{
			$is_show   = config('constant.IS_DISPLAY');
		}else{
			$is_show   = config('constant.NOT_DISPLAY');
		}
		
		if(isset($form_data['subject']) && !empty($form_data['subject'])){ 
		
			$form_data['content'] = urldecode ($form_data['content'] );
			$results = Templates::where('subject', $form_data['subject'])->orderBy('id', 'desc');
		
			if(!empty($form_data['id'])){
                $results->where('id','!=',$form_data['id']);
            }
            $l_count = $results->count();
			
            if($l_count >= 1)
            {
				$message='Already exists';
            }else{
                if(empty($form_data['id'])){
	             	$status = Templates::Create([
						'cmpny_id' => Auth::user()->cmpny_id,
	                    'subject' => $form_data['subject'],
	                    'title' => $form_data['title'],
	                    'content' => $content,
						'type' => $form_data['type'],
						'is_show'=> $is_show,
	                    'status' => $form_data['status'],
						'sort_order' => $form_data['sort_order'],
						]);
					$message='Added Successfully';
         		}else
         		{
         			$status = Templates::updateOrCreate(
	                [
	                    
	                    'id' => $form_data['id']
	                ],
	                [
						'cmpny_id' => Auth::user()->cmpny_id,
	                    'subject' => $form_data['subject'],
	                    'title' => $form_data['title'],
	                    'content' => $content,
	                    'status' => $form_data['status'],
                        'type' => $form_data['type'],
                        'is_show'=> $is_show,
						'sort_order' => $form_data['sort_order'],
					]);
					$message='Successfuly updated';
         		}
                //echo $status->id;
            }
			if(!empty($form_data['id'])){
                $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
			}else{
				$result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
			}
            return $result_arr;		

        }
        
			
	}
	
	/**
    * @author RINKU.E.B
    * @date 13/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return searching mail category
   */
	 public function search_mailcategory(Request $request)
    {
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords']; 
        $thread_details=array();
        $results = Templates::select('id','subject','content','title')->where('status',1)->where('is_show',1)->where('type',2);
        
        if(isset($search_keywords) && !empty($search_keywords) && empty($drop_id)) 
        {
           $results->where(function($results) use ($search_keywords){
                $results->orWhere('subject', 'like', '%' . $search_keywords . '%');
                $results->orWhere('title', 'like', '%' . $search_keywords . '%');
           });
        }
 
        $thread_details = $results->paginate(config('constant.pagination_constant'));
        //return view('masters.Templates.listmailcategory',compact('thread_details'));
		
		$html = view('masters.Templates.listmailcategory')->with(compact('thread_details'))->render();
		$result_arr=array('success' => true,'html2' => $html,'channel' => config('constant.CH_EMAIL'));
		return $result_arr;	
	}
	/**
    * @author RINKU.E.B.
    * @date 13/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Loading selected teemplate
   */
	public function load_selected_template(Request $request)
	{
        $response           =   $request->all();
        $temp_id            =   $response['temp_id'];
        $campaign_type      =   $response['campaign_type'];
        $email_thread		= 	NULL;
          
        $user_details=array();
        $template_details = Templates::find($temp_id);
            
        if(isset($response['new_email']) && !empty($response['new_email']))
        {	$email_thread=$response['new_email'];
		$user_details=EmailFetch::where('thread_id',$email_thread)->first();
        }
        return view('masters.Templates.email_details', compact('template_details','user_details','campaign_type','email_thread'));
	}
	
	  /**
    * New CAtegory
    * @author RINKU.E.B.
    * @date 13/11/2017
    * @since version 1.0.0
    * @param NULL
    * @return Loading selected teemplate
   */
    function compose_mail_template(Request $request)
    {
        $user = Auth::User()->id;

		$new_email = '';$new_mobile = '';$channel = '';
        $new_subject    = $request->post('new_subject');
        $new_email      = $request->post('new_email');
	 $ccmail      = $request->post('ccmail');
	 
	
        $company_select = CompanyMeta::select('cmpny_id','id','meta_name')->where('meta_name','like', 'mail_server_host%')->orderBy('updated_at','asc')->first();
        $username=null;
        if($company_select)
			{
				$cmpny_id = $company_select->cmpny_id;
				$meta_arr = $company_select->meta_name;
				$meta_arr = explode("_host_",$meta_arr);
				$username = Helpers::get_company_meta('mail_server_username_'.$meta_arr[1],$cmpny_id);
			}

		$ccmail=str_replace($username.",","",$ccmail);
		$new_mobile     = $request->post('new_mobile');
		$channel     	= $request->post('channel');
        $new_content    = urldecode($request->post('new_content'));
        $campaign_id    = (int)$request->post('campaign_id');
        $campaign_title = $request->post('cmp_title');
        $channel_gateway = '';
        $survey_id=NULL;
        $is_replay_mail_id=NULL;
        $attachments    = $request->post('attachments');
        $attachments    = json_decode($attachments);
       
        if(!empty($request->post('channel_gateway')))
        {
            $channel_gateway      = "-".$request->post('channel_gateway');
        }
        if(!empty($request->post('survey_id')))
        {
            $survey_id      = $request->post('survey_id');
        }
		if(!empty($request->post('is_replay_mail_id')))
        {
            $is_replay_mail_id    = $request->post('is_replay_mail_id');
        }
		if(!empty($request->post('schedule')))
		{
			$schedule = $request->post('schedule');
		}
		else
		{
			$schedule = '';
		}
		if(!empty($request->post('query_type')))
		{
			$query_type = $request->post('query_type');
		}
		else
		{
			$query_type = '';
		}
		if(!empty($request->post('faq_cat_id')))
		{
			$faq_cat_id = $request->post('faq_cat_id');
		}
		else
		{
			$faq_cat_id = '';
		}
		// if(isset($channel) && !empty($channel) && ($channel==config('constant.CH_MANUAL_CALL')))
		// {
		// 	$query_type = Helpers::get_company_meta('set_manual_call_query_type');
		// }
		if(!empty($request->post('query_subcategory')))
		{
			$query_subcategory = $request->post('query_subcategory');
		}
		else
		{
			$query_subcategory = '';
		}
		if(!empty($request->post('query_status')))
		{
			$query_status = $request->post('query_status');
		}
		else
		{
			$query_status = '';
		}
		if(!empty($request->post('priority')))
		{
			$priority = $request->post('priority');
		}
		else
		{
			$priority = 0;
		}
		
			
        //$new_signature = $response['new_signature'];
        //$attachments = $response['attachments'];
        //$attachments = json_decode($attachments);
		
		
        do {
            if (empty($campaign_id))
            {
                if ((!empty($new_email) && !empty($new_content))||(!empty($new_mobile) && !empty($new_content)))
                {
                	$customer_id = $request->post('customer_id');
                	if (!empty($customer_id))
                	{
                		$customer = CustomerProfile::find($customer_id);
                		if (!empty($customer))
                		{
                			$new_content = str_replace('[[ First Name ]]', $customer->first_name, $new_content);
		                    $new_content = str_replace('[[ Last Name ]]', $customer->last_name, $new_content);
		                    $new_content = str_replace('[[ Email ]]', $customer->email, $new_content);

		                    $registration_code_data   = CustomerProfileMeta::where('status', config('constant.ACTIVE'))
                                        ->where('user_id', $customer->id)
                                        ->where('field_name', 'LIKE', '%registration_code%')
                                        ->first();
                    		$registration_code  = $registration_code_data->value ?? '';
		                    $called_name_data   = CustomerProfileMeta::where('status', config('constant.ACTIVE'))
		                                        ->where('user_id', $customer->id)
		                                        ->where('field_name', 'LIKE', '%called_name%')
		                                        ->first();
		                    $called_name  = $called_name_data->value ?? '';
		                    $new_content    = str_replace('[[ Registration Code ]]', $registration_code, $new_content);
                    		$new_content    = str_replace('[[ Called Name ]]', $called_name, $new_content);
                		}
                	}
                    // $profilename=['First Name'=>'Sir/Madam','Last Name'=>'','Middle name'=>'','Email'=>$new_email,'Mobile'=>$new_mobile];
                    // foreach ($profilename as $pkey => $pvalue) {
                    //     $new_content = str_replace('[[ '.$pkey.' ]]', $pvalue, $new_content);
                    // }
                    
                    $email_cc='';
                    $buffer='not sent';
					if($channel == config('constant.CH_EMAIL'))
					{
						// ADDED FOR TEMPLATES HEADER AND FOOTER
						$email_header_content = '';$email_footer_content = '';
						$email_header = Helpers::get_company_meta('email_header',Auth::user()->cmpny_id);
						$email_footer = Helpers::get_company_meta('email_footer',Auth::user()->cmpny_id);
						if(isset($email_header) && !empty($email_header) && ($email_header>0))
						{
							$email_header_content = Helpers::get_template_content($email_header);
						}
						if(isset($email_footer) && !empty($email_footer) && ($email_footer>0))
						{
							$email_footer_content = Helpers::get_template_content($email_footer);
						}
						$new_content = $email_header_content.$new_content.$email_footer_content;
						// ADDED FOR TEMPLATES HEADER AND FOOTER
					}
			$email_details = EmailFetch::where('id',$is_replay_mail_id)->first();
						if(!empty($email_details) && isset($username) && !empty($username))
						{
							$message_id=$email_details->message_id;
							$from=$email_details->from;
						}
						else{
							$message_id = NULL;
							$from= NULL;
						}
                    $email = CommonSmsEmail::Create([
                        'authentication' => '',
                        'cmpny_id' => Auth::user()->cmpny_id,
                        'source' => 4,
                        'email' => $new_email,
			'from' =>$from,
						'mobile' => $new_mobile,
                        'sent_type' => $channel,
                        'response' => $buffer,
                        'content' => $new_content,
                        'subject' => $new_subject,  
                        'email_cc' => $ccmail,
			'message_id'=>$message_id,    
                        'status' => config('constant.INACTIVE'),
                        'created_by' => 0,
                        'updated_by' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);

                    if (isset($email->id) && !empty($attachments) && count($attachments) > 0)
                    {
                        foreach ($attachments as $attachment)
                        {
                            $new_attachment = Attachment::create([
                                'cmpny_id'                  => Auth::user()->cmpny_id,
                                'attachable_id'             => $email->id,
                                'attachable_type'           => CommonSmsEmail::class,
                                'attachment_file_name'      => $attachment->savedName,
                                'attachment_original_name'  => $attachment->originalName,
                                'attachment_mime_type'      => $attachment->mimeType,
                                'status'                    => config('constant.ACTIVE')
                            ]);
                        }
                    }
					if(isset($is_replay_mail_id) && !empty($is_replay_mail_id))
					{
						$company_select = CompanyMeta::select('cmpny_id','id','meta_name')->where('meta_name','like', 'mail_server_host%')->orderBy('updated_at','asc')->first();
						if($company_select)
						{
							$tab_id = $company_select->id;
							$cmpny_id = $company_select->cmpny_id;
							$meta_arr = $company_select->meta_name;
							$meta_arr = explode("_host_",$meta_arr);

					    $username = Helpers::get_company_meta('mail_server_username_'.$meta_arr[1],$cmpny_id);
						}
						$email_details = EmailFetch::where('id',$is_replay_mail_id)->first();
						if(!empty($email_details) && isset($username) && !empty($username))
						{
						$thread_id  = $email_details->thread_id;
						EmailFetch::Create([
								'email_id' => 'null',
								'cmpny_id' => Auth::user()->cmpny_id,
								'subject' => $new_subject,
								'message' => $new_content,
								'message_id'=>$message_id,														
								'from_name' => $username,
								'to'=>$new_email,
								'Cc_email'=>$ccmail,
								'received_date' => Helpers::get_date_time(TRUE,TRUE),
								'from' => $username,
								'thread_id' => $thread_id,
								]);
						$email_fetchs_update = EmailFetch::where('thread_id', $thread_id)->update(
													[   'read_status' => config('constant.READ'),
													   'answered' => config('constant.ANSWERED')]
													);
						}	
	
					}
					
                }

                break;
            }

            $campaign = Campaign::find($campaign_id);
            $campaign_members_count = $campaign->members_count();
            $goal_stage	= NULL;
            $sales_automation_activated = Helpers::get_company_meta('auto_stage_activation_customer');
            if (!empty($sales_automation_activated) && $sales_automation_activated == 1 && !empty($campaign->goal_stage))
            {
            	$goal_stage = $campaign->goal_stage;
            }
            $batch  = CampaignBatch::create([
                'cmpny_id'              => Auth::user()->cmpny_id,
                'subject'               => $new_subject,
                'content'               => $new_content,
                'campaign_id'           => $campaign->id,
                'survey_id'             => $survey_id,
                'campaign_type'         => $campaign->campaign_type.$channel_gateway,
                'title'                 => $campaign_title,
                'total_target_count'    => $campaign_members_count,
                'goal_stage'            => $goal_stage,
                'channel_type'          => $channel,
                'status'                => config('constant.INACTIVE'),
				'autodial_schedule_id'	=> $schedule,
				'obc_type'				=> $query_type,
				'obc_category'			=> $faq_cat_id,
				'obc_subcategory'		=> $query_subcategory,
				'enq_priority'			=> $priority,
            ]);

            if (isset($batch->id) && !empty($attachments) && count($attachments) > 0)
            {
                foreach ($attachments as $attachment)
                {
                    $new_attachment = Attachment::create([
                        'cmpny_id'                  => Auth::user()->cmpny_id,
                        'attachable_id'             => $batch->id,
                        'attachable_type'           => CampaignBatch::class,
                        'attachment_file_name'      => $attachment->savedName,
                        'attachment_original_name'  => $attachment->originalName,
                        'attachment_mime_type'      => $attachment->mimeType,
                        'status'                    => config('constant.ACTIVE')
                    ]);
                }
            }

            $campaign_group_ids    = $campaign->groups->pluck('id')->all();
            foreach ($campaign_group_ids as $group_id)
            {
                $batch_group = CampaignBatchGroup::create([
                    'cmpny_id'  => Auth::user()->cmpny_id,
                    'batch_id'  => $batch->id,
                    'group_id'  => $group_id,
                    'status'    => config('constant.ACTIVE')
                ]);
            }
			
			if(isset($channel) && !empty($channel) && (($channel==config('constant.CH_AUTODIAL')) || ($channel==config('constant.CH_MANUAL_CALL'))))
			{
				if(isset($query_status) && !empty($query_status))
				{
					foreach($query_status as $q_status)
					{
						CampaignQueryStatus::updateOrCreate([
						'cmpny_id' => Auth::user()->cmpny_id,
						'campaign_id' => $campaign->id,
						'batch_id' => $batch->id,
						'query_status' => $q_status,					
						],['query_type' => $query_type]);
					}
					
				}
			}

        }
        while(false);
        
    }
	/**
    * @author RINKU.E.B
    * @date 21/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return searching sms category
   */
	 public function search_smscategory(Request $request)
    {
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords']; 
        $thread_details=array();
        $results = Templates::select('id','subject','content','title')->where('status',config('constant.ACTIVE'))->where('is_show',config('constant.ACTIVE'))->where('type',config('constant.CH_SMS'));
        
        if(isset($search_keywords) && !empty($search_keywords) && empty($drop_id)) 
        {
           $results->where(function($results) use ($search_keywords){
                $results->orWhere('subject', 'like', '%' . $search_keywords . '%');
                $results->orWhere('title', 'like', '%' . $search_keywords . '%');
           });
        }
 
        $thread_details = $results->paginate(config('constant.pagination_constant'));
		//echo "<pre>";print_r($thread_details);die;
		$html = view('masters.Templates.listsmscategory')->with(compact('thread_details'))->render();
		$result_arr=array('success' => true,'html3' => $html,'channel' => config('constant.CH_SMS'));
		return $result_arr;	
	}
	/**
    * @author RINKU.E.B.
    * @date 21/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Loading selected sms template
   */
	public function load_selected_sms_template(Request $request)
	{
        $response           =   $request->all();
        $temp_id            =   $response['temp_id'];
            
        $user_details=array();
        $template_details = Templates::find($temp_id);
            
        if(isset($response['new_mobile']) && !empty($response['new_mobile']))
        {
            $user_details['mobile'] =$response['new_mobile'];
        }
        return view('masters.Templates.sms_details', compact('template_details','user_details'));
	}
	
	/**
    * @author RINKU.E.B
    * @date 26/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return searching push category
   */
	 public function search_pushcategory(Request $request)
    {
        $response           =   $request->all();
        $search_keywords    =   $response['search_keywords']; 
        $thread_details=array();
        $results = Templates::select('id','subject','content','title')->where('status',config('constant.ACTIVE'))->where('is_show',config('constant.ACTIVE'))->where('type',config('constant.CH_PUSH_MESSAGES'));
        
        if(isset($search_keywords) && !empty($search_keywords) && empty($drop_id)) 
        {
           $results->where(function($results) use ($search_keywords){
                $results->orWhere('subject', 'like', '%' . $search_keywords . '%');
                $results->orWhere('title', 'like', '%' . $search_keywords . '%');
           });
        }
 
        $thread_details = $results->paginate(config('constant.pagination_constant'));
		//echo "<pre>";print_r($thread_details);die;
		$html = view('masters.Templates.listpushcategory')->with(compact('thread_details'))->render();
		$result_arr=array('success' => true,'html4' => $html,'channel' => config('constant.CH_PUSH_MESSAGES'));
		return $result_arr;	
	}
	/**
    * @author RINKU.E.B.
    * @date 26/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Loading selected push template
   */
	public function load_selected_push_template(Request $request)
	{
        $response           =   $request->all();
        $temp_id            =   $response['temp_id'];
            
        $user_details=array();
        $template_details = Templates::find($temp_id);
            
        if(isset($response['new_mobile']) && !empty($response['new_mobile']))
        {
            $user_details['mobile'] =$response['new_mobile'];
        }
        return view('masters.Templates.push_details', compact('template_details','user_details'));
	}

    /**
    * Mail Attachment Upload
    * @author RAHUL R.
    * @date 06/12/2018
    * @since version 1.0.0
    * @param NULL
    * @return mail attachment upload
   */

    public function mail_attachment_upload(Request $request)
    {
        $id                 = '';
        $id                 = request('id');
        $file               = request("file$id");
        $id                 = request('id');
        $email_type         = request('email_type');
        $allowed_file_types = config('constant.upload_allowed_mime_types');
        $max_upload_size    = config('constant.max_file_upload_size');
        $custom_error       = array();
        $files_array        = array();

        $original_file_name  = $file->getClientOriginalName();
        $file_ext            = strtolower($file->getClientOriginalExtension());
        $new_file_name       = md5(str_random(40).time()).'.'.$file->getClientOriginalExtension();
        $file_mime_type      = $file->getMimeType();
        $valid_file         = 0;

        $custom_error['id'] = $id;
        do {

            if (!array_key_exists($file_ext, $allowed_file_types))
            {
                $custom_error['jquery-upload-file-error']="This type of files are not allowed.";
                echo json_encode($custom_error);
                die();
            }

            if ($file->getMimeType() != $allowed_file_types[$file_ext])
            {
                $custom_error['jquery-upload-file-error']="The file type does not match its mime type.";
                echo json_encode($custom_error);
                die();
            }

            if ($file->getClientSize() > $max_upload_size)
            {
                $max_file_upload_size_mb    = $max_upload_size / (1024 * 1024);
                $max_file_upload_size_mb    = round($max_file_upload_size_mb, 2);
                $custom_error['jquery-upload-file-error']="Files with size greater than $max_file_upload_size_mb are not allowed";
                echo json_encode($custom_error);
                die();
            }

            $valid_file = 1;
        }
        while(false);

        if ($valid_file)
        {
           
            if(request('type') == 1){
                        $file->move(
                        public_path() . '/uploads/profile/', $new_file_name
                        );
                 
                       if (file_exists(public_path().'/uploads/profile/'.$new_file_name))
                       {
                       
                        $files_array    = array(
                            'original_name' => $original_file_name,
                            'mime_type'     => $file_mime_type,
                            'inc'            => $id,
                            'saved_name'    => $new_file_name
                        );
                       }
                       else
                       {
                        $custom_error['jquery-upload-file-error']="The File could not be uploaded.";
                        echo json_encode($custom_error);
                        die();
                       }
            }else{
                     $file->move(
                        storage_path() . '/app/attachments/', $new_file_name
                      );
                      if (file_exists(storage_path().'/app/attachments/'.$new_file_name))
                      {
                        // $attachment_data    = [
                        //     'attachment_filename'       => $new_file_name,
                        //     'attachment_original_name'  => $original_file_name,
                        //     'attachment_type'           => $file_mime_type,
                        //     'status'                    => config('constant.ACTIVE')
                        // ];
                        // if ($email_type == 1)
                        // {
                        //     $attachment_data['batch_id']    = $id;
                        // }
                        // else if ($email_type == 2)
                        // {
                        //  $attachment_data['email_id']    = $id;
                        // }
                        // // cc_email_attachment::create($attachment_data);
                        $files_array    = array(
                            'original_name' => $original_file_name,
                            'mime_type'     => $file_mime_type,
                            'inc'            => $id,
                            'saved_name'    => $new_file_name
                        );
                      }
                      else
                      {
                        $custom_error['jquery-upload-file-error']="The File could not be uploaded.";
                        echo json_encode($custom_error);
                        die();
                      }
            }

        }

        echo json_encode($files_array);
    }
	
}
