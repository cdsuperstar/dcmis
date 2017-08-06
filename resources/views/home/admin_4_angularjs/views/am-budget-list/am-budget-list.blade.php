<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="ambudgetlistCtrl">
    <div class="table-toolbar">
        单位名称：@{{ unit_name }}
    </div>
    <div class="table-toolbar">
        <div id="ambudgetlistgrid" ui-grid="gridOptions" ui-grid-exporter ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="ambudgetlistgrid"></div>
    </div>
</div>

