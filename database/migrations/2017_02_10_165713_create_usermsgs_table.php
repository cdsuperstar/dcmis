<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsermsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usermsgs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sender_id')->unsigned();
            $table->integer('recver_id')->unsigned();
            $table->text('body');
            $table->dateTime('readtime')->nullable();
            $table->dateTime('s_delat')->nullable();
            $table->dateTime('r_delat')->nullable();
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
        Schema::dropIfExists('usermsgs');
    }
}
