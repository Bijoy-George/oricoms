<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_projects', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->string('prjt_name', 150);
            $table->string('description')->nullable();
            $table->date('due_date')->nullable();
			$table->integer('never_due')->default(0)->nullable();
            $table->string('budget', 150)->nullable();
            $table->string('members')->nullable();
            $table->integer('sort_order')->default(0)->nullable();
			$table->integer('status')->default(1)->comment('1-Active 2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_projects', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ori_projects');
    }
}
