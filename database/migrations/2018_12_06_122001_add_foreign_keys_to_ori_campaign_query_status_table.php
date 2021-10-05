<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriCampaignQueryStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_campaign_query_status', function(Blueprint $table)
		{
			$table->foreign('cmpny_id', 'ori_campaign_query_status_cmpny_id_foreign')->references('id')->on('ori_company_profiles')->onDelete('CASCADE');
			$table->foreign('campaign_id', 'ori_campaign_query_status_campaign_id_foreign')->references('id')->on('ori_campaigns')->onDelete('CASCADE');
			$table->foreign('batch_id', 'ori_campaign_query_status_batch_id_foreign')->references('id')->on('ori_campaign_batches')->onDelete('CASCADE');
			$table->foreign('query_type', 'ori_campaign_query_status_query_type_foreign')->references('id')->on('ori_mast_query_type')->onDelete('CASCADE');
			$table->foreign('query_status', 'ori_campaign_query_status_query_status_foreign')->references('id')->on('ori_mast_query_status')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_campaign_query_status', function(Blueprint $table)
		{
			$table->dropForeign('ori_campaign_query_status_cmpny_id_foreign');
		});
	}

}
