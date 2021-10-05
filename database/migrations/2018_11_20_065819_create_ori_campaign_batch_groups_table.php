<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriCampaignBatchGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_campaign_batch_groups', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('cmpny_id');
            $table->integer('batch_id')->comment('Referred from ori_campaign_batches');
            $table->integer('group_id')->unsigned()->comment('Referred from ori_groups');
            $table->integer('status')->comment('1-Active,2-Inactive');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ori_campaign_batch_groups', function (Blueprint $table) {
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('ori_campaign_batches')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('ori_groups')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('ori_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_campaign_batch_groups', function (Blueprint $table) {
            //
        });
    }
}
