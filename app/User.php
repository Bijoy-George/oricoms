<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes; 

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'ori_users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','cmpny_id','username','access_permission', 'email','cc_emails','phone','chat_name','address','password','role_id','status','updated_at','session_id','logged_in','last_logged_in_at','deleted_at','country_id','state_id','district_id','local_body_type','corporation_id','muncipality_id','panchayath_type','district_panchayath_id','block_panchayath_id','grama_panchayath_id','panchayath_id','taluk_id','village_id','chat_flag','current_chat_count','department','designation','agent_number'
    ];
	//protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
	public function passwordHistories()
    {
        return $this->hasMany('App\PasswordHistory');
    }
	public function passwordSecurity()
    {
        return $this->hasOne('App\PasswordSecurity');
    }
    public function getCompany()
	{
		return $this->hasOne('App\CompanyProfile', 'id', 'cmpny_id');
	}
	public function getDepartment() 
	{
		return $this->belongsTo('App\FaqCategories','department', 'id');
	}
	public function getDesignation() 
	{
		return $this->belongsTo('App\Designations','designation', 'id');
	}
}
