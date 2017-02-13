<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="dcuserCtrl">
    <div class="table-toolbar">
        <button type="button" id="addData" class="btn blue-hoki" ng-click="addData()">增加</button>
        <button type="button" id="delData" class="btn btn-danger" confirmation-needed="确定要删除这些用户吗？" ng-click="delData()">删除</button>
        <button type="button"  class="btn btn-info" ng-click="editData()">保存</button>
        <button id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow">筛选</button>
        <button id="refreshButton" type="button" class="btn purple-plum" ng-click="refreshData()">重获数据</button>
        <div class="btn-group btn-group-solid pull-right">
            <a class="btn green-meadow" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-file-excel-o"> </i>  导入/导出
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="javascript:;" ng-click="exportxls()"> 导出CSV </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="javascript:;"> 导入CSV </a>
                </li>
            </ul>
        </div>
    </div>
    <div id="usergrid" ui-grid="gridOptions" ui-grid-exporter ui-grid-importer ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="sysusergrid"></div>
</div>


