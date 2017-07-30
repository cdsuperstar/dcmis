<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dcmatters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dcmatters', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('suser_id')->unsigned();
            $table->integer('ruser_id')->unsigned();
            $table->string('title');
            $table->string('content')->nullable();
            $table->date('enddate');
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
        //
        Schema::dropIfExists('dcmatters');

    }
}
