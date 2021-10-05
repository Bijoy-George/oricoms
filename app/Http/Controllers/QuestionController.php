<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\FeedbackQuestion;
use App\SurveyQuestion;

   /*
    * Question Controller
    * @author Reshma Rajan
    * @date 9/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return
    */
class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        return view('feedback_survey.question.index');
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
        $search_keywords    =   $response['search_keywords'];
        $results = array(); 
        $results = Question::where('cmpny_id',Auth::user()->cmpny_id)->orderBy('id', 'asc');        
        if(isset($search_keywords) && !empty($search_keywords))
        {
            $results->where(function ($results) use ($search_keywords) {
                
                $results->orWhere('questions', 'like', '%' . $search_keywords . '%');
        
            });                 
        }
                        
        $results   =   $results->paginate(config('constant.pagination_constant'));
                     
        $html = view('feedback_survey.question.listview')->with(compact('results'))->render();
        
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
        $exist_flag=0;
        return view('feedback_survey.question.create', compact('exist_flag'));
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
        $res = Question::select('id','questions','option1','option1','option2','option3','option4', 'option5', 'option6','language_type','survey','feedback','status')
                ->where('id',$id)
                ->first();
        $exist_flag=0;
        $feedback_count=FeedbackQuestion::where('status',config('constant.ACTIVE'));
         $feedback_count->where(function($feedback_count) use ($id){
               $feedback_count->orwhere('eng_qstn_id',$id);
               $feedback_count->orwhere('mal_qstn_id',$id);
               
                });
         $feedback_count=$feedback_count->count();    
        $survey_count=SurveyQuestion::where('status',config('constant.ACTIVE'));
         $survey_count->where(function($survey_count) use ($id){
               $survey_count->orwhere('qstn_id_lang1',$id);
               $survey_count->orwhere('qstn_id_lang2',$id);
               
                });
         $survey_count=$survey_count->count();  
       
        if($feedback_count > 0 || $survey_count >0)
        {
            $exist_flag=1;
        }    
        return view('feedback_survey.question.create', compact('id','res','exist_flag'));
        
    }
    /*
    * Saving Questions
     * @author Reshma Rajan
    * @date 09/10/2018
    * @since version 1.0.0
    * @param NULL
    * @return Question form */
    
    
    public function store(Request $request){
        
        
         $category=array();
         $cmpny_id = Auth::user()->cmpny_id; 
         $this->validate($request,[
                'questions' => 'required',
                'questions' => 'unique:ori_questions,questions,'.request('id').',id,cmpny_id,'.$cmpny_id
                ],[
                'questions.required' => ' The Question field is required.',
                'questions.unique' => 'Question Already Exist.',
                ]);
        $duplication_arr=array();
        if(request('option1') !='')
            {
                $duplication_arr['option1']=request('option1');
            }
        if(request('option2') !='')
            {
                $duplication_arr['option2']=request('option2');
            }
        if(request('option3') !='')
            {
                $duplication_arr['option3']=request('option3');
            }
        if(request('option4') !='')
            {
                $duplication_arr['option4']=request('option4');
            }
        if(request('option5') !='')
            {
                $duplication_arr['option5']=request('option5');
            }
        if(request('option6') !='')
            {
                $duplication_arr['option6']=request('option6');
            }
        
        $unique_arr = array_unique($duplication_arr);
        if(count($duplication_arr) != count($unique_arr))
        {
            $result_arr = array('reset'=>false,'success' => true,'message' => 'Entering Duplicate Options');
            echo json_encode($result_arr);die;
        }else{
            $res = Question::updateOrCreate(['id' => request('id')],
                                    [
                                        'cmpny_id' => Auth::user()->cmpny_id,
                                        'questions' => request('questions'),
                                        'option1' => request('option1'),
                                        'option2' => request('option2'),
                                        'option3' => request('option3'),
                                        'option4' => request('option4'),
                                        'option5' => request('option5'),
                                        'option6' => request('option6'),
                                        'language_type' => request('language_type'),
                                        'status' => request('status'),
                                        'survey' => request('survey'),
                                        'feedback' => request('feedback'),
                                        
                                        
                                    ]);
            if(!empty($res)){
                if(!empty(request('id'))){
                    $result_arr=array('reset'=>false,'success' => true,'message' => 'Successfuly updated');
                }else{
                    $result_arr=array('reset'=>true,'success' => true,'message' => 'Successfuly added');
                }
            }else{
                    $result_arr=array('reset'=>false,'success' => false,'message' => 'Something went wrong');
            }
            return $result_arr;    
            /*$result_arr = array('reset'=>true,'success' => true,'message' => 'Successfuly updated');
            echo json_encode($result_arr);*/
        }
            
            
    }
    
	
}
