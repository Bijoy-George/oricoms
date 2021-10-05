<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMastFaqCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void2018_10_01_000002_update__mast_faq_category_table
     */
    public function up()
    {
        Schema::table('ori_mast_faq_categories', function (Blueprint $table) {
           $table->integer('type')->default(0)->comment('1 - FAQ, 2 - CALL')->after('status');
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
