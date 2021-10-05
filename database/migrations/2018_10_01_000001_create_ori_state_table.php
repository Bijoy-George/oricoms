<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriStateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_state', function(Blueprint $table)
		{
			$table->integer('country_code');
			$table->integer('state_code')->default(0);
			$table->string('state_name', 50)->nullable();
			$table->string('updated_by', 15)->nullable();
			$table->dateTime('updatedtime')->nullable();
			$table->primary(['country_code','state_code']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_state');
	}

}
