<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriAutoReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_auto_reply', function (Blueprint $table) {
            $table->increments('id',true);
			$table->integer('cmpny_id')->nullable();
			$table->integer('auto_reply_category_id')->unsigned();
			$table->text('reply');
			$table->integer('status')->comment('1-Active 2-Inactive');
			$table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
		
		Schema::table('ori_auto_reply', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		
		Schema::table('ori_auto_reply', function (Blueprint $table) {
			$table->foreign('auto_reply_category_id')->references('id')->on('ori_auto_reply_category')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_auto_reply');
    }
}
