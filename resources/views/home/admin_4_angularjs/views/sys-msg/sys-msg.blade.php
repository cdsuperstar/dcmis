<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="sysmsgCtrl">
    <div class="table-toolbar">
        <button type="button" id="addData" class="btn btn-success" ng-click="addData()">群发消息</button>
        <button id='showdetailmsg' ng-click="showdetailmsg()" class="btn btn-info">查看往来消息</button>
        <button type="button" id="delData" class="btn btn-danger" confirmation-needed="确定要删除这些消息吗？" ng-click="delData()">　删　除　</button>
        <button id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow">　筛　选　</button>
        <button id="refreshButton" type="button" class="btn purple-plum" ng-click="refreshData()">重获数据</button>
    </div>
    <div id="userMsggrid" ui-grid="gridOptions" ui-grid-selection ui-grid-pagination ui-grid-resize-columns ui-grid-move-columns class="sysMsggrid"></div>
</div>