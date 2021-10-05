<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerProfileLog extends Model
{
    use UpdaterCompanyData;
    protected $table = 'ori_customer_profile_log';
	protected $guarded = [];

   
}
