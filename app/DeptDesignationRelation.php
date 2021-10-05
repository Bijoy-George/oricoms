<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class DeptDesignationRelation extends Model
{
    protected $table = 'ori_mast_query_designation_relation';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;
	public function GetDepartment() 
	{
		return $this->belongsTo('App\QueryTypes','query_type_id', 'id');
	}
	public function GetDesignation() 
	{
		return $this->belongsTo('App\Designation','designation_id', 'id');
	}
}
