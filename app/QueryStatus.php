<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class QueryStatus extends Model
{
    protected $table = 'ori_mast_query_status';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;
	
	public function GetQueryType()
    {
        return $this->belongsTo('App\QueryTypes', 'query_type', 'id');
    }
}
