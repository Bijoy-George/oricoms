<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOriGroupContacts3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ori_group_contacts', function (Blueprint $table) {
            $table->dropUnique('contact_group_unique');
            $table->dropColumn('contact_type');
            $table->unique(['contact_id', 'group_id', 'deleted_at'], 'contact_group_unique');
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
            $table->dropUnique('ori_group_contacts_contact_id_group_id_deleted_at_unique');
            $table->string('contact_type',50);
            $table->unique(['contact_id','contact_type','group_id','deleted_at'], 'contact_group_unique');
        });
    }
}
