<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupExcelImportBatch extends Model
{
    use UpdaterCompanyData;

    protected $table = 'ori_group_excel_import_batches';
    protected $guarded = [];
}
