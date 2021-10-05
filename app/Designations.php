<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Designations extends Model
{
    protected $table = 'ori_mast_designations';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;
}
