<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriSurveyQuestionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_survey_question_details', function(Blueprint $table)
		{
			$table->foreign('survey_det_id', 'ori_survey_question_details_ibfk_1')->references('id')->on('ori_survey_details')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('question_id', 'ori_survey_question_details_ibfk_2')->references('id')->on('ori_questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_survey_question_details', function(Blueprint $table)
		{
			$table->dropForeign('ori_survey_question_details_ibfk_1');
			$table->dropForeign('ori_survey_question_details_ibfk_2');
		});
	}

}
