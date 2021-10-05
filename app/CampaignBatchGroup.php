<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignBatchGroup extends Model
{
    use UpdaterCompanyData;

    protected $table = 'ori_campaign_batch_groups';
    protected $guarded = [];
}
