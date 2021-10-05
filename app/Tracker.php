<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use SoftDeletes;
    protected $table = 'ori_tracker';
	protected $guarded = [];
	use UpdaterCompanyData;

	public function task()
    {
        return $this->belongsTo('App\ProjectTask','task_id','id');
    }
}