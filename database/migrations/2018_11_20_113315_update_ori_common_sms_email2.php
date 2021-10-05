<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriCommonSmsEmail2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_common_sms_email', function (Blueprint $table) {
            $table->integer('communication_type')->nullable()->after('sms_type')->comment('1 - Notificational, 2 - Promotional, 3 - Transactional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_common_sms_email', function (Blueprint $table) {
            //
        });
    }
}
