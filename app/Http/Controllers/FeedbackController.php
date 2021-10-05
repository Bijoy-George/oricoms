<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\Helpdesk;
use App\Question;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\QueryTypes;
use App\CompanyChannel;
use App\Channel;
use App\QueryStatus;
use App\FeedbackDetail;
use App\User;
use App\CompanyMeta;
use App\FeedbackQuestion;
use App\LeadSources;
use App\CommonSmsEmail;
use App\Jobs\FbReportExportJob; 
use App\Exports\FbExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FbViewExport; 
use App\Exports\UserExport;
use PDF;

   /*
    * Question Controller
    * @author Reshma Rajan
    * @date 9/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['feedbackform']);
        $this->middleware('check-permission:feedback report',   ['only' => ['report_index','report_list','more_feedback_det','export_fb_report']]);
    }
    /*
    * Getting Questions
    * @author Reshma Rajan
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Question page
    */
    public function index()
    { 
        $channels =['' => 'Select'] +Channel::whereHas('channel_details', function($q) {
            $q->where('cmpny_id', Auth::user()->cmpny_id);
        })->pluck('name', 'id')->all();
        return view('feedback_survey.feedback.index',compact('channels'));
    }

    /*
    * QUESTION LISTING VIEW WITH FILTERS
    * @author Reshma Rajan
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Question list
    */
    public function search_list(Request $request)
    {
        $response           =   $request->all();
        $fb_type =Channel::whereHas('channel_details', function($q) {
            $q->where('cmpny_id', Auth::user()->cmpny_id);
        })->pluck('name', 'id')->all();
        $query_type =QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('type',config('constant.TICKET'))->orderBy('query_type')->get();
        $results = array(); 
        $results = Feedback::where('cmpny_id',Auth::user()->cmpny_id)->where('status',config('constant.ACTIVE'))->orderBy('id', 'asc');        
        
        if(request('search_keywords')) 
            {
               $results->Where('fb_type',request('search_keywords'));
            }                 
        $results   =   $results->paginate(config('constant.pagination_constant'));
        foreach ($results as  $value) {
         
          $fb_status= $value->fb_status;
          $unserialize=unserialize($fb_status);
         // echo 'kkk'.$value->id;
          if(!empty($unserialize)){
          $status     = QueryStatus::whereIn('id',$unserialize)->get(); 
          $value->fb_status=$status;
          }else{
            $value->fb_status='';
          }
         
          
        }             
        $html = view('feedback_survey.feedback.listview')->with(compact('results','fb_type','query_type'))->render();
        
        $result_arr=array('success' => true,'html' => $html);
        return json_encode($result_arr);        
        

    }
    /*
    * FOR CREATE Questio
    * @author Reshma Rajan
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Question form
    */
    public function create()
    {   
        $channels =['' => 'Select'] +  Channel::whereHas('channel_details', function($q) {
            $q->where('cmpny_id', Auth::user()->cmpny_id);
        })->pluck('name', 'id')->all();
      
        return view('feedback_survey.feedback.create', compact('channels'));
    }
    /*
    * Update Questions
    * @author Reshma Rajan
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Question dorm
    */
    public function edit($id = null)
    {   
        $res = Feedback::select('id','questions','option1','option1','option2','option3','option4', 'option5', 'option6')
                ->where('id',$id)
                ->first();
                
        return view('feedback_survey.feedback.create', compact('id','res'));
        
    }
    /*
    * Saving Questions
     * @author Reshma Rajan
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Question form */
    
    
    public function store(Request $request){
        $response = $request->all();
        $form_data=  array();
        //print_r($response);
        //parse_str($response['data'], $form_data);
        if(request('fb_type') == config('constant.CH_CHAT'))
         { 
        $this->validate($request,[
                'fb_type' => 'required',
                ],[
                'fb_type.required' => ' The Feedback Type field is required.',
                ]);
        }else{
        $this->validate($request,[
                'fb_type' => 'required',
                'query_type' => 'required',
                'action_time' => 'required',
                'action' => 'required',
                'status_id' => 'required',
                ],[
                'fb_type.required' => ' The Feedback Type field is required.',
                'query_type.required' => 'Query Type  field is required.',
                'action_time.required' => 'Action Time  field is required.',
                'action.required' => 'Action Type  field is required.',
                'status_id.required' => 'Status  field is required.',
                ]);
        }
        $condition_arr=array();
        $update_arr=array();
        $condition_arr['cmpny_id']=Auth::user()->cmpny_id;
        $condition_arr['fb_type']=request('fb_type');
        $update_arr['fb_type']=request('fb_type');
        $update_arr['status']=config('constant.ACTIVE');
        if(request('query_type'))
        {
            $condition_arr['query_type']=request('query_type');
            $update_arr['query_type']=request('query_type');
        }
        
        if(request('status_id'))
        {
            $status_id=request('status_id');
           $update_arr['fb_status']=serialize($status_id);
           
        }
        if(request('question_id'))
        {

           $fb_questions=request('question_id');
           $update_arr['question_ids']=serialize($fb_questions);
        }else{
           $fb_questions=array();
           $update_arr['question_ids']=serialize($fb_questions);
        }
        if(request('action') && request('action_time'))
        {
           $action=request('action');
           $action_time=request('action_time');
           if($action == 1)
           {
            $action_time=$action_time * 60;

           }
           $update_arr['action_time']=$action_time;
        }
        if(request('action'))
        {
           $update_arr['action_type']=request('action');
        }
        if(request('comment_box') == 1)
        {
           $update_arr['is_comment']=request('comment_box');
        }else{
            $update_arr['is_comment']=2;
        }
        if(request('rating') == 1)
        {
           $update_arr['is_rating']=request('rating');
        }else{
            $update_arr['is_rating']=2;
        }

            $save_data=Feedback::updateOrCreate($condition_arr,$update_arr);
            $fbid=$save_data->id;
            $engid=array_filter($response['eng_q']);
            $malid=array_filter($response['mal_q']);

            if (($key = array_search("0", $engid)) !== false) {
                unset($engid[$key]);
            }
            if (($key1 = array_search("0", $malid)) !== false) {
               unset($malid[$key1]);
            }
           
            if(count($engid) != count($malid))
            {
                $result_arr = array('success' => false,'message' => 'Question Mismatch');
                echo json_encode($result_arr);die;
            }
            $unique_arr_eng = array_unique($engid);
            $unique_arr_mal = array_unique($malid);
           
            if(count($engid) != count($unique_arr_eng))
                {
                    $result_arr = array('success' => false,'message' => 'Duplicate Question');
                    echo json_encode($result_arr);die;
                }
               if(count($malid) != count($unique_arr_mal))
                {
                    $result_arr = array('success' => false,'message' => 'Duplicate Question');
                    echo json_encode($result_arr);die;
                } 
            for($i=0;$i<=3;$i++)
                {
                     $relation_id='relation_id'.$i;
                    if(isset($response['eng_q'][$i]) && $response['eng_q'][$i] != 0){  
                        $eng_qid=$response['eng_q'][$i];
                    }else
                    {
                        $eng_qid=0;
                    }
                    if(isset($response['mal_q'][$i]) && $response['mal_q'][$i] !=0){
                        $mala_qid=$response['mal_q'][$i];
                    }else
                    {
                        $mala_qid=0;
                    }
             
                    if(isset($response[$relation_id]) &&  !empty($relation_id)){ 

                         if($eng_qid != 0 && $mala_qid !=0){
                          

                        $update_s=FeedbackQuestion::updateOrCreate(
                            [
                                'feedback_id'=>$fbid,
                                'cmpny_id'=>Auth::user()->cmpny_id,
                                'id'=>$response[$relation_id],
                            ],[
                            
                            'eng_qstn_id'=>$eng_qid,
                            'mal_qstn_id'=>$mala_qid,
                            'created_by'=> Auth::User()->id,
                            'status'=>config('constant.ACTIVE')
                         ]);
                          $inactive_q=FeedbackQuestion::where('feedback_id',$fbid)->where('eng_qstn_id',0)->where('mal_qstn_id',0)->update(['status'=>config('constant.INACTIVE')]);
                    }
                    }else{
                        

                        if($eng_qid != 0 && $mala_qid !=0){
                            
                                
                            $save_q_data=FeedbackQuestion::Create([
                                    'feedback_id'=>$fbid,
                                    'eng_qstn_id'=>$eng_qid,
                                    'mal_qstn_id'=>$mala_qid,
                                    'created_by'=> Auth::User()->id,
                                    'status'=>config('constant.ACTIVE')
                                 ]);
                            $inactive_q=FeedbackQuestion::where('feedback_id',$fbid)->where('eng_qstn_id',0)->where('mal_qstn_id',0)->update(['status'=>config('constant.INACTIVE')]);    
                            
                        }
                    }
                }

            $result_arr = array('success' => true,'message' => 'Successfuly updated');
            echo json_encode($result_arr);
            
            
    }
    /*
    * Dispalying feedback form
     * @author Reshma Rajan
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return feedback form */
    function get_feedback_form(Request $request)
    {  
       
        $fb_type='';
        $fb_det=array();
        $fb_questions=array();
        $query_types =QueryTypes::where('cmpny_id',Auth::user()->cmpny_id)->where('type',config('constant.TICKET'))->where('status',config('constant.ACTIVE'))->orderBy('query_type')->get();
        $engquestions=Question::where('status',config('constant.ACTIVE'))->where('language_type',config('constant.LANG_ENG'))->where('feedback',1)->get();
        $malaquestions=Question::where('status',config('constant.ACTIVE'))->where('language_type',config('constant.LANG_MALA'))->where('feedback',1)->get();
        
        if(request('fb_type'))
        {
            $fb_type=request('fb_type');
            
            $fb_det=Feedback::where('fb_type',$fb_type);
            if(request('enq_type'))
            {

                $fb_det=$fb_det->where('query_type',request('enq_type'));
            }
            $fb_det=$fb_det->first();
             if($fb_det){
                $fb_questions=FeedbackQuestion::where('feedback_id',$fb_det->id)->where('status',config('constant.ACTIVE'))->get();
                
            }
            if(request('fb_type') == config('constant.CH_CHAT'))
            {
                $html = view('feedback_survey.feedback.feedback_form_other')->with(compact('query_types','fb_det','fb_type','engquestions','malaquestions','fb_questions'))->render();
        
            }else{
                $html = view('feedback_survey.feedback.feedback_form_email')->with(compact('query_types','fb_det','fb_type','fb_questions'))->render();

            }
            $result_arr=array('success' => true,'html' => $html);
            return json_encode($result_arr);
            
        }
    }
    /*
    * Dispalying feedback form
     * @author Reshma Rajan
    * @date 10/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return feedback form */
    function feedback_status_form(Request $request)
    {  
        
        $fb_det=array();
        if(request('enq_type')){
        
       
        $status = QueryStatus::where('status',config('constant.ACTIVE'))->get();
        }else{
            $status = QueryStatus::where('status',config('constant.ACTIVE'))->get();
        }

        if(request('fb_type')){
            $fb_det=Feedback::where('fb_type',request('fb_type'));
            if(request('enq_type')){
                $fb_det=$fb_det->where('query_type',request('enq_type'));
            }
            $fb_det=$fb_det->first();
        }
        if($fb_det){
                $fb_questions=FeedbackQuestion::where('feedback_id',$fb_det->id)->where('status',config('constant.ACTIVE'))->get();
                
            }
        
        $status_json ='';
        if(count($status)>0)
        {
            if(!empty($fb_det->fb_status)){
                $fbstatus=unserialize($fb_det->fb_status);
            }else{
              $fbstatus=array();
            }

            
            $status_json = '[';
            foreach ($status as $value) {
                $status_json .= '{"id":'.$value->id.',"name":"'.$value->name.'","selected":';
               if(in_array($value->id, $fbstatus))
                {
                    $status_json .= 'true},';
                }
                else 
                {
                    $status_json .= 'false},';
                }
            }
            $status_json=rtrim($status_json,",");
             $status_json .= ']';
        }
        else {
            $status_json = '[{"id":"0","disabled": true,"name":"No Question found","selected":false}]';
        }

        $engquestions=Question::where('status',config('constant.ACTIVE'))->where('language_type',config('constant.LANG_ENG'))->where('feedback',1)->get();
        $malaquestions=Question::where('status',config('constant.ACTIVE'))->where('language_type',config('constant.LANG_MALA'))->where('feedback',1)->get();
        $html = view('feedback_survey.feedback.status_form')->with(compact('status','fb_type','fb_questions','status_json','fb_det','engquestions','malaquestions'))->render();
        $result_arr=array('success' => true,'html' => $html);
            return json_encode($result_arr);
       
    } 
    /*
    * Getting Feedback form for outside customers
    * @author Reshma Rajan
    * @date 12/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Feedback form
    */
    function feedbackform($randomstr='')
    {
        $db_det=array();
        $company_id='';
        $decoded_str = base64_decode( urldecode($randomstr));
        $str = explode('_', $decoded_str);
        if(isset($str[0]) && !empty($str[0])){
            $fid=$str[0];
            $db_det=Helpdesk::where('id',$fid)->first();
            
            
        }
        if(isset($str[1]) && !empty($str[1])){
            $ltype=$str[1];
        }else{
            $ltype='';
        }
        if(isset($str[2]) && !empty($str[2])){
            $randomcode=$str[2];
        }else{
            $randomcode='';
        }
        if(isset($str[3]) && !empty($str[3])){
            $authentication=$str[3];
        }else{
            $authentication='';
        }
        if(isset($str[4]) && !empty($str[4])){
            $channel_type=$str[4];
        }else{
            $channel_type='';
        }
        $check_user=CommonSmsEmail::where('random_code',$randomcode)->count();
         $check_auth=LeadSources::where('cmpny_id',$db_det->cmpny_id)
                    ->where('status',config('constant.ACTIVE'))->where('source_key',$authentication)->count();
        if($check_user > 0  &&  $check_auth >0 && !empty($db_det)){
        return view('feedback_survey.feedback.api_feedback',compact('db_det','authentication','fid','ltype','channel_type','randomcode'));
        }

    }
    /*
    * Getting Feedback Report
    * @author Reshma Rajan
    * @Modified by PRANEESHA KP
    * @date 13/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Report page
    */
    public function report_index()
    { 
		$channels =['' => 'Select Type'] +Channel::whereHas('channel_details', function($q) {
            $q->where('cmpny_id', Auth::user()->cmpny_id);
        })->pluck('name', 'id')->all();
		
		$chat_agent_role= CompanyMeta::select('cmpny_id','id','meta_value')->where('meta_name','chat_agent')->first();
		
		$agents=['' => 'Select Agent'] +User::where('role_id','like','%' . $chat_agent_role->meta_value . '%')->pluck('name', 'id')->all();
		
        return view('feedback_survey.feedback.report_index',compact('channels','agents'));
    }

    /*
    * Report listing view with filters
    * @author Reshma Rajan
    * @date 13/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Report list
    */
    public function report_list(Request $request)
    {
        $response           =   $request->all();
        
        $results = array(); 
        $agent_id=request('agent_id');
        $results = FeedbackDetail::with('feedback_profile')->with('channels')->with('chat_reference')->with(['feedback_reference' => function ($q) use($agent_id) { 
                if($agent_id) {
                    $q->Where('ori_helpdesk.created_by',$agent_id);
                }
        }])->where('status',config('constant.ACTIVE'))->where('cmpny_id', Auth::user()->cmpny_id);
        if(request('search_keywords')) 
        {
           $results->Where('fb_type',request('search_keywords'));
        }
        if(request('rating_id')) 
        {
           $results->Where('rating',request('rating_id'));
        } 

        $results   =   $results->paginate(config('constant.pagination_constant'));

        $html = view('feedback_survey.feedback.report_list')->with(compact('results','fb_type','query_type'))->render();
        $result_arr=array('success' => true,'html' => $html);
        return json_encode($result_arr);          
        

    }
     /*
    * Report popup view o feedback details
    * @author Reshma Rajan
    * @date 15/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Report list
    */
    function more_feedback_det(Request $request)
    {
   
    if(request('id') && request('type')){
        if(request('type') == config('constant.CH_CHAT'))
        {
           /* $details = fb_details::select('fb_details.comments','fb_details.rating','fb_details.reference_id','fb_details.id','cc_customer_profiles.first_name','cc_customer_profiles.middle_name','cc_customer_profiles.last_name','fb_details.created_at','cc_customer_profiles.middle_name','fb_details.fb_type')
      // ->leftjoin('cc_chat_thread', 'cc_chat_thread.id', '=', 'fb_details.reference_id')
           
        ->leftjoin('cc_customer_profiles', 'cc_customer_profiles.id', '=', 'fb_details.customer_id')
      
        ->where('fb_details.id',request('id'))->orderBy('id', 'desc')->first();*/
        }else{  

            $details=FeedbackDetail::with(['feedback_profile','feedback_reference','feedback_question','feedback_request'])->where('id',request('id'))->orderBy('id', 'desc')->first();
        }
        $channels=Channel::all();   
               return view('feedback_survey.feedback.fb_more_popup',compact('details','channels'));
    }
    }
     /*
    * Delete questions from feedback form
    * @author Reshma Rajan
    * @date 31/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Feedback form
    */
     public function delete_fb_question(Request $request)
    {
        if(request('rid') !=0)
        {
            $inactive_q=FeedbackQuestion::where('id',request('rid'))->update(['status'=>config('constant.INACTIVE')]);
            echo 'SUCCESS';
        }else{
            echo 'EMPTY';
        }
    }

     /*
    * Delete questions from feedback form
    * @author Reshma Rajan
    * @date 31/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Feedback form
    */
     public function export_fb_report(Request $request)
    {
       $file_name=request('file_name').str_random(5).'.xlsx';
        $path='/fb_report/'.$file_name;
        //(new UsersExport($request))->store($path.'.xlsx');
        
        //(new UsersExport)->queue('invoices.xlsx');
        $details=array('cmpny_id'=>Auth::user()->cmpny_id,'user_id'=>Auth::user()->id);
        if(request('rating_id'))
        {
            $details['rating_id']=request('rating_id');
        }
        if(request('agent_id'))
        {
            $details['agent_id']=request('agent_id');
        }
        if(request('search_keyword'))
        {
            $details['search_keyword']=request('search_keyword');
        }
        if(request('file_name'))
        {
            $details['path']=$path;
        }
        if(request('file_name'))
        {
            $details['file_name']=$file_name;
        }
      //  (new FbViewExport($details))->store($path.'.xlsx');
       // die;
        (new FbExport($details))->queue($path)->chain([
            new FbReportExportJob($details),
        ]);
        
    }
    function download_fbreport($path_name, $type = false)
    {
        if($type == 'attachments'){
            $path = storage_path('app/attachments/'.$path_name);
        }else{
            $path = storage_path('app/fb_report/'.$path_name);
        }
        return response()->download($path);

    }
   
	
}
