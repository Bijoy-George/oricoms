<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyProfile extends Model
{
    use SoftDeletes;
	protected $table = 'ori_company_profiles';
	protected $guarded = [];

	/* public function channels()
	{
		return $this->belongsToMany(Channel::class, 'ori_company_channels', 'cmpny_id');
	} */
   
}
