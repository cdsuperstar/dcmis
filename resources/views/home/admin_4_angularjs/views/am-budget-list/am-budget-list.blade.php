<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="ambudgetlistCtrl">
    <div class="btn-group btn-group-solid table-toolbar">
        <button type="button"  class="btn grey-cascade btn-outline" ng-click="editData()"><i class="fa fa-floppy-o"></i>　修　改　</button>
        <button type="button" id="delData" class="btn grey-cascade btn-outline" confirmation-needed="确定要删除这些用户吗？" ng-click="delData()"><i class="fa fa-trash"></i>　删　除　</button>
        <button type="button" id='toggleFiltering' ng-click="toggleFiltering()" class="btn grey-cascade btn-outline"><i class="fa fa-search"></i>　筛　选　</button>
        <button type="button" id="refreshButton" type="button" class="btn grey-cascade btn-outline" ng-click="refreshData()"><i class="fa fa-refresh"></i>　重获数据</button>
        <div class="btn-group btn-group-solid">
            <button type="button" class="btn grey-cascade btn-outline" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-stack-overflow"></i>　审　批
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu" >
                <li>
                    <a href="javascript:;"> 审 批 </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="javascript:;"> 批量审批通过 </a>
                </li>
                <li>
                    <a href="javascript:;"> 批量审批不通过 </a>
                </li>
            </ul>
        </div>
        <div class="btn-group btn-group-solid">
            <a class="btn grey-cascade btn-outline" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-file-excel-o"> </i>　导入/导出
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="javascript:;" ng-click="exportxls()"> 导出CSV </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="javascript:;"> 导入CSV </a>
                </li>
            </ul>
        </div>
        <button type="button" id='toggleFiltering' ng-click="printsource()" class="btn grey-cascade btn-outline"><i class="fa fa-print"></i>　打　印　</button>

    </div>


    <div id="usergrid" ui-grid="gridOptions" ui-grid-selection ui-grid-exporter ui-grid-pagination ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="am-budgetlistgrid"></div>
</div>

