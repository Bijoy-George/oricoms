<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriAutomatedProcessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_automated_process', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('process_name')->nullable();
			$table->string('description')->nullable();
			$table->string('process')->nullable();
			$table->integer('process_type')->nullable()->comment('1 - Notificational, 2 - Promotional, 3 - Transactional');
			$table->string('stage', 5)->nullable();
			$table->integer('parent_id')->nullable();
			$table->integer('process_stage_type')->nullable();
			$table->integer('category')->nullable()->comment('1-mail/sms open check');
			$table->integer('faq_category')->nullable()->comment('Referred from cc_faq_categories');
			$table->string('action', 15)->nullable()->comment('1 sms, 2 email, 3 manual call, 4 autodial');
			$table->string('response_pos')->nullable();
			$table->string('response_neg')->nullable();
			$table->string('action_time', 55)->nullable();
			$table->string('expiry_time', 55)->nullable();
			$table->integer('expiry_param')->nullable()->default(0)->comment('to select expiry 0 - current month, 1 - next month');
			$table->string('content')->nullable()->comment('referred from cc_mail_categories');
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
		Schema::drop('ori_automated_process');
	}

}
