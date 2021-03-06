<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDcmodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dcmodels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title');
            $table->tinyInteger('ismenu');
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->text('syscfg')->nullable(); //系统配置 json 模板
            $table->text('usercfg')->nullable(); //用户配置 json 模板

            $table->string('templateurl')->nullable();
            $table->text('files')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dcmodels');
    }
}
