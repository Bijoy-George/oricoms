<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriSurveySettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_survey_settings', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('cmpny_id')->nullable()->index('cmpny_id');
			$table->string('survey_name_lang1', 250)->nullable();
			$table->string('survey_name_lang2', 250)->nullable();
			$table->string('desc_lang1', 250)->nullable();
			$table->string('desc_lang2', 250)->nullable();
			$table->integer('is_lang1')->nullable();
			$table->integer('is_lang2')->nullable();
			$table->dateTime('expiry_date')->nullable();
			$table->integer('status')->nullable()->comment('1-Active,2-Inactive');
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
		Schema::drop('ori_survey_settings');
	}

}
