<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTalukIdToOriUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_users', function (Blueprint $table) {
            $table->integer('taluk_id')->nullable()->after('block_panchayath_id');
            $table->integer('village_id')->nullable()->after('taluk_id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_users', function (Blueprint $table) {
			$table->dropColumn('taluk_id');
			$table->dropColumn('village_id');
		});
    }
}


