<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class SurveyDetail extends Model
{
    protected $table = 'ori_survey_details';
	protected $guarded = [];
	use SoftDeletes;
	public function survey_details()
	{
		 return $this->belongsTo('App\Survey', 'survey_id', 'id');
	}
	public function customers()
	{
		 return $this->belongsTo('App\CustomerProfile', 'customer_id', 'id');
	}
	public function question_answers()
	{
		 return $this->hasMany('App\SurveyQuestionDetails', 'survey_det_id', 'id');
	}
	

	
   
}
