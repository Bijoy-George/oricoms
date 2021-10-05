<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriMastSupplyCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_mast_supply_cards', function(Blueprint $table)
		{
			$table->foreign('cmpny_id', 'ori_mast_supply_cards_ibfk_1')->references('id')->on('ori_company_profiles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_mast_supply_cards', function(Blueprint $table)
		{
			$table->dropForeign('ori_mast_supply_cards_ibfk_1');
		});
	}

}
