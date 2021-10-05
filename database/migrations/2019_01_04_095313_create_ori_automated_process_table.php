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
			$table->integer('cmpny_id')->nullable()->index('ori_automated_process_cmpny_id_foreign');
			$table->string('process_name')->nullable();
			$table->string('action', 15)->nullable()->comment('1 sms, 2 email, 3 manual call, 4 autodial');
			$table->string('intimation_to')->nullable()->comment('(format:- flag-value), flag 1-district, 2-department, 3-designation, 4-taluk');
			$table->string('intimation_cc_to')->nullable()->comment('(format:- flag-value), flag 1-district, 2-department, 3-designation, 4-taluk');
			$table->integer('intimation_to_param')->default(1)->comment('0 - from conditions on intimation_to field in current table, 1 - intimation_to from helpdesk');
			$table->string('response_pos')->nullable();
			$table->string('response_neg')->nullable();
			$table->string('action_time', 55)->nullable();
			$table->string('expiry_time', 55)->nullable();
			$table->integer('action_time_param')->default(1)->comment('1 - minutes, 2 - hours, 3 - days');
			$table->integer('expiry_time_param')->default(1)->comment('1 - minutes, 2 - hours, 3 - days');
			$table->integer('expiry_flag')->nullable()->default(0)->comment('0 - as per expiry time, 1 - from helpdesk table');
			$table->string('content')->nullable()->comment('referred from cc_mail_categories');
			$table->integer('closed')->nullable()->default(0)->comment('closed stage');
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
		Schema::drop('ori_automated_process');
	}

}
