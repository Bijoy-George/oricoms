<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use SoftDeletes;
    protected $table = 'ori_projects';
	protected $guarded = [];
	use UpdaterCompanyData;
	public function tasks()
	{
		return $this->hasMany('App\ProjectTask');
	}
}
