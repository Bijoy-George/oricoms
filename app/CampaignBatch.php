<?php

namespace App;

use App\Attachment;
use Illuminate\Database\Eloquent\Model;

class CampaignBatch extends Model
{
    use UpdaterCompanyData;

    protected $table = 'ori_campaign_batches';
    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function survey_mast()
    {
        return $this->belongsTo('App\Survey', 'survey_id');
    }
    public function campaign_det()
    {
        return $this->belongsTo('App\Campaign', 'campaign_id');
    }
    public function survey_det()
    {
        //return $this->hasMany('App\SurveyDetail','survey_id','survey_id1')->where('status',config('constant.ACTIVE'));
        return $this->hasMany('App\SurveyDetail','survey_id','survey_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'ori_campaign_batch_groups', 'batch_id', 'group_id')
                    ->where('ori_groups.status', config('constant.ACTIVE'))
                    ->wherePivot('status',  config('constant.ACTIVE'));
    }

    public function communications()
    {
        return $this->hasMany(CommonSmsEmail::class, 'batch_id');
    }

    public function converted_customers()
    {
        return $this->hasMany(CommonSmsEmail::class, 'batch_id')
                    ->where('campaign_efficiency', 1);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_type');
    }

}
