<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriChatThreadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_chat_thread', function (Blueprint $table) {
            $table->bigInteger('id',true);
			$table->integer('cmpny_id')->nullable();
			$table->bigInteger('cust_id');
			$table->integer('agent_id');
			$table->bigInteger('lead_source_id');
			$table->integer('status')->default(1)->nullable()->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
		
		Schema::table('ori_chat_thread', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		
		Schema::table('ori_chat_thread', function (Blueprint $table) {
			$table->foreign('cust_id')->references('id')->on('ori_customer_profiles')->onDelete('cascade');
		});
		
		Schema::table('ori_chat_thread', function (Blueprint $table) {
			$table->foreign('agent_id')->references('id')->on('ori_users')->onDelete('cascade');
		});
		
		Schema::table('ori_chat_thread', function (Blueprint $table) {
			$table->foreign('lead_source_id')->references('id')->on('ori_mast_lead_sources')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_chat_thread');
    }
}
