<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = 'ori_servers';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;

	public function getservices() 
	{
		return $this->belongsToMany('App\Server', 'ori_servers');
	}

	public function getresources()
	{
		return $this->hasMany('App\Serverresource', 'ori_server_resource_details');
	}
	public function getservice()
	{
		return $this->hasMany('App\ServerService','server_id','id');
	}
	public function getresource()
	{
		return $this->hasMany('App\Serverresource','server_id','id');
	}
}


