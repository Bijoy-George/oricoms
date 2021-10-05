<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class LeadSourceType extends Model
{
	use UpdaterCompanyData;
	use SoftDeletes;
    protected $table = 'ori_mast_lead_source_type';
	protected $guarded = [];
	
	public function LeadSourceList()
    {
        return $this->hasMany('App\LeadSources', 'id', 'lead_source_type_id');
    }
	
}
