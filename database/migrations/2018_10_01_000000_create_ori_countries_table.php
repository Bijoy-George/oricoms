<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_countries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('country_name', 150);
			$table->dateTime('created_at');
			$table->integer('status')->comment('1-Active 2-Inactive');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_countries');
	}

}
