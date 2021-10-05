<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FaqCategories extends Model
{
	use SoftDeletes;
	use UpdaterCompanyData;
    protected $table = 'ori_mast_faq_categories';
	protected $guarded = [];
	
	public function GetQueryTypeCategory() 
	{
    	return $this->hasMany('App\QueryCategoryRelation','category_id','id');
	}
	public function GetSubCategory() 
	{
    	return $this->hasMany('App\FaqCategories','parent_category_id');
	} 
	public function GetParent() 
	{
		return $this->belongsTo('App\FaqCategories','parent_category_id', 'id');
	}
	public function getFaqList()
	{
		return $this->hasMany('App\Faq','faq_cat_id','id');
	}
}
