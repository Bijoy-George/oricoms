<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class AutomatedProcessRelationsCustomer extends Model
{
	use SoftDeletes;
    protected $table = 'ori_automated_process_relations_customer';
	protected $guarded = [];
    use UpdaterCompanyData;
}
