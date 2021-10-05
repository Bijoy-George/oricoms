<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class FeedbackDetail extends Model
{
        protected $table = 'ori_fb_details';
	protected $guarded = [];
	use SoftDeletes;
	public function feedback_profile()
    {
        return $this->belongsTo('App\CustomerProfile', 'customer_id', 'id');
    }
    public function feedback_question()
    {
        return $this->hasMany('App\FeedbackQuestionDetail', 'fb_det_id', 'id');
    }
    public function feedback_request()
    {
        return $this->hasOne('App\Helpdesk', 'id', 'reference_id');
    }
    public function feedback_reference()
    {
       
       return $this->hasManyThrough(
            'App\User', 
            'App\Helpdesk', 
            'id', // Helpdesk/id
            'id', // oriuser/id
            'reference_id', // feedback_details/reference_id
            'created_by' // helpdesk/creted_by
        );
       

	}

     public function chat_reference()
    {
       
       return $this->hasManyThrough(
            'App\User', 
            'App\ChatThread', 
            'id', // ChatThread/id
            'id', // oriuser/id
            'thread_id', // feedback_details/thread_id
            'agent_id' // ChatThread/agent_id
        );
       

    }
    public function channels()
    {
        return $this->hasOne('App\Channel', 'id', 'fb_type');
    }

   
}
