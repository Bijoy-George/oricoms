<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriCommonSmsEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        
        Schema::table('ori_common_sms_email', function (Blueprint $table) {
             
            $table->bigInteger('survey_id')->nullable()->comment('Referred from ori_survey_details')->after('batch_id');
            
        });

        
        Schema::table('ori_common_sms_email', function (Blueprint $table) {
             $table->foreign('survey_id')->references('id')->on('ori_survey_details')->onDelete('cascade');
             
             
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
