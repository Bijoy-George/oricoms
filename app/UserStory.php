<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserStory extends Model
{
    //
    use SoftDeletes;
	protected $table = 'ori_user_story';
    protected $guarded = [];
	
	public function GetPriority()
    {
        return $this->belongsTo('App\Priority', 'priority', 'id');
    }
	
}
