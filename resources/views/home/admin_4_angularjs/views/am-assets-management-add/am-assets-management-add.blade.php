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
                            <span class="caption-subject bold uppercase"> 固定资产登记 </span>
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
                                <ui-select ng-model="dcEdition.requester" theme="bootstrap">
                                    <ui-select-match placeholder="选择申报人...">@{{$select.selected.name}}</ui-select-match>
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
                                <ui-select ng-model="basket.unit" theme="bootstrap">
                                    <ui-select-match placeholder="选择部门...">@{{$select.selected.name}}</ui-select-match>
                                    <ui-select-choices
                                            repeat="category.id as category in untigrps | filter: $select.search">
                                        <div ng-bind-html="category.name | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 数 量 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="number" class="form-control" ng-model="dcEdition.amt" placeholder="数量">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 备 注 </label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" ng-model="dcEdition.remark" placeholder="备注">
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
    <div class="table-toolbar">

        <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-pencil"></i> 登记领用信息 </button>
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要移除这些固定资产数据吗？" ng-click="delData()"><i class="fa fa-sign-out"></i> 固定资产移除 </button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选数据 </button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据 </button>

        <div class="btn-group btn-group-solid pull-right">
            <button id="refreshButton" type="button"  class="btn green-meadow" ng-click="exportxls()"><i class="fa fa-file-excel-o"> </i>  导出Excel</button>
        </div>
    </div>
    <div id="amassetmangementaddgrid" ui-grid="gridOptions" ui-grid-exporter ui-grid-selection ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="amassetmangementaddgrid"></div>
</div>