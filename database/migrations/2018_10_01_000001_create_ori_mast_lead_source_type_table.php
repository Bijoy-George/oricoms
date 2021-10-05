<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriMastLeadSourceTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_mast_lead_source_type', function (Blueprint $table) {
            $table->bigInteger('id',true);
			$table->integer('cmpny_id')->nullable();
			$table->string('source_type',255)->nullable();
			$table->integer('status')->default(1)->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
		
		Schema::table('ori_mast_lead_source_type', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_mast_lead_source_type');
    }
}
