<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class NotificationsList extends Model
{
	use SoftDeletes;
    protected $table = 'ori_notifications_list';
	protected $guarded = [];
    use UpdaterCompanyData;
}
