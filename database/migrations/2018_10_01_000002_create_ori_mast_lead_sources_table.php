<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriMastLeadSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_mast_lead_sources', function (Blueprint $table) {
            $table->bigInteger('id',true);
			$table->integer('cmpny_id')->nullable();
			$table->string('name',150)->nullable();
			$table->bigInteger('lead_source_type_id')->nullable()->comment('Referred from ori_mast_lead_source_type table');
			$table->string('source_key',250)->nullable();
			$table->integer('status')->default(1)->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
		
		Schema::table('ori_mast_lead_sources', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		
		Schema::table('ori_mast_lead_sources', function (Blueprint $table) {
			$table->foreign('lead_source_type_id')->references('id')->on('ori_mast_lead_source_type')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_mast_lead_sources');
    }
}
