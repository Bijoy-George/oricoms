<?php

namespace App;

use App\CustomerProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupContact extends Model
{
    use UpdaterCompanyData, SoftDeletes;
	
    protected $table = 'ori_group_contacts';
    protected $guarded = [];

    public function contact()
    {
    	if ($this->contact_type == CustomerProfile::class)
    	{
    		return $this->belongsTo(CustomerProfile::class, 'contact_id');
    	}
    }
    
}
