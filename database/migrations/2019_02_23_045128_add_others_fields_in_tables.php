<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOthersFieldsInTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
		Schema::table('ori_helpdesk', function (Blueprint $table) {
             $table->string('other_category',50)->after('sub_query_category')->nullable();
        });
		Schema::table('ori_helpdesk_log', function (Blueprint $table) {
             $table->string('other_category',50)->after('sub_query_category')->nullable();
        });
		Schema::table('ori_helpdesk', function (Blueprint $table) {
             $table->string('other_subcategory',50)->after('other_category')->nullable();
        });
		Schema::table('ori_helpdesk_log', function (Blueprint $table) {
             $table->string('other_subcategory',50)->after('other_category')->nullable();
        });
		Schema::table('ori_lead_followups', function (Blueprint $table) {
             $table->string('other_category',50)->after('sub_query_category')->nullable();
        });
		Schema::table('ori_lead_followups_log', function (Blueprint $table) {
             $table->string('other_category',50)->after('sub_query_category')->nullable();
        });
		Schema::table('ori_lead_followups', function (Blueprint $table) {
             $table->string('other_subcategory',50)->after('other_category')->nullable();
        });
		Schema::table('ori_lead_followups_log', function (Blueprint $table) {
             $table->string('other_subcategory',50)->after('other_category')->nullable();
        });
		Schema::table('ori_mast_faq_categories', function (Blueprint $table) {
             $table->integer('is_other')->after('sort_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
		Schema::table('ori_helpdesk', function (Blueprint $table) {
            $table->dropColumn('other_category');
        });
		Schema::table('ori_helpdesk', function (Blueprint $table) {
            $table->dropColumn('other_subcategory');
        });
		Schema::table('ori_helpdesk_log', function (Blueprint $table) {
            $table->dropColumn('other_category');
        });
		Schema::table('ori_helpdesk_log', function (Blueprint $table) {
            $table->dropColumn('other_subcategory');
        });
		Schema::table('ori_lead_followups', function (Blueprint $table) {
            $table->dropColumn('other_category');
        });
		Schema::table('ori_lead_followups', function (Blueprint $table) {
            $table->dropColumn('other_subcategory');
        });
		Schema::table('ori_lead_followups_log', function (Blueprint $table) {
            $table->dropColumn('other_category');
        });
		Schema::table('ori_lead_followups_log', function (Blueprint $table) {
            $table->dropColumn('other_subcategory');
        });
		Schema::table('ori_mast_faq_categories', function (Blueprint $table) {
            $table->dropColumn('is_other');
        });
    }
}
