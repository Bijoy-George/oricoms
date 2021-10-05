<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class PusherList extends Model
{
	use SoftDeletes;
    protected $table = 'ori_pusher';
	protected $guarded = [];
    use UpdaterCompanyData;
}
