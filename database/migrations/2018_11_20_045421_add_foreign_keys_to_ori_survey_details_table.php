<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriSurveyDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_survey_details', function(Blueprint $table)
		{
			$table->foreign('survey_id', 'ori_survey_details_ibfk_1')->references('id')->on('ori_survey_settings')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('cmpny_id', 'ori_survey_details_ibfk_2')->references('id')->on('ori_company_profiles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('customer_id', 'ori_survey_details_ibfk_3')->references('id')->on('ori_customer_profiles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('common_id', 'ori_survey_details_ibfk_4')->references('id')->on('ori_common_sms_email')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('campaign_id', 'ori_survey_details_ibfk_5')->references('id')->on('ori_campaigns')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('contact_id', 'ori_survey_details_ibfk_6')->references('id')->on('ori_cmp_contacts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('batch_id', 'ori_survey_details_ibfk_7')->references('id')->on('ori_campaign_batches')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_survey_details', function(Blueprint $table)
		{
			$table->dropForeign('ori_survey_details_ibfk_1');
			$table->dropForeign('ori_survey_details_ibfk_2');
			$table->dropForeign('ori_survey_details_ibfk_3');
			$table->dropForeign('ori_survey_details_ibfk_4');
			$table->dropForeign('ori_survey_details_ibfk_5');
			$table->dropForeign('ori_survey_details_ibfk_6');
			$table->dropForeign('ori_survey_details_ibfk_7');
		});
	}

}
