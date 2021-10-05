<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriProjectIntimationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_project_intimations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cmpny_id');
            $table->boolean('project_assignment_intimations_members')->nullable();
            $table->boolean('project_assignment_intimations_lead')->nullable();
            $table->integer('project_near_due_intimation_period')->nullable();
            $table->boolean('project_near_due_intimations_members')->nullable();
            $table->boolean('project_near_due_intimations_lead')->nullable();
            $table->boolean('project_near_due_intimations_creator')->nullable();
            $table->integer('project_overdue_intimation_period')->nullable();
            $table->boolean('project_overdue_intimations_members')->nullable();
            $table->boolean('project_overdue_intimations_lead')->nullable();
            $table->boolean('project_overdue_intimations_creator')->nullable();
            $table->boolean('project_completion_intimations_members')->nullable();
            $table->boolean('project_completion_intimations_lead')->nullable();
            $table->boolean('project_completion_intimations_creator')->nullable();
            $table->boolean('task_assignment_intimations')->nullable();
            $table->integer('task_near_due_intimation_period')->nullable();
            $table->boolean('task_near_due_intimations_members')->nullable();
            $table->boolean('task_near_due_intimations_lead')->nullable();
            $table->boolean('task_near_due_intimations_creator')->nullable();
            $table->integer('task_overdue_intimation_period')->nullable();
            $table->boolean('task_overdue_intimations_members')->nullable();
            $table->boolean('task_overdue_intimations_lead')->nullable();
            $table->boolean('task_overdue_intimations_creator')->nullable();
            $table->boolean('task_completion_intimations_lead')->nullable();
            $table->boolean('task_completion_intimations_creator')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_project_intimations');
    }
}
