<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class PmMaster extends Model
{
    use SoftDeletes;
    protected $table = 'ori_pm_master';
	protected $guarded = [];
	use UpdaterCompanyData;
}