<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriCmpContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_cmp_contacts', function(Blueprint $table)
        {
            $table->bigInteger('id', true);
            $table->integer('cmpny_id');
            $table->bigInteger('user_id')->nullable()->comment('Referred from ori_customer_profile');
            $table->string('first_name', 25)->nullable();
            $table->string('middle_name', 25)->nullable();
            $table->string('last_name', 25)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('country_code', 15)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->integer('gender')->nullable()->comment('1-Male,2-Female,3-Transgender');
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->integer('customer_nature')->nullable();
            $table->integer('source')->default(0)->comment('1- crm, 2- bulk upload');
            
            $table->integer('status')->nullable()->comment('1-Active,2-Inactive');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('ori_cmp_contacts', function (Blueprint $table) {
            $table->foreign('cmpny_id')->references('id')->on('ori_company_profiles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('ori_customer_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ori_cmp_contacts');
    }
}
