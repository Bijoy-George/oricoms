<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriProjectMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_project_meta', function(Blueprint $table)
		{
			$table->foreign('project_id', 'ori_project_meta_ibfk_1')->references('id')->on('ori_projects')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('cmpny_id', 'ori_project_meta_ibfk_2')->references('id')->on('ori_company_profiles')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_project_meta', function(Blueprint $table)
		{
			$table->dropForeign('ori_project_meta_ibfk_1');
			$table->dropForeign('ori_project_meta_ibfk_2');
		});
	}

}
