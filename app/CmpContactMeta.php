<?php

namespace App;

use App\CmpContact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmpContactMeta extends Model
{
	use UpdaterCompanyData;
	use SoftDeletes;
	protected $table = 'ori_cmp_contacts_meta';
	protected $guarded = [];
	public function contact()
    {
        return $this->belongsTo(CmpContact::class, 'id', 'contact_id');
    }
}
