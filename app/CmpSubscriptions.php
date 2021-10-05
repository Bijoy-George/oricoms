<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CmpSubscriptions extends Model
{
    protected $table = 'ori_company_subscriptions';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;
}
