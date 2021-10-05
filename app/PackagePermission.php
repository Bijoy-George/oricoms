<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackagePermission extends Model
{
    //
    use SoftDeletes;
	protected $table = 'ori_mast_package';
    protected $guarded = [];
	
	public function plans()
    {
    	return $this->belongsTo(Plan::class,'package_type','id');
    }
}
