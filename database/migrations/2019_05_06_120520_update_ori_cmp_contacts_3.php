<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriCmpContacts3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_cmp_contacts', function (Blueprint $table) {
            $table->string('profile_photo', 50)->nullable()->after('source');
            $table->integer('dnd')->default(0)->after('profile_photo');
            $table->integer('hide_details')->default(0)->after('dnd');
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
