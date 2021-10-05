<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkToOriIntimation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_notifications_list', function (Blueprint $table) {
         $table->string('link',250)->nullable()->after('role');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_notifications_list', function (Blueprint $table) {
         $table->dropColumn('link');
		});
    }
}
