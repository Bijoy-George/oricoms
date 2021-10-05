<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriFbFeedbackRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_fb_feedback_request', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->bigInteger('customer_id')->comment('Referred from cc_customer_profile');
			$table->integer('helpdesk_id')->nullable()->comment('refers ori_helpdesk');
			$table->integer('fb_type')->nullable()->comment('Refered from ori_channels');
			$table->dateTime('action_time')->nullable();
			$table->bigInteger('common_id')->comment('Referred from ori_common_sms_email')->nullable();
			$table->integer('status')->default(1)->comment('1-Active 2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_fb_feedback_request', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		Schema::table('ori_fb_feedback_request', function (Blueprint $table) {
			$table->foreign('fb_type')->references('id')->on('ori_channels')->onDelete('cascade');
		});
		Schema::table('ori_fb_feedback_request', function (Blueprint $table) {
			$table->foreign('customer_id')->references('id')->on('ori_customer_profiles')->onDelete('cascade');
		});
		Schema::table('ori_fb_feedback_request', function (Blueprint $table) {
			$table->foreign('helpdesk_id')->references('id')->on('ori_helpdesk')->onDelete('cascade');
		});
		Schema::table('ori_fb_feedback_request', function (Blueprint $table) {
			$table->foreign('common_id')->references('id')->on('ori_common_sms_email')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_fb_feedback_request');
	}

}
