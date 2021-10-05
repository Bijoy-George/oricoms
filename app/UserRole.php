<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    //
    use SoftDeletes;
	protected $table = 'ori_roles';
    protected $guarded = [];
}
