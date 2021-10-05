<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class LocalBodyType extends Model
{
    protected $table = 'ori_localbodytype';
	protected $guarded = [];

	use SoftDeletes;
	use Updater;

	
	
   
}
