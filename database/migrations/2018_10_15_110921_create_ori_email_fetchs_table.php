<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriEmailFetchsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_email_fetchs', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->bigInteger('email_id')->nullable()->comment('0 - outgoing mails');
			$table->bigInteger('thread_id');
			$table->string('from', 50)->nullable();
			$table->string('from_name');
			$table->text('subject')->nullable();
			$table->text('message')->nullable();
			$table->dateTime('received_date')->nullable();
			$table->boolean('submit_status')->default(0)->comment('1 - Complaint submitted  0 complaint not submitted');
			$table->integer('read_status')->default(0)->comment('1 - Read, 0 - Unread');
			$table->string('answered', 11)->nullable()->comment('1 - Answered');
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
		Schema::drop('ori_email_fetchs');
	}

}
