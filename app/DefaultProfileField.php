<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class DefaultProfileField extends Model
{
   protected $table = 'ori_default_profile_fields';

   protected $guarded = [];

   public function def_profile_fields()
   {
   	return $this->hasOne('App\CustomerProfileField', 'field_id', 'id')->where('ori_customer_profile_fields.cmpny_id',Auth::User()->cmpny_id); 
   }

}
