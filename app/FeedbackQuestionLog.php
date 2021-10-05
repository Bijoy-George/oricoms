<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class FeedbackQuestionLog extends Model
{
        protected $table = 'ori_fb_question_details_log';
	protected $guarded = [];
	use SoftDeletes;
	

   
}
