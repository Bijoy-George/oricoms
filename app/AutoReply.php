<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoReply extends Model
{
    protected $table = 'ori_auto_reply';
	protected $guarded = [];

	public function AutoReplies()
	{
		return $this->belongsTo('App\AutoReplyCategory', 'auto_reply_category_id', 'id');
	}
}
