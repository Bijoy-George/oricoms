<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOriIntimations2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('ori_intimations', function (Blueprint $table) {
            $table->integer('daily_template')->nullable()->after('monthly_intimation');
            $table->integer('monthly_template')->nullable()->after('daily_template');
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
