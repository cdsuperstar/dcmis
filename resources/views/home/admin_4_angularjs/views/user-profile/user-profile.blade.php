<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="userprofilesCtrl">
    <div class="table-toolbar">
        <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>

    </div>
    <div id="userprivilegrid" ui-grid="gridOptions" ui-grid-edit ui-grid-pinning ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-move-columns class="userProfileGrid"></div>
</div>
