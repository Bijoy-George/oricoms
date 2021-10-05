<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'ori_services';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;
}
