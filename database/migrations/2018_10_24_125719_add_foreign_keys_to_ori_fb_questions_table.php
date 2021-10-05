<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriFbQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_fb_questions', function(Blueprint $table)
		{
			$table->foreign('feedback_id', 'ori_fb_questions_ibfk_1')->references('id')->on('ori_fb_settings')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('eng_qstn_id', 'ori_fb_questions_ibfk_2')->references('id')->on('ori_questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('mal_qstn_id', 'ori_fb_questions_ibfk_3')->references('id')->on('ori_questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_fb_questions', function(Blueprint $table)
		{
			$table->dropForeign('ori_fb_questions_ibfk_1');
			$table->dropForeign('ori_fb_questions_ibfk_2');
			$table->dropForeign('ori_fb_questions_ibfk_3');
		});
	}

}
