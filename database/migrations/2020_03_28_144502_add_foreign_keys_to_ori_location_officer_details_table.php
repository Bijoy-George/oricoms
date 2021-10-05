<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriLocationOfficerDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_location_officer_details', function(Blueprint $table)
		{
			$table->foreign('location_id', 'ori_location_officer_details_ibfk_1')->references('id')->on('ori_location_settings')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('cmpny_id', 'ori_location_officer_details_ibfk_2')->references('id')->on('ori_company_profiles')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('designation', 'ori_location_officer_details_ibfk_3')->references('id')->on('ori_mast_designations')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_location_officer_details', function(Blueprint $table)
		{
			$table->dropForeign('ori_location_officer_details_ibfk_1');
			$table->dropForeign('ori_location_officer_details_ibfk_2');
			$table->dropForeign('ori_location_officer_details_ibfk_3');
		});
	}

}
