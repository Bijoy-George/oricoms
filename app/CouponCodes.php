<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CouponCodes extends Model
{
    protected $table = 'ori_mast_coupon_codes';
	protected $guarded = [];
	use SoftDeletes;
	use Updater;
}
