<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterOriHelpdeskTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_helpdesk', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->bigInteger('customer_id')->nullable()->comment('Referred from ori_customer_profile');
			$table->text('chit_payment_id')->nullable()->comment('refers ori_customer_chit_payments id');
			$table->string('docket_number', 100)->nullable();
			$table->dateTime('remainder_date')->nullable();
			$table->text('req_title', 65535)->nullable();
			$table->text('question')->nullable();
			$table->text('answer')->nullable();
			$table->string('short_message', 350)->nullable();
			$table->integer('query_type')->nullable()->comment('Referred from ori_mast_query_type');
			$table->integer('query_category')->nullable()->comment('Referred from ori_mast_faq_categories');
			$table->integer('sub_query_category')->nullable()->comment('Referred from ori_mast_faq_categories');
			$table->integer('customer_nature')->nullable()->comment('Referred from ori_mast_customer_nature');
			$table->integer('priority')->nullable()->comment('Referred from ori_mast_priority');
			$table->integer('need_followup')->nullable()->comment('1-need 2-not needed');
			$table->bigInteger('lead_source_id')->nullable()->comment('Referred from 	ori_mast_lead_sources ');
			$table->integer('query_status')->nullable()->comment('Referred from ori_mast_query_status ');
			$table->integer('escalation_status')->nullable();
			$table->integer('escalate')->nullable()->comment('Referred from ori_users');
			$table->integer('escalation_deadline')->nullable();
			$table->dateTime('escalation_due_date')->nullable();
			$table->integer('take_up_status')->default(0)->comment('0-default 1-moved to takeup 2-escalate updated');
			$table->string('call_id', 32)->nullable();
			$table->integer('outbound_calls')->default(0)->comment('0- Normal followups, 1- outbound calls');
			$table->integer('batch_id')->nullable()->comment('referred from cmp_process_batches');
			$table->integer('agent_id')->nullable();
			$table->integer('attended_by')->nullable();
			$table->integer('assigned_agent')->default(0);
			$table->integer('status')->default(1)->comment('1-Active 2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_helpdesk', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		Schema::table('ori_helpdesk', function (Blueprint $table) {
			$table->foreign('customer_id')->references('id')->on('ori_customer_profiles')->onDelete('cascade');
		});
		Schema::table('ori_helpdesk', function (Blueprint $table) {
			$table->foreign('query_type')->references('id')->on('ori_mast_query_type')->onDelete('cascade');
		});
		Schema::table('ori_helpdesk', function (Blueprint $table) {
			$table->foreign('query_category')->references('id')->on('ori_mast_faq_categories')->onDelete('cascade');
		});
		Schema::table('ori_helpdesk', function (Blueprint $table) {
			$table->foreign('sub_query_category')->references('id')->on('ori_mast_faq_categories')->onDelete('cascade');
		});
		Schema::table('ori_helpdesk', function (Blueprint $table) {
			$table->foreign('customer_nature')->references('id')->on('ori_mast_customer_nature')->onDelete('cascade');
		});
		Schema::table('ori_helpdesk', function (Blueprint $table) {
			$table->foreign('priority')->references('id')->on('ori_mast_priority')->onDelete('cascade');
		});
		Schema::table('ori_helpdesk', function (Blueprint $table) {
			$table->foreign('lead_source_id')->references('id')->on('ori_mast_lead_sources')->onDelete('cascade');
		});
		Schema::table('ori_helpdesk', function (Blueprint $table) {
			$table->foreign('query_status')->references('id')->on('ori_mast_query_status')->onDelete('cascade');
		});
		Schema::table('ori_helpdesk', function (Blueprint $table) {
			$table->foreign('escalate')->references('id')->on('ori_users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_helpdesk');
	}

}
