<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_log extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
	 protected $table = 'ori_user_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id','related_to','ipaddress','location','message','created_at','updated_at'
	];

    
}
