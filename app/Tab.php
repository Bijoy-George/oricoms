<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
    protected $table = 'ori_tabs';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;
	
	public function profile_fields()
	{
		 return $this->hasMany('App\CustomerProfileField', 'tab_id', 'id')->where('status',config('constant.ACTIVE'))->where('type','!=',4)->orderBy(DB::raw('sort_order IS NULL'))->orderBy('sort_order','asc')->orderBy('id','asc');
	}  
   
}
