<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriMastPackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_mast_package', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('package_name', 100)->nullable();
			$table->integer('package_type')->nullable();
			$table->text('permission_under_package', 65535)->nullable();
			$table->integer('status')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by');
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_mast_package', function (Blueprint $table) {
			$table->foreign('package_type')->references('id')->on('ori_mast_plans')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_mast_package');
	}

}
