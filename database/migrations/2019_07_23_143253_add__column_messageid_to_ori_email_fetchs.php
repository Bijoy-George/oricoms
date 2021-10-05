<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnMessageidToOriEmailFetchs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         Schema::table('ori_email_fetchs', function (Blueprint $table) {$table->string('message_id', 255)->nullable()->after('thread_id');
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
            $table->dropColumn('message_id');
        });
    }
}
