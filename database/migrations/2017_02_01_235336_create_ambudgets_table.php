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
            $table->enum('type',['物资预算','工程预算','服务预算','其他预算']); //预算类别
            $table->string('no')->unique(); //申请表编号
            $table->string('unit')->nullable(); //申请部门
            $table->string('requester')->nullable(); //申请人     ??????
            $table->date('reqdate')->nullable(); //申请日期
            $table->text('summary')->nullable(); //摘要
            $table->decimal('total')->nullable(); //总金额
            $table->boolean('isappr')->nullable(); //审批通过
            $table->boolean('isdone')->nullable(); //是否执行完毕
            $table->boolean('isabort')->nullable(); //是否终止执行
            $table->text('abortsum')->nullable(); //终止执行原因
            $table->text('remark')->nullable(); //备注

            $table->string('asname')->nullable(); //物资名称
            $table->string('aspara')->nullable(); //物资参数
            $table->integer('amt')->nullable(); //数量
            $table->string('meas')->nullable(); //单位
            $table->decimal('price')->nullable(); //金额
            $table->date('purchdate')->nullable(); //采购日期
            $table->string('purchway')->nullable(); //采购方式
            $table->string('purchaser')->nullable(); //采购人 ??????
            $table->boolean('isassets')->nullable(); //是否固定资产

            $table->string('contrname')->nullable(); //合同名称
            $table->string('paymentp')->nullable(); //付款用途
            $table->decimal('contrprice')->nullable(); //合同金额
            $table->string('contrno')->nullable(); //合同编号
            $table->string('payee')->nullable(); //收款单位
            $table->string('payeebank')->nullable(); //收款单位开户行
            $table->string('bankacc')->nullable(); //银行帐号
            $table->decimal('contralterp')->nullable(); //合同变更（金额）
            $table->decimal('sumpay')->nullable(); //累计付款（不含本次付款） ???????
            $table->decimal('thepay')->nullable(); //本次付款
            $table->boolean('isaccept')->nullable(); //是否验收
            $table->text('acceptdt')->nullable(); //验收详情

            $table->text('itemname')->nullable(); //事项名称

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
        Schema::dropIfExists('ambudgets');
    }
}
