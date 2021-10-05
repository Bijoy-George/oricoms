<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriCampaignsMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_campaigns_meta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id');
			$table->integer('campaign_id')->comment('refered from ori_campaigns');
			$table->bigInteger('source_type')->nullable();
			$table->bigInteger('source_id');
			$table->integer('budget')->nullable();
			$table->string('field1', 30)->nullable();
			$table->string('field2', 30)->nullable();
			$table->string('field3', 30)->nullable();
			$table->string('field1_description')->nullable();
			$table->string('field2_description')->nullable();
			$table->string('field3_description')->nullable();
			$table->integer('status')->nullable()->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::table('ori_campaigns_meta', function (Blueprint $table) {
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('ori_campaigns')->onDelete('cascade');
            $table->foreign('source_type')->references('id')->on('ori_mast_lead_source_type')->onDelete('cascade');
            $table->foreign('source_id')->references('id')->on('ori_mast_lead_sources')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('ori_users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('ori_users')->onDelete('cascade');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_campaigns_meta');
	}

}
