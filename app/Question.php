<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'ori_questions';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;

   
}
