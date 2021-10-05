<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriCampaignBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_campaign_batches', function (Blueprint $table) {
            $table->integer('updated_by')->nullable()->after('created_by');
        });

        Schema::table('ori_campaign_batches', function (Blueprint $table) {
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
        Schema::table('ori_campaign_batches', function (Blueprint $table) {
            //
        });
    }
}
