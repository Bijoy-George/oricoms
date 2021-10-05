<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatThreadLog extends Model
{
	protected $table = 'ori_chat_thread_logs';
	protected $guarded = [];
	
	public function ChatThread()
	{
		return $this->belongsTo('App\ChatThread', 'thread_id', 'id');
	}
}
