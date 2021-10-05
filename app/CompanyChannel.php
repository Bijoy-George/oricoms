<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class CompanyChannel extends Model
{
    protected $table = 'ori_company_channels';
	protected $guarded = [];
	use SoftDeletes;
	//use Updater;
	use UpdaterCompanyData;
	public function GetTemplateType() 
	{
		return $this->belongsTo('App\Channel','channel_id', 'id');
	}
   public function getChannelGateway()
    {
      return $this->hasMany('App\ChannelGateway', 'channel_id', 'channel_id');
    }
}
