<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriCampaignBatchesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_campaign_batches', function (Blueprint $table) {
            $table->integer('campaign_type')->nullable()->after('campaign_id')->comment('1 - Notificational, 2 - Promotional, 3 - Transactional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
