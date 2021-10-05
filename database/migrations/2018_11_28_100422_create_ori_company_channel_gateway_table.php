<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriCompanyChannelGatewayTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_company_channel_gateway', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable()->index('cmpny_id');
			$table->integer('gateway_id')->nullable()->index('channel_id');
			$table->integer('status')->nullable()->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
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
		Schema::drop('ori_company_channel_gateway');
	}

}
