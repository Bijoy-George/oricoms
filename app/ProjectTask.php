<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use SoftDeletes;
    protected $table = 'ori_project_tasks';
	protected $guarded = [];
	use UpdaterCompanyData;

	public function project()
    {
        return $this->belongsTo('App\Project','project_id','id');
    }
}