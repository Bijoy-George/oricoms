<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class LocationSettings extends Model
{
    protected $table = 'ori_location_settings';
	protected $guarded = [];

	use SoftDeletes;
	use Updater;

	
	
   
}
