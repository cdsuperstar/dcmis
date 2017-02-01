<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmassetsregsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amassetsregs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('asname')->nullable(); //物资名称
            $table->string('asclass')->nullable(); //物资类别
            $table->string('aspara')->nullable(); //物资参数
            $table->integer('amt')->nullable(); //数量
            $table->string('receiver')->nullable(); //领用人 ?????????
            $table->string('meas')->nullable(); //单位
            $table->date('recdate')->nullable(); //领用日期
            $table->date('validdate')->nullable(); //有效期
            $table->date('asstate')->nullable(); //物质状态
            $table->date('scraper')->nullable(); //报废人 ???????????
            $table->date('scrapdate')->nullable(); //报废日期
            $table->date('remark')->nullable(); //备注

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
        Schema::dropIfExists('amassetsregs');
    }
}
