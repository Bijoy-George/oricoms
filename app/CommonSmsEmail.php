<?php

namespace App;
use App\AutomatedProcessCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CommonSmsEmail extends Model
{
	use SoftDeletes;
    protected $table = 'ori_common_sms_email';
	protected $guarded = [];
    use UpdaterCompanyData;

    public function campaign()
    {
    	return $this->belongsTo(Campaign::class);
    }

    public function batch()
    {
        return $this->belongsTo(CampaignBatch::class);
    }

    public function customer()
    {
    	return $this->belongsTo(CustomerProfile::class);
    }

    public function contact()
    {
    	return $this->belongsTo(CmpContact::class, 'contact_id');
    }

    public function start_stage()
    {
    	return $this->belongsTo(AutomatedProcessCustomer::class, 'current_stage');
    }

    public function end_stage()
    {
    	return $this->belongsTo(AutomatedProcessCustomer::class, 'converted_process_id');
    }

    public function followup()
    {
        return $this->belongsTo(LeadFollowup::class, 'follow_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
	public function LeadSource()
	{
		return $this->belongsTo('App\LeadSources', 'source', 'id');
	}
	public function docket_number_det()
	{
		return $this->belongsTo('App\Helpdesk', 'follow_id', 'id');
	}

    public function sendgrid_response()
    {
        return $this->hasMany('App\SendgridResponse', 'mail_ref_id', 'mail_ref_id')
                    ->orderBy('id', 'desc');
    }

    public function sendgrid_open_response()
    {
        return $this->hasMany('App\SendgridResponse', 'mail_ref_id', 'mail_ref_id')
                    ->where('event', 'open');
    }

    public function sendgrid_delivered_response()
    {
        return $this->hasOne('App\SendgridResponse', 'mail_ref_id', 'mail_ref_id')
                    ->where('event', 'delivered');
    }
    public function leadstatus()
    {
        return $this->belongsTo(CustomerProfile::class);
    }
}
