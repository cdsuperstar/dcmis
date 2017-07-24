<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userprofiles', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('no')->nullable()->unique();
            $table->string('name')->nullable();
            $table->string('sex', 1)->nullable();
            $table->string('phone')->nullable();
            $table->date('birth')->nullable();
            $table->string('tel')->nullable();
            $table->string('address')->nullable();
            $table->string('duties')->nullable();//职务
            $table->integer('unitid')->unsigned(); //部门
            $table->string('signpic')->nullable();
            $table->text('memo')->nullable();

            $table->primary('id');

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
        Schema::dropIfExists('userprofiles');
    }
}
