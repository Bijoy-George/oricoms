<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_password_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cmpny_id')->nullable();
			$table->integer('user_id');
			$table->string('password');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_password_histories', function (Blueprint $table) {
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
		Schema::drop('ori_password_histories');
	}

}
