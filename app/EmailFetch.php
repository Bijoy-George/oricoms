<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class EmailFetch extends Model
{
	use SoftDeletes;
    protected $table = 'ori_email_fetchs';
	protected $guarded = [];
    use UpdaterCompanyData;
	public function email_details()
    {
        return $this->hasMany('App\EmailFetchAttachment', 'attachment_id', 'id');
    }
}
