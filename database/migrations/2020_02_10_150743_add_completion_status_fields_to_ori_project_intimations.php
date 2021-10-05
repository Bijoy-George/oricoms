<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompletionStatusFieldsToOriProjectIntimations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_project_intimations', function (Blueprint $table) {
            $table->integer('project_completion_status')->nullable()->after('project_completion_intimations_creator_mail');
            $table->integer('task_completion_status')->nullable()->after('task_completion_intimations_creator_mail');
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
