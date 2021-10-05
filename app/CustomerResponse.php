<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerResponse extends Model
{
    use SoftDeletes;
    protected $table = 'ori_mast_customer_response';
	protected $guarded = [];
	use UpdaterCompanyData;

	public function parent()
	{
		return $this->belongsTo(CustomerResponse::class);
	}
}
