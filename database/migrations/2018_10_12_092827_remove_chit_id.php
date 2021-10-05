<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveChitId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_helpdesk', function($table) {
             $table->dropColumn('chit_payment_id');
        });
		Schema::table('ori_helpdesk_log', function($table) {
             $table->dropColumn('chit_payment_id');
        });
		Schema::table('ori_lead_followups', function($table) {
             $table->dropColumn('chit_payment_id');
        });
		Schema::table('ori_lead_followups_log', function($table) {
             $table->dropColumn('chit_payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_helpdesk', function($table) {
             $table->addColumn('chit_payment_id');
        });
		Schema::table('ori_helpdesk_log', function($table) {
             $table->addColumn('chit_payment_id');
        });
		Schema::table('ori_lead_followups', function($table) {
             $table->addColumn('chit_payment_id');
        });
		Schema::table('ori_lead_followups_log', function($table) {
             $table->addColumn('chit_payment_id');
        });
    }
}
