<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriEmailFetchsAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_email_fetchs_attachments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->bigInteger('attachment_id')->index('attachment_id')->comment('id in cc_email_fetchs');
			$table->string('file_name', 250);
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_email_fetchs_attachments', function (Blueprint $table) {
			$table->foreign('attachment_id')->references('id')->on('ori_email_fetchs')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_email_fetchs_attachments');
	}

}
