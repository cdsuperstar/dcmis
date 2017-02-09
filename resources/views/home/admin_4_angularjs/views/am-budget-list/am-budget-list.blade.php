<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="ambudgetlistCtrl">
    <div class="btn-group btn-group-solid table-toolbar">
        <button type="button"  class="btn blue btn-outline" ng-click="editData()"><i class="fa fa-floppy-o"></i>　保　存　</button>
        <button type="button" id="delData" class="btn red btn-outline" confirmation-needed="确定要删除这些用户吗？" ng-click="delData()"><i class="fa fa-trash"></i>　删　除　</button>
        <button type="button" id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow btn-outline"><i class="fa fa-search"></i>　筛　选　</button>
        <button type="button" id="refreshButton" type="button" class="btn green btn-outline" ng-click="refreshData()"><i class="fa fa-refresh"></i>　重获数据</button>
        <div class="btn-group btn-group-solid">
            <button type="button" class="btn red-intense btn-outline" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-cubes"></i>　批量操作
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu" >
                <li>
                    <a href="javascript:;"> 审批通过 </a>
                </li>
                <li>
                    <a href="javascript:;"> 审批不通过 </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="javascript:;"> 执行完毕 </a>
                </li>
            </ul>
        </div>
        <div class="btn-group btn-group-solid">
            <a class="btn yellow-soft btn-outline" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-file-excel-o"> </i>　导入/导出
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
        <button type="button" id='toggleFiltering' ng-click="printsource()" class="btn grey-salsa btn-outline"><i class="fa fa-print"></i>　打　印　</button>

    </div>


    <div id="usergrid" ui-grid="gridOptions" ui-grid-exporter ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="usergrid"></div>
</div>

