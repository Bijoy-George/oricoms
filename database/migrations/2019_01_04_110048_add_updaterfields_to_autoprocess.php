<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdaterfieldsToAutoprocess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
		Schema::table('ori_automated_process_batch', function (Blueprint $table) {
         $table->integer('created_by')->nullable()->after('action_time');
		 $table->integer('updated_by')->nullable()->after('created_by');
		});
		Schema::table('ori_automated_process_batch_expiry', function (Blueprint $table) {
         $table->integer('created_by')->nullable()->after('action_expiry_time');
		 $table->integer('updated_by')->nullable()->after('created_by');
		});
		Schema::table('ori_automated_process_log', function (Blueprint $table) {
         $table->integer('created_by')->nullable()->after('security_info');
		 $table->integer('updated_by')->nullable()->after('created_by');
		});
		Schema::table('ori_automated_process_relations', function (Blueprint $table) {
         $table->integer('created_by')->nullable()->after('security_info');
		 $table->integer('updated_by')->nullable()->after('created_by');
		});
		Schema::table('ori_automated_process_stages', function (Blueprint $table) {
         $table->integer('created_by')->nullable()->after('stage_name');
		 $table->integer('updated_by')->nullable()->after('created_by');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
		Schema::table('ori_automated_process_batch', function (Blueprint $table) {
         $table->dropColumn('created_by');
		 $table->dropColumn('updated_by');
		});
		Schema::table('ori_automated_process_batch_expiry', function (Blueprint $table) {
         $table->dropColumn('created_by');
		 $table->dropColumn('updated_by');
		});
		Schema::table('ori_automated_process_log', function (Blueprint $table) {
         $table->dropColumn('created_by');
		 $table->dropColumn('updated_by');
		});
		Schema::table('ori_automated_process_relations', function (Blueprint $table) {
         $table->dropColumn('created_by');
		 $table->dropColumn('updated_by');
		});
		Schema::table('ori_automated_process_stages', function (Blueprint $table) {
         $table->dropColumn('created_by');
		 $table->dropColumn('updated_by');
		});
    }
}
