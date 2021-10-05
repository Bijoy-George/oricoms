<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriTabsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_tabs', function(Blueprint $table)
		{
			$table->foreign('cmpny_id', 'ori_tabs_ibfk_1')->references('id')->on('ori_company_profiles')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_tabs', function(Blueprint $table)
		{
			$table->dropForeign('ori_tabs_ibfk_1');
		});
	}

}
