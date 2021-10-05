<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    protected $table = 'ori_survey_question_settings';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;
	public function survey_eng_qstn()
	{
		return $this->belongsTo('App\Question', 'qstn_id_lang1', 'id');
		 
	}
	public function survey_mal_qstn()
	{
		 return $this->belongsTo('App\Question', 'qstn_id_lang2', 'id');
	}
	public function eng_options()
	{
		return $this->hasManyThrough(
            'App\SurveyQuestionDetails',  // user
            'App\SurveyDetail', // hepldesk
            'survey_id', // Helpdesk/id
            'survey_det_id', // oriuser/id
            'survey_id', // feedback_details/reference_id
            'id' // helpdesk/creted_by
        );
		
		 
	}
	
	public function survey_questions()
	{
		return $this->belongsTo('App\Survey', 'survey_id');
		 
	}
	
   
}
