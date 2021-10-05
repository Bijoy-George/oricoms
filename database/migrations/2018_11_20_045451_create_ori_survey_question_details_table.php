<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriSurveyQuestionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_survey_question_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('survey_det_id')->nullable()->index('survey_det_id')->comment('Referred from cc_survey_details');
			$table->integer('question_id')->nullable()->index('question_id')->comment('Referred from cc_survey_question_master');
			$table->string('answer', 100)->nullable();
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
		Schema::drop('ori_survey_question_details');
	}

}
