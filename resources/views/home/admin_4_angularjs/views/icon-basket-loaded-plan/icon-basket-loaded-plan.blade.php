<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="iconbasketloadplanCtrl">
    <form id="fm" class="form-horizontal" role="form">
        <div class="table-toolbar">
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
                        <ui-select ng-model="basket.type" theme="bootstrap">
                            <ui-select-match placeholder="选择类别...">@{{$select.selected.label}}</ui-select-match>
                            <ui-select-choices
                                    repeat="tmplist.value as tmplist in listnames track by tmplist.value">
                                @{{tmplist.label}}
                            </ui-select-choices>
                        </ui-select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label"> 部  门 </label>
                    <div class="col-md-4">
                        <ui-select ng-model="basket.unit" theme="bootstrap">
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
                <div class="form-group">
                    <label class="col-md-2 control-label"> 项目名称 </label>
                    <div class="col-md-4">
                        <div class="input-icon right">
                            <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                            <input type="text" ng-model="basket.summary" class="form-control" placeholder="项目名称">
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-5 col-sm-4 col-xs-4">
                        <a href="#" ng-click="seache()" class="btn yellow-saffron">
                            <i class="fa fa-search"></i> 搜 索 </a>
                    </div>
                </div>
        </div>
        <div class="btn-group btn-group-solid">
            <button type="button" id="icon-basketset" class="btn blue" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-stack-overflow"></i> 设 置
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu" >
                <li>
                    <a href="javascript:;"> 报销状态【已报销】 </a>
                </li>
                <li>
                    <a href="javascript:;"> 报销状态【未报销】 </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="javascript:;"> 采购方式【直接购买】 </a>
                </li>
                <li>
                    <a href="javascript:;"> 采购方式【公开招标】 </a>
                </li>
            </ul>
        </div>

        <div id="iconbasketlistgrid" ui-grid="gridOptions" ui-grid-selection ui-grid-exporter ui-grid-pagination ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="iconbasketloadlistgrid"></div>
    </form>
</div>

