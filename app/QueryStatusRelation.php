<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class QueryStatusRelation extends Model
{
    protected $table = 'ori_mast_query_status_relation';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;
	public function GetStatus() 
	{
		return $this->belongsTo('App\QueryStatus','query_status_id', 'id');
	}
}
