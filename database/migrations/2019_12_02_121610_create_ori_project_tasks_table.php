<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriProjectTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_project_tasks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->string('title', 150);
            $table->string('description')->nullable();
			$table->integer('project_id')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('required_time')->default(1)->comment('In hours');
            $table->integer('version')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('category')->nullable();
            $table->string('members')->nullable();
			$table->integer('status')->default(1)->comment('1-Active 2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_project_tasks', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
			$table->foreign('project_id')->references('id')->on('ori_projects')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ori_project_tasks');
    }
}
