<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class LeadSources extends Model
{
	use UpdaterCompanyData;
	use SoftDeletes;
    protected $table = 'ori_mast_lead_sources';
	protected $guarded = [];
	
	public function GetLeadSourceType()
    {
        return $this->belongsTo('App\LeadSourceType', 'lead_source_type_id', 'id');
    }
}
