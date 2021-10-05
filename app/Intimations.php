<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class Intimations extends Model
{
	use SoftDeletes;
    protected $table = 'ori_intimations';
	protected $guarded = [];
    use UpdaterCompanyData;
}
