<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\SurveyQuestionDetails;
use App\SurveyDetail;
use App\User;
use App\SurveyQuestion;
use App\Survey;
use App\CommonSmsEmail;
use App\LeadSources;
use DB;
use App\Campaign;
use App\CampaignBatch;
use App\Exports\SurveyExport;
use App\Exports\CustomerSurveyExport; 
use App\Helpers;
use App\CustomerProfileField; 
use Carbon\Carbon;
   /*
    * Question Controller
    * @author Reshma Rajan
    * @date 9/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['surveyform']);
        $this->middleware('check-permission:survey management',   ['only' => ['index','search_list']]);
        $this->middleware('check-permission:survey report',   ['only' => ['report_index','report_list','export_survey_report','more_survey_det']]);
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
        return view('feedback_survey.survey.index');
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
        $results = array(); 
        $results = Survey::with('survey_author')->where('status',config('constant.ACTIVE'))->orderBy('id', 'asc');        
        
        if(request('search_keywords')) 
            {
               $searchkey=request('search_keywords');
               $results->where(function($results) use ($searchkey){
               $results->orwhere('survey_name_lang1', 'like', '%' . request('search_keywords') . '%');
               $results->orwhere('survey_name_lang2', 'like', '%' . request('search_keywords') . '%');
               $results->orwhere('desc_lang1', 'like', '%' . request('search_keywords') . '%');
               $results->orwhere('desc_lang2', 'like', '%' . request('search_keywords') . '%');
                });
            }                 
        $results   =   $results->paginate(config('constant.pagination_constant'));
        $html = view('feedback_survey.survey.listview')->with(compact('results'))->render();
        
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
    public function create($sid=0)
    {   
        $survey_details=array();
        $eng_questions=Question::where('status',config('constant.ACTIVE'))->where('language_type',config('constant.LANG_ENG'))->where('survey',1)->get();
        $mala_questions=Question::where('status',config('constant.ACTIVE'))->where('language_type',config('constant.LANG_MALA'))->where('survey',1)->get();
        
        return view('feedback_survey.survey.create', compact('eng_questions','survey_details','mala_questions','sid'));
    }
    /*
    * Update Questions
    * @author Reshma Rajan
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Question dorm
    */
    public function edit($sid =0)
    {   
        
        if($sid !=0)
        {
            $survey_details=survey::with('question_ids')->where('id',$sid)->whereHas('question_ids', function($q) {
                
                    $q->Where('ori_survey_question_settings.status',config('constant.ACTIVE'));
            });
            $survey_details=$survey_details->first();
            $eng_questions=Question::where('status',config('constant.ACTIVE'))->where('language_type',config('constant.LANG_ENG'))->get();
            $mala_questions=Question::where('status',config('constant.ACTIVE'))->where('language_type',config('constant.LANG_MALA'))->get();
          
            return view('feedback_survey.survey.create', compact('eng_questions','survey_details','mala_questions','sid'));
        }

        
        
    }
    /*
    * Saving Survey
     * @author Reshma Rajan
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Question form */
    
    
    public function store(Request $request){
        $response = $request->all();
        
        if(request('is_english'))
        { 
        $this->validate($request,[
                'eng_sur_name' => 'required',
                
                ],[
                ],[
                'eng_sur_name.required' => ' Surve Name field is required.',
               
                ]);
        }
        if(request('is_malayalam'))
        { 
        $this->validate($request,[
                'mal_sur_name' => 'required',
                ],[
                'mal_sur_name.required' => 'Surve Name field is required.',
                ]);
        }
        $f_count=request('f_count');
        $f_count_mala=request('f_count_mala'); 
        $max_val=max($f_count,$f_count_mala);
        $eq_arr=$mq_arr=array();
        for($i=0;$i<$max_val;$i++)
        {
            if(request('eng_q'.$i) != 0){
                $eq_arr[]=request('eng_q'.$i);
            }
            if(request('mala_q'.$i) != 0){
                $mq_arr[]=request('mala_q'.$i);
            }
        }

        $is_english=0;
        $is_malayalam=0;
        $condition_arr=array();
        $update_arr=array();
         
           
        if(request('is_english'))
        {
            $is_english=request('is_english');
        }
        if(request('is_malayalam'))
        {
            $is_malayalam=request('is_malayalam');
        }
        if((count($eq_arr) == 0 && $is_english != 0) || ($is_malayalam != 0 && count($mq_arr) == 0)){
            $result_arr = array('success' => false,'message' => 'Please Specify Questions','reset'=>false);
                    echo json_encode($result_arr);die;
        }
        $expiry_date=NULL;

                if(request('expiry_date')){
                    $exp=request('expiry_date');
                    $date_format       =   explode('/', $exp);
                    
                     if(isset($date_format[2]) && !empty($date_format[2]) && isset($date_format[1]) && !empty($date_format[1]) && isset($date_format[0]) && !empty($date_format[0]))
                     {
                        $datevalue    =   $date_format[2].'-'.$date_format[1].'-'.$date_format[0];
                        $expiry_date     =   date('Y-m-d', strtotime($datevalue));
                        
                    }
                }
        $is_exist=Survey::where('cmpny_id',Auth::User()->cmpny_id);
            if(request('eng_sur_name') && request('is_english'))
            {
                $is_exist->where('survey_name_lang1',request('eng_sur_name'));
            }
            if(request('mal_sur_name') && request('is_malayalam'))
            {
                $is_exist->where('survey_name_lang2',request('mal_sur_name'));
            }
            
            if(request('sid'))
            {
                $is_exist->where('id','!=',request('sid'));
            }
            $survey_exist=$is_exist->count();

            if($survey_exist == 0)
            {
                if(!empty(request('sid')))
                {
                    $s_id=request('sid');
                }else{
                    $s_id=null;
                }
                
                //$expiry_date = (!empty(request('expiry_date'))? date('Y-m-d H:i', strtotime(request('expiry_date'))): NULL );
                $save_data=Survey::updateOrCreate(['id'=>request('sid')],[
                                    'cmpny_id'=>Auth::User()->cmpny_id,
                                    'survey_name_lang1'=>request('eng_sur_name'),
                                    'expiry_date'=>$expiry_date, 
                                    'survey_name_lang2'=>request('mal_sur_name'),
                                    'desc_lang1'=>request('eng_desc'),
                                    'desc_lang2'=>request('mala_desc'),
                                    'is_lang1'=>request('is_english'),
                                    'is_lang2'=>request('is_malayalam'),
                                    'status'=>config('constant.ACTIVE'),
                                    'updated_by'=> Auth::User()->id
                 ]);  
                 $sid=$save_data->id;   
                 
                    for($i=0;$i<$max_val;$i++)
                    {
                        $engquestions='eng_q'.$i;
                        $relation_id='relation_id'.$i;


                        if(isset($response[$engquestions]) && $response[$engquestions] !=0 && $is_english !=0){
                            $eng_qid=$response[$engquestions];
                        }else
                        {
                            $eng_qid=NULL;
                        }
                        
                        $malquestions='mala_q'.$i;
                        if(isset($response[$malquestions]) && $response[$malquestions] != 0 && $is_malayalam !=0){
                            $mala_qid=$response[$malquestions];
                        }else
                        {
                            $mala_qid=NULL;
                        }
                       
                        if(isset($response[$relation_id]) &&  !empty($relation_id)){ 

                             if($eng_qid != NULL || $mala_qid !=NULL){
                                $exist_engq=SurveyQuestion::where('qstn_id_lang1',$eng_qid)->where('survey_id',$sid)->where('status',config('constant.ACTIVE'))->where('id','!=',$response[$relation_id])->count();
                                $exist_malq=SurveyQuestion::where('qstn_id_lang2',$mala_qid)->where('survey_id',$sid)->where('status',config('constant.ACTIVE'))->where('id','!=',$response[$relation_id])->count();
                                if($exist_engq > 0)
                                {
                                    $eng_qid=NULL;
                                }
                                if($exist_malq > 0)
                                {
                                    $mala_qid=NULL;
                                }

                            $update_s=SurveyQuestion::updateOrCreate(
                                [
                                    'survey_id'=>$sid,
                                    'id'=>$response[$relation_id],
                                    'cmpny_id' => Auth::user()->cmpny_id,
                                ],[
                                
                                'qstn_id_lang1'=>$eng_qid,
                                'qstn_id_lang2'=>$mala_qid,
                                'created_by'=> Auth::User()->id,
                                'status'=>config('constant.ACTIVE')
                             ]);
                            $inactive_q=SurveyQuestion::where('survey_id',$sid)->where('qstn_id_lang1',NULL)->where('qstn_id_lang2',NULL)->update(['status'=>config('constant.INACTIVE')]);
                        }else{
                            $inactive_1=SurveyQuestion::where('survey_id',$sid)->where('id',$response[$relation_id])->update(['status'=>config('constant.INACTIVE')]);
                        }
                        }else{
                            

                            if($eng_qid != NULL || $mala_qid !=NULL){
                                $exist_engq=SurveyQuestion::where('qstn_id_lang1',$eng_qid)->where('survey_id',$sid)->where('status',config('constant.ACTIVE'))->count();
                                $exist_malq=SurveyQuestion::where('qstn_id_lang2',$mala_qid)->where('survey_id',$sid)->where('status',config('constant.ACTIVE'))->count();
                                if($exist_engq > 0)
                                {
                                    $eng_qid=NULL;
                                }
                                if($exist_malq > 0)
                                {
                                    $mala_qid=NULL;
                                }
                                    
                                $save_q_data=SurveyQuestion::Create([
                                        'survey_id'=>$sid,
                                        'cmpny_id' => Auth::user()->cmpny_id,
                                        'qstn_id_lang1'=>$eng_qid,
                                        'qstn_id_lang2'=>$mala_qid,
                                        'created_by'=> Auth::User()->id,
                                        'status'=>config('constant.ACTIVE')
                                     ]);
                                $inactive_q=SurveyQuestion::where('survey_id',$sid)->where('qstn_id_lang1',NULL)->where('qstn_id_lang2',NULL)->update(['status'=>config('constant.INACTIVE')]);    
                                
                            }
                        }
                    }

                    if($sid)
                    {
                        if(!empty(request('sid'))){
                        $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
                        echo json_encode($result_arr);
                        }else{
                            $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
                            echo json_encode($result_arr);
                        }
                   
                    }else{
                    $result_arr = array('success' => false,'message' => 'Something went wrong','reset'=>true);
                    echo json_encode($result_arr);
                    }
                   
            }else{
                 $result_arr = array('success' => false,'message' => 'Survey Already Exist','reset'=>false);
                echo json_encode($result_arr);
            }        
                
            
            
    }
    /*
    * Getting  more questions
     * @author Reshma Rajan
    * @date 09/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Survey form */
    public function add_more_questions(Request $request)
    {
        $response = $request->all();
        $i=$response['i'];
        $type=$response['type'];
        $questions=Question::where('status',config('constant.ACTIVE'));
        if($type == config('constant.LANG_ENG')){
            $questions->where('language_type',config('constant.LANG_ENG'));
            $q_det=$questions->get();
            return view('feedback_survey.survey.add_more_questions', compact('i','q_det'));
         }
         if($type == config('constant.LANG_MALA')){
            $questions->where('language_type',config('constant.LANG_MALA'));
             $q_det=$questions->get();
            return view('feedback_survey.survey.add_more_questions_mala', compact('i','q_det'));
         }
     }
     /*
    * To submit Survey Form for customers 
    * @author Reshma Rajan
    * @date 09/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Survey form */
     function surveyform($randomstr='')
     {
        
       /* $randomcode='12345';
        $surveyid='19';
        $langtype='1';*/
        $surv_page='';
        $decoded_str = base64_decode( urldecode($randomstr));
        $str = explode('_', $decoded_str);
        //print_r($str);die;
        if(isset($str[0]) && !empty($str[0])){
            $randomcode=$str[0];
        }
        if(isset($str[1]) && !empty($str[1])){
            $surveyid=$str[1];
        }
        if(isset($str[2]) && !empty($str[2])){
            $langtype=$str[2];
        }
     
        if(!empty($randomcode) && !empty($surveyid) && !empty($langtype))
        {
            $survey_det=CommonSmsEmail::where('random_code',$randomcode)->first();

            if($survey_det)
            {
                 $common_id=$survey_det->id;
                 $company_id=$survey_det->cmpny_id;
                 $surv_exist=0;//SurveyDetail::where('common_id',$common_id)->count();  
                if($langtype == config('constant.LANG_ENG')){
                    $survey_qstn=surveyQuestion::with('survey_eng_qstn')->where('survey_id',$surveyid)->where('status',config('constant.ACTIVE'))->get();
                  
                   // if($survey_qstn[0]['survey_eng_qstn']['questions']){
                     $surv_page='feedback_survey.survey.api_survey';
                  //  }

                    
                }
                if($langtype == config('constant.LANG_MALA')){
                    $survey_qstn=surveyQuestion::with('survey_mal_qstn')->where('survey_id',$surveyid)->where('status',config('constant.ACTIVE'))->get();;
                   // if($survey_qstn[0]['survey_mal_qstn']['questions']){
                    $surv_page='feedback_survey.survey.api_survey_language2';
                  //  }
                    
                }
              
                $auth=LeadSources::where('cmpny_id',$company_id)
                    ->where('status',config('constant.ACTIVE'))->first();
                $authentication=$auth->source_key;
                $check_expiry=survey::where('id',$surveyid)->where(function($q){
                       $q->orwhere('expiry_date', '>',Carbon::now());
                       $q->orwhere('expiry_date','');
                       $q->orwhereNull('expiry_date');
                       
                       })->count();
                //print_r($survey_qstn[0]['survey_eng_qstn']);die;
                if($surv_page){
                   return view($surv_page,compact('check_expiry','survey_det','surveyid','langtype','surv_exist','survey_qstn','authentication')); 
                }
                
            }
                
        }
     }

      /*
    * Getting Survey Report
    * @author Reshma Rajan
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Report page
    */
    public function report_index()
    { 
        $campaign=CampaignBatch::with('campaign_det')->where('status',config('constant.ACTIVE'))->whereNotNull('survey_id')->groupBy('campaign_id')->get();
        return view('feedback_survey.survey.report_index',compact('campaign'));
    }

    /*
    * Report listing view with filters
    * @author Reshma Rajan
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Report list
    */
    public function report_list(Request $request)
    {
        $response           =   $request->all();
        $campaign=request('campaign');
        $batch_id=request('batch_id');
        $results = CampaignBatch::select('survey_id','campaign_id','id','created_at','survey_id',DB::raw('SUM(processed_count) as process_count'))->with('survey_mast')->with(['survey_det' => function ($q) use($campaign,$batch_id) { $q->where('status',config('constant.ACTIVE'));
            if($campaign)
            {
                $q->where('campaign_id',$campaign);
            }
            if($batch_id)
            {
                $q->where('batch_id',$batch_id);
            }    



         }])->where('status',config('constant.ACTIVE'))->whereNotNull('survey_id');
        if(request('campaign'))
        {
            $results->where('campaign_id',request('campaign'));
        }
        if(request('batch_id'))
        {
            $results->where('id',request('batch_id'));
        }
        /*if(request('startdate') &&  request('enddate')){
        $start_date=request('startdate');
        $end_date=request('enddate');     
        $s_date       =   explode('/', $start_date);
        //print_r($s_date);
        if(isset($s_date[2]) && !empty($s_date[2]) && isset($s_date[1]) && !empty($s_date[1]) && isset($s_date[0]) && !empty($s_date[0]) )
        {
        $start_date    =   $s_date[2].'-'.$s_date[1].'-'.$s_date[0];
        $start_date     =   date('Y-m-d', strtotime($start_date));
        }
        $e_date       =   explode('/', $end_date);
        
        if(isset($e_date[2]) && !empty($e_date[2]) && isset($e_date[1]) && !empty($e_date[1]) && isset($e_date[0]) && !empty($e_date[0]) )
        {
        $end_date    =   $e_date[2].'-'.$e_date[1].'-'.$e_date[0];
        $end_date     =   date('Y-m-d', strtotime($end_date));
        }
        $end_date     =   date('Y-m-d', strtotime($end_date));
        $results->where('created_at', '>=', $start_date.' 00:00:00')
        ->where('created_at', '<=', $end_date.' 23:59:59');
       }*/
        $results=$results->groupBy('survey_id')->paginate(config('constant.pagination_constant'));
        
        $html = view('feedback_survey.survey.report_list')->with(compact('results'))->render();
        $result_arr=array('success' => true,'html' => $html);
        return json_encode($result_arr);        
        

    }

     /*
    * Report listing view with filters
    * @author Reshma Rajan
    * @date 14/11/2018
    * @since version 1.0.0
    * @param NULL
    * @return Report list
    */
    public function more_survey_det($batch_id,$start_date,$end_date,$camp_id,$process_count,$response_count,$survey_id='')
    {
       
        if($survey_id)
        {
            $survey_qstn=surveyQuestion::with(['eng_options','survey_mal_qstn','survey_eng_qstn'])->where('survey_id',$survey_id)->where('status',config('constant.ACTIVE'))->get();
            $survey_details=SurveyDetail::with(['question_answers'=> function ($q) {
                    $q->select('id','survey_det_id','relation_id','question_id','answer',DB::raw('count(answer) as option_count'))->groupBy('question_id')->groupBy('answer'); 
                  }])->where('survey_id',$survey_id)->where('status',config('constant.ACTIVE'));
            if(!empty($batch_id))
                    {
                        $survey_details->where('batch_id',$batch_id);
                    }
                    if(!empty($camp_id))
                    {
                        $survey_details->where('campaign_id',$camp_id);
                    }    

           /* $survey_details=SurveyQuestionDetails::select('id','survey_det_id','relation_id','question_id','answer',DB::raw('count(answer) as option_count'))->with(['survey_ques_ans' => function ($q) use($survey_id,$batch_id,$camp_id) {
                    $q->where('survey_id1',$survey_id)->where('status',config('constant.ACTIVE')); 
                    if(!empty($batch_id))
                    {
                        $q->where('batch_id',$batch_id);
                    }
                    if(!empty($camp_id))
                    {
                        $q->where('campaign_id',$camp_id);
                    }*/
                    
                    /*if(!empty($start_date) &&  !empty($end_date)){
                    $s_date       =   explode('/', $start_date);
                    //print_r($s_date);
                    if(isset($s_date[2]) && !empty($s_date[2]) && isset($s_date[1]) && !empty($s_date[1]) && isset($s_date[0]) && !empty($s_date[0]) )
                    {
                    $start_date    =   $s_date[2].'-'.$s_date[1].'-'.$s_date[0];
                    $start_date     =   date('Y-m-d', strtotime($start_date));
                    }
                    $e_date       =   explode('/', $end_date);
                    
                    if(isset($e_date[2]) && !empty($e_date[2]) && isset($e_date[1]) && !empty($e_date[1]) && isset($e_date[0]) && !empty($e_date[0]) )
                    {
                    $end_date    =   $e_date[2].'-'.$e_date[1].'-'.$e_date[0];
                    $end_date     =   date('Y-m-d', strtotime($end_date));
                    }
                    $end_date     =   date('Y-m-d', strtotime($end_date));
                    $results->where('created_at', '>=', $start_date.' 00:00:00')
                    ->where('created_at', '<=', $end_date.' 23:59:59');
                   }*/

                 /* }])->groupBy('question_id')->groupBy('answer')->get();*/
            $survey_details=$survey_details->get();
            $option_arr=array();
            
            foreach ($survey_details as $values) {
                foreach($values['question_answers'] as $val){
                 $survey_det_id=$val->survey_det_id;
                  $question_id=$val->relation_id;
                  $answer=$val->answer;
                 $option_count=$val->option_count;
                 $option_arr[$question_id][$answer]=$option_count;
                } 
              }

            return view('feedback_survey.survey.more_popup',compact('survey_qstn','option_arr'));
           /* $survey_qstn=surveyQuestion::with(['survey_mal_qstn','survey_eng_qstn'])->where('survey_id',$survey_id)->where('status',config('constant.ACTIVE'))->get();
            $survey_details=SurveyDetail::with(['customers','question_answers'])->where('status',config('constant.ACTIVE'))->get();
            $question_mast=Question::where('status',config('constant.ACTIVE'))->get();
            $qmast_arr=array();
            foreach ($question_mast as $key => $value) {
                $qmast_arr[$value->id]['option1']=$value->option1;
                $qmast_arr[$value->id]['option2']=$value->option2;
                $qmast_arr[$value->id]['option3']=$value->option3;
                $qmast_arr[$value->id]['option4']=$value->option4;
                $qmast_arr[$value->id]['option5']=$value->option5;
                $qmast_arr[$value->id]['option6']=$value->option6;
            }
            $default_field = CustomerProfileField::CurrentFields(config('constant.DEFAULT_FEILD'));  
           
            return view('feedback_survey.survey.more_popup',compact('survey_qstn','survey_details','question_mast','qmast_arr','default_field'));*/
        }
    }

    function export_survey_report(Request $request)
    {
        if(request('survey_id'))
        {
        $file_name='survey_report'.str_random(5);
        $path='/survey_report/'.$file_name;
        
        $details=array('cmpny_id'=>Auth::user()->cmpny_id,'userid'=>Auth::user()->id,'path'=>$path,'survey_id'=>request('survey_id'));
        if(request('batch_id'))
        {
            $details['batch_id']=request('batch_id');
        }
        if(request('campaign'))
        {
            $details['campaign']=request('campaign');
        }
       /* if(request('startdate'))
        {
            $details['startdate']=request('startdate');
        }
        if(request('enddate'))
        {
            $details['enddate']=request('enddate');
        }*/
       
        
        if(request('process_count'))
        {
            $details['process_count']=request('process_count');
        }
        if(request('response_count'))
        {
            $details['response_count']=request('response_count');
        }
        
        (new SurveyExport($details))->store($path.'.xlsx');
        $comment= 'Please use the below link to download Survey Report';
        
        $link=url('/download_report/'.$file_name.'.xlsx');
        
        Helpers::add_notifications(Auth::user()->id,'Survey Report has been completed',$comment,$link,Auth::user()->id,1);
        
        }
    }
    function download_report($path_name)
    {
       $path = storage_path('app/survey_report/'.$path_name);
       return response()->download($path);
    }
    function survey_customer_report(Request $request)
    {
        if(request('survey_id'))
        {
        $file_name='customer_survey_report'.str_random(5);
        $path='/survey_report/'.$file_name;
        
        $details=array('cmpny_id'=>Auth::user()->cmpny_id,'userid'=>Auth::user()->id,'path'=>$path,'survey_id'=>request('survey_id'));
        if(request('batch_id'))
        {
            $details['batch_id']=request('batch_id');
        }
        if(request('campaign'))
        {
            $details['campaign']=request('campaign');
        }
      /*  if(request('startdate'))
        {
            $details['startdate']=request('startdate');
        }
        if(request('enddate'))
        {
            $details['enddate']=request('enddate');
        }*/
       
        
        if(request('process_count'))
        {
            $details['process_count']=request('process_count');
        }
        if(request('response_count'))
        {
            $details['response_count']=request('response_count');
        }
        
        (new CustomerSurveyExport($details))->store($path.'.xlsx');
        $comment= 'Please use the below link to download Survey Report1';
        
        $link=url('/download_survey_report2/'.$file_name.'.xlsx');
        
        Helpers::add_notifications(Auth::user()->id,'Survey Report has been completed',$comment,$link,Auth::user()->id,1);
        
        }
    }

    function get_campaign_batch(Request $request)
    {
       if(request('campaign'))
       {
        $result=CampaignBatch::where('campaign_id',request('campaign'))->get();
        return json_encode($result);
       }
    }

    function download_survey_report2($path_name)
    {
       $path = storage_path('app/survey_report/'.$path_name);
       return response()->download($path);
    } 
    
	
}
