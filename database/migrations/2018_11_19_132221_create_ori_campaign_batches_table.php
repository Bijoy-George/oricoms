<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriCampaignBatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_campaign_batches', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id');
			$table->string('subject')->nullable();
			$table->text('content')->nullable();
			$table->integer('campaign_id')->nullable();
			$table->integer('autodial_schedule_id')->nullable();
			$table->string('title')->nullable()->comment('batch title');
			$table->integer('goal_stage')->nullable();
			$table->integer('enq_priority')->default(0);
			$table->integer('total_target_count')->nullable()->comment('total campaign members count');
			$table->integer('processed_count')->nullable();
			$table->integer('last_processed_id')->nullable();
			$table->integer('obc_type')->nullable()->comment('referred from cc_query_type');
			$table->integer('obc_category')->nullable()->comment('referred from cc_faq_categories');
			$table->integer('encoding_type')->nullable();
			$table->date('from_period')->nullable();
			$table->date('to_period')->nullable();
			$table->bigInteger('survey_id')->nullable();
			$table->integer('obc_subcategory')->nullable();
			$table->integer('channel_type')->nullable()->comment('Refered from ori_channels');
			$table->integer('status')->nullable()->comment('1. Completed, 2. Processing');
			$table->integer('created_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::table('ori_campaign_batches', function (Blueprint $table) {
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('ori_campaigns')->onDelete('cascade');
            $table->foreign('survey_id')->references('id')->on('ori_survey_settings')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('ori_users')->onDelete('cascade');
            $table->foreign('channel_type')->references('id')->on('ori_channels')->onDelete('cascade');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cmp_process_batches');
	}

}
