<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="iconbasketsearchindexCtrl">
    <div class="table-toolbar">
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> @{{ toggleFilteringsign }} </button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>

    </div>
    <div id="iconbasketsearchindexgrid" ui-grid="gridOptions" ui-grid-selection  ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-move-columns class="iconbasketsearchindexgrid"></div>
</div>