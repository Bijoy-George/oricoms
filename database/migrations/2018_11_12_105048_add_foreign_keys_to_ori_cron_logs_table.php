<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriCronLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_cron_logs', function(Blueprint $table)
		{
			$table->foreign('cmpny_id', 'ori_cron_logs_ibfk_1')->references('id')->on('ori_company_profiles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_cron_logs', function(Blueprint $table)
		{
			$table->dropForeign('ori_cron_logs_ibfk_1');
		});
	}

}
