<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQueryStatusRelationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_mast_query_status_relation', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->integer('query_type_id')->comment('Referred from ori_mast_query_type');
			$table->integer('query_status_id')->comment('Referred from ori_mast_query_status');
			$table->integer('status')->default(1)->comment('1- Active, 2- Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
			
		});
		Schema::table('ori_mast_query_status_relation', function (Blueprint $table) {
			$table->foreign('query_type_id')->references('id')->on('ori_mast_query_type')->onDelete('cascade');
		});
		Schema::table('ori_mast_query_status_relation', function (Blueprint $table) {
			$table->foreign('query_status_id')->references('id')->on('ori_mast_query_status')->onDelete('cascade');
		});
		Schema::table('ori_mast_query_status_relation', function (Blueprint $table) {
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
		Schema::drop('ori_mast_query_status_relation');
	}

}
