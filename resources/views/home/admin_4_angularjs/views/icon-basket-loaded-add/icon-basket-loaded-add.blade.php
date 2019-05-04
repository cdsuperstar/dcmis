<div class="tabbable" data-ng-controller="iconbasketloadedCtrl">
    <script type="text/ng-template" id="showdetail-material">
        <div class="row">
            <div class ="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 物资列表
                            </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(addMaterialdetail)">
                            </a>
                        </div>
                    </div>
                    <div class="table-toolbar">
                        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> @{{ toggleFilteringsign }} </button>
                        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>
                        <button id="saveData" type="button"  class="btn btn-info" ng-click="confirm( materialgridApi )"><i class="fa fa-check"></i> 选择完成 </button>
                    </div>
                    <div id="iconmaterialgrid" ui-grid="materialgridOptions" ui-grid-selection ui-grid-edit ui-grid-row-edit ui-grid-exporter ui-grid-pagination ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="iconmaterialgrid"></div>
                </div>
            </div>
        </div>
    </script>
    <script type="text/ng-template" id="add-material">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 添加物资
                            </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcaddMaterial)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 物资分类 </label>
                            <div class="col-md-8">
                                <ui-select ng-model="dcaddMaterial.aswzfl" theme="bootstrap" on-select="chanagewzdata()">
                                    <ui-select-match placeholder="选择物资分类...">@{{$select.selected}}</ui-select-match>
                                    <ui-select-choices repeat="twzflarr in wzfl | filter: $select.search">
                                        @{{twzflarr}}
                                    </ui-select-choices>
                                    <ui-select-no-choice>
                                        <font color="red">暂无相关分类信息，请与管理员联系...</font>
                                    </ui-select-no-choice>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" ng-click="ShowmaterialData()" style="cursor:pointer;border-width:1px;border-style:dashed;border-color:#E00D91;" title="点击进入 物资筛选 ！"> <i class="fa fa-search"></i>  物资名称 </label>
                            <div class="col-md-8">
                                <ui-select ng-model="dcaddMaterial.wzno" theme="bootstrap">
                                    <ui-select-match placeholder="选择物资名称...">@{{$select.selected.name}} 【@{{$select.selected.measunit}}】</ui-select-match>
                                    <ui-select-choices repeat="tmparr.no as tmparr in wzgrps | filter: $select.search">
                                        <div ng-bind-html="tmparr.name | highlight: $select.search"></div>
                                        <small>
                                            编号：<span ng-bind-html="tmparr.no | highlight: $select.search"></span><br>
                                            类别：<span ng-bind-html="''+tmparr.class | highlight: $select.search"></span>；
                                            单位：<span ng-bind-html="''+tmparr.measunit | highlight: $select.search"></span>
                                        </small>
                                    </ui-select-choices>
                                    <ui-select-no-choice>
                                        <font color="red">暂无相关物资信息，请与管理员联系...</font>
                                    </ui-select-no-choice>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 规格型号 </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" ng-model="dcaddMaterial.wzsmodel" placeholder="规格型号">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 申报数量 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="number" class="form-control" ng-model="dcaddMaterial.reqamt" placeholder="申报数量">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 预算单价 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="number" class="form-control" ng-model="dcaddMaterial.bdg" placeholder="预算单价">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 备 注 </label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" ng-model="dcaddMaterial.remark" maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="请输入备注（1000字以内）"></textarea>
                            </div>
                        </div>
                        <div class="form-action" align="center">
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn green" ng-click="confirm(dcaddMaterial)" ng-disabled="dcaddMaterialFm.$invalid">
                                    <i class="fa fa-check"></i>  确 认 </a>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn purple-plum" ng-click="closeThisDialog(dcaddMaterial)">
                                    <i class="icon-reload"></i>  取 消  </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END: ACCORDION DEMO -->
            </div>
        </div>
    </script>
    <script type="text/ng-template" id="add-contr">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 添加工程项目 </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcaddContr)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 项目名称 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddContr.name" placeholder="采购内容">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 工期要求 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddContr.req" placeholder="工期要求">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 工程预算 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="number" class="form-control" ng-model="dcaddContr.bdg" placeholder="预算金额">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 工程地点 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddContr.addr" placeholder="地点">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 负责人 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddContr.picharge" placeholder="负责人">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 负责人电话 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddContr.picphone" placeholder="负责人电话">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 备 注 </label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" ng-model="dcaddContr.remark" maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="请输入备注（1000字以内）"></textarea>
                            </div>
                        </div>
                        <div class="form-action" align="center">
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn green" ng-click="confirm(dcaddContr)">
                                    <i class="fa fa-check"></i>  确 认 </a>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn purple-plum" ng-click="closeThisDialog(dcaddContr)">
                                    <i class="icon-reload"></i>  取 消  </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END: ACCORDION DEMO -->
            </div>
        </div>
    </script>
    <script type="text/ng-template" id="add-sv">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 添加服务项目 </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcaddSv)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 服务内容 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddSv.name" placeholder="采购内容">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 服务期限 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddSv.req" placeholder="服务期限">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 预算金额 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="number" class="form-control" ng-model="dcaddSv.bdg" placeholder="预算金额">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 服务地点 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddSv.addr" placeholder="服务地点">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 负责人 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddSv.picharge" placeholder="负责人">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 负责人电话 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddSv.picphone" placeholder="负责人电话">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 备 注 </label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" ng-model="dcaddSv.remark" maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="请输入备注（1000字以内）"></textarea>
                            </div>
                        </div>
                        <div class="form-action" align="center">
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn green" ng-click="confirm(dcaddSv)">
                                    <i class="fa fa-check"></i>  确 认 </a>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn purple-plum" ng-click="closeThisDialog(dcaddSv)">
                                    <i class="icon-reload"></i>  取 消  </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END: ACCORDION DEMO -->
            </div>
        </div>
    </script>
    <script type="text/ng-template" id="add-ot">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 添加其他项目 </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcaddOt)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 采购内容 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddOt.name" placeholder="采购内容">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 其他说明 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddOt.otremark" placeholder="其他说明">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 预算金额 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="number" class="form-control" ng-model="dcaddOt.bdg" placeholder="预算金额">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 地  点 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddOt.addr" placeholder="地点">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 负责人 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddOt.picharge" placeholder="负责人">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 负责人电话 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcaddOt.picphone" placeholder="负责人电话">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 备 注 </label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="3" ng-model="dcaddOt.remark" maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="请输入备注（1000字以内）"></textarea>
                            </div>
                        </div>
                        <div class="form-action" align="center">
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn green" ng-click="confirm(dcaddOt)">
                                    <i class="fa fa-check"></i>  确 认 </a>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn purple-plum" ng-click="closeThisDialog(dcaddOt)">
                                    <i class="icon-reload"></i>  取 消  </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END: ACCORDION DEMO -->
            </div>
        </div>
    </script>
    <form id="fm" class="form-horizontal" role="form">
        <div class="mt-element-step">
            <ul class="nav step-thin">
                <li class="col-md-4 bg-grey mt-step-col active">
                    <a href="" data-target="#basic" data-toggle="tab">
                        <div class="mt-step-number bg-white font-grey">1</div>
                        <div class="mt-step-title uppercase font-grey-cascade"> 基本信息 </div>
                    </a>
                </li>
                <li class="col-md-4 bg-grey mt-step-col">
                    <a href="" data-target="#details" data-toggle="tab" ng-click="changestep()">
                        <div class="mt-step-number bg-white font-grey">2</div>
                        <div class="mt-step-title uppercase font-grey-cascade"> 添加详情 </div>
                    </a>
                </li>
                <li class="col-md-4 bg-grey mt-step-col">
                    <a href="" data-target="#preview" data-toggle="tab" ng-click="stepthrid()">
                        <div class="mt-step-number bg-white font-grey">3</div>
                        <div class="mt-step-title uppercase font-grey-cascade"> 提交申报 </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content" style="margin-top: 15px;">
            <div class="tab-pane active" id="basic">
                {{--年度、部门、申报人（默认为当前用户）--}}
                <div class="form-group">
                    <label class="col-md-2 control-label"> 项目名称 </label>
                    <div class="col-md-10">
                        <div class="input-icon right">
                            <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                            <input type="text" ng-model="basket.name" class="form-control" placeholder="项目名称">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label"> 年  度 </label>
                    <div class="col-md-4">
                        <ui-select ng-model="basket.syear" theme="bootstrap">
                            <ui-select-match placeholder="选择年度...">@{{$select.selected}}</ui-select-match>
                            <ui-select-choices repeat="tmparr in tyear | filter: $select.search">
                                <div ng-bind-html="tmparr | highlight: $select.search"></div>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                    <label class="col-md-2 control-label"> 类  别 </label>
                    <div class="col-md-4">
                        <ui-select ng-model="basket.ambudgettype_id" theme="bootstrap" readonly="Midifysign" ng-disabled="Midifysign" ng-change="dumpimdata()">
                            <ui-select-match placeholder="选择类别...">@{{$select.selected.type}}</ui-select-match>
                            <ui-select-choices
                                    repeat="tmplist.id as tmplist in listnames | filter: $select.search">
                                <div ng-bind-html="tmplist.type | highlight: $select.search"></div>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label"> 部  门 </label>
                    <div class="col-md-4">
                        <ui-select ng-model="basket.unitgrp_id" theme="bootstrap" readonly="true" ng-disabled="true" search-enabled="true">
                            <ui-select-match placeholder="选择部门...">@{{$select.selected.name}}</ui-select-match>
                            <ui-select-choices
                                    repeat="category.id as category in untigrps | filter: $select.search">
                                <div ng-bind-html="category.name | highlight: $select.search"></div>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                    <label class="col-md-2 control-label">申报人</label>
                    <div class="col-md-4">
                        <ui-select ng-model="basket.requester" theme="bootstrap">
                            <ui-select-match placeholder="选择申报人...">@{{$select.selected.name}}</ui-select-match>
                            <ui-select-choices repeat="tmpperson.id as tmpperson in peoplegrps | filter: $select.search">
                                <div ng-bind-html="tmpperson.name | highlight: $select.search"></div>
                                <small ng-bind-html="tmpperson.email | highlight: $select.search"></small>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="details">
                <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-plus"></i> 增加</button>
                <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
                <div class="portlet-body">
                    <div ui-grid="soucegridOptions" ui-grid-exporter ui-grid-pinning ui-grid-importer ui-grid-selection ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="iconbasketloadedgrid"></div>
                </div>
            </div>
            <div class="tab-pane" id="preview">
                <div class="table-scrollable" uib-collapse="isMaterialbudget" id="isMaterialbudget">
                    <table width="800" border="0" style="border-collapse:collapse;" align="center" cellpadding="8px">
                        <tr>
                            <td>编号：<b><font color="red">@{{ basket.no }}</font></b></td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-hover" width="800" border="1" style="border-collapse:collapse;" align="center" cellpadding="8px">
                        <tbody>
                        <tr>
                            <td colspan="3" style="text-align:center;">预算年度</td>
                            <td>@{{ basket.syear }}</td>
                            <td colspan="4" style="text-align:center;">项目名称</td>
                            <td colspan="8">@{{ basket.name }} </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">申请单位</td>
                            <td colspan="7">@{{ listunname }} </td>
                            <td colspan="3" style="text-align:center;">预算类别</td>
                            <td colspan="3">@{{ listtyname }} </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">申请人</td>
                            <td colspan="7">@{{ listusname }}</td>
                            <td colspan="3" style="text-align:center;">申请日期</td>
                            <td colspan="3">@{{ datetimestr }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">序号</td>
                            <td colspan="3" style="text-align:center;">物资编号</td>
                            <td colspan="3" style="text-align:center;">物资名称</td>
                            <td colspan="4" style="text-align:center;">规格、型号</td>
                            <td style="text-align:center;">申报数量</td>
                            <td style="text-align:center;">单位</td>
                            <td style="text-align:center;">预算单价</td>
                            <td style="text-align:center;">小计</td>
                            <td style="text-align:center;">备注</td>
                        </tr>
                        {{--按照物资分类排序--}}
                        <tr ng-repeat="wzdata in imdata">
                            <td style="text-align:center;">@{{ $index+1 }}</td>
                            <td colspan="3">@{{ wzdata.wzno }}</td>
                            <td colspan="3">@{{ wzdata.wzname }}</td>
                            <td colspan="4">@{{ wzdata.wzsmodel }}</td>
                            <td>@{{ wzdata.reqamt }}</td>
                            <td>@{{ wzdata.wzmeasunit }}</td>
                            <td>@{{ wzdata.bdg | currency:'￥'}}</td>
                            <td>@{{ wzdata.amt*wzdata.bdg | currency:'￥' }}</td>
                            <td>@{{ wzdata.remark }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:center;">本次预算金额合计（元）</td>
                            <td colspan="9" style="text-align:center;"> @{{ wztotalimdata | currency:'￥' }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align:center;">年预算总金额（元）</td>
                            <td colspan="6" style="text-align:center;"> @{{ yearbudgettotal | currency:'￥' }}</td>
                            <td colspan="3" style="text-align:center;">累计执行金额（元）</td>
                            <td colspan="4" style="text-align:center;"> @{{ addactrualbudgettotal | currency:'￥' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-scrollable"  uib-collapse="isProjectbudget" id="isProjectbudget">
                    <table width="800" border="0" style="border-collapse:collapse;" align="center" cellpadding="8px">
                        <tr>
                            <td>编号：<b><font color="red">@{{ basket.no }}</font></b></td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-hover" width="800" border="1" style="border-collapse:collapse;" align="center" cellpadding="8px">
                        <tbody>
                        <tr>
                            <td colspan="3" style="text-align:center;">预算年度</td>
                            <td>@{{ basket.syear }}</td>
                            <td colspan="5" style="text-align:center;">项目名称</td>
                            <td colspan="8">@{{ basket.name }} </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">申请单位</td>
                            <td colspan="8">@{{ listunname }} </td>
                            <td colspan="3" style="text-align:center;">预算类别</td>
                            <td colspan="3">@{{ listtyname }} </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">申请人</td>
                            <td colspan="7">@{{ listusname }}</td>
                            <td colspan="3" style="text-align:center;">申请日期</td>
                            <td colspan="4">@{{ datetimestr }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:center;">本次预算金额合计（元）</td>
                            <td colspan="10" style="text-align:center;"> @{{ totalimdata | currency:'￥'}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align:center;">年预算总金额（元）</td>
                            <td colspan="7" style="text-align:center;"> @{{ yearbudgettotal | currency:'￥' }}</td>
                            <td colspan="3" style="text-align:center;">累计执行金额（元）</td>
                            <td colspan="3" style="text-align:center;"> @{{ addactrualbudgettotal | currency:'￥' }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">序号</td>
                            <td colspan="8" style="text-align:center;">工程项目名称</td>
                            <td colspan="4" style="text-align:center;">工期要求</td>
                            <td style="text-align:center;">工程预算</td>
                            <td style="text-align:center;">工程地点</td>
                            <td colspan="1" style="text-align:center;">负责人</td>
                            <td colspan="1" style="text-align:center;">负责人电话</td>
                        </tr>
                        <tr ng-repeat="gcdata in imdata">
                            <td style="text-align:center;">@{{ $index+1 }}</td>
                            <td colspan="8" >@{{ gcdata.name }}</td>
                            <td colspan="4" >@{{ gcdata.req }}</td>
                            <td >@{{ gcdata.bdg | currency:'￥'}}</td>
                            <td >@{{ gcdata.addr }}</td>
                            <td colspan="1" >@{{ gcdata.picharge }}</td>
                            <td colspan="1" >@{{ gcdata.picphone }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-scrollable"  uib-collapse="isServicebudget" id="isServicebudget">
                    <table width="800" border="0" style="border-collapse:collapse;" align="center" cellpadding="8px">
                        <tr>
                            <td>编号：<b><font color="red">@{{ basket.no }}</font></b></td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-hover" width="800" border="1" style="border-collapse:collapse;" align="center" cellpadding="8px">
                        <tbody>
                        <tr>
                            <td colspan="3" style="text-align:center;">预算年度</td>
                            <td>@{{ basket.syear }}</td>
                            <td colspan="5" style="text-align:center;">项目名称</td>
                            <td colspan="8">@{{ basket.name }} </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">申请单位</td>
                            <td colspan="8">@{{ listunname }} </td>
                            <td colspan="3" style="text-align:center;">预算类别</td>
                            <td colspan="3">@{{ listtyname }} </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">申请人</td>
                            <td colspan="7">@{{ listusname }}</td>
                            <td colspan="3" style="text-align:center;">申请日期</td>
                            <td colspan="4">@{{ datetimestr }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:center;">本次预算金额合计（元）</td>
                            <td colspan="10" style="text-align:center;"> @{{ totalimdata | currency:'￥'}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align:center;">年预算总金额（元）</td>
                            <td colspan="7" style="text-align:center;"> @{{ yearbudgettotal | currency:'￥' }}</td>
                            <td colspan="3" style="text-align:center;">累计执行金额（元）</td>
                            <td colspan="3" style="text-align:center;"> @{{ addactrualbudgettotal | currency:'￥' }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">序号</td>
                            <td colspan="8" style="text-align:center;">服务内容</td>
                            <td colspan="4" style="text-align:center;">服务期限</td>
                            <td style="text-align:center;">预算金额</td>
                            <td style="text-align:center;">地点</td>
                            <td colspan="1" style="text-align:center;">负责人</td>
                            <td colspan="1" style="text-align:center;">负责人电话</td>
                        </tr>
                        <tr ng-repeat="fwdata in imdata">
                            <td style="text-align:center;">@{{ $index+1 }}</td>
                            <td colspan="8" >@{{ fwdata.name }}</td>
                            <td colspan="4" >@{{ fwdata.req }}</td>
                            <td >@{{ fwdata.bdg | currency:'￥' }}</td>
                            <td >@{{ fwdata.addr }}</td>
                            <td colspan="1" >@{{ fwdata.picharge }}</td>
                            <td colspan="1" >@{{ fwdata.picphone }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-scrollable"  uib-collapse="isOthersbudget" id="isOthersbudget">
                    <table width="800" border="0" style="border-collapse:collapse;" align="center" cellpadding="8px">
                        <tr>
                            <td>编号：<b><font color="red">@{{ basket.no }}</font></b></td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-hover" width="800" border="1" style="border-collapse:collapse;" align="center" cellpadding="8px">
                        <tbody>
                        <tr>
                            <td colspan="3" style="text-align:center;">预算年度</td>
                            <td>@{{ basket.syear }}</td>
                            <td colspan="5" style="text-align:center;">项目名称</td>
                            <td colspan="8">@{{ basket.name }} </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">申请单位</td>
                            <td colspan="8">@{{ listunname }} </td>
                            <td colspan="3" style="text-align:center;">预算类别</td>
                            <td colspan="3">@{{ listtyname }} </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">申请人</td>
                            <td colspan="7">@{{ listusname }}</td>
                            <td colspan="3" style="text-align:center;">申请日期</td>
                            <td colspan="4">@{{ datetimestr }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" style="text-align:center;">本次预算金额合计（元）</td>
                            <td colspan="10" style="text-align:center;"> @{{ totalimdata | currency:'￥'}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align:center;">年预算总金额（元）</td>
                            <td colspan="7" style="text-align:center;"> @{{ yearbudgettotal | currency:'￥' }}</td>
                            <td colspan="3" style="text-align:center;">累计执行金额（元）</td>
                            <td colspan="3" style="text-align:center;"> @{{ addactrualbudgettotal | currency:'￥' }}</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;">序号</td>
                            <td colspan="8" style="text-align:center;">采购内容</td>
                            <td colspan="4" style="text-align:center;">其他说明</td>
                            <td style="text-align:center;">预算金额</td>
                            <td style="text-align:center;">地点</td>
                            <td colspan="1" style="text-align:center;">负责人</td>
                            <td colspan="1" style="text-align:center;">负责人电话</td>
                        </tr>
                        <tr ng-repeat="qtdata in imdata">
                            <td style="text-align:center;">@{{ $index+1 }}</td>
                            <td colspan="8" >@{{ qtdata.name }}</td>
                            <td colspan="4" >@{{ qtdata.req }}</td>
                            <td >@{{ qtdata.bdg | currency:'￥' }}</td>
                            <td >@{{ qtdata.addr }}</td>
                            <td colspan="1" >@{{ qtdata.picharge }}</td>
                            <td colspan="1" >@{{ qtdata.picphone }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="form-group">
                    <div class="col-md-offset-2 col-md-2 col-sm-4 col-xs-4">
                        <a href="#" ng-click="saveformdata()" ng-show="subsign" class="btn green">
                            <i class="fa fa-check"></i> 提交申报 </a>
                        {{--必须提交申报后 才可以打印--}}
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-4">
                        <a href="#" ng-click="printformdata()" ng-show="printsign" class="btn blue-oleo">
                            <i class="fa fa-print"></i> - 打 印 - </a>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
