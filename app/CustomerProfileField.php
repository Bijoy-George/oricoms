<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class CustomerProfileField extends Model
{
   protected $table = 'ori_customer_profile_fields';
   protected $guarded = [];
   use UpdaterCompanyData;
   public static function CurrentFields($type='')
	{

	    $results=self::where(['status'=>config('constant.ACTIVE')]);
	    if($type !='')
	    {
	    	$results->where('type',$type);
	    }
	    return $results->orderBy('sort_order','asc')->get();
	}
	public function GetFieldType()
	{
		return $this->belongsTo('App\FieldType', 'field_type', 'id');
	}

	public function GetOptions()
	{
		return $this->hasMany('App\FieldOptions', 'field_id', 'id')->where('status',config('constant.ACTIVE'));
	}

	
	
}
