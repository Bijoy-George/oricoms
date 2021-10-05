<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class CmpRegPayment extends Model
{
    protected $table = 'ori_cmp_reg_payments';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;
	
}
