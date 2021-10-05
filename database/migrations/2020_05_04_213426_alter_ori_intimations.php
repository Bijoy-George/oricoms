<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOriIntimations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('ori_intimations', function (Blueprint $table) {
            $table->integer('daily_intimation')->nullable()->after('time_interval');
            $table->integer('monthly_intimation')->nullable()->after('daily_intimation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_intimations', function (Blueprint $table) {
            //
        });
    }
}
