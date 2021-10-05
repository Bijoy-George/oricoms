<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class FeedbackQuestion extends Model
{
    protected $table = 'ori_fb_questions';
	protected $guarded = [];
	use SoftDeletes;
	use Updater;
	public function eng_questions()
    {
        return $this->belongsTo('App\Question', 'eng_qstn_id', 'id');
    }
    public function mal_questions()
    {
        return $this->belongsTo('App\Question', 'mal_qstn_id', 'id');
    }
   
}
