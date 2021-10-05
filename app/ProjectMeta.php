<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class ProjectMeta extends Model
{
    //use SoftDeletes;
    protected $table = 'ori_project_meta';
	protected $guarded = [];
	use UpdaterCompanyData;
}