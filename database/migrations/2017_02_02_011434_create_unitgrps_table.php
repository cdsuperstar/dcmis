<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitgrpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unitgrps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->index();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();
            $table->string('name'); //单位名称
            $table->text('brief')->nullable(); //单位介绍

            $table->timestamps();
        });

        Schema::create('unitgrp_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('unitgrp_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unitgrp_id')->references('id')->on('unitgrps')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'unitgrp_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unitgrp_user');
        Schema::dropIfExists('unitgrps');
    }
}
