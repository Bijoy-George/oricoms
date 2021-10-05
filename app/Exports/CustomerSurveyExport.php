<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\SurveyQuestionDetails;
use App\SurveyQuestion;
use App\SurveyDetail; 
use App\Question;
use Illuminate\Contracts\View\View; 
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use App\CustomerProfileField;
class CustomerSurveyExport implements FromView
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
        $survey_details=SurveyDetail::with(['customers','question_answers'])->where('status',config('constant.ACTIVE'))->where('survey_id',$survey_id);
         
            if(isset($filter_val['batch_id']) && !empty($filter_val['batch_id']))
            {
                $survey_details->where('batch_id',$filter_val['batch_id']);
            }
            if(isset($filter_val['campaign']) && !empty($filter_val['campaign']))
            {
                $survey_details->where('campaign_id',$filter_val['campaign']);
            }
           
           /* if(isset($filter_val['startdate']) && !empty($filter_val['startdate']) && isset($filter_val['enddate']) && !empty($filter_val['enddate'])){
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
            $survey_details->where('created_at', '>=', $start_date.' 00:00:00')
            ->where('created_at', '<=', $end_date.' 23:59:59');
           }*/

          $survey_details=$survey_details->get();
          
          $survey_qstn=surveyQuestion::with(['survey_mal_qstn','survey_eng_qstn'])->where('survey_id',$survey_id)->where('status',config('constant.ACTIVE'))->get();
            
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
        return view('exports.customersurveyexport', [
            'survey_details' => $survey_details,
            'qmast_arr' => $qmast_arr,
            'survey_qstn' => $survey_qstn,
            'default_field'=>$default_field,
        ]);
    }
}
