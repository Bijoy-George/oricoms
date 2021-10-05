<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OriServerServiceDetailsDropColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_server_service_details', function (Blueprint $table) {
            $table->dropColumn('resource1');
            $table->dropColumn('resource1_remarks');
            $table->dropColumn('resource2');
            $table->dropColumn('resource2_remarks');
            $table->dropColumn('resource3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_server_service_details', function (Blueprint $table) {
            //
        });
    }
}
