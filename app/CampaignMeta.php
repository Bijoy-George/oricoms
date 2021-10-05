<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignMeta extends Model
{
    use UpdaterCompanyData;

    protected $table = 'ori_campaigns_meta';
    protected $guarded = [];

    public function get_source_type()
    {
    	return $this->belongsTo(LeadSourceType::class, 'source_type');
    }

    public function lead_source()
    {
    	return $this->belongsTo(LeadSources::class, 'source_id');
    }
}
