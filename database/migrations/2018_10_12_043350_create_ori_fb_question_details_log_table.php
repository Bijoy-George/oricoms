<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriFbQuestionDetailsLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_fb_question_details_log', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->bigInteger('fb_question_id')->nullable()->comment('Reffered from ori_fb_question_details');
			$table->bigInteger('fb_det_id')->nullable()->comment('Referred from fb_details');
			$table->integer('question_id')->nullable();
			$table->string('answer', 100)->nullable();
			$table->integer('status')->default(1)->comment('1-Active 2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_fb_question_details_log', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		Schema::table('ori_fb_question_details_log', function (Blueprint $table) {
			$table->foreign('fb_det_id')->references('id')->on('ori_fb_details')->onDelete('cascade');
		});
		Schema::table('ori_fb_question_details_log', function (Blueprint $table) {
			$table->foreign('question_id')->references('id')->on('ori_questions')->onDelete('cascade');
		});
		Schema::table('ori_fb_question_details_log', function (Blueprint $table) {
			$table->foreign('fb_question_id')->references('id')->on('ori_fb_question_details')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_fb_question_details_log');
	}

}
