<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SupplyOffices extends Model
{
	use SoftDeletes;
	use UpdaterCompanyData;
    protected $table = 'ori_mast_supply_offices';
	protected $guarded = [];
	
	public function GetSubCategory() 
	{
    	return $this->hasMany('App\SupplyOffices','parent_id');
	} 
	public function GetParent() 
	{
		return $this->belongsTo('App\SupplyOffices','parent_id', 'id');
	}	
}
