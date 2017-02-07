<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="ambudgetlistCtrl">
    <div class="btn-group btn-group-solid table-toolbar">
        <button type="button"  class="btn green" ng-click="editData()">保存</button>
        <button type="button" id="delData" class="btn btn-danger" confirmation-needed="确定要删除这些用户吗？" ng-click="delData()">删除</button>
        <div class="btn-group btn-group-solid">
            <button type="button" class="btn blue" data-toggle="dropdown" aria-expanded="true">批量操作
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu" >
                <li>
                    <a href="javascript:;"> Action </a>
                </li>
                <li>
                    <a href="javascript:;"> Another action
                        <span class="badge badge-warning"> 2 </span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;"> Something else here </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="javascript:;"> Separated link
                        <span class="badge badge-info"> 7 </span>
                    </a>
                </li>
            </ul>
        </div>
        <button id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow">筛选</button>
        <button id="refreshButton" type="button" class="btn purple-plum" ng-click="refreshData()">重获数据</button>
    </div>


    <div id="usergrid" ui-grid="gridOptions" ui-grid-exporter ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="usergrid"></div>
</div>

