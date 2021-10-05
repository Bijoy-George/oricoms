<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class Serverresource extends Model
{
    protected $table = 'ori_server_resource_details';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;

	// public function getresources() 
	// {
	// 	return $this->belongsTo('App\Server','server_id','id');
	// }
	public function getservices1() 
	{
		return $this->belongsTo('App\Server','server_id','id'
);
	}

	public function getresources()
	{
		return $this->hasMany('App\Serverresource', 'ori_server_resource_details');
	}

	
	public function getserver()
	{
		return $this->belongsTo('App\Server','server_id','id');
	}
	public function getresource()
	{
		return $this->hasMany('App\ServerService','server_resource_id');
		
	}
}
