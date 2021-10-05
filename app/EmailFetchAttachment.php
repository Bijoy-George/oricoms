<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class EmailFetchAttachment extends Model
{
	use SoftDeletes;
    protected $table = 'ori_email_fetchs_attachments';
	protected $guarded = [];
    use UpdaterCompanyData;
	public function attach_details()
    {
        return $this->belongsTo('App\EmailFetch', 'id', 'attachment_id');
    }
}
