<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="ambudgetcountCtrl">
    <form id="fm" class="form-horizontal" role="form">
        <div class="table-toolbar">
            <div class="form-group">
                <label class="col-md-1 control-label"> 年  度 </label>
                <div class="col-md-2">
                    <ui-select ng-model="ambudgetcount.syear" theme="bootstrap">
                        <ui-select-match placeholder="选择年度..." allow-clear="true">@{{$select.selected}}</ui-select-match>
                        <ui-select-choices repeat="tmparr in tyear | filter: $select.search">
                            <div ng-bind-html="tmparr | highlight: $select.search"></div>
                        </ui-select-choices>
                    </ui-select>
                </div>
                <label class="col-md-1 control-label"> 部  门 </label>
                <div class="col-md-3">
                    <ui-select ng-model="ambudgetcount.unit" theme="bootstrap">
                        <ui-select-match placeholder="选择部门..." allow-clear="true">@{{$select.selected.name}}</ui-select-match>
                        <ui-select-choices
                                repeat="category.id as category in untigrps | filter: $select.search">
                            <div ng-bind-html="category.name | highlight: $select.search"></div>
                        </ui-select-choices>
                    </ui-select>
                </div>
                <div class="col-md-2 btn-group btn-group-solid">
                    <button type="button" id="icon-basketset" class="btn green-steel" ng-click="formsearch()"><i class="fa fa-search"></i> 搜 索
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="table-toolbar">
        <div id="budgetcountgrid" ui-grid="gridOptions" ui-grid-exporter ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="budgetcountgrid"></div>
    </div>

</div>
