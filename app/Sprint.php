<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sprint extends Model
{
    //
    use SoftDeletes;
	protected $table = 'ori_sprint';
    protected $guarded = [];
	
	
	
}
