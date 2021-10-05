<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriSendgridResponseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_sendgrid_response', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('email', 250)->nullable();
			$table->string('time_stamp', 250)->nullable();
			$table->string('sg_message_id', 250)->nullable();
			$table->string('event', 250)->nullable();
			$table->string('mail_ref_id', 20)->nullable()->index('mail_ref_id');
			$table->string('category', 200)->nullable();
			$table->text('mail_full_response')->nullable();
			$table->timestamp('added_date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('status')->default(1)->comment('1-active 0-inactive');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_sendgrid_response');
	}

}
