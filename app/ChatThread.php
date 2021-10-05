<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatThread extends Model
{
	protected $table = 'ori_chat_thread';
	protected $guarded = [];
   
	public function ChatThreadLogs()
	{
		return $this->hasMany('App\ChatThreadLog', 'thread_id', 'id');
	}
	
	public function LeadSource()
	{
		return $this->belongsTo('App\LeadSources', 'lead_source_id', 'id');
	}
	
	public function Customer()
	{
		return $this->belongsTo('App\CustomerProfile', 'cust_id', 'id');
	}
	
	public function Agent()
	{
		return $this->belongsTo('App\User', 'agent_id', 'id');
	}
}
