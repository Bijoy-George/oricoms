<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriTrackerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_tracker', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->index('cmpny_id');
			$table->integer('task_id')->index('task_id');
			$table->integer('user_id')->index('user_id');
			$table->dateTime('from_time');
			$table->dateTime('to_time');
			$table->string('description')->nullable();
			$table->integer('status')->default(1);
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
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
		Schema::drop('ori_tracker');
	}

}
