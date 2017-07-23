<div class="portlet-body" data-ng-controller="budgetmanagementCtrl">
    <script type="text/ng-template" id="addambudgetmanagement">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 预算设置 </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" id="addBudgetFm">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 年  度 </label>
                            <div class="col-md-8">
                                <ui-select ng-model="addBudget.syear" theme="bootstrap">
                                    <ui-select-match placeholder="选择年度...">@{{$select.selected}}</ui-select-match>
                                    <ui-select-choices repeat="tmparr in tyear | filter: $select.search">
                                        @{{tmparr}}
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 类  别 </label>
                            <div class="col-md-8">
                                <ui-select ng-model="addBudget.type">
                                    <ui-select-match placeholder="选择类别...">@{{$select.selected.label}}</ui-select-match>
                                    <ui-select-choices
                                            repeat="tmplist.value as tmplist in listnames track by tmplist.value">
                                        @{{tmplist.label}}
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 部  门 </label>
                            <div class="col-md-8">
                                <ui-select ng-model="addBudget.unit">
                                    <ui-select-match placeholder="选择部门...">@{{$select.selected.name}}</ui-select-match>
                                    <ui-select-choices
                                            repeat="category.id as category in untigrps | filter: $select.search">
                                        <div ng-bind-html="category.name | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 金  额 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="number" class="form-control" ng-model="addBudget.total" placeholder="¥0.00">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 备 注 </label>
                            <div class="col-md-8">
                                <textarea ng-model="addBudget.remark" class="form-control" rows="2" style="margin-top: 0px; margin-bottom: 0px; height: 50px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写备注信息（1000字以内）"></textarea>
                            </div>
                        </div>
                        <div class="form-group" align="center">
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn green" ng-click="confirm(addBudget)">
                                    <i class="fa fa-check"></i>  确 认 </a>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn purple-plum" ng-click="closeThisDialog(addBudget)">
                                    <i class="icon-reload"></i>  取 消  </a>
                            </div>
                        </div>
                    </form>
                    <!-- END: ACCORDION DEMO -->
                </div>
            </div>
        </div>
    </script>
    <div class="table-toolbar">

        <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-plus"></i> 增加</button>
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>
        <div class="pull-right">
            <button id="exportButton" type="button"  class="btn green-meadow" ng-click="exportxls()"><i class="fa fa-file-excel-o"></i> 导出CSV</button>
        </div>

    </div>
    <div id="ambudgetmanagement" ui-grid="gridOptions" ui-grid-exporter ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="ambudgetmanagementid"></div>

</div>