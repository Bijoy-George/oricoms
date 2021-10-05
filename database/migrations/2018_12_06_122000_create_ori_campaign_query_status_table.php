<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriCampaignQueryStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_campaign_query_status', function(Blueprint $table)
		{
			$table->integer('id',true);
			$table->integer('cmpny_id')->nullable()->index('ori_emailfetch_company_cmpny_id_foreign');
			$table->integer('campaign_id')->nullable();
			$table->integer('batch_id')->nullable();
			$table->integer('query_type')->nullable();
			$table->integer('query_status')->nullable();
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
		Schema::drop('ori_campaign_query_status');
	}

}
