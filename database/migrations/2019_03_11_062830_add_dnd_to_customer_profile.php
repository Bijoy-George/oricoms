<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDndToCustomerProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_customer_profiles', function (Blueprint $table) {
            $table->integer('dnd')->default(0)->after('profile_status');
        });
        Schema::table('ori_customer_profile_log', function (Blueprint $table) {
            $table->integer('dnd')->default(0)->after('profile_status');
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
            $table->dropColumn('dnd');
        });
        Schema::table('ori_customer_profile_log', function (Blueprint $table) {
			$table->dropColumn('dnd');
		});
    }
}


