<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsFaqCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_mast_faq_categories', function (Blueprint $table) {
            $table->string('slug', 500)->nullable()->comment('additional fields')->after('category_name');
            $table->string('short_code', 500)->nullable()->comment('additional fields')->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_mast_faq_categories', function (Blueprint $table) {
			$table->dropColumn('slug');
			$table->dropColumn('short_code');
        });
    }
}
