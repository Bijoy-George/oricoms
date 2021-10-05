<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOriProfileFieldOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ori_profile_field_options', function(Blueprint $table)
		{
			$table->foreign('cmpny_id', 'ori_profile_field_options_ibfk_1')->references('id')->on('ori_company_profiles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('field_id', 'ori_profile_field_options_ibfk_2')->references('id')->on('ori_customer_profile_fields')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ori_profile_field_options', function(Blueprint $table)
		{
			$table->dropForeign('ori_profile_field_options_ibfk_1');
			$table->dropForeign('ori_profile_field_options_ibfk_2');
		});
	}

}
