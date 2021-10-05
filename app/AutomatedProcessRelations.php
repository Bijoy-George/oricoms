<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class AutomatedProcessRelations extends Model
{
	use SoftDeletes;
    protected $table = 'ori_automated_process_relations';
	protected $guarded = [];
    use UpdaterCompanyData;
}
