<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class AutomatedProcessCustomer extends Model
{
	use SoftDeletes;
    protected $table = 'ori_automated_process_customer';
	protected $guarded = [];
    use UpdaterCompanyData;
}
