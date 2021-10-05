<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOriProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_projects', function (Blueprint $table) {
            $table->integer('category')->default(0)->after('description');
            $table->integer('framework')->default(0)->after('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_projects', function (Blueprint $table) {
            $table->dropColumn('category');
			$table->dropColumn('framework');
        });
    }
}
