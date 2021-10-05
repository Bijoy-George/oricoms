<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOriMastPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_mast_plans', function (Blueprint $table) {
			$table->string('discount', 500)->comment('percent')->nullable()->after('plan_des');
			});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_mast_plans', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
}
