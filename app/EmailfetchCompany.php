<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class EmailfetchCompany extends Model
{
	use SoftDeletes;
    protected $table = 'ori_emailfetch_company';
	protected $guarded = [];
    use UpdaterCompanyData;
}
