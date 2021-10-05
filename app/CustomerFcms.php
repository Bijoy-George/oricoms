<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class CustomerFcms extends Model
{
    use UpdaterCompanyData;
	use SoftDeletes;
    protected $table = 'ori_customer_fcms';
    protected $guarded = [];
}
