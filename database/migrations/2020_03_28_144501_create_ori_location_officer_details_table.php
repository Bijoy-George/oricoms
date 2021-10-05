<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriLocationOfficerDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_location_officer_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->index('cmpny_id');
			$table->integer('location_id')->index('location_id');
			$table->integer('designation')->index('designation');
			$table->string('name', 55)->nullable();
			$table->string('email', 55)->nullable();
			$table->string('mobile', 15)->nullable();
			$table->integer('created_by')->default(0);
			$table->integer('updated_by')->default(0);
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
		Schema::drop('ori_location_officer_details');
	}

}
