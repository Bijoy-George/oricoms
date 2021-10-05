<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriSurveyDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_survey_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('cmpny_id')->nullable()->index('cmpny_id');
			$table->bigInteger('customer_id')->nullable()->index('customer_id')->comment('Referred from cc_customer_profile');
			$table->bigInteger('contact_id')->nullable()->index('contact_id');
			$table->bigInteger('survey_id')->nullable()->index('survey_id');
			$table->integer('campaign_id')->nullable()->index('campaign_id')->comment('Referred from cmp_details');
			$table->integer('batch_id')->nullable()->index('batch_id')->comment('Referred from cmp_process_batches');
			$table->bigInteger('common_id')->nullable()->index('common_id')->comment('Referred from cc_common_email_sms');
			$table->integer('type')->nullable()->comment('1- SMS,2- Email, ');
			$table->integer('language_type')->nullable()->comment('1-  English,2- Malayalam');
			$table->integer('status')->nullable()->comment('1- Active,2- Inactive');
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
		Schema::drop('ori_survey_details');
	}

}
