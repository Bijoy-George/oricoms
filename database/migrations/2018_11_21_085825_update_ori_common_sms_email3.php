<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriCommonSmsEmail3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_common_sms_email', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->nullable()->after('batch_id')->comment('Referred from ori_groups');
        });

        Schema::table('ori_common_sms_email', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('ori_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_common_sms_email', function (Blueprint $table) {
            //
        });
    }
}
