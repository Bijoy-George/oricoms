<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateOriUsersRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
		public function up()
			{
				 Schema::table('ori_roles', function($table) {
					$table->integer('cmpny_id')->after('id')->nullable()->change();

				});

			}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
{
   
}

}
