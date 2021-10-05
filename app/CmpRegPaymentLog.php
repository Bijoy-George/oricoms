<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class CmpRegPaymentLog extends Model
{
    protected $table = 'ori_cmp_reg_payments_log';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;
}
