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
                    <button type="button" id="icon-basketset" class="btn btn-warning" ng-click="formsearch()"><i class="fa fa-search"></i> 搜 索
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="table-scrollable">
        <table class="table table-bordered table-hover">
            <thead style="background-color: #578ebe;color: #ffffff;">
            <tr>
                <th> # </th>
                <th> 预算类别 </th>
                <th> 总金额 </th>
                <th> 申报金额 </th>
                <th> 支出金额 </th>
                <th> 预算可用金额 </th>
                <th> 实际可用金额 </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td> 1 </td>
                <td> 物资预算 </td>
                <td> 100000 </td>
                <td> 50000 </td>
                <td> 40000 </td>
                <td class="warning"> 60000 </td>
            </tr>
            <tr>
                <td> 2 </td>
                <td> 工程预算 </td>
                <td> 100000 </td>
                <td> 50000 </td>
                <td> 40000 </td>
                <td> 60000 </td>
            </tr>
            <tr>
                <td> 3 </td>
                <td> 服务预算 </td>
                <td> 100000 </td>
                <td> 50000 </td>
                <td> 40000 </td>
                <td> 60000 </td>
            </tr>
            <tr>
                <td> 4 </td>
                <td> 其他预算 </td>
                <td> 100000 </td>
                <td> 50000 </td>
                <td> 40000 </td>
                <td class="danger"> 60000 </td>
            </tr>
            <tr>
                <td colspan="2" class="active" style="text-align: center;"> 小  计  </td>
                <td class="active"> 100000 </td>
                <td class="active"> 50000 </td>
                <td class="active"> 40000 </td>
                <td class="active"> 60000 </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
