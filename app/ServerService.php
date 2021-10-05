<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;

class ServerService extends Model
{
    protected $table = 'ori_server_service_details';
	protected $guarded = [];
	use SoftDeletes;
	use UpdaterCompanyData;

	public function getservices() 
	{
		return $this->belongsTo('App\Service','service_id','id');
	}
	public function getserver()
	{
		return $this->belongsTo('App\Server','server_id','id');
	}
	public function getresource()
	{
		return $this->belongsTo('App\Serverresource','server_resource_id','id');;
	}

}
