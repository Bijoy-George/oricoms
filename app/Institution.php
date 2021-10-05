<?php
namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
	use SoftDeletes;
	use UpdaterCompanyData;
    protected $table = 'ori_mast_institution';
	protected $guarded = [];
	
	public function GetQueryTypeCategory() 
	{
    	return $this->hasMany('App\DistInstitutionRelation','institution_id','id');
	}
	public function GetSubCategory() 
	{
    	return $this->hasMany('App\Institution','parent_institution_id');
	} 
	public function GetParent() 
	{
		return $this->belongsTo('App\Institution','parent_institution_id', 'id');
	}
	
}
