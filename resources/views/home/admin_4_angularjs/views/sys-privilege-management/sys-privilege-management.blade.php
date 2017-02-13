<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="privilegemanagementCtrl">
    <div class="table-toolbar">
        <button type="button" id="addData" class="btn btn-success" ng-click="addData()">增加</button>
        <button type="button" id="delData" class="btn btn-danger" confirmation-needed="确定要删除这些数据吗？" ng-click="delData()">删除</button>
        <button type="button"  class="btn btn-info" ng-click="editData()">保存</button>
        <button id='toggleFiltering' ng-click="jsoneditdata()" class="btn red-pink">JSON编辑器</button>
        <button id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow">筛选</button>
        <button id="refreshButton" type="button" class="btn purple-plum" ng-click="refreshData()">重获数据</button>
    </div>
    <div id="privilegrid" ui-grid="gridOptions" ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-move-columns class="userGrid"></div>
</div>
