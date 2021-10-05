<?php
return [
    'site_title'		            => 'Oricoms',
	'callcenter_url'                => 'https://192.168.1.8',
	'dishacallcenter_url'           => 'https://192.168.1.100',
    'pagination_constant'           => env('PAGINATION_CONST','10'),
    
    'ACTIVE'                        => '1',
    'INACTIVE'                      => '2',
    'QA_Servers'					=>'1',
    'Production_Servers'			=>'2',
    'PROCESSING'					=> '2',
    'INSERTING_MODEL_DELETED'		=> '99',
    'PAUSED'						=> '100',
    'STOPPED'						=> '101',
	
	'API_ACTIVE'					=> '1',
	'API_INACTIVE'					=> '0',
	'API_EXIST'						=> '2',
	'API_EMPTY_MANDATORY_FIELDS'	=> '3',
	'API_AUTH_FAILURE'				=> '4',
	'API_DB_ERROR'					=> '5',

	'passwordHistories_count'       =>'3',
	'password_expiry_days'          =>'360',
	'to_inactivate_inactive_user'   =>'360',  //days
	'maxAttempts'                   => 3,
	'decayMinutes'                  => 60,  // in seconds

	// permission
	'ESCALATE'    					=> 'escalate',
	'ESCALATE_TO'    				=> 'escalated to',
	'ESCALATED'   					 => '1',
	'REPLIED'   					 => '2',
	
	'DEFAULT_FEILD'                 => '1',
	'CUSTOM_FIELD'                  => '2',
	'LOCATION_FEILD'                 => '3',
	'UPLOAD_FEILD'                 => '4',
	// Channels
	'CH_SMS'                        => '1',
	'CH_EMAIL'                      => '2',
   	'CH_MANUAL_CALL'                => '3',
   	'CH_AUTODIAL'              		=> '4',
   	'CH_CHAT'              			=> '5',
	'CH_PUSH_MESSAGES'              => '6',
	
	'MANUAL_OUTBOUND_CALLS'			=> 1,
	'UNATTENDED_CALL_FOLLOWUP'          => 8,
	
	'IS_DISPLAY'            		=> '1', // 1 - showing content
    'NOT_DISPLAY'           		=> '2',
	
	'IS_CLOSE'            			=> '1', // 1 - checkbox 
    'NOT_CLOSE'           			=> '0',

	'DEFAULT_FEILD'                 => '1',
	'CUSTOM_FIELD'                  => '2',
   

	'DEFAULT_FEILD'                 => '1',
	'CUSTOM_FIELD'                  => '2',
    'PROFILE_SEARCH'                => ['first_name','middle_name','last_name','email','mobile'],
	
	
	'LEAD'							=> '1',
	'CUSTOMER'						=> '5',
	'profile_status'                   => ['1'=>'Lead', '2'=>'Qualified', '3'=>'Proposition', '4'=>'Negotiation', '5'=>'Customer'],
	'service_status'                   => ['1'=>'Running', '2'=>'Stopped'],
	'server_stages'                   => ['1'=>'QA Servers', '2'=>'Production Servers'],
	
	'TICKET'						=> '1',
	'FOLLOWUPS'						=> '2',
	'USER_ROLE_CHAT_AGENT' =>9,

	'FB_RATING'=>['1'=>'Very Bad','2'=>'Bad','3'=>'Average','4'=>'Good','5'=>'Excellent'],

	
	'READ'                         	=> '1', // TABLE ori_email_fetchs
    'UNREAD'                       	=> '0',
    'ANSWERED'                     	=> '1',
	
	'FAQ'							=> '1',
	'CALL'							=> '2',
	'LANG_ENG'						=> '1',
	'LANG_MALA'						=> '2',
	
	'NOTIFICATION'					=> '1',	
	'PROMOTION'						=> '2',
	'TRANSACTION'					=> '3',
	
	'INTIMATION_SMS' 				=> 1,// table cc_intimations channel
	'INTIMATION_MAIL' 				=> 2,// table cc_intimations channel
	'INTIMATION_INTERNAL' 			=> 3,
	
	'INTIMATION_IMMEDIATE' 			=> 1,// table ori_intimations interval
	'INTIMATION_DAILY'				=> 2,
	'INTIMATION_WEEKLY' 			=> 3,
	'INTIMATION_MONTHLY' 			=> 4,
	'INTIMATION_IMMEDIATE_INTERNAL' => 5,
	'INTIMATION_SUPERIOR' 			=> 6,
	
	// AUTOMATED PROCESS
	'CRM_CALLCENTER_AUTO_PROCESS'   => '5',
	'AUTO_PROCESS_FAILURE_MAILID'	=> 'rinku.eb@orisys.in',
	'AUTO_PROCESS_MAIL_SMS_OPEN_CATEGORY'	=> 1,
	
	/* AUTO PROCESS RESPONSES */
	'AUTO_PROCESS_RESPONSE_POSITIVE'=>1,
	'AUTO_PROCESS_RESPONSE_NEGATIVE'=>0,
	
	/* AUTO PROCESS TYPES */
	'AUTO_PROCESS_TYPE_NOTF' =>1,
	'AUTO_PROCESS_TYPE_PROMO' =>2,
	'AUTO_PROCESS_TYPE_TRANS' =>3,

	/* COMMON BATCH PROCESS TYPES */
	'BP_GROUP_LEAD_IMPORT' => 1,
	'UNATTENDED_CALL_TYPE' => 2,
	'MANUAL_OUTBOUND_TYPE' => 3,
	'BP_REASSIGN_GROUP_IMPORT' => 4,
	
	
	// allowed file types to be downloaded and their mime types
    'upload_allowed_mime_types' => [
        'jpeg'  => 'image/jpeg',
        'jpg'   => 'image/jpeg',
        'png'   => 'image/png',
        // 'xlsx'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        // 'xls'   => 'text/html',
        // 'csv'   => 'text/plain',
        'pdf'   => 'application/pdf',
        // 'doc'   => 'application/msword',
        // 'docx'  => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ],
    'max_file_upload_size'  => 2097152,
	'sms_max_length'       =>'320',
	'push_message_max_length'       =>'100',
	
	'QUERY_TYPES'=>['1'=>'General Enquiry','2'=>'Complaints','3'=>'Followup'],
	'TERM_LENGTH'=>['1'=>'1 Month','6'=>'6 Months','12'=>'12 months'],
	'QUERY_CATEGORY'=>['1'=>'Registration','2'=>'Security','3'=>'Callback','4'=>'Abandoned Call','5'=>'After Hour Call','6'=>'Holiday'],
	'QUERY_STATUS'=>['1'=>'Open','2'=>'Processing','3'=>'Closed','4'=>'Re-open'],
	'BASIC_ROLES'=>['Manager','Domain Expert','Chat Agent'],
	'CUSTOMER_NATURE'=>['Hot','Warm','Cold','Less Interest','DND'],
	'CUSTOMER_PRIORITY'=>['Low','Medium','High'],
	'PRIORITY'=>['1'=>'Low','2'=>'Medium','3'=>'High'],
	'SOURCE_TYPE'=>['Social Media','News Paper','TV Channels','CRM','Campaign'],


	'Social Media'=>['FB','WP','Twitter'],
	'News Paper'=>['Times of India','New Indian Express'],
	'TV Channels'=>['Asianet','DD National'],
	'CRM'=>['CRM Call Centre','CRM Call Centre Sales Automation'],
	'Campaign'=>['Campign via sms','Campaign via Manual Call','Campaign via Outbound Call','Campaign via Unattended Calls'],
	 
	'query_title_lang1' => 'how can i contact you?',
	'query_title_lang2' => 'how can i contact you?',

	'question_lang1' => 'how can i contact you?',
	'question_lang2' => 'how can i contact you?',

	'answer_lang1' => 'Please contact with www.oricoms.com',
	'answer_lang2' => 'Please contact with www.oricoms.com',

	'answer_lang1_short' => 'Please contact with www.oricoms.com',
	'answer_lang2_short' => 'Please contact with www.oricoms.com',



	 'ORICOM_ADMIN'  					=>'1',
	 'EXTENDED_EXPIRY_IN_DAYS'  		=> 5,
	 'SBCR_EXPIRE_NOTIFICATION_PERIOD'  => 10,
	 'SUBSCRIPTION_STATUS'				=>['1'=>'Subscribed','2'=>'Expired'],
	 
	 'DISC_IN_PERCENT'         => '1', // 1 - showing content
     'DISC_IN_RUPEE'           => '2',

	 //EMAIL DELIVERY STATUS
	 'EMAIL_DELIVERY_STATUS'	=> [
	 	'MOVED'				=> 1,
	 	'QUEUED' 			=> 2,
	 	'PROCESSED' 		=> 3,
	 	'DROPPED' 			=> 4,
	 	'DELIVERED'			=> 5,
	 	'BOUNCED'			=> 6,
	 	'DEFFERED'			=> 7,
	 	'OPENED'			=> 8,
	 	'CLICKED'			=> 9,
	 	'REPORTED_SPAM'		=> 10,
	 	//INTERNAL STATUS
	 	'REPEAT'			=> 55,
	 	'FAILED'			=> 88,
	 	'EXCEPTION_OCCURED'	=> 89,
	 	'PROCESSING'		=> 90
	 ],

	 //EMAIL DELIVERY STATUS key & value in reverse
	 'EMAIL_DELIVERY_STATUS_REV'	=> [
	 	1	=> 'MOVED',
	 	2	=> 'QUEUED',
	 	3	=> 'PROCESSED',
	 	4	=> 'DROPPED',
	 	5	=> 'DELIVERED',
	 	6	=> 'BOUNCED',
	 	7	=> 'DEFFERED',
	 	8	=> 'OPENED',
	 	9	=> 'CLICKED',
	 	10	=> 'REPORTED SPAM',
	 	//INTERNAL STATUS
	 	55	=> 'REPEAT',
	 	88	=> 'FAILED',
	 	89	=> 'EXCEPTION OCCURED',
	 	90	=> 'PROCESSING'
	 ],

	 //EMAIL DELIVERY STATUS FROM SENDGRID
	 'SG_EMAIL_DELIVERY_STATUS'	=> [
	 	'MOVED'				=> 1,
	 	'QUEUED' 			=> 2,
	 	'PROCESSED' 		=> 3,
	 	'DROPPED' 			=> 4,
	 	'DELIVERED'			=> 5,
	 	'BOUNCED'			=> 6,
	 	'DEFFERED'			=> 7,
	 	'OPENED'			=> 8,
	 	'CLICKED'			=> 9,
	 	'REPORTED_SPAM'		=> 10
	 ],

	 //SMS DELIVERY STATUS
	 'SMS_DELIVERY_STATUS'	=> [
	 	'MOVED'						=> 1,
	 	'QUEUED'					=> 2,
	 	'DELIVERED'					=> 3,
	 	'INVALID_NUMBER'			=> 4,
	 	'ABSENT_SUBSCRIBER'			=> 5,
	 	'MEMORY_EXCEEDED'			=> 6,
	 	'MOBILE_EQUIPMENT_ERROR'	=> 7,
	 	'NETWORK_ERROR'				=> 8,
	 	'BARRED'					=> 9,
	 	'INVALID_SENDER_ID'			=> 10,
	 	'NDNC_FAILURE'				=> 11,
	 	'UNKNOWN_ERROR'				=> 12,
	 	'UNDELIVERED'				=> 13,
	 	'SUBMITTED_TO_OPERATOR'		=> 14,
	 	'REJECTED'					=> 15,
	 	'INVALID_CREDENTIALS'	    => 16,
	 	'NO_CREDITS'	            => 17,
	 	'DB_ERROR'	                => 18,
	 	'INVALID_DUPLICATE'	        => 19,
	 	'NETWORK_ERROR_SMSC'	    => 20,
	 	'SMSC_TIMEOUT'	  		    => 21,
	 	'SENDER_NOT_APPROVED'	    => 22,
	 	'SUSPECT_SPAM'	            => 23
	 ],

	 //SMS DELIVERY STATUS key & value in reverse
	 'SMS_DELIVERY_STATUS_REV'	=> [
	 	1	=> 'MOVED',
	 	2	=> 'QUEUED',
	 	3	=> 'DELIVERED',
	 	4	=> 'INVALID_NUMBER',
	 	5	=> 'ABSENT_SUBSCRIBER',
	 	6	=> 'MEMORY_EXCEEDED',
	 	7	=> 'MOBILE_EQUIPMENT_ERROR',
	 	8	=> 'NETWORK_ERROR',
	 	9	=> 'BARRED',
	 	10	=> 'INVALID_SENDER_ID',
	 	11	=> 'NDNC_FAILURE',
	 	12	=> 'UNKNOWN_ERROR',
	 	13	=> 'UNDELIVERED',
	 	14	=> 'SUBMITTED_TO_OPERATOR',
	 	15	=> 'REJECTED'
	 ],
	 
	 'FCM_MISMATCH' => 5, 
	 'REPEAT_STATUS' => 55,
	 'PARENT_CATEGORY' => 0,

	 //CALLCENTRE_STATUS
	 'CALLCENTRE_STATUS' => [
	 	'MOVED'		=> 1,
	 	'QUEUE'		=> 2,
	 	'ONQUEUE'	=> 3,
	 	'ABANDONED'	=> 4,
	 	'SUCCESS'	=> 5,
	 	'HUNGUP'	=> 6,
	 	'PLACING'	=> 7,
	 	'RINGING'	=> 8,
	 	'FAILURE'	=> 9,
	],

	'PUSH_DELIVERY_STATUS'	=> [
		'SENT'			=> 1,
		'IN_CRM_QUEUE'	=> 2,
		'NO_FCM'		=> 4,
		'FCM_MISMATCH'	=> 5
	],

	'PUSH_DELIVERY_STATUS_REV'	=> [
		1	=> 'Sent',
		2	=> 'In CRM Queue',
		4	=> 'No FCM',
		5	=> 'FCM Mismatch'
	],

	'call_success_status'   => ['5'=>'SUCCESS', '6'=>'HUNGUP'],
    'call_failure_status'   => ['1'=>'MOVED', '2'=>'QUEUE', '3'=>'ONQUEUE', '4'=>'ABANDONED', '7'=>'PLACING', '8'=>'RINGING', '9'=>'FAILURE'],
    'email_success_status'  => ['5'=>'DELIVERED', '8'=>'OPENED', '9'=>'CLICKED'],
    'email_failure_status'  => ['1'=>'MOVED', '2'=>'QUEUED', '3'=>'PROCESSED', '4'=>'DROPPED', '6'=>'BOUNCED', '7'=>'DEFFERED', '10'=>'REPORTED_SPAM'],
    'sms_success_status'    => ['3'=>'DELIVERED'],
    'sms_failure_status'    => ['1'=>'MOVED', '2'=>'QUEUED', '4'=>'INVALID_NUMBER', '5'=>'ABSENT_SUBSCRIBER', '6'=>'MEMORY_EXCEEDED', '7'=>'MOBILE_EQUIPMENT_ERROR', '8'=>'NETWORK_ERROR', '9'=>'BARRED', '10'=>'INVALID_SENDER_ID', '11'=>'NDNC_FAILURE', '12'=>'UNKNOWN_ERROR', '13'=>'UNDELIVERED', '14'=>'SUBMITTED_TO_OPERATOR', '15'=>'REJECTED'],

	'EXCEL_IMPORT_FAILURE_TYPES' => [
		'VALIDATION'	=> 1,
		'QUERY'			=> 2	
	],
	
	'DISTRICT' => 1,
	'DEPARTMENT' => 2,
	'DESIGNATION' => 3,
	'TALUK' => 4,
	
	'INTIMATION_CHANNEL_ARR' => array(1,2),
	'INTIMATION_INTERVAL_ARR' => array(1,2,3,4,5),
	'COUNTRY'						=> 'country',

	'chromever' =>75,
	 'mozilaver' =>67,
	 'Safari'    => 5,
	 'opera'     => 63,
	 // 'Chrome'    => 64
	 
	 //Project Management
	 'pm_master_types'    => ['1'=>'Priority','2'=>'Project Category','3'=>'Technology','4'=>'Project Status','5'=>'Task Type','6'=>'Task Status'],

	 'project_near_due_default_interval'			=> 2,
	 'project_overdue_default_interval'				=> 2,
	 'project_task_near_due_default_interval'		=> 2,
	 'project_task_overdue_default_interval'		=> 2,

	  'service_flag'    => ['1'=>'Sheduler Services','2'=>'Windows Services','3'=>'IIS Services','4'=>'Database Cluster status','5'=>'Node Server Status','6'=>'Mail Server Status','7'=>'Ping Status','8'=>'IQTrack Chat Services','9'=>'CPU','10'=>'RAM','11'=>'HDD'],

	  'DISHA_CMPNY'	=> 24,
	  'EHEALTH_CMPNY'	=> 32,
	  'SECRETRIAT_CMPNY' => 25,
	  'DEMO'                   => ['1'=>'Interested', '2'=>'Not Interested'],
	  'INVDEMO'                   => ['Interested'=>'1','Not Interested'=>'2'],
	  'PROJECT_INTIMATION_STATUS'	=> 3,
	  'profile_status'                   => ['1'=>'Unverified Customer', '2'=>'Invalid Customer', '3'=>'Valid Customer'],
	  'profile_status_rev' => ['unverified_customer' => '1', 'invalid_customer' => '2', 'valid_customer' => '3'],
	  'SERVICE_REQUEST'	=> 6,

];
