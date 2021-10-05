<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriPmMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_pm_master', function(Blueprint $table)
		{
			$table->foreign('cmpny_id', 'ori_pm_master_ibfk_1')->references('id')->on('ori_company_profiles')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_pm_master', function(Blueprint $table)
		{
			$table->dropForeign('ori_pm_master_ibfk_1');
		});
	}

}
