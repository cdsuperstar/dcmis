<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="iconbasketloadedCtrl">
    <script type="text/ng-template" id="iconbasketload">
        <div class="row">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="fa fa-plus font-red"></i>
                        <span class="caption-subject bold uppercase"> 添加详情 </span>
                    </div>
                    <div class="tools">
                        <a href="" class="fullscreen"> </a>
                        <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)">
                        </a>
                    </div>
                </div>
                <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-plus"></i> 增加</button>
                <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
                <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
                <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>
                <div class="portlet-body">
                    <div ui-grid="soucegridOptions" ui-grid-exporter ui-grid-importer ui-grid-selection ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="iconbasketloadedgrid"></div>
                </div>
            </div>
        </div>
    </script>
    <div class="table-toolbar">
        <form class="form-horizontal" role="form">
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
                                repeat="category in untigrps | filter: $select.search">
                            <div ng-bind-html="category.name | highlight: $select.search"></div>
                        </ui-select-choices>
                    </ui-select>
                </div>
                <label class="col-md-2 control-label">申报人</label>
                <div class="col-md-4">
                    <ui-select ng-model="basket.selected" theme="bootstrap">
                        <ui-select-match placeholder="选择申报人...">@{{$select.selected.name}}</ui-select-match>
                        <ui-select-choices repeat="tmpperson in peoplegrps | filter: $select.search">
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
                <label class="col-md-2 control-label">总金额</label>
                <div class="col-md-4">
                    <input type="number" ng-model="basket.total" class="form-control" placeholder="￥0.00" readonly>
                    <p class="help-block">该项自动计算，毋须填写。</p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-2 col-sm-4 col-xs-4">
                    <a href="javascript:;" class="btn red" ng-click="showdetail()">
                        <i class="fa fa-plus"></i>添加详情</a>
                </div>
                <div class="col-md-offset-1 col-md-3 col-sm-4 col-xs-4">
                    <a href="#" ng-click="savedate()" class="btn green">
                        <i class="fa fa-check"></i> 提交申报 </a>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-4">
                    <a href="#" ng-click="savedate()" class="btn blue-oleo">
                        <i class="fa fa-print"></i> - 打 印 - </a>
                </div>
            </div>
            {{--<p class="help-block"> 第一步 ：点击 提交申报 按钮；  第二步 ：点击 添加详情 按钮。 </p>--}}
        </form>
    </div>
</div>