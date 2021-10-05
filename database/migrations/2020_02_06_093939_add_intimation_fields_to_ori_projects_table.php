<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIntimationFieldsToOriProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_projects', function (Blueprint $table) {
            $table->boolean('near_due_intimated')->nullable()->after('due_date');
            $table->boolean('overdue_intimated')->nullable()->after('near_due_intimated');
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
            //
        });
    }
}
