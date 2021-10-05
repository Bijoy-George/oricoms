<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class LocalBody extends Model
{
    protected $table = 'ori_localbody';
	protected $guarded = [];

	use SoftDeletes;
	use Updater;

	
	
   
}
