<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterYourOriProjectIntimations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('ori_project_intimations', function (Blueprint $table) {
             $table->integer('daily_view_deatils_intimations')->nullable()->after('task_completion_status');
             $table->integer('daily_view_deatils_intimations_mail')->nullable()->after('daily_view_deatils_intimations');
             $table->integer('monthly_view_deatils_intimations')->nullable()->after('daily_view_deatils_intimations_mail');
             $table->integer('monthly_view_deatils_intimations_mail')->nullable()->after('monthly_view_deatils_intimations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_project_intimations', function (Blueprint $table) {
            //
        });
    }
}
