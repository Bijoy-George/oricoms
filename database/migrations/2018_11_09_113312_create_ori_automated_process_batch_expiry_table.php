<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriAutomatedProcessBatchExpiryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_automated_process_batch_expiry', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->integer('last_relation_id')->nullable();
			$table->dateTime('action_expiry_time')->nullable();
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
		Schema::drop('ori_automated_process_batch_expiry');
	}

}
