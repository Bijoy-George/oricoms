<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCommonSmsEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_common_sms_email', function (Blueprint $table) {
            $table->integer('encoding_type')->nullable()->after('communication_type');
			$table->integer('communication_gateway')->nullable()->after('encoding_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_common_sms_email', function($table) {
        $table->dropColumn('encoding_type');
		$table->dropColumn('communication_gateway');
		});
    }
}
