<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalCcFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_automated_process', function (Blueprint $table) {
             $table->integer('additional_cc_flag')->after('intimation_cc_to')->nullable()->comment = "From helpdesk table taluk_supply_office column";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_automated_process', function (Blueprint $table) {
            $table->dropColumn('additional_cc_flag');
        });
    }
}
