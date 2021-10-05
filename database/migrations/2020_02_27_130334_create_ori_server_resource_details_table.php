<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriServerResourceDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_server_resource_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cmpny_id')->index('cmpny_id');
			$table->integer('server_id')->index('server_id');
			$table->integer('resource1')->default(0);
			$table->string('resource1_remarks')->nullable();
			$table->integer('resource2')->default(0);
			$table->string('resource2_remarks')->nullable();
			$table->text('resource3', 65535)->nullable();
			$table->integer('status');
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_server_resource_details');
	}

}
