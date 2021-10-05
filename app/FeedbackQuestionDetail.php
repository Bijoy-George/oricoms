<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class FeedbackQuestionDetail extends Model
{
    protected $table = 'ori_fb_question_details';
	protected $guarded = [];
	use SoftDeletes;
	

   
}
