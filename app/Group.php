<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	use UpdaterCompanyData;

    protected $table = 'ori_groups';
    protected $guarded = [];


    public function creator()
    {
    	return $this->belongsTo(User::class, 'created_by');
    }

    public function contacts()
    {
        return $this->belongsToMany(CmpContact::class, 'ori_group_contacts', 'group_id', 'contact_id')->withPivot('status')->wherePivot('status',  config('constant.ACTIVE'))->take(50);
    }

    public function excel_batches()
    {
        return $this->hasMany(GroupExcelImportBatch::class);
    }

    public function import_batches()
    {
        return $this->hasMany(BatchProcess::class);
    }

    public function processing_import_batches()
    {
        return $this->hasMany(BatchProcess::class)->where('ori_batch_process.status', config('constant.PROCESSING'));
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'ori_campaign_groups')->wherePivot('status',  config('constant.ACTIVE'));
    }

    public function campaign_batches()
    {
        return $this->belongsToMany(CampaignBatch::class, 'ori_campaign_batch_groups', 'group_id', 'batch_id')
                    ->wherePivot('status',  config('constant.ACTIVE'));
    }
}
