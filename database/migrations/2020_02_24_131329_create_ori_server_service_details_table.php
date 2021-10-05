<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriServerServiceDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_server_service_details', function(Blueprint $table)
		{
			$table->integer('id');
			$table->integer('cmpny_id');
			$table->integer('server_id')->index('server_id');
			$table->integer('service_id')->index('service_id');
			$table->integer('resource1');
			$table->string('resource1_remarks', 155)->nullable();
			$table->integer('resource2');
			$table->string('resource2_remarks', 155)->nullable();
			$table->string('resource3')->nullable();
			$table->integer('status');
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_server_service_details', function (Blueprint $table) {
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
		Schema::drop('ori_server_service_details');
	}

}
