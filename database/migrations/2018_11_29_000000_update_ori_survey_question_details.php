<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriSurveyQuestionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_survey_question_details', function (Blueprint $table) {
             
            $table->bigInteger('relation_id')->nullable()->comment('Referred from ori_survey_question_settings')->after('question_id');
            
        });

        
        Schema::table('ori_survey_question_details', function (Blueprint $table) {
             $table->foreign('relation_id')->references('id')->on('ori_survey_question_settings')->onDelete('cascade');
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
