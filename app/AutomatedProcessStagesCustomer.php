<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class AutomatedProcessStagesCustomer extends Model
{
	use SoftDeletes;
    protected $table = 'ori_automated_process_stages_customer';
	protected $guarded = [];
    use UpdaterCompanyData;
}
