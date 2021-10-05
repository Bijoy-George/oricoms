<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use UpdaterCompanyData;

    protected $table = 'ori_attachments';
    protected $guarded = [];

    public function attachable()
    {
        return $this->morphTo();
    }
}
