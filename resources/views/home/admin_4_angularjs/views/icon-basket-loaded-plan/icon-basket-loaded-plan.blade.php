<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="iconbasketloadplanCtrl">
    <script type="text/ng-template" id="baket-load-plan">
        <div class="row">
            <div class ="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-youtube font-red-thunderbird"></i>
                            <span class="caption-subject font-red-thunderbird sbold">采购项目详细（编号：@{{tmpobjdata.no}}&nbsp;）</span>
                        </div>
                        <div class="tools">
                            {{--<a href="" class="fullscreen" data-original-title="全屏" title="全屏"> </a>--}}
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)" data-original-title="关闭" title="关闭">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存数据 </button>
                            <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 数据查询</button>
                            <div class="btn-group btn-group-solid">
                                <button type="button" id="icon-basketset" class="btn green-seagreen dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i> 采购方式  <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" >
                                    <li>
                                        <a href="javascript:;"> 采购方式【取消采购】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 采购方式【自行采购】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 采购方式【询价采购】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 采购方式【定点采购】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 采购方式【公开招标】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 采购方式【邀请招标】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 采购方式【竞争性谈判】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 采购方式【单一来源采购】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 采购方式【协议供货采购】 </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="btn-group btn-group-solid">
                                <button type="button" id="icon-basketset" class="btn blue-madison dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tags"></i> 状态标记  <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" >
                                    <li>
                                        <a href="javascript:;"> 采购状态【已采购】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 采购状态【未采购】 </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> 报销状态【已报销】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 报销状态【未报销】 </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> 物资状态【固定资产】 </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> 物资状态【非固定资产】 </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="btn-group btn-group-solid pull-right">
                                <button type="button" class="btn green-meadow"><i class="fa fa-file-excel-o"> </i>  导出数据  </button>
                            </div>

                        </div>
                        <div id="soucegrid" ui-grid="soucegridOptions" ui-grid-selection ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="iconbaketsoucelistgrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </script>
    <form id="fm" class="form-horizontal" role="form">
        <div class="table-toolbar">
                <div class="form-group">
                    <label class="col-md-1 control-label"> 年  度 </label>
                    <div class="col-md-2">
                        <ui-select ng-model="basket.syear" theme="bootstrap">
                            <ui-select-match placeholder="选择年度...">@{{$select.selected}}</ui-select-match>
                            <ui-select-choices repeat="tmparr in tyear | filter: $select.search">
                                <div ng-bind-html="tmparr | highlight: $select.search"></div>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                    <label class="col-md-1 control-label"> 类  别 </label>
                    <div class="col-md-2">
                        <ui-select ng-model="basket.type" theme="bootstrap">
                            <ui-select-match placeholder="选择类别...">@{{$select.selected.label}}</ui-select-match>
                            <ui-select-choices
                                    repeat="tmplist.value as tmplist in listnames track by tmplist.value">
                                @{{tmplist.label}}
                            </ui-select-choices>
                        </ui-select>
                    </div>
                    <label class="col-md-1 control-label">申报人</label>
                    <div class="col-md-2">
                        <ui-select ng-model="basket.requester" theme="bootstrap">
                            <ui-select-match placeholder="选择申报人...">@{{$select.selected.name}}</ui-select-match>
                            <ui-select-choices repeat="tmpperson.id as tmpperson in peoplegrps | filter: $select.search">
                                <div ng-bind-html="tmpperson.name | highlight: $select.search"></div>
                                <small ng-bind-html="tmpperson.email | highlight: $select.search"></small>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label"> 部  门 </label>
                    <div class="col-md-3">
                        <ui-select ng-model="basket.unit" theme="bootstrap">
                            <ui-select-match placeholder="选择部门...">@{{$select.selected.name}}</ui-select-match>
                            <ui-select-choices
                                    repeat="category.id as category in untigrps | filter: $select.search">
                                <div ng-bind-html="category.name | highlight: $select.search"></div>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                    <label class="col-md-1 control-label"> 名  称 </label>
                    <div class="col-md-3">
                        <div class="input-icon right">
                            <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                            <input type="text" ng-model="basket.summary" class="form-control" placeholder="项目名称">
                        </div>
                    </div>
                    <div class="col-md-2 btn-group btn-group-solid">
                        <button type="button" id="icon-basketset" class="btn btn-warning"><i class="fa fa-search"></i> 搜 索
                        </button>
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">切换下拉菜单</span>
                        </button>
                        <ul class="dropdown-menu" >
                            <li>
                                <a href="javascript:;"> 受理采购申请【已审批】 </a>
                            </li>
                            <li>
                                <a href="javascript:;"> 退回采购申请【已驳回】 </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;"> 报销状态【已报销】 </a>
                            </li>
                            <li>
                                <a href="javascript:;"> 报销状态【未报销】 </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;"> 采购方式【取消采购】 </a>
                            </li>
                            <li>
                                <a href="javascript:;"> 采购方式【自行采购】 </a>
                            </li>
                            <li>
                                <a href="javascript:;"> 采购方式【询价采购】 </a>
                            </li>
                            <li>
                                <a href="javascript:;"> 采购方式【定点采购】 </a>
                            </li>
                            <li>
                                <a href="javascript:;"> 采购方式【公开招标】 </a>
                            </li>
                            <li>
                                <a href="javascript:;"> 采购方式【邀请招标】 </a>
                            </li>
                            <li>
                                <a href="javascript:;"> 采购方式【竞争性谈判】 </a>
                            </li>
                            <li>
                                <a href="javascript:;"> 采购方式【单一来源采购】 </a>
                            </li>
                            <li>
                                <a href="javascript:;"> 采购方式【协议供货采购】 </a>
                            </li>
                        </ul>
                    </div>
                </div>
        </div>

        <div id="iconbasketlistgrid" ui-grid="gridOptions" ui-grid-selection ui-grid-exporter ui-grid-pagination ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="iconbasketloadlistgrid"></div>
    </form>
</div>
