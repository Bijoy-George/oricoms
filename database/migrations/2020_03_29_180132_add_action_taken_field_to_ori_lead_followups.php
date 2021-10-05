<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActionTakenFieldToOriLeadFollowups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_lead_followups', function (Blueprint $table) {
            $table->integer('action_taken')->nullable()->comment('Referred from ori_mast_query_actions')->after('customer_nature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_lead_followups', function (Blueprint $table) {
            //
        });
    }
}
