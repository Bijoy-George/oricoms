<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class QueryCategoryRelation extends Model
{
    use SoftDeletes;
    protected $table = 'ori_mast_query_category_relation';
	protected $guarded = [];
	public function GetCategory() 
	{
		return $this->belongsTo('App\FaqCategories','category_id', 'id');
	}
}
