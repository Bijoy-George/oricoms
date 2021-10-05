<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignGroup extends Model
{
    use UpdaterCompanyData;

    protected $table = 'ori_campaign_groups';
    protected $guarded = [];
}
