<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriGroupContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_group_contacts', function (Blueprint $table) {
            $table->integer('cmpny_id')->after('id');
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ori_group_contacts', function (Blueprint $table) {
            $table->dropForeign('ori_group_contacts_cmpny_id_foreign');
            $table->dropColumn('cmpny_id');
        });
    }
}
