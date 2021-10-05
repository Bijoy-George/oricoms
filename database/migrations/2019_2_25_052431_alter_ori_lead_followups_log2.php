<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterOriLeadFollowupsLog2 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_lead_followups_log', function (Blueprint $table) {
          
           $table->integer('supply_card')->nullable()->after('priority');
           $table->foreign('supply_card')->references('id')->on('ori_mast_supply_cards')->onDelete('cascade');
          
        });

		
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_lead_followups_log', function (Blueprint $table) {
            $table->dropColumn('supply_card');
            
        });
	}

}
