<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class AutomatedProcessBatchExpiryCustomer extends Model
{
	use SoftDeletes;
    protected $table = 'ori_automated_process_batch_expiry_customer';
	protected $guarded = [];
    use UpdaterCompanyData;
}
