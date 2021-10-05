<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriChannelGatewayTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_channel_gateway', function(Blueprint $table)
		{
			$table->foreign('channel_id', 'channel_id')->references('id')->on('ori_channels')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_channel_gateway', function(Blueprint $table)
		{
			$table->dropForeign('channel_id');
		});
	}

}
