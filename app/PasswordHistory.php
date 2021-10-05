<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
	 protected $table = 'ori_password_histories';
     protected $guarded = [];
 
    public function post()
    {
        return $this->belongsTo('App\User');
    }
}
