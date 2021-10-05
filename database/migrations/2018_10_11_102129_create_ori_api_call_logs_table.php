<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriApiCallLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_api_call_logs', function (Blueprint $table) {
            $table->bigInteger('id',true);
			$table->integer('cmpny_id')->nullable();
			$table->string('api',255)->nullable();
			$table->longText('inputs')->nullable();
			$table->longText('headers')->nullable();
			$table->longText('output')->nullable();
			$table->longText('error_msg')->nullable();
			$table->integer('status')->default(1)->comment('1-Active,2-Inactive');
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
        Schema::dropIfExists('ori_api_call_logs');
    }
}
