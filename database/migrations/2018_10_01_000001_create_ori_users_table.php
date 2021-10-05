<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id');
			$table->string('name', 50);
			$table->string('email', 50)->unique();
			$table->string('username', 50)->unique();
			$table->string('chat_name', 50)->nullable();
			$table->string('phone', 20)->nullable();
			$table->string('address')->nullable();
			$table->string('password');
			$table->string('extension', 10)->nullable();
			$table->integer('role_id')->index('role_id')->comment('Referred from ori_roles');
			$table->string('remember_token', 300)->nullable();
			$table->text('access_permission')->nullable();
			$table->integer('logged_in')->nullable();
			$table->text('session_id', 65535)->nullable();
			$table->dateTime('last_logged_in_at')->nullable();
			$table->dateTime('chat_login_time')->nullable();
			$table->integer('current_chat_count')->nullable();
			$table->integer('chat_flag')->nullable();
			$table->integer('status')->comment('1-Active 2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_users', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_users');
	}

}
