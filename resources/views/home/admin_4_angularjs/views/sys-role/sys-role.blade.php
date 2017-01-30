<!-- BEGIN MAIN CONTENT -->
<div class="row" data-ng-controller="rolesCtrl">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="icon-globe font-dark"></i>
                <span class="caption-subject bold uppercase"> 角色管理 </span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-toolbar">
                <button type="button" id="addData" class="btn btn-success" ng-click="addData()">增加</button>
                <button type="button" id="delData" class="btn btn-danger" confirmation-needed="确定要删除这些用户吗？" ng-click="delData()">删除</button>
                <button type="button"  class="btn btn-info" ng-click="editData()">保存</button>
                <button id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow">筛选</button>
                <button id="refreshButton" type="button" class="btn purple-plum" ng-click="refreshData()">重获数据</button>
            </div>
            <div id="usergrid" ui-grid="gridOptions" ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-move-columns class="userGrid"></div>
        </div>
    </div>
</div>