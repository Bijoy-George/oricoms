<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriCampaignGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_campaign_groups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id');
			$table->integer('campaign_id')->comment('Referred from ori_campaigns');
			$table->integer('group_id')->unsigned()->comment('Referred from ori_groups');
			$table->integer('status')->nullable()->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::table('ori_campaign_groups', function (Blueprint $table) {
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('ori_campaigns')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('ori_groups')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('ori_users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('ori_users')->onDelete('cascade');
            $table->unique(['campaign_id', 'group_id']);
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_campaign_groups');
	}

}
