<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriGroupExcelImportFailedRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_group_excel_import_failed_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cmpny_id');
            $table->integer('batch_process_id')->unsigned()->comment('Reffered from ori_group_excel_import_batch table');
            $table->integer('row_id');
            $table->text('row_data');
            $table->integer('failure_type')->comment('1. Validation failure');
            $table->string('failure_message', 255);
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ori_group_excel_import_failed_rows', function (Blueprint $table) {
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
            $table->foreign('batch_process_id')->references('id')->on('ori_group_excel_import_batches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_group_excel_import_failed_rows');
    }
}
