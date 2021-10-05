<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class CustomerNature extends Model
{
    use SoftDeletes;
    protected $table = 'ori_mast_customer_nature';
	protected $guarded = [];
	use UpdaterCompanyData;
}
