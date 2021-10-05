<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriTrackerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_tracker', function(Blueprint $table)
		{
			$table->foreign('cmpny_id', 'ori_tracker_ibfk_1')->references('id')->on('ori_company_profiles')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('task_id', 'ori_tracker_ibfk_2')->references('id')->on('ori_project_tasks')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'ori_tracker_ibfk_3')->references('id')->on('ori_users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_tracker', function(Blueprint $table)
		{
			$table->dropForeign('ori_tracker_ibfk_1');
			$table->dropForeign('ori_tracker_ibfk_2');
			$table->dropForeign('ori_tracker_ibfk_3');
		});
	}

}
