<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriChatThreadLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {		
		Schema::create('ori_chat_thread_logs', function (Blueprint $table) {
            $table->bigInteger('id',true);
			$table->bigInteger('thread_id')->comment('Referred from ori_chat_thread table');
			$table->integer('cmpny_id')->nullable();
			$table->bigInteger('chat_from');
			$table->bigInteger('chat_to');
			$table->text('chat_body');
			$table->integer('chat_from_type')->comment('1-Customer, 2-Agent');
			$table->integer('status')->default(1)->nullable()->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_chat_thread_logs');
    }
}
