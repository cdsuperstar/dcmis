<!-- BEGIN MAIN CONTENT -->
<div class="row" ng-controller="userCtrl">
    <button type="button" id="addData" class="btn btn-success" ng-click="addData()">增加</button>
    <button type="button" id="delData" class="btn btn-danger" ng-click="delData()">删除</button>
    <div id="usergrid" ui-grid="gridOptions" ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-move-columns class="grid"></div>
</div>


<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS & CSS -->
<script language="JavaScript" type="text/javascript">
//    TableEditable.init();
</script>
<!-- BEGIN MAIN JS & CSS -->