<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueryAction extends Model
{
    use SoftDeletes;
    protected $table = 'ori_mast_query_actions';
	protected $guarded = [];
	use UpdaterCompanyData;
}
