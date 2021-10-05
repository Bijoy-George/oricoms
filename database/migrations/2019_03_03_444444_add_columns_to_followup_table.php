<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToFollowupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_lead_followups', function (Blueprint $table) {
            $table->string('ard_no', 500)->nullable()->comment('additional fields')->after('priority');
            $table->string('location', 500)->nullable()->comment('additional fields')->after('ard_no');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_lead_followups', function (Blueprint $table) {
            $table->dropColumn('ard_no');
            $table->dropColumn('location');
        });
    }
}
