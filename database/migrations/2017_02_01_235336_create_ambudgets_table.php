<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambudgets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('no')->unique(); //申请表编号
            $table->text('summary')->nullable(); //项目名称
            $table->text('syear')->nullable(); //年度
            $table->enum('type',['物资预算','工程预算','服务预算','其他预算']); //类别
            $table->string('unit')->nullable(); //申请部门
            $table->decimal('total')->nullable(); //总金额
            $table->decimal('requester')->nullable(); //申报人
            $table->text('remark')->nullable(); //备注

            $table->timestamps();
        });

        Schema::create('amasbudgets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('asname')->nullable(); //物资名称
            $table->string('aspara')->nullable(); //物资参数
            $table->integer('amt')->nullable(); //数量
            $table->string('meas')->nullable(); //单位
            $table->decimal('price')->nullable(); //申报价格
            $table->decimal('actualprice')->nullable(); //实际价格
            $table->date('purchdate')->nullable(); //采购日期
            $table->string('purchway')->nullable(); //采购方式
            $table->string('purchaser')->nullable(); //采购人 ??????
            $table->string('accountstatus')->nullable(); //报销状态
            $table->boolean('isassets')->nullable(); //是否固定资产
            $table->text('asremark')->nullable(); //是否固定资产

            $table->timestamps();
        });
        Schema::create('amcontrbudgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contrname')->nullable(); //工程名称
            $table->string('contrpicharge')->nullable(); //负责人
            $table->string('contrpicphone')->nullable(); //负责人电话
            $table->string('contraddr')->nullable(); //合同地点
            $table->text('contrworkreq')->nullable(); //工期要求
            $table->decimal('contrprice')->nullable(); //金额
            $table->boolean('isaccept')->nullable(); //验收状态
            $table->text('acceptdt')->nullable(); //验收详情
            $table->text('contrremark')->nullable(); //备注

            $table->timestamps();

        });
        Schema::create('amsvbudgets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('svpicharge')->nullable(); //负责人
            $table->string('svpicphone')->nullable(); //负责人电话
            $table->string('svaddr')->nullable(); //合同地点

            $table->timestamps();
        });
        Schema::create('amotbudgets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('otpicharge')->nullable(); //负责人
            $table->string('otpicphone')->nullable(); //负责人电话
            $table->string('otaddr')->nullable(); //合同地点

            $table->timestamps();
        });

        Schema::create('ambudget_amasbudget', function (Blueprint $table) {
            $table->integer('ambudget_id')->unsigned();
            $table->integer('amasbudget_id')->unsigned();

            $table->foreign('ambudget_id')->references('id')->on('ambudgets')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('amasbudget_id')->references('id')->on('amasbudgets')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['ambudget_id', 'amasbudget_id']);
        });
        Schema::create('ambudget_amcontrbudget', function (Blueprint $table) {
            $table->integer('ambudget_id')->unsigned();
            $table->integer('amcontrbudget_id')->unsigned();

            $table->foreign('ambudget_id')->references('id')->on('ambudgets')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('amcontrbudget_id')->references('id')->on('amcontrbudgets')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['ambudget_id', 'amcontrbudget_id']);
        });
        Schema::create('ambudget_amsvbudget', function (Blueprint $table) {
            $table->integer('ambudget_id')->unsigned();
            $table->integer('amsvbudget_id')->unsigned();

            $table->foreign('ambudget_id')->references('id')->on('ambudgets')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('amsvbudget_id')->references('id')->on('amsvbudgets')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['ambudget_id', 'amsvbudget_id']);
        });
        Schema::create('ambudget_amotbudget', function (Blueprint $table) {
            $table->integer('ambudget_id')->unsigned();
            $table->integer('amotbudget_id')->unsigned();

            $table->foreign('ambudget_id')->references('id')->on('ambudgets')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('amotbudget_id')->references('id')->on('amotbudgets')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['ambudget_id', 'amotbudget_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ambudget_amotbudget');
        Schema::dropIfExists('ambudget_amsvbudget');
        Schema::dropIfExists('ambudget_amcontrbudget');
        Schema::dropIfExists('ambudget_amasbudget');
        Schema::dropIfExists('amotbudgets');
        Schema::dropIfExists('amsvbudgets');
        Schema::dropIfExists('amcontrbudgets');
        Schema::dropIfExists('amasbudgets');
        Schema::dropIfExists('ambudgets');
    }
}
