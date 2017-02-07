<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="ambudgetlistCtrl">
    <div class="btn-group btn-group-solid table-toolbar">
        <button type="button" id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow">　筛　选　</button>
        <button type="button" id='toggleFiltering' ng-click="printsource()" class="btn blue">　打　印　</button>
        <button type="button" id="refreshButton" type="button" class="btn green" ng-click="refreshData()">重获数据</button>
        <div class="btn-group btn-group-solid">
            <button type="button" class="btn purple" data-toggle="dropdown" aria-expanded="true">批量操作
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
        <button type="button" id="delData" class="btn red" confirmation-needed="确定要删除这些用户吗？" ng-click="delData()">　删　除　</button>
        <button type="button"  class="btn blue" ng-click="editData()">　保　存　</button>
    </div>


    <div id="usergrid" ui-grid="gridOptions" ui-grid-exporter ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="usergrid"></div>
</div>

