<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriTaskStoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('ori_task_story', function(Blueprint $table)
		{
		   $table->integer('id', true);
			$table->integer('userstory_id')->nullable();
			$table->string('task')->nullable();
			$table->string('asigned_to')->nullable();
			$table->string('status')->nullable();
			$table->integer('hour')->nullable();
			$table->integer('created_by')->default(0);
			$table->integer('updated_by')->default(0);
			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_task_story');
    }
}
