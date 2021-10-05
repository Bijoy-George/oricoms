<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class PlanDuration extends Model
{
    use SoftDeletes;
	use Updater;
    protected $table = 'ori_mast_plans_duration';
	protected $guarded = [];
	public function GetParentPlan() 
	{
		return $this->belongsTo('App\Plan','plan_id', 'id');
	}
}
