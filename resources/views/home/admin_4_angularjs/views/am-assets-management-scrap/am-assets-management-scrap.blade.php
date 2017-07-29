<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="amassetmangementscrapCtrl">
    <div class="table-toolbar">
        <button id="saveData" type="button"  class="btn btn-primary" ng-click="editData()"><i class="fa fa-check"></i> 保存数据 </button>
        <div class="btn-group btn-group-solid">
            <button type="button" id="icon-basketset" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sign-out"></i> 物资状态处理  <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu" >
                <li>
                    <a href="javascript:;" confirmation-needed="确定将这些物资状态置为【正常】吗？" ng-click="changeStatus('purchway','正常')"> 物资状态【正常】 </a>
                </li>
                <li>
                    <a href="javascript:;" confirmation-needed="确定要报废这些资产吗？"  ng-click="changeStatus('purchway','报废')"> 物资状态【报废】 </a>
                </li>
            </ul>
        </div>
        <button id='toggleFiltering' type="button"class="btn btn-warning" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选数据 </button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据 </button>

        <div class="btn-group btn-group-solid pull-right">
            <button id="refreshButton" type="button"  class="btn green-meadow" ng-click="exportxls()"><i class="fa fa-file-excel-o"> </i>  导出Excel</button>
        </div>
    </div>
    <div id="amassetmangementscrapgrid" ui-grid="gridOptions"  ui-grid-edit ui-grid-row-edit ui-grid-pinning ui-grid-exporter ui-grid-selection ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="amassetmangementscrapgrid"></div>
</div>