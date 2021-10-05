<?php
namespace App\Http\Controllers;
use App\ApiCallLog;
use App\CampaignBatch;
use App\CommonSmsEmail;
use App\Feedback;
use App\FeedbackDetail;
use App\FeedbackDetailLog;
use App\FeedbackQuestion;
use App\FeedbackQuestionDetail;
use App\FeedbackQuestionLog;
use App\FeedbackRequest;
use App\Helpdesk;
use App\HelpdeskLog;
use App\Http\Controllers\Controller;
use App\LeadSources;
use App\QueryTypes;
use App\Question;
use App\SendgridResponse;
use App\SurveyDetail;
use App\SurveyQuestionDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\CustomerProfile;
use App\CustomerProfileLog;
class ApiCommon extends Controller
{
    public function __construct() {
		date_default_timezone_set("Asia/Kolkata");
                header('Access-Control-Allow-Origin: *');
	}
     /**
    * Common feedback api for chat,email,sms and IVR
    * @author Reshma Rajan
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function feedback_details(Request $request)
    {

        $api_call_log    = new ApiCallLog;
        $apilogid           = $api_call_log->createLog($request);
        $updated_arr=array();
        $condition_arr=array();
    try{
                $customer_id='';
                $type = request('type');
                $random_code = request('random_code'); 
                $fid = request('fid');
                $ltype = request('ltype');
                $company_id = request('company_id');
                $authentication = request('authentication_key');
                $query_type = request('query_type');
                if(!empty($type) && !empty($company_id) && !empty($authentication))
                {
                    $auth_check = LeadSources::where('source_key',$authentication)
                    ->where('cmpny_id',$company_id)
                    ->where('status',config('constant.ACTIVE'))->count();
                    if($auth_check > 0){
                            $fb_exist=0;
                            if(isset($fid) && !empty($fid) && isset($random_code) && !empty($random_code))
                            {
                                $follow_det=Helpdesk::where('id',$fid)->first();
                                $customer_id=$follow_det['customer_id']; // only in web
                                $query_type=$follow_det['query_type'];
                                $fb_exist=FeedbackDetail::where('reference_id',$fid)->whereIn('fb_type',[config('constant.CH_EMAIL'),config('constant.CH_SMS')])->count();

                            }
                            $fb_det=Feedback::where('fb_type',$type);
                            if(isset($query_type) && !empty($query_type))
                            {
                                $fb_det=$fb_det->where('query_type',$query_type);
                            }
                            $fb_det=$fb_det->first();
                            if($fb_det)
                            {
                                //$qstn=$fb_det->question_ids;
                                $fb_type=$fb_det->fb_type;
                                $is_rating=$fb_det->is_rating;
                                $is_comment=$fb_det->is_comment;
                                $fbid=$fb_det->id;
                               // $unserial=unserialize($qstn);
                                if(isset($ltype) && $ltype == config('constant.LANG_MALA')){
                                $q_det=FeedbackQuestion::with('mal_questions')->where('feedback_id',$fbid)->where('status',config('constant.ACTIVE'))->get();
                                $fbpage='feedback_survey.feedback.api_feedbackform_language2';

                            }else{
                                $q_det=FeedbackQuestion::with('eng_questions')->where('feedback_id',$fbid)->where('status',config('constant.ACTIVE'));
                                if(isset($company_id) && !empty($company_id))
                                {
                                    $q_det->where('cmpny_id',$company_id);
                                }
                                $q_det=$q_det->get();
                                $fbpage='feedback_survey.feedback.api_feedbackform';
                            }
                                $status=config('constant.ACTIVE');
                                $result_arr=array('status'=>$status,'type'=>$fb_type,'questions'=>$q_det,'is_rating'=>$is_rating,'is_comment'=>$is_comment,'is_exist'=>$fb_exist);

                                if(isset($customer_id) && !empty($customer_id))
                                {
                                    $result_arr['customer_id']=$customer_id;
                                }
                                if(isset($follow_det['docket_number']) && !empty($follow_det['docket_number']))
                                {
                                    $result_arr['docket_number']=$follow_det['docket_number'];
                                }
                                if(isset($follow_det['req_title']) && !empty($follow_det['req_title']))
                                {
                                    $result_arr['req_title']=$follow_det['req_title'];
                                }
                                $result_arr['company_id']=$company_id; 
                                    
                            }else{
                                $status=config('constant.INACTIVE');
                                $result_arr=array('status'=>$status);
                            }
                            $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                            if($type == config('constant.CH_SMS') || $type == config('constant.CH_EMAIL')){
                                $result_arr['authentication']=$authentication;
                                $result_arr['fid']=$fid;
                                $result_arr['type']=$type;
                                $result_arr['customer_id']=$customer_id;
                                $html = view($fbpage)->with(compact('result_arr'))->render();
                                    $result_arr1=array('success' => true,'html' => $html);
                                   echo json_encode($result_arr1);
                            }else{
                                echo json_encode($result_arr);die;
                            }
                        }else{
                        $result_arr= array('status'=>'AUTH_FAILURE');
                        $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                        echo json_encode($result_arr);die;
                    }   
                }else{
                    $result_arr= array('status'=>'EMPTY_DATA');
                    $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                    echo json_encode($result_arr);die;
                }
                    
        }catch(\Illuminate\Database\QueryException $ex)
        {
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,$company_id,$data,$error);
            return $data;
        }


    }
            /**
    * Common api for inserting feedbacks
    * @author Reshma Rajan
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function common_feedback_insertion(Request $request)
    {

        $api_call_log    = new ApiCallLog;
        $apilogid           = $api_call_log->createLog($request);
        $updated_arr=array();
        $condition_arr=array();
    try{

                $type = request('type'); 
                $fid = request('fid');
                $random_code = request('random_code');
                $company_id = request('company_id');
                $authentication = request('authentication_key');
                $rating = request('rating');
                $comments = request('comments');
                $question_answers = request('question_answers');
                $qustn_answers  =   json_decode($question_answers);

                //print_r($qustn_answers);
                $thread_id = request('thread_id');
                $call_id = request('call_id');
                $customer_id = request('customer_id');
                if(!empty($customer_id) && !empty($company_id) && !empty($authentication) && !empty($type))
                {
                $auth_check = LeadSources::where('source_key',$authentication)
                    ->where('cmpny_id',$company_id)
                    ->where('status',config('constant.ACTIVE'))->count();
                if($auth_check > 0){
                    if($type == config('constant.CH_CHAT')){
                       if(isset($thread_id) && !empty($thread_id)){
                           // $condition_arr['reference_id']=$thread_id;
                             $update_arr['thread_id']=$thread_id;
                        }
                    }else{
                        if(isset($fid) && !empty($fid)){
                            $condition_arr['reference_id']=$fid;
                             $update_arr['reference_id']=$fid;
                        }
                    }
                        
                        
                    $fb_exist=0;
                    if(isset($fid) && !empty($fid))
                    {
                    $fb_exist=FeedbackDetail::where('reference_id',$fid)->whereIn('fb_type',[config('constant.CH_EMAIL'),config('constant.CH_SMS')])->count();
                    }
                    if($fb_exist ==0){
                    $update_arr['fb_type']=$type;
                    if(isset($rating) && !empty($rating)){
                        $update_arr['rating']=$rating;
                    }
                    if(isset($call_id) && !empty($call_id)){
                        $update_arr['call_id']=$call_id;
                    }
                    if(isset($comments) && !empty($comments)){
                        $update_arr['comments']=$comments;
                    }
                    if(isset($customer_id) && !empty($customer_id)){
                                
                        if($type != config('constant.CH_CHAT')){
                            $condition_arr['customer_id']=$customer_id;
                         }
                         $update_arr['customer_id']=$customer_id;
                    }
                    $update_arr['cmpny_id']=$company_id;
                    $update_arr['created_by']=$customer_id;
                    $update_arr['updated_by']=$customer_id;
                    $update_arr['status']=config('constant.ACTIVE');
                    if($type == config('constant.CH_CHAT')){
                         $fb_data=FeedbackDetail::Create($update_arr);
                    }else{
                         $fb_data=FeedbackDetail::updateOrCreate($condition_arr,$update_arr);
                    }
                    $fbid=$fb_data->id;
                    $update_arr['fb_det_id']=$fbid;
                    FeedbackDetailLog::Create($update_arr);
                    if($type != config('constant.CH_CHAT')){
                        Helpdesk::where('id',$fid)->update(['feedback_id'=>$fbid]);
                    }
                   if(isset($fid) && !empty($fid))
                        {
                            $arr_fb=array('status'=>config('constant.ACTIVE'));
                            FeedbackRequest::where('helpdesk_id',$fid)->update($arr_fb);
                            
                            $qustn_answers=array();
                            $val_arr=new \stdClass();
                            if(request('questions'))
                            {
                                $q_answers = request('questions');
                                foreach ($q_answers as $key => $value) {
                                $val_arr->id=$key;
                                $val_arr->answer=$value;
                                $qustn_answers[]=$val_arr;
                                }
                            }
                            
                        }
                    if(isset($qustn_answers) && count($qustn_answers) > 0)
                    {
                        

                        foreach($qustn_answers as $values){
                            $up_arr=array();
                            $con_arr=array();
                            $up_arr_log=array();
                            $q_id=trim($values->id);
                            $answer=trim($values->answer);
                            $con_arr['fb_det_id']=$fbid;
                            if(isset($q_id) && !empty($q_id)){
                                $up_arr['question_id']=$q_id;
                                $con_arr['question_id']=$q_id;
                            }
                            if(isset($answer) && !empty($answer)){
                                $up_arr['answer']=$answer;
                            }
                            $up_arr['cmpny_id']=$company_id;
                            $up_arr['created_by']=$customer_id;
                            $up_arr['updated_by']=$customer_id;
                            $up_arr['status']=config('constant.ACTIVE');
                            $save_data=FeedbackQuestionDetail::updateOrCreate($con_arr,$up_arr);
                            $up_arr_log=$up_arr;
                            $up_arr_log['fb_question_id']=$save_data->id;
                            FeedbackQuestionLog::Create($up_arr_log);
                        }


                    }

                    $helpdesk_log_arr=array(
                     'created_at' => date('Y-m-d H:i:s'),
                     'status' => config('constant.ACTIVE'),
                     'feedback_id'=>$fbid
                     );

                    
                    if($type != config('constant.CH_CHAT')){
                        $docket_no_det=Helpdesk::where('id',$fid)->first();
                        $helpdesk_log_arr['docket_number']=$docket_no_det->docket_number;
                        $helpdesk_log = HelpdeskLog::create($helpdesk_log_arr);
                    }
                        if($fbid)
                        {

                            $status=config('constant.ACTIVE');
                            $result_arr=array('reset'=>true,'status'=>$status,'success' => true,'message' => 'Feedback Added successfully');
                        }else{
                            $status=config('constant.INACTIVE');
                            $result_arr=array('reset'=>false,'status'=>$status,'success' => false,'message' => 'Something went wrong');
                        }
                        $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                        echo json_encode($result_arr);die;
                    }else{
                        $result_arr= array('status'=>config('constant.INACTIVE'),'success' => false,'message' => 'Feedback Already Submitted');
                        $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                        echo json_encode($result_arr);die;
                    }
                        
                }else{
                    $result_arr= array('status'=>'AUTH_FAILURE','success' => false,'message' => 'Something went wrong');
                    $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                    echo json_encode($result_arr);die;
                }
            }else{
                    $result_arr= array('status'=>'EMPTY_DATA','success' => false,'message' => 'Something went wrong');
                    $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                    echo json_encode($result_arr);die;
                    }
        }catch(\Illuminate\Database\QueryException $ex)
        {
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,$company_id,$data,$error);
            return $data;
        }


    }

            /**
    * Common api for inserting feedbacks
    * @author Reshma Rajan
    * @date 11/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return
   */
    public function common_survey_insertion(Request $request)
    {

        $api_call_log    = new ApiCallLog;
        $apilogid           = $api_call_log->createLog($request);
        $updated_arr=array();
        $condition_arr=array();
    try{
                $agent_id=NULL;
                $type='';
                $authentication = request('authentication_key');
                $common_id = request('common_id');
                
                $customer_id = request('customer_id');
                $batch_id = request('batch_id');
                $qustn_answers = request('questions');
                $uniquevalue = request('uniquevalue');
                $agent_id = request('agent_id');
                $survey_id = request('survey_id');
                $company_id = request('company_id');
                $langtype = request('langtype');
                $contact_id = request('contact_id');
                $campaign_id = request('campaign_id');

                if(!empty($customer_id) && !empty($company_id) && !empty($authentication) && !empty($langtype) && !empty($batch_id) && !empty($survey_id) && !empty($qustn_answers))
                {
                $auth_check = LeadSources::where('source_key',$authentication)
                    ->where('cmpny_id',$company_id)
                    ->where('status',config('constant.ACTIVE'))->count();
                if($auth_check > 0){
                    
                    
                        
                    $e_count=0;
                    $exist_count=SurveyDetail::where('batch_id',$batch_id)->where('survey_id',$survey_id)->where('status',config('constant.ACTIVE'))->where('customer_id',$customer_id);

                    if(isset($common_id) && !empty($common_id))
                        {
                            $exist_count->where('common_id',$common_id);
                        }
                    if(isset($uniquevalue) && !empty($uniquevalue))
                        {
                            $exist_count->where('id',$uniquevalue);
                        }
                    $e_count=$exist_count->count();

                    if($e_count ==0){
                        
                            if(isset($contact_id) && !empty($contact_id))
                            {
                                //$condition_arr['contact_id']=$contact_id;
                                $update_arr['contact_id']=$contact_id;
                            }
                            //$condition_arr['cmpny_id']=$company_id;
                            $update_arr['cmpny_id']=$company_id;
                            $condition_arr['customer_id']=$customer_id;
                            $update_arr['customer_id']=$customer_id;    

                            $condition_arr['survey_id']=$survey_id;
                            $update_arr['survey_id']=$survey_id;

                            $condition_arr['batch_id']=$batch_id;
                            $update_arr['batch_id']=$batch_id;

                            $update_arr['campaign_id']=$campaign_id;
                           /*  $batch_det=cmp_process_batch::where('id',$batch_id)->first();
                           if(isset($batch_det->type) && !empty($batch_det->type))
                            {
                                $update_arr['type']=$batch_det->type;
                            }*/
                            $batch_det=CampaignBatch::where('id',$batch_id)->first();
                            $update_arr['type']=$batch_det->channel_type;
                            $update_arr['language_type']=$langtype;
                            $update_arr['common_id']=$common_id;
                            $update_arr['created_by']=$agent_id;
                           
                            $update_arr['status']=config('constant.ACTIVE');
                            $fb_data=SurveyDetail::updateOrCreate($condition_arr,$update_arr);

                            $sid=$fb_data->id;
                            $update_arr['survey_det_id']=$sid;

                            if(isset($qustn_answers) && count($qustn_answers) > 0)
                            {

                                $q_id_arr=request('qstn');
                                foreach($qustn_answers as $keyval=> $values){
                                    $up_arr=array();
                                    $con_arr=array();
                                    $up_arr_log=array();
                                    $r_id=trim($keyval);
                                    $answer=trim($values);
                                    $con_arr['survey_det_id']=$sid;
                                    if(isset($r_id) && !empty($r_id) && isset($answer) && !empty($answer) && isset($q_id_arr) && !empty($q_id_arr))
                                    {

                                    $up_arr['relation_id']=$r_id;
                                    $con_arr['relation_id']=$r_id;
                                    $up_arr['answer']=$answer;
                                    $up_arr['question_id']=$q_id_arr[$r_id];

                                    $up_arr['created_by']=$agent_id;
                                    $up_arr['status']=config('constant.ACTIVE');
                                    $save_data=SurveyQuestionDetails::updateOrCreate($con_arr,$up_arr);
                                    }

                                }


                            }
                            if($sid)
                            {

                                $status=config('constant.API_ACTIVE');
                                $result_arr=array('status'=>$status,'success' => true,'message' => 'Survey Added successfully');
                            }else{
                                $status=config('constant.API_INACTIVE');
                                $result_arr=array('status'=>$status,'success' => false,'message' => 'Something went wrong');
                            }
                            $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                            echo json_encode($result_arr);die;
                    }else{
                        $result_arr= array('status'=>3,'success' => false,'message' => 'Survey Already Exist');
                        $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                        echo json_encode($result_arr);die;
                    }
                        
                }else{
                    $result_arr= array('status'=>'AUTH_FAILURE','success' => false,'message' => 'Something went wrong');
                    $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                    echo json_encode($result_arr);die;
                }
            }else{
                    $result_arr= array('status'=>'EMPTY_DATA','success' => false,'message' => 'Something went wrong');
                    
                    $api_call_log->updateLog($apilogid,$company_id,$result_arr);
                    echo json_encode($result_arr);die;

        }
        }catch(\Illuminate\Database\QueryException $ex)
        {
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,$company_id,$data,$error);
            return $data;
        }


    }

    /**
     * Automated mail status updation api : called by sendgrid
     * * Modified to split and save all relavent data
     * @author Rahul R.
     * @date 21/11/2018
     * @since version 1.0.0
    */
    function save_email_response(Request $request)
    {
        $api_call_log    = new ApiCallLog;
        $apilogid           = $api_call_log->createLog($request);
        $arr=array();
        try
        {
                $response               = $request->all();
                $inputs                 = json_encode($response);
                $inputs                 = str_replace("<","",$inputs);
                $inputs                 = str_replace(">","",$inputs);
                $inputs                 = str_replace("-","",$inputs);
                $mail_full_response     = $inputs;
                $result                 = json_decode($mail_full_response);
                $arr                    = array('mail_full_response' =>$inputs);
                $current_status         = '';
                foreach ($result as  $data)
                {
                    if($data->sg_message_id != "")
                    {
                        $arr['sg_message_id'] = trim($data->sg_message_id);
                        if(isset($data->email))
                        {
                                $arr['email']= trim($data->email);
                        }
                        if(isset($data->timestamp))
                        {
                                $arr['time_stamp']= trim($data->timestamp);
                        }
                        if(isset($data->category))
                        {
                                $arr['category']= trim($data->category);
                        }
                        if(isset($data->event))
                        {
                                $arr['event']= trim($data->event);
                                switch ($arr['event']) {
                                    case 'processed':
                                        $current_status = config('constant.SG_EMAIL_DELIVERY_STATUS.PROCESSED');
                                        break;
                                    case 'delivered':
                                        $current_status = config('constant.SG_EMAIL_DELIVERY_STATUS.DELIVERED');
                                        break;
                                    case 'open':
                                        $current_status = config('constant.SG_EMAIL_DELIVERY_STATUS.OPENED');
                                        break;
                                    case 'click':
                                        $current_status = config('constant.SG_EMAIL_DELIVERY_STATUS.CLICKED');
                                        break;
                                    case 'dropped':
                                        $current_status = config('constant.SG_EMAIL_DELIVERY_STATUS.DROPPED');
                                        break;
                                    case 'bounce':
                                        $current_status = config('constant.SG_EMAIL_DELIVERY_STATUS.BOUNCED');
                                        break;
                                    case 'deferred':
                                        $current_status = config('constant.SG_EMAIL_DELIVERY_STATUS.DEFFERED');
                                        break;
                                    case 'spam report':
                                        $current_status = config('constant.SG_EMAIL_DELIVERY_STATUS.REPORTED_SPAM');
                                        break;

                                    default:
                                        $current_status = 99;
                                        break;
                                }
                        }
                        if(isset($data->mail_ref_id))
                        {
                                $arr['mail_ref_id']= trim($data->mail_ref_id);
                        }
                        $results=SendgridResponse::create($arr);
                        if($current_status != '' && isset($data->mail_ref_id))
                        {
                            $mail_ref_id = trim($data->mail_ref_id);
                            CommonSmsEmail::where('mail_ref_id',$mail_ref_id)->update(['status'=>$current_status]);

                            /////////// AUTOMATED PROCESS CODES STARTS HERE ////////////
                            /*if(config('constant.AUTO_PROCESS_ACTIVATION')!=1)
                            {
                                if($current_status == config('constant.SG_EMAIL_DELIVERY_STATUS.OPENED'))
                                {
                                    $common_results = CommonSmsEmail::select('id')->where('mail_ref_id',$mail_ref_id)->first();
                                    if(count($common_results)>0)
                                    {
                                        $cmn_id = $common_results->id;
                                        $fin_results = cmp_automated_process_relations::where('field4',$cmn_id)->get();
                                        if(count($fin_results)>0)
                                        {
                                        foreach($fin_results as $result)
                                        {
                                            $user_id = $result->customer_id;
                                            $flag = null;$chitty = $result->field2;$chittal = $result->field1;$security = $result->security_flag;
                                            $response = config('constant.AUTO_PROCESS_RESPONSE_POSITIVE');
                                            $resp = cmp_automated_process_relations::where('customer_id',$user_id)->where('field2',$chitty)->get();
                                            if(count($resp)>0)
                                            {
                                                foreach($resp as $resp)
                                                {
                                                    $chittal = $resp->field1;
                                                    helpers::auto_process_updation($user_id,$response,$flag,$chitty,$chittal,$security);
                                                }
                                            }

                                        }
                                        }
                                    }

                                }
                            }*/
                            /////////// AUTOMATED PROCESS CODES ENDS HERE ////////////

                        }

                    }
                }



        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,$company_id,$data,$error);
            return $data;
        }
    }

   
    /**
     * SAVE LEAD FROM LANDING PAGE
     * @author AKHIL MURUKAN
     * @date 21/03/2019
     * @since version 1.0.0
    */
    function new_lead(Request $request)
    {
        $api_call_log    = new ApiCallLog;
        $apilogid           = $api_call_log->createLog($request);
        $arr=array();
        try
        {
            $response 			=  	$request->all();
			$authentication 	= 	request('authentication_key');
			$first_name 		= 	request('first_name');
			$email 				= 	request('email');
			$mobile 			= 	request('mobile');
			$mobile             =   str_replace(" ", "", $mobile);
			$mobile             =   str_replace("+", "", $mobile);
			$mobile             =   str_replace("-", "", $mobile);
			if(!empty($authentication))
                {
                    $check = LeadSources::where('source_key',$authentication)
						->where('status',config('constant.ACTIVE'))->first();
                    if($check)
					{
						$source = $check['id'];
						$cmpny_id = $check['cmpny_id'];
						$profile_status = 1;
						
						if(isset($email) && !empty($email))
							{
								$user_exist = CustomerProfile::where(['email'=>$email])->where(['cmpny_id'=>$cmpny_id])->first();
							}
						if(isset($mobile) && !empty($mobile))
							{
								$user_mobile_exist = CustomerProfile::where(['mobile'=>$mobile])->where(['cmpny_id'=>$cmpny_id])->first();
							}
						if(isset($user_mobile_exist) && !empty($user_mobile_exist))
						{

					    /*  $update_arr2['profile_status'] = $profile_status;
					      $update_arr2['first_name'] = $first_name;
					      $update_arr2['email'] = $email;
					      $update_arr2['mobile'] = $mobile;
					      $update_arr2['source'] = $source;
					      $update_arr2['status'] = config('constant.ACTIVE');
						  $condition_arr2['id'] = $user_mobile_exist->id;
						  
					      $results  = CustomerProfile::updateOrCreate($condition_arr2,$update_arr2);
						  $user_id = $results->id;
                          $update_arr2['user_id']=$user_id;
						  $log_values=CustomerProfileLog::Create($update_arr2);
						  */
					    }
						elseif(isset($user_exist) && !empty($user_exist))
						{
						 /* $update_arr3['profile_status'] = $profile_status;
						  $update_arr3['first_name'] = $first_name;
					      $update_arr3['email'] = $email;
					      $update_arr3['mobile'] = $mobile;
					      $update_arr3['source'] = $source;
					      $update_arr3['status'] = config('constant.ACTIVE');
						  $condition_arr3['id'] = $user_exist->id;
						  
					      $results2  = CustomerProfile::updateOrCreate($condition_arr3,$update_arr3);  
						  $user_id2 = $results2->id;
                          $update_arr3['user_id']=$user_id2;
						  $log_values3=CustomerProfileLog::Create($update_arr3);*/
						}
						else
						{
							$insert_arr['profile_status'] = $profile_status;
							$insert_arr['first_name'] = $first_name;
							$insert_arr['email'] = $email;
							$insert_arr['cmpny_id'] = $cmpny_id;
							$insert_arr['mobile'] = $mobile;
							$insert_arr['source'] = $source;
							$insert_arr['status'] = config('constant.ACTIVE');
							$insertion = CustomerProfile::create($insert_arr);
							$user_id3 = $insertion->id;
                            $insert_arr['user_id']=$user_id3;
							$log_values3=CustomerProfileLog::Create($insert_arr);
							
							$result = array('status'=>config('constant.ACTIVE'));
						    echo json_encode($result);die;
						}
					}
				}
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $error      = $ex->getMessage();
            $data       = array('status'=>'DB_ERROR');
            $api_call_log->updateLog($apilogid,'',$data,$error);
            return $data;
        }
    }


}
