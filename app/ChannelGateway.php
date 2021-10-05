<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class ChannelGateway extends Model
{
    protected $table = 'ori_channel_gateway';
	protected $guarded = [];
	use SoftDeletes;
	//use UpdaterCompanyData;
	
	public function getChannel()
    {
      return $this->belongsTo('App\Channel', 'Channel_id', 'id');
    }
}
