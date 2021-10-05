<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Templates extends Model
{
	use SoftDeletes;
	use UpdaterCompanyData;
    protected $table = 'ori_mast_templates';
	protected $guarded = [];
	public function GetTemplate() 
	{
		return $this->belongsTo('App\Channel','type', 'id');
	}

	
}
