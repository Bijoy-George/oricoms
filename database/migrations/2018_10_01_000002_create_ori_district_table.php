<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriDistrictTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_district', function(Blueprint $table)
		{
			$table->integer('country_code');
			$table->integer('state_code')->default(0);
			$table->integer('district_code')->default(0);
			$table->string('district_name', 50)->nullable();
			$table->string('dist_abbr', 5);
			$table->string('updated_by', 15)->nullable();
			$table->dateTime('updatedtime')->nullable();
			$table->primary(['country_code','state_code','district_code']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_district');
	}

}
