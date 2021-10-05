<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriFbQuestionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_fb_question_details', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		Schema::table('ori_fb_question_details', function (Blueprint $table) {
			$table->foreign('fb_det_id')->references('id')->on('ori_fb_details')->onDelete('cascade');
		});
		Schema::table('ori_fb_question_details', function (Blueprint $table) {
			$table->foreign('question_id')->references('id')->on('ori_questions')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
