<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriSurveyQuestionSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_survey_question_settings', function(Blueprint $table)
		{
			$table->foreign('survey_id', 'ori_survey_question_settings_ibfk_1')->references('id')->on('ori_survey_settings')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('qstn_id_lang1', 'ori_survey_question_settings_ibfk_2')->references('id')->on('ori_questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('qstn_id_lang2', 'ori_survey_question_settings_ibfk_3')->references('id')->on('ori_questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('cmpny_id', 'ori_survey_question_settings_ibfk_4')->references('id')->on('ori_company_profiles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_survey_question_settings', function(Blueprint $table)
		{
			$table->dropForeign('ori_survey_question_settings_ibfk_1');
			$table->dropForeign('ori_survey_question_settings_ibfk_2');
			$table->dropForeign('ori_survey_question_settings_ibfk_3');
			$table->dropForeign('ori_survey_question_settings_ibfk_4');
		});
	}

}
