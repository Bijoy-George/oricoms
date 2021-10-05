<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriAutomatedProcessCustomerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_automated_process_customer', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable()->index('ori_automated_process_cmpny_id_foreign');
			$table->string('process_name')->nullable();
			$table->string('description')->nullable();
			$table->string('process')->nullable();
			$table->integer('process_type')->nullable()->comment('1 - Notificational, 2 - Promotional, 3 - Transactional');
			$table->integer('stage')->nullable()->index('ori_automated_process_stage_foreign');
			$table->integer('parent_id')->nullable();
			$table->integer('process_stage_type')->nullable();
			$table->integer('category')->nullable()->comment('1-mail/sms open check');
			$table->integer('faq_category')->nullable()->comment('Referred from cc_faq_categories');
			$table->integer('query_type')->nullable()->index('ori_automated_process_query_type_foreign');
			$table->integer('priority')->nullable()->index('ori_automated_process_priority_foreign');
			$table->integer('customer_nature')->nullable()->index('ori_automated_process_customer_nature_foreign');
			$table->integer('query_status')->nullable()->index('ori_automated_process_query_status_foreign');
			$table->bigInteger('lead_source_id')->nullable()->index('ori_automated_process_lead_source_id_foreign');
			$table->string('action', 15)->nullable()->comment('1 sms, 2 email, 3 manual call, 4 autodial');
			$table->integer('response_pos')->nullable();
			$table->integer('response_neg')->nullable();
			$table->string('action_time', 55)->nullable();
			$table->string('expiry_time', 55)->nullable();
			$table->integer('expiry_param')->nullable()->default(0)->comment('to select expiry 0 - current month, 1 - next month');
			$table->string('content')->nullable()->comment('referred from cc_mail_categories');
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
		Schema::drop('ori_automated_process_customer');
	}

}
