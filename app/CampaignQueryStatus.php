<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CampaignQueryStatus extends Model
{
    use SoftDeletes;
    protected $table = 'ori_campaign_query_status';
	protected $guarded = [];
    use UpdaterCompanyData;
	public function GetStatus() 
	{
		return $this->belongsTo('App\QueryStatus','query_status', 'id');
	}
}
