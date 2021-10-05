<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriGroupExcelImportBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_group_excel_import_batches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cmpny_id');
            $table->integer('group_id')->unsigned()->comment('Referred from ori_groups');
            $table->string('file_name', 100);
            $table->text('field_map');
            $table->bigInteger('lead_source');
            $table->text('comment')->nullable();
            $table->tinyInteger('skip_existing_contacts')->nullable();
            $table->tinyInteger('add_to_leads')->nullable();
            $table->integer('status')->nullable()->comment('1-Active,2-Processing');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ori_group_excel_import_batches', function (Blueprint $table) {
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('ori_groups')->onDelete('cascade');
            $table->foreign('lead_source')->references('id')->on('ori_mast_lead_sources')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('ori_users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('ori_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_group_excel_import_batches');
    }
}
