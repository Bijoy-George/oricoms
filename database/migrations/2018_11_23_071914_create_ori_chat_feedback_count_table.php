<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriChatFeedbackCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_chat_feedback_count', function (Blueprint $table) {
            $table->increments('id',true);
            $table->date('date');
            $table->integer('agent_id');
            $table->integer('excellent')->nullable();
            $table->integer('good')->nullable();
            $table->integer('average')->nullable();
            $table->integer('bad')->nullable();
            $table->integer('very_bad')->nullable();
            $table->integer('status')->default(1)->nullable()->comment('1-Active,2-Inactive');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ori_chat_feedback_count', function (Blueprint $table) {
            $table->foreign('agent_id')->references('id')->on('ori_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_chat_feedback_count');
    }
}
