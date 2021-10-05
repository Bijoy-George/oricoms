<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoReplyCategory extends Model
{
    protected $table = 'ori_auto_reply_category';
	protected $guarded = [];

	public function AutoRepliesCategory()
	{
		return $this->hasMany('App\AutoReply', 'auto_reply_category_id ', 'id');
	}
}
