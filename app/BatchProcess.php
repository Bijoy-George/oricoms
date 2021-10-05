<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchProcess extends Model
{
    use UpdaterCompanyData;

    protected $table = 'ori_batch_process';
    protected $guarded = [];
}
