<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriFbQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_fb_questions', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('feedback_id')->nullable()->index('feedback_id_2')->comment('Referred from ori_fb_settings');
			$table->integer('eng_qstn_id')->nullable()->index('eng_qstn_id')->comment('Referred from ori_questions');
			$table->integer('mal_qstn_id')->nullable()->index('mal_qstn_id')->comment('Referred from fReferre from ori_questions');
			$table->integer('status')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->dateTime('deleted_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_fb_questions');
	}

}
