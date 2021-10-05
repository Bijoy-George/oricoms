<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriFbDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_fb_details', function (Blueprint $table) {
             $table->foreign('reference_id')->references('id')->on('ori_helpdesk')->onDelete('cascade');
            $table->bigInteger('thread_id')->nullable()->comment('Referred from ori_chat_thread')->after('reference_id');
            
        });

        
        Schema::table('ori_fb_details', function (Blueprint $table) {
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
