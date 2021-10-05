<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupplyOfficeToFollowupHelpdeskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_lead_followups', function (Blueprint $table) {
            $table->string('district_supply_office', 500)->nullable()->after('docket_number');
            $table->string('taluk_supply_office', 500)->nullable()->after('district_supply_office');
        });
        Schema::table('ori_lead_followups_log', function (Blueprint $table) {
            $table->string('district_supply_office', 500)->nullable()->after('docket_number');
            $table->string('taluk_supply_office', 500)->nullable()->after('district_supply_office');
        });
        Schema::table('ori_helpdesk', function (Blueprint $table) {
            $table->string('district_supply_office', 500)->nullable()->after('docket_number');
            $table->string('taluk_supply_office', 500)->nullable()->after('district_supply_office');
        });
        Schema::table('ori_helpdesk_log', function (Blueprint $table) {
            $table->string('district_supply_office', 500)->nullable()->after('docket_number');
            $table->string('taluk_supply_office', 500)->nullable()->after('district_supply_office');
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
            $table->dropColumn('district_supply_office');
            $table->dropColumn('taluk_supply_office');
        });
        Schema::table('ori_lead_followups_log', function (Blueprint $table) {
            $table->dropColumn('district_supply_office');
            $table->dropColumn('taluk_supply_office');
        }); 
        Schema::table('ori_helpdesk', function (Blueprint $table) {
            $table->dropColumn('district_supply_office');
            $table->dropColumn('taluk_supply_office');
        });
        Schema::table('ori_helpdesk_log', function (Blueprint $table) {
            $table->dropColumn('district_supply_office');
            $table->dropColumn('taluk_supply_office');
        });
    }
}
