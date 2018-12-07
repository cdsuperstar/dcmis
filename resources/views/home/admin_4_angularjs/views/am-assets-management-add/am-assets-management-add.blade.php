<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="amassetmangementaddCtrl">
    <script type="text/ng-template" id="assets-managementadd">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 登记领用信息 </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 领用人 </label>
                            <div class="col-md-8">
                                <ui-select ng-model="dcEdition.asuser" theme="bootstrap">
                                    <ui-select-match placeholder="选择领用人...">@{{$select.selected.name}}</ui-select-match>
                                    <ui-select-choices repeat="tmpperson.id as tmpperson in peoplegrps | filter: $select.search">
                                        <div ng-bind-html="tmpperson.name | highlight: $select.search"></div>
                                        <small ng-bind-html="tmpperson.email | highlight: $select.search"></small>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 领用部门 </label>
                            <div class="col-md-8">
                                <ui-select ng-model="dcEdition.unitgrp_id" theme="bootstrap">
                                    <ui-select-match placeholder="选择部门...">@{{$select.selected.name}}</ui-select-match>
                                    <ui-select-choices
                                            repeat="category.id as category in untigrps | filter: $select.search">
                                        <div ng-bind-html="category.name | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 领用数量 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="number" class="form-control" ng-model="dcEdition.amt" placeholder="可领用数量: @{{ souceamttoal }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 有效期 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <input type="date" class="form-control" ng-model="dcEdition.validdate" placeholder="有效期">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 备 注 </label>
                            <div class="col-md-8">
                                <textarea ng-model="dcEdition.remark" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写备注内容（1000字以内）"></textarea>
                            </div>
                        </div>
                        <div class="form-action" align="center">
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn green" ng-click="confirm(dcEdition)" ng-disabled="dcEditionFm.$invalid">
                                    <i class="fa fa-check"></i>  确 认 </a>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn purple-plum" ng-click="closeThisDialog(dcEdition)">
                                    <i class="icon-reload"></i>  取 消  </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END: ACCORDION DEMO -->
            </div>
        </div>
    </script>
    <script type="text/ng-template" id="asset-load-list">
        <div class="row">
            <div class ="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-youtube font-red-thunderbird"></i>
                            <span class="caption-subject font-red-thunderbird sbold">物资领取登记（剩余数量：【@{{ souceamttoal }}】编号：@{{tmpobjno}}&nbsp;   物资名称：@{{ tmpobjname }}）</span>
                        </div>
                        <div class="tools">
                            {{--<a href="" class="fullscreen" data-original-title="全屏" title="全屏"> </a>--}}
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)" data-original-title="关闭" title="关闭">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <button id="addData" type="button" class="btn btn-success" ng-click="addbranchData()"><i class="fa fa-pencil"></i> 登记领用信息 </button>
                            <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些领用数据吗？" ng-click="delbranchData()"><i class="fa fa-trash"></i> 删除领用信息</button>
                            <button id="saveData" type="button"  class="btn btn-info" ng-click="editbranchData()"><i class="fa fa-check"></i> 保存数据 </button>
                            <button id='toggleFiltering' type="button"class="btn yellow" ng-click="togglebranchFiltering()" ><i class="fa fa-search"></i> @{{ toggleFilteringsign }} </button>

                        </div>
                            {{--<div class="btn-group btn-group-solid pull-right">--}}
                            {{--<button type="button" class="btn green-meadow"><i class="fa fa-file-excel-o"> </i>  导出数据  </button>--}}
                            {{--</div>--}}
                        </div>
                        <div id="assetssouceplangrid" ui-grid="soucegridOptions" ui-grid-selection ui-grid-edit ui-grid-row-edit ui-grid-exporter ui-grid-pagination ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="assetssouceplangrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <div class="table-toolbar">

        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> @{{ toggleFilteringsign }} </button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据 </button>
        <div class="btn-group btn-group-solid pull-right">
            <button id="refreshButton" type="button"  class="btn green-meadow" ng-click="exportxls()"><i class="fa fa-file-excel-o"> </i>  导出Excel</button>
        </div>
    </div>
    <div id="amassetmangementaddgrid" ui-grid="gridOptions" ui-grid-pinning ui-grid-exporter ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="amassetmangementaddgrid"></div>
    {{--<button id="saveData" type="button"  class="btn btn-primary" ng-click="editData()"><i class="fa fa-check"></i> 保存数据 </button>--}}
    {{--<div class="btn-group btn-group-solid">--}}
        {{--<button type="button" id="icon-basketset" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i> 采购方式  <i class="fa fa-angle-down"></i>--}}
        {{--</button>--}}
        {{--<ul class="dropdown-menu" >--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchway','取消采购')"> 采购方式【取消采购】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchway','自行采购')"> 采购方式【自行采购】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchway','询价采购')"> 采购方式【询价采购】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchway','定点采购')"> 采购方式【定点采购】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchway','公开招标')"> 采购方式【公开招标】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchway','邀请招标')"> 采购方式【邀请招标】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchway','竞争性谈判')"> 采购方式【竞争性谈判】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchway','单一来源采购')"> 采购方式【单一来源采购】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchway','协议供货采购')"> 采购方式【协议供货采购】 </a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="btn-group btn-group-solid">--}}
        {{--<button type="button" id="icon-basketset" class="btn btn-info dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tags"></i> 状态标记  <i class="fa fa-angle-down"></i>--}}
        {{--</button>--}}
        {{--<ul class="dropdown-menu" >--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchstate','已采购')"> 采购状态【已采购】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('purchstate','未采购')"> 采购状态【未采购】 </a>--}}
            {{--</li>--}}
            {{--<li class="divider"> </li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('reimstate','已报销')"> 报销状态【已报销】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('reimstate','未报销')"> 报销状态【未报销】 </a>--}}
            {{--</li>--}}
            {{--<li class="divider"> </li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('asstate','固定资产')"> 物资状态【固定资产】 </a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="javascript:;" ng-click="changeStatus('asstate','非固定资产')"> 物资状态【非固定资产】 </a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    {{--<div id="amassetmangementaddgrid" ui-grid="gridOptions"  ui-grid-edit ui-grid-row-edit ui-grid-pinning ui-grid-exporter ui-grid-selection ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="amassetmangementaddgrid"></div>--}}
</div>