<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Auth;
use Request;

class CompanyScope implements Scope {

    public function apply(Builder $builder, Model $model)
    {
        // This is the part where you add the where clause.
        // I have no idea how you are passing the client_id though.
        // This example just assumes that you are passing an "id"
        // as a route parameter, but you may need to adjust accordingly.
       // $builder->where('client_id', '=', Request::route('id'));
        $tablename = $model->getTable();
        if(isset(Auth::User()->id) && !empty(Auth::User()->id))
        {     
             $builder->where($tablename.'.cmpny_id',Auth::user()->cmpny_id);
        }
        
         
    }

    public function remove(Builder $builder, Model $model) {
        // Not necessary
    }
}