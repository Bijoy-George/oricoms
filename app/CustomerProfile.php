<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerProfile extends Model
{
    use UpdaterCompanyData;
	use SoftDeletes;
    protected $table = 'ori_customer_profiles';
	protected $guarded = [];
	public function profile_details()
    {
        return $this->hasMany('App\CustomerProfileMeta', 'user_id', 'id');
    }

    public function groups()
    {
        return $this->morphToMany('App\Group', 'contact');
    }
     public function GetProfileAttachment()
    {
        return $this->hasMany('App\Attachment', 'attachable_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo('App\CompanyProfile','cmpny_id');
    }
    public function GetLeadSource()
    {
        return $this->belongsTo('App\LeadSources', 'source', 'id');
    }

    public function getCountry()
    {
        return $this->belongsTo('App\LocationSettings', 'country_id', 'id');
    }

    public function getState()
    {
        return $this->belongsTo('App\LocationSettings', 'state_id', 'id');
    }

    public function getDistrict()
    {
        return $this->belongsTo('App\LocationSettings', 'district_id', 'id');
    }

    public function GetCreator()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function GetHelpdesk()
    {
        return $this->hasMany('App\Helpdesk', 'customer_id');
    }

    public function GetLatestHelpdesk()
    {
        return $this->hasOne('App\Helpdesk', 'customer_id')->latest();
    }
   
}
