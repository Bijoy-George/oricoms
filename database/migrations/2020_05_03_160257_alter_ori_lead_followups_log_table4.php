<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOriLeadFollowupsLogTable4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_lead_followups_log', function (Blueprint $table) {
             $table->integer('demo')->nullable()->after('customer_response');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_lead_followups_log', function (Blueprint $table) {
            //
        });
    }
}
