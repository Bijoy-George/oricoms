<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultipleFieldsToOriServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_servers', function (Blueprint $table) {
           $table->integer('threshold_resource1')->nullable()->after('description');
           $table->integer('threshold_resource2')->nullable()->after('threshold_resource1');
           $table->integer('threshold_resource3')->nullable()->after('threshold_resource2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_servers', function (Blueprint $table) {
            //
        });
    }
}
