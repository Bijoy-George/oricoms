<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordSecuritiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_password_securities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cmpny_id')->nullable();
			$table->integer('user_id');
			$table->integer('password_expiry_days')->nullable();
			$table->dateTime('password_updated_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_password_securities', function (Blueprint $table) {
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
		Schema::drop('ori_password_securities');
	}

}
