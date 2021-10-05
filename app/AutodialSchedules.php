<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class AutodialSchedules extends Model
{
	use SoftDeletes;
    protected $table = 'ori_autodial_schedules';
	protected $guarded = [];
    use UpdaterCompanyData;
}
