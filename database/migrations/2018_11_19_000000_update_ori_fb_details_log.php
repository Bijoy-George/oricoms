<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriFbDetailsLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_fb_details_log', function($table) {
        
        $table->integer('reference_id')->change();
        $table->bigInteger('thread_id')->nullable()->comment('Referred from ori_chat_thread')->after('reference_id');
        
        });

        Schema::table('ori_fb_details_log', function (Blueprint $table) {
             $table->foreign('reference_id')->references('id')->on('ori_helpdesk')->onDelete('cascade');
        });

        
        Schema::table('ori_fb_details_log', function (Blueprint $table) {
             $table->foreign('thread_id')->references('id')->on('ori_chat_thread')->onDelete('cascade');
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
