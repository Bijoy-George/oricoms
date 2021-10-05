<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriCompanyChannelGatewayTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_company_channel_gateway', function(Blueprint $table)
		{
			$table->foreign('cmpny_id', 'cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
			$table->foreign('gateway_id', 'gateway_id')->references('id')->on('ori_channel_gateway')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_company_channel_gateway', function(Blueprint $table)
		{
			$table->dropForeign('cmpny_id');
			$table->dropForeign('gateway_id');
		});
	}

}
