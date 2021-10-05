<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class AutomatedProcessStages extends Model
{
	use SoftDeletes;
    protected $table = 'ori_automated_process_stages';
	protected $guarded = [];
    use UpdaterCompanyData;
}
