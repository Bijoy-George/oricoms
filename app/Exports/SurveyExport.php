<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\SurveyQuestionDetails;
use App\SurveyQuestion;
use Illuminate\Contracts\View\View; 
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use App\SurveyDetail;
class SurveyExport implements FromView
{
	use Exportable;
    private $search_value;
    public function __construct($details) {
        $this->search_value = $details;
    }

    public function view(): View
    {
        $filter_val=$this->search_value;
        $survey_id=$filter_val['survey_id'];
        $survey_qstn=SurveyQuestion::with(['eng_options','survey_mal_qstn','survey_eng_qstn'])->where('survey_id',$survey_id)->where('status',config('constant.ACTIVE'))->get();
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
        $survey_details=$survey_details->get();
       /* $survey_details=SurveyQuestionDetails::select('id','question_id','answer','relation_id',DB::raw('count(answer) as option_count'))->with(['survey_ques_ans' => function ($q) use($survey_id) {
            $q->where('survey_id',$survey_id)->where('status',config('constant.ACTIVE')); 
            if(isset($filter_val['batch_id']) && !empty($filter_val['batch_id']))
            {
                $q->where('batch_id',$filter_val['batch_id']);
            }
            if(isset($filter_val['campaign']) && !empty($filter_val['campaign']))
            {
                $q->where('campaign_id',$filter_val['campaign']);
            }*/
           
            /*if(isset($filter_val['startdate']) && !empty($filter_val['startdate']) && isset($filter_val['enddate']) && !empty($filter_val['enddate'])){
            $start_date= $filter_val['startdate']; 
            $end_date= $filter_val['enddate'];    
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
            $q->where('created_at', '>=', $start_date.' 00:00:00')
            ->where('created_at', '<=', $end_date.' 23:59:59');
           }*/

         /* }])->groupBy('question_id')->groupBy('answer')->get();*/
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
        return view('exports.surveyexport', [
            'survey_qstn' => $survey_qstn,
            'option_arr' => $option_arr,
        ]);
    }
}
