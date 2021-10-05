<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriCmpContactsMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_cmp_contacts_meta', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->integer('cmpny_id');
            $table->bigInteger('contact_id')->comment('Referred from ori_cmp_contacts');
            $table->string('field_name', 25)->nullable();
            $table->string('value', 500)->nullable();
            $table->bigInteger('field_id')->nullable()->comment('Referred from profile_field');
            $table->integer('sort_order')->nullable();
            $table->integer('status')->nullable()->comment('1-Active,2-Inactive');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('ori_cmp_contacts_meta', function (Blueprint $table) {
            $table->foreign('field_id')->references('id')->on('ori_customer_profile_fields')->onDelete('cascade');
        });
        Schema::table('ori_cmp_contacts_meta', function (Blueprint $table) {
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
        });
        Schema::table('ori_cmp_contacts_meta', function (Blueprint $table) {
            $table->foreign('contact_id')->references('id')->on('ori_cmp_contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ori_cmp_contacts_meta');
    }
}
