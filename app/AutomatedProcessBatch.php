<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class AutomatedProcessBatch extends Model
{
	use SoftDeletes;
    protected $table = 'ori_automated_process_batch';
	protected $guarded = [];
    use UpdaterCompanyData;
}
