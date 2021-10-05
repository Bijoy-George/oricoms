<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStatusInoriserverservicedetailsTableTypes1ab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_server_service_details', function(Blueprint $table)
        {
            DB::statement('ALTER TABLE `ori_server_service_details` CHANGE `status` `status` INTEGER(2) NULL DEFAULT NULL');
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
