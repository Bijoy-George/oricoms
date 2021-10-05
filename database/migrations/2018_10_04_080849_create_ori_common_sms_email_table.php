<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriCommonSmsEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_common_sms_email', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->string('authentication')->nullable()->comment('static key');
			$table->integer('follow_id')->nullable();
			$table->string('customer_id', 250)->nullable();
			$table->integer('campaign_id')->nullable()->comment('referred from cmp_details table');
			$table->integer('autodial_schedule_id')->nullable();
			$table->integer('contact_id')->nullable()->comment('referred from cmp_contact_lists table');
			$table->integer('sms_type')->nullable()->comment('1-OTP,2-Transaction,3-Promotional,4-Followup,5-New Enquiry from profile,6- Resend email sms from crm');
			$table->integer('source')->nullable();
			$table->string('mobile', 100)->nullable();
			$table->string('email')->nullable();
			$table->integer('sent_type')->nullable()->comment('1-sms,2-email');
			$table->text('content')->nullable();
			$table->string('subject')->nullable();
			$table->text('email_cc', 65535)->nullable();
			$table->string('response')->nullable()->comment('response');
			$table->string('mail_response')->nullable();
			$table->string('mail_ref_id', 20)->nullable();
			$table->string('random_code', 100)->nullable();
			$table->integer('otp')->nullable();
			$table->integer('mobile_verified')->default(2);
			$table->integer('email_verified')->default(2);
			$table->integer('batch_id')->nullable();
			$table->integer('auto_process_id')->nullable();
			$table->integer('auto_process_rel_id')->nullable();
			$table->integer('current_stage')->nullable();
			$table->integer('goal_stage')->nullable();
			$table->dateTime('goal_stage_date')->nullable();
			$table->integer('campaign_efficiency')->nullable();
			$table->integer('converted_process_id')->nullable();
			$table->integer('converted_process_parent_id')->nullable();
			$table->integer('process')->nullable()->comment('1- feedback, 2- Survey');
			$table->integer('status')->comment('1 - sent,2- not sent');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_common_sms_email', function (Blueprint $table) {
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
		Schema::drop('ori_common_sms_email');
	}

}
