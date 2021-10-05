<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServerResourceIdToOriServerServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_server_service_details', function (Blueprint $table) {
            $table->unsignedInteger('server_resource_id')->nullable()->after('service_id');
            $table->foreign('server_resource_id')->references('id')->on('ori_server_resource_details')->onUpdate('CASCADE')->onDelete('CASCADE');
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
