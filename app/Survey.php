<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'ori_survey_settings';
	protected $guarded = [];

	use SoftDeletes;
	use UpdaterCompanyData;

	public function survey_author()
	{
		 return $this->belongsTo('App\User', 'created_by', 'id');
	}
	public function question_ids()
	{
		 return $this->hasMany('App\SurveyQuestion', 'survey_id', 'id')->where('status',config('constant.ACTIVE'));
	}
	
   
}
