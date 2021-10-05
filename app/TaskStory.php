<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStory extends Model
{
    //
    use SoftDeletes;
	protected $table = 'ori_task_story';
    protected $guarded = [];
}
