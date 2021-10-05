<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class AutomatedProcessLog extends Model
{
	use SoftDeletes;
    protected $table = 'ori_automated_process_log';
	protected $guarded = [];
    use UpdaterCompanyData;
}
