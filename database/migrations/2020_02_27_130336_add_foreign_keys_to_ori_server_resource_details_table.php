<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriServerResourceDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_server_resource_details', function(Blueprint $table)
		{
			$table->foreign('cmpny_id', 'ori_server_resource_details_ibfk_1')->references('id')->on('ori_company_profiles')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('server_id', 'ori_server_resource_details_ibfk_2')->references('id')->on('ori_servers')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_server_resource_details', function(Blueprint $table)
		{
			$table->dropForeign('ori_server_resource_details_ibfk_1');
			$table->dropForeign('ori_server_resource_details_ibfk_2');
		});
	}

}
