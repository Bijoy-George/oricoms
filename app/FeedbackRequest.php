<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class FeedbackRequest extends Model
{
        protected $table = 'ori_fb_feedback_request';
	protected $guarded = [];
	use SoftDeletes;
	

   
}
