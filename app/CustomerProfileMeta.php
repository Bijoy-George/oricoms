<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerProfileMeta extends Model
{
   use UpdaterCompanyData;
   protected $table = 'ori_customer_profile_meta';
   protected $guarded = [];
   public function profile()
    {
        return $this->belongsTo('App\CustomerProfile', 'id', 'user_id');
    }
    public function ProfileOptions()
	{
		return $this->belongsTo('App\FieldOptions', 'value', 'id');
	}
}
