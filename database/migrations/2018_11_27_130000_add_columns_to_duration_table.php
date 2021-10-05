<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToDurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_mast_plans_duration', function (Blueprint $table) {
            $table->datetime('start_date')->nullable()->after('duration');
			$table->datetime('end_date')->nullable()->after('start_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_mast_plans_duration', function($table) {
        $table->dropColumn('start_date');
		$table->dropColumn('end_date');
		});
    }
}
