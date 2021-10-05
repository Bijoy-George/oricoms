<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardnoToFollowupHelpdeskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_lead_followups', function (Blueprint $table) {
            $table->string('card_no', 500)->nullable()->after('docket_number');
        });
        Schema::table('ori_lead_followups_log', function (Blueprint $table) {
            $table->string('card_no', 500)->nullable()->after('docket_number');
        });
        Schema::table('ori_helpdesk', function (Blueprint $table) {
            $table->string('card_no', 500)->nullable()->after('docket_number');
        });
        Schema::table('ori_helpdesk_log', function (Blueprint $table) {
            $table->string('card_no', 500)->nullable()->after('docket_number');
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
            $table->dropColumn('card_no');
        });
        Schema::table('ori_lead_followups_log', function (Blueprint $table) {
            $table->dropColumn('card_no');
        }); 
        Schema::table('ori_helpdesk', function (Blueprint $table) {
            $table->dropColumn('card_no');
        });
        Schema::table('ori_helpdesk_log', function (Blueprint $table) {
            $table->dropColumn('card_no');
        });
    }
}
