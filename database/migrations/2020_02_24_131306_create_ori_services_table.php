<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_services', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id');
			$table->string('service_name', 55);
			$table->string('description');
			$table->integer('status')->default(1);
			$table->boolean('created_by');
			$table->boolean('updated_by');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_services', function (Blueprint $table) {
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
		Schema::drop('ori_services');
	}

}
