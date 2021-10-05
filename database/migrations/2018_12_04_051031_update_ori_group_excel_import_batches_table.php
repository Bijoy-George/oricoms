<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriGroupExcelImportBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_group_excel_import_batches', function (Blueprint $table) {
            $table->integer('last_processed_id')->nullable()->after('add_to_leads')->comment('Last processed row id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_group_excel_import_batches', function (Blueprint $table) {
            //
        });
    }
}
