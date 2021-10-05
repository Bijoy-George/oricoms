<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
        protected $table = 'ori_channels';
	protected $guarded = [];
	use SoftDeletes;
	//use UpdaterCompanyData;
	
	public function channel_details()
        {
          return $this->hasMany('App\CompanyChannel', 'channel_id', 'id');
        }
    public function getChannelGateway()
        {
          return $this->hasMany('App\ChannelGateway', 'channel_id', 'id');
        }


   
}
