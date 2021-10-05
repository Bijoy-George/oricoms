<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriBatchProcessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_batch_process', function(Blueprint $table)
		{
			$table->integer('id', true);
            $table->integer('cmpny_id');
			$table->integer('process_type')->default(0)->comment('Referred from batch process types section in constants file');
			$table->text('searched_criteria')->nullable()->comment('Serialized json containing search criteria data');
			$table->text('exclude_list')->nullable()->comment('Comma separated list of contact ids to be excluded');
			$table->integer('target_count')->default(0);
			$table->integer('processed_count')->default(0);
			$table->integer('last_processed_id')->default(0);
			$table->integer('group_id')->nullable()->unsigned();
			$table->string('file_name', 50)->nullable();
			$table->integer('status')->nullable()->comment('1-Active,2-Processing');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('ori_groups')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('ori_users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('ori_users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cc_common_batch_process');
	}

}
