<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriNotificationsRolesRelationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_notifications_roles_relations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->integer('user_id')->nullable()->comment('referred from ori_users');
			$table->integer('notification_id')->nullable()->comment('referred fron ori_notifications_list');
			$table->integer('status')->nullable()->comment('2 not viewed , 1 viewed');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_notifications_roles_relations', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		Schema::table('ori_notifications_roles_relations', function (Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('ori_users')->onDelete('cascade');
		});
		Schema::table('ori_notifications_roles_relations', function (Blueprint $table) {
			$table->foreign('notification_id')->references('id')->on('ori_notifications_list')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_notifications_roles_relations');
	}

}
