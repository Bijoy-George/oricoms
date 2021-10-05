<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class LeadFollowupLog extends Model
{
    protected $table = 'ori_lead_followups_log';
	protected $guarded = [];
	use SoftDeletes;
	//use UpdaterCompanyData;
	public function GetQueryType()
    {
        return $this->belongsTo('App\QueryTypes', 'query_type', 'id');
    }
	public function GetCompany()
    {
        return $this->belongsTo('App\CompanyProfile', 'cmpny_id', 'id');
    }
	public function GetCustomer()
    {
        return $this->belongsTo('App\CustomerProfile', 'customer_id', 'id');
    }
	public function GetQueryCategory()
    {
        return $this->belongsTo('App\FaqCategories', 'query_category', 'id');
    }
	public function GetSubQueryCategory()
    {
        return $this->belongsTo('App\FaqCategories', 'sub_query_category', 'id');
    }
	public function GetCustomerNature()
    {
        return $this->belongsTo('App\CustomerNature', 'customer_nature', 'id');
    }
	public function GetPriority()
    {
        return $this->belongsTo('App\Priority', 'priority', 'id');
    }
	public function GetLeadSource()
    {
        return $this->belongsTo('App\LeadSources', 'lead_source_id', 'id');
    }
	public function GetQueryStatus()
    {
        return $this->belongsTo('App\QueryStatus', 'query_status', 'id');
    }
	public function GetEscalateUser()
    {
        return $this->belongsTo('App\User', 'escalate', 'id');
    }
	public function GetEscalateFrom()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }
    public function GetSupplyCard()
    {
        return $this->belongsTo('App\SupplyCards', 'supply_card', 'id');
    }
   
}
