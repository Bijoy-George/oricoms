<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class CompanyChannelGateway extends Model
{
    protected $table = 'ori_company_channel_gateway';
	protected $guarded = [];
	use SoftDeletes;
	//use Updater;
	use UpdaterCompanyData;
	public function GetGateway() 
	{
		return $this->belongsTo('App\ChannelGateway','gateway_id', 'id');
	}
  
}
