<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class FeedbackDetailLog extends Model
{
        protected $table = 'ori_fb_details_log';
	protected $guarded = [];
	use SoftDeletes;
	

   
}
