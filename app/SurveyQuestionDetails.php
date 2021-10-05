<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class SurveyQuestionDetails extends Model
{
    protected $table = 'ori_survey_question_details';
	protected $guarded = [];
	use SoftDeletes;
	public function survey_ques_ans()
	{
		 return $this->belongsTo('App\SurveyDetail', 'survey_det_id', 'id');
	}
	
   
}
