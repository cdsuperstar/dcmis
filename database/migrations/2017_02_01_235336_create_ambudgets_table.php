<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAmbudgetsTable
 */
class CreateAmbudgetsTable extends Migration
{
    /**
     * Run the migrations.
     * 预算系列表
     *
     * @return void
     */
    public function up()
    {

        /**
         * 预算类别表
         *
         */
        Schema::create('ambudgettypes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('no')->unique(); //编号
            $table->string('type'); //类别
            $table->string('spell'); //简拼
            $table->string('template'); //模板

            $table->timestamps();
        });

        /**
         * 预算设置表
         */
        Schema::create('ambudgets', function (Blueprint $table) {
            $table->increments('id');

//            $table->string('no')->unique(); //申请表编号9
//            $table->text('summary')->nullable(); //项目名称
            $table->string('syear'); //年度
            $table->integer('type'); //类别ID
            $table->integer('unit'); //申请部门
            $table->decimal('total',10,2); //总金额
//            $table->decimal('requester')->nullable(); //申报人
//            $table->decimal('urchasingstatus')->nullable(); //采购状态
            $table->text('remark')->nullable(); //备注

            $table->unique(['syear','unit','type']);

            $table->timestamps();
        });

        /**
         * 供应商资料表
         */
        Schema::create('amsuppliers', function (Blueprint $table) {
            $table->increments('id');

            $table->text('compname'); //公司名
            $table->string('principal')->nullable(); //负责人
            $table->string('contacter'); //联络人
            $table->string('tel')->nullable(); //固定电话
            $table->string('phone'); //联系电话
            $table->string('compaddr')->nullable(); //公司地址
            $table->text('remark')->nullable(); //备注

            $table->timestamps();
        });

        /**
         * 基础物资表
         */
        Schema::create('ambaseass', function (Blueprint $table) {
            $table->increments('id');

            $table->string('class'); //物资分类
            $table->string('no'); //物资编号
            $table->string('name'); //物资名称
            $table->string('measunit'); //单位
            $table->string('spell'); //简拼

            $table->timestamps();
        });

        /**
         * 采购申请表
         */
        Schema::create('amapplications', function (Blueprint $table) {
            $table->increments('id');

            $table->string('syear'); //年度
            $table->integer('unitgrp_id'); //申请部门
            $table->integer('requester')->unsigned(); //申请人

            $table->string('no')->unique(); //项目编号
            $table->string('name'); //项目名称
            $table->integer('ambudgettype_id'); //预算类别
            $table->string('appstate')->nullable(); //审批状态
            $table->integer('apper')->nullable(); //审批人
            $table->dateTime('appdate')->nullable(); //审批时间
            $table->string('progress')->nullable(); //采购进度
            $table->string('isterm')->nullable(); //是否终止
            $table->text('termreason')->nullable(); //终止原因


            $table->timestamps();
        });

        /**
         * 采购表子表
         */
        Schema::create('amsubbudgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amapplication_id'); //采购申请表id

            $table->string('name')->nullable(); //工程名称
            $table->text('req')->nullable(); //工程要求 其他要求 otremark
            $table->text('addr')->nullable(); //工程地点
            $table->string('picharge')->nullable(); //负责人
            $table->string('picphone')->nullable(); //负责人电话

            $table->string('wzno')->nullable(); //物资编号
            $table->string('wzsmodel')->nullable(); //规格型号
            $table->integer('amt')->nullable()->default(1); //实际数量
            $table->integer('reqamt')->nullable(); //申报数量
            $table->decimal('bdg')->nullable(); //预算单价
            $table->decimal('price')->nullable(); //采购单价
            $table->string('purchway')->nullable(); //采购方式
            $table->string('purchstate')->nullable(); //采购状态
            $table->dateTime('purchdate'); //采购日期


            $table->string('reimstate')->nullable(); //报销状态
            $table->string('contrno')->nullable(); //合同编号
            $table->integer('amsupplier_id')->nullable(); //供应商编号
            $table->string('asstate')->nullable(); //物资状态

            $table->integer('regamt')->nullable(); //库存数量
            $table->integer('scrapamt')->nullable(); //报废数量


            $table->decimal('total',10,2)->nullable(); //合计金额
            $table->text('remark')->nullable(); //备注
            $table->foreign('amapplication_id')->references('id')->on('amapplications')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });

        /**
         * 资产登记表
         */
        Schema::create('amassregs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('amsubbudget_id'); //物资id

            $table->integer('amt'); //数量
            $table->integer('asuser'); //领用人
            $table->integer('unitgrp_id')->nullable(); //领用单位
            $table->dateTime('userdate'); //领用时间
            $table->dateTime('validdate')->nullable(); //有效期
            $table->string('state')->nullable(); //物资状态
            $table->string('outbound')->nullable(); //出库单号

            $table->text('remark')->nullable(); //备注

            $table->integer('scrapuser')->nullable(); //报废人
            $table->dateTime('scrapdate')->nullable(); //报废日期

            $table->text('scrapremark')->nullable(); //备注

            $table->foreign('amsubbudget_id')->references('id')->on('amsubbudgets')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });

//        Schema::create('ambudget_amotbudget', function (Blueprint $table) {
//            $table->integer('ambudget_id')->unsigned();
//            $table->integer('amotbudget_id')->unsigned();
//
//            $table->foreign('ambudget_id')->references('id')->on('ambudgets')
//                ->onUpdate('cascade')->onDelete('cascade');
//            $table->foreign('amotbudget_id')->references('id')->on('amotbudgets')
//                ->onUpdate('cascade')->onDelete('cascade');
//
//            $table->primary(['ambudget_id', 'amotbudget_id']);
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amassregs');
        Schema::dropIfExists('amsubbudgets');

        Schema::dropIfExists('amapplications');
        Schema::dropIfExists('ambaseass');
        Schema::dropIfExists('amsuppliers');
        Schema::dropIfExists('ambudgets');
        Schema::dropIfExists('ambudgettypes');
    }
}
