<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use SoftDeletes;
	use UpdaterCompanyData;
    protected $table = 'ori_mast_priority';
	protected $guarded = [];
}
