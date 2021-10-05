<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanyMeta extends Model
{
    use SoftDeletes;
    protected $table = 'ori_company_meta';
	protected $guarded = [];
    use UpdaterCompanyData;
	public function GetStatus() 
	{
		return $this->belongsTo('App\QueryStatus','meta_value', 'id');
	}
}
