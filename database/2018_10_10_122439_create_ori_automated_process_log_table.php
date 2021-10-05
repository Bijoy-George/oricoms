<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriAutomatedProcessLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_automated_process_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('customer_id')->nullable();
			$table->integer('auto_process_id')->nullable();
			$table->dateTime('action_created_time')->nullable();
			$table->dateTime('action_time')->nullable();
			$table->dateTime('action_expiry_time')->nullable();
			$table->string('field1')->nullable();
			$table->string('field2')->nullable();
			$table->string('field3')->nullable();
			$table->string('field4')->nullable();
			$table->string('field5')->nullable();
			$table->text('mail_field', 65535)->nullable();
			$table->integer('security_flag')->nullable();
			$table->string('security_info')->nullable();
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
		Schema::drop('ori_automated_process_log');
	}

}
