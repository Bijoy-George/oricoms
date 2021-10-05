<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'ori_faqs';
	protected $guarded = [];
	use SoftDeletes;
	//use Updater;
	use UpdaterCompanyData;

	
	public function GetQueryType()
    {
        return $this->belongsTo('App\QueryTypes', 'query_type_id', 'id');
    }
	
	/* public function GetFaqCat()
    {
        return $this->belongsTo('App\QueryTypes', 'query_type_id', 'id');
    } */
   
}
