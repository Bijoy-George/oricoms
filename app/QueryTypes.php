<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class QueryTypes extends Model
{
	use SoftDeletes;
        protected $table = 'ori_mast_query_type';
	protected $guarded = [];
        use UpdaterCompanyData;
}
