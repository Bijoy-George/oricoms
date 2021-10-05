<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateOriHelpdeskLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
		public function up()
			{
				 Schema::table('ori_helpdesk_log', function (Blueprint $table) {
	            $table->bigInteger('feedback_id')->nullable()->after('assigned_agent');
	            $table->foreign('feedback_id')->references('id')->on('ori_fb_details')->onDelete('cascade');
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
