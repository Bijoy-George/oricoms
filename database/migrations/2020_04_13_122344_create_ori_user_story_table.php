<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriUserStoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_user_story', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->index('cmpny_id');
			$table->integer('project_id')->nullable();
			$table->string('title')->nullable();
			$table->string('priority')->nullable();
			$table->string('estimate',)->nullable();
			$table->string('user')->nullable();
			
			$table->string('goal')->nullable();
			$table->string('given')->nullable();
			$table->string('when')->nullable();
			$table->string('then')->nullable();
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
        Schema::dropIfExists('ori_user_story');
    }
}
