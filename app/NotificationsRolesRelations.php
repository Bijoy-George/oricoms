<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class NotificationsRolesRelations extends Model
{
	use SoftDeletes;
    protected $table = 'ori_notifications_roles_relations';
	protected $guarded = [];
    use UpdaterCompanyData;
}
