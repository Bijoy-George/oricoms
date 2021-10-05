<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOriFaqsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ori_faqs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->integer('query_type_id')->nullable()->index('query_type_id')->comment('Referred from ori_mast_query_type');
			$table->integer('faq_cat_id')->nullable()->index('faq_cat_id')->comment('Referred from ori_mast_faq_categories');
			$table->string('query_title_lang1')->nullable();
			$table->string('query_title_lang2')->nullable();
			$table->text('question_lang1', 65535)->nullable();
			$table->text('question_lang2', 65535)->nullable();
			$table->text('answer_lang1', 65535)->nullable();
			$table->text('answer_lang2', 65535)->nullable();
			$table->text('answer_lang1_short', 65535)->nullable();
			$table->text('answer_lang2_short', 65535)->nullable();
			$table->text('keywords')->nullable();
			$table->integer('added_from')->nullable()->comment('1:web, 2:web import');
			$table->string('filename', 50)->nullable();
			$table->integer('sort_order')->default(0)->nullable();
			$table->integer('status')->default(1)->comment('1-Active 2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_faqs', function (Blueprint $table) {
			$table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
		});
		Schema::table('ori_faqs', function (Blueprint $table) {
			$table->foreign('query_type_id')->references('id')->on('ori_mast_query_type')->onDelete('cascade');
		});
		Schema::table('ori_faqs', function (Blueprint $table) {
			$table->foreign('faq_cat_id')->references('id')->on('ori_mast_faq_categories')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ori_faqs');
	}

}
