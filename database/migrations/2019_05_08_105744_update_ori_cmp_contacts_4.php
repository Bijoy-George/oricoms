<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriCmpContacts4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_cmp_contacts', function (Blueprint $table) {
            $table->integer('profile_status')->nullable()->after('hide_details')->comment('1- lead, 2- customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_cmp_contacts', function (Blueprint $table) {
            //
        });
    }
}
