<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriSurveyQuestionSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_survey_question_settings', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('cmpny_id')->nullable()->index('cmpny_id');
			$table->bigInteger('survey_id')->nullable()->index('ori_survey_question_settings_ibfk_1')->comment('Referred from ori_survey_sertting');
			$table->integer('qstn_id_lang1')->nullable()->index('eng_qstn_id')->comment('Referred from ori_questions');
			$table->integer('qstn_id_lang2')->nullable()->index('mal_qstn_id')->comment('Referred from fReferre from ori_questions');
			$table->integer('status')->nullable();
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
		Schema::drop('ori_survey_question_settings');
	}

}
