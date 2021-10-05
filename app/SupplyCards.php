<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SupplyCards extends Model
{
	use SoftDeletes;
	use UpdaterCompanyData;
    protected $table = 'ori_mast_supply_cards';
	protected $guarded = [];
	
		
}
