<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    //
    use SoftDeletes;
	protected $table = 'ori_permissions';
    protected $guarded = [];
}
