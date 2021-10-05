<?php

namespace App;

use App\CmpContactMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmpContact extends Model
{
	use UpdaterCompanyData;
	use SoftDeletes;
    protected $table = 'ori_cmp_contacts';
	protected $guarded = [];
	public function contact_details()
    {
        return $this->hasMany(CmpContactMeta::class, 'contact_id', 'id');
    }
}
