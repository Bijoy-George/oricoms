<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class LocationOfficerDetail extends Model
{
	use SoftDeletes;
        protected $table = 'ori_location_officer_details';
	protected $guarded = [];
        use UpdaterCompanyData;
}
