<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriAutomatedProcessStagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_automated_process_stages', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->string('stage_name')->nullable();
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
		Schema::drop('ori_automated_process_stages');
	}

}
