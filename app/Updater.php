<?php 
namespace App; // /laravel/app/Updater.php
use Auth; 

trait Updater { protected static function boot() { 
    parent::boot(); /* * During a model create Eloquent will also update the updated_at field so * need to have the updated_by field here as well * */ 
   
    if(isset(Auth::User()->id) && !empty(Auth::User()->id))
    {
         $userid = Auth::User()->id;
    }
    else 
    {
        $userid = NULL;
    }
    
    static::creating(function($model) use($userid) { 
            $model->created_by =  $userid;
            $model->updated_by =  $userid;
        });
 
        static::updating(function($model) use($userid) { 
            $model->updated_by =  $userid;
        }); 
    }
}
