<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_questions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->text('questions')->nullable();
			$table->integer('language_type')->nullable()->comment('1-  English,2- Malayalam');
			$table->string('option1', 250)->nullable();
			$table->string('option2', 250)->nullable();
			$table->string('option3', 250)->nullable();
			$table->string('option4', 250)->nullable();
			$table->string('option5', 250)->nullable();
			$table->string('option6', 250)->nullable();
			$table->integer('feedback')->nullable();
			$table->integer('survey')->nullable();
			$table->integer('status')->nullable()->comment('1-Active,2-Processing');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_questions', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_questions');
	}

}
