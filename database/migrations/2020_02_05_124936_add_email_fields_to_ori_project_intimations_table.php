<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailFieldsToOriProjectIntimationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_project_intimations', function (Blueprint $table) {
            $table->integer('project_assignment_intimations_members_mail')->nullable()->after('project_assignment_intimations_members');
            $table->integer('project_assignment_intimations_lead_mail')->nullable()->after('project_assignment_intimations_lead');
            $table->integer('project_near_due_intimations_members_mail')->nullable()->after('project_near_due_intimations_members');
            $table->integer('project_near_due_intimations_lead_mail')->nullable()->after('project_near_due_intimations_lead');
            $table->integer('project_near_due_intimations_creator_mail')->nullable()->after('project_near_due_intimations_creator');
            $table->integer('project_overdue_intimations_members_mail')->nullable()->after('project_overdue_intimations_members');
            $table->integer('project_overdue_intimations_lead_mail')->nullable()->after('project_overdue_intimations_lead');
            $table->integer('project_overdue_intimations_creator_mail')->nullable()->after('project_overdue_intimations_creator');
            $table->integer('project_completion_intimations_members_mail')->nullable()->after('project_completion_intimations_members');
            $table->integer('project_completion_intimations_lead_mail')->nullable()->after('project_completion_intimations_lead');
            $table->integer('project_completion_intimations_creator_mail')->nullable()->after('project_completion_intimations_creator');
            $table->integer('task_assignment_intimations_mail')->nullable()->after('task_assignment_intimations');
            $table->integer('task_near_due_intimations_members_mail')->nullable()->after('task_near_due_intimations_members');
            $table->integer('task_near_due_intimations_lead_mail')->nullable()->after('task_near_due_intimations_lead');
            $table->integer('task_near_due_intimations_creator_mail')->nullable()->after('task_near_due_intimations_creator');
            $table->integer('task_overdue_intimations_members_mail')->nullable()->after('task_overdue_intimations_members');
            $table->integer('task_overdue_intimations_lead_mail')->nullable()->after('task_overdue_intimations_lead');
            $table->integer('task_overdue_intimations_creator_mail')->nullable()->after('task_overdue_intimations_creator');
            $table->integer('task_completion_intimations_lead_mail')->nullable()->after('task_completion_intimations_lead');
            $table->integer('task_completion_intimations_creator_mail')->nullable()->after('task_completion_intimations_creator');
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
