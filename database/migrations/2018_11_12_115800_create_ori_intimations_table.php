<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriIntimationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_intimations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->integer('user_id')->nullable()->comment('Referred from ori_users');
			$table->integer('channel')->nullable()->comment('1 SMS, 2 Email, 3 Internal');
			$table->integer('time_interval')->nullable()->comment('1 Immediate, 2 Daily, 3 Weekly, 4 Monthly, 5 Internal immediate, 6 Superior');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_intimations', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		Schema::table('ori_intimations', function (Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('ori_users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_intimations');
	}

}
