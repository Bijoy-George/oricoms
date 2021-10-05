<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnonymousToCustomerProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_customer_profiles', function (Blueprint $table) {
            $table->integer('hide_details')->default(0)->comment('0-Show Profile Details 1-Hide Profile Details')->after('profile_status');
        });
        Schema::table('ori_customer_profile_log', function (Blueprint $table) {
            $table->integer('hide_details')->default(0)->comment('0-Show Profile Details 1-Hide Profile Details')->after('profile_status');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_customer_profiles', function (Blueprint $table) {
            $table->dropColumn('hide_details');
        });
        Schema::table('ori_customer_profile_log', function (Blueprint $table) {
			$table->dropColumn('hide_details');
		});
    }
}


