<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriBatchProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_batch_process', function (Blueprint $table) {
            $table->text('include_list')->after('exclude_list')->nullable()->comment('Comma separated list of contact ids to be included');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_batch_process', function (Blueprint $table) {
            $table->dropColumn('include_list');
        });
    }
}
