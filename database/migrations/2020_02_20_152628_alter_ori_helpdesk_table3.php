<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOriHelpdeskTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_helpdesk', function (Blueprint $table) {
            $table->dateTime('next_service_date')->nullable()->after('service_date');
            $table->string('next_service_type')->nullable()->after('service_type');
            $table->boolean('pick_and_drop')->nullable()->after('insurance_expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_helpdesk', function (Blueprint $table) {
            //
        });
    }
}
