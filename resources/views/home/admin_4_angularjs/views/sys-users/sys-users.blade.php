<!-- BEGIN MAIN CONTENT -->
<!-- BEGIN MAIN CONTENT -->
<div class="row" data-ng-controller="dcuserCtrl">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="icon-puzzle font-dark"></i>
                <span class="caption-subject bold uppercase"> 系统用户 </span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-toolbar">
                <button type="button" id="addData" class="btn btn-success" ng-click="addData()">增加</button>
                <button type="button" id="delData" class="btn btn-danger" confirmation-needed="确定要删除这些用户吗？" ng-click="delData()">删除</button>
                <button type="button"  class="btn btn-info" ng-click="editData()">保存</button>
                <button id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow">筛选</button>
                <button id="refreshButton" type="button" class="btn purple-plum" ng-click="refreshData()">重获数据</button>

                <div class="btn-group open" >
                <button id="btnGroupVerticalDrop5" type="button" class="btn yellow dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Dropdown
                    <i class="fa fa-angle-down"></i>
                </button>

                <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupVerticalDrop5">
                    <li>
                        <a href="#" ng-click="export('pdf')"> 导出PDF </a>
                    </li>
                    <li>
                        <a href="#" ng-click="export('csv')"> 导出EXCEL </a>
                    </li>
                </ul>
                </div>

            </div>
            <div id="usergrid" ui-grid="gridOptions" ui-grid-exporter ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-move-columns class="usergrid"></div>
        </div>
    </div>
</div>
<script  type="text/javascript">
    window.pdfMake.fonts = {
        Roboto: {
            normal: 'Roboto-Regular.ttf',
            bold: 'Roboto-Medium.ttf',
            italics: 'Roboto-Italic.ttf',
            bolditalics: 'Roboto-Italic.ttf'
        },
        微软雅黑: {
            normal: 'msyh.ttf',
            bold: 'msyhbd.ttf',
            italics: 'msyh.ttf',
            bolditalics: 'msyhbd.ttf',
        }
    };
</script>