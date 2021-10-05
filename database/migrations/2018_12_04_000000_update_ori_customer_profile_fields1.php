<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriCustomerProfileFields1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_customer_profile_fields', function (Blueprint $table) {
             $table->integer('tab_id')->nullable()->after('field_id');
             $table->foreign('tab_id')->references('id')->on('ori_tabs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_customer_profile_fields', function (Blueprint $table) {
            $table->dropColumn('tab_id');
        });
    }
}
