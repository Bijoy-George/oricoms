<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriFbQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_fb_questions', function (Blueprint $table) {
           $table->integer('cmpny_id')->nullable()->after('id');
        });
        Schema::table('ori_fb_questions', function (Blueprint $table) {
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
        //
    }
}
