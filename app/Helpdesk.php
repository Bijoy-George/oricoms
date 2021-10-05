<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Helpdesk extends Model
{
    protected $table = 'ori_helpdesk';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;	
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
    public function GetQueryAction()
    {
        return $this->belongsTo('App\QueryAction', 'action_taken', 'id');
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
    public function GetAttachment()
    {
        return $this->hasMany('App\Attachment', 'attachable_type', 'docket_number');
    }
    public function GetState()
    {
        return $this->belongsTo('App\LocationSettings', 'state_id', 'id');
    }
    public function GetDistrict()
    {
        return $this->belongsTo('App\LocationSettings', 'district_id', 'id');
    }
     public function GetTaluk()
    {
        return $this->belongsTo('App\LocalBody', 'taluk_id', 'id');
    }
    public function GetVillage()
    {
        return $this->belongsTo('App\LocalBody', 'village_id', 'id');
    }
    public function GetLocalBodyType()
    {
        return $this->belongsTo('App\LocalBodyType', 'local_body_type', 'id');
    }
    public function GetMuncipality()
    {
        return $this->belongsTo('App\LocalBody', 'muncipality_id', 'id');
    }
    public function GetCorporation()
    {
        return $this->belongsTo('App\LocalBody', 'corporation_id', 'id');
    }
    public function GetDistrictPanchayath()
    {
        return $this->belongsTo('App\LocalBody', 'district_panchayath_id', 'id');
    } 
    public function GetBlockPanchayath()
    {
        return $this->belongsTo('App\LocalBody', 'block_panchayath_id', 'id');
    }
    public function GetGramaPanchayath()
    {
        return $this->belongsTo('App\LocalBody', 'grama_panchayath_id', 'id');
    }
    public function GetPanchayath()
    {
        return $this->belongsTo('App\LocalBody', 'panchayath_id', 'id');
    }
    public function GetCreator()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    public function GetSupplyCard()
    {
        return $this->belongsTo('App\SupplyCards', 'supply_card', 'id');
    }
    public function GetInstitution()
    {
        return $this->belongsTo('App\Institution', 'institution', 'id');
    }
	public function GetIssue()
    {
        return $this->belongsTo('App\QueryTypes', 'issue', 'id');
    }
	public function GetNature()
    {
        return $this->belongsTo('App\FaqCategories', 'nature_of_call', 'id');
    }
	public function GetMeasure()
    {
        return $this->belongsTo('App\QueryTypes', 'measure_taken', 'id');
    }
}
