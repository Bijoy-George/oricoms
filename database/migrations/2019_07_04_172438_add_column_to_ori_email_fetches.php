<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToOriEmailFetches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_email_fetchs', function (Blueprint $table) {$table->string('to', 500)->nullable()->after('from_name');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_email_fetchs', function (Blueprint $table) {
            $table->dropColumn('to');
        });
    }
}
