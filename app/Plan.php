<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use SoftDeletes;
	use Updater;
    protected $table = 'ori_mast_plans';
	protected $guarded = [];
	public function GetPlanDuration()
	{
		return $this->hasMany('App\PlanDuration', 'plan_id', 'id');
	}
}
