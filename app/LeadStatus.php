<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Leadstatus extends Model
{
    use SoftDeletes;
    protected $table = 'leadstatuses';
	protected $guarded = [];
	use UpdaterCompanyData;
}
