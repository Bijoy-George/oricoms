<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriGroupContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ori_group_contacts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedInteger('group_id');
            $table->integer('contact_id');
            $table->string('contact_type',50);
            $table->integer('status')->comment('1-Active,2-Inactive');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('group_id')->references('id')->on('ori_groups')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('ori_users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('ori_users')->onDelete('cascade');
            $table->unique(['contact_id','group_id','deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ori_group_contacts');
    }
}
