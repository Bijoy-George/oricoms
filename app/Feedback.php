<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'ori_fb_settings';
	protected $guarded = [];
	use SoftDeletes;
	use Updater;
	
   
}
