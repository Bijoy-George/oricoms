<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OriMastTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('ori_mast_templates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cmpny_id')->nullable();
			$table->string('title', 250)->nullable();
			$table->string('subject', 250)->nullable();
			$table->text('content', 65535)->nullable();
			$table->integer('type')->default(0)->comment(' 1- SMS, 2- EMAIL');
			$table->integer('is_show')->default(2)->comment('1- displayed in listing page, 2- Not displayed in listing');
			$table->integer('sort_order')->default(0)->nullable();
			$table->integer('status')->nullable()->comment('1-Active,2-Inactive');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		Schema::table('ori_mast_templates', function (Blueprint $table) {
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
       Schema::drop('ori_mast_templates');
    }
}
