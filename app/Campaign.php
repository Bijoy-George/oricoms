<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use UpdaterCompanyData;

    protected $table = 'ori_campaigns';
    protected $guarded = [];

    public function creator()
    {
    	return $this->belongsTo(User::class, 'created_by');
    }

    public function groups()
    {
    	return $this->belongsToMany(Group::class, 'ori_campaign_groups')->wherePivot('status',  config('constant.ACTIVE'));
    }

    public function meta_data()
    {
    	return $this->hasOne(CampaignMeta::class);
    }

    public function batches()
    {
        return $this->hasMany(CampaignBatch::class);
    }

    public function members_count()
    {
        $groups = $this->groups;
        $campaign_contacts  = collect([]);
        foreach ($groups as $group)
        {
            $campaign_contacts  = $campaign_contacts->merge($group->contacts);
        }
        $unique_contacts_count  = count($campaign_contacts->unique('id'));

        return $unique_contacts_count;
    }

}
