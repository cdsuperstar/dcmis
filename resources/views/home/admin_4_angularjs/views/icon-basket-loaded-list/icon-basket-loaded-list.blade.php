<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="iconbasketloadlistCtrl">
    <script type="text/ng-template" id="approval-detail">

    </script>
    <div class="table-toolbar">
        <button type="button" id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow"><i class="fa fa-search"></i> 筛选</button>
        <button type="button" id="delData" class="btn red" confirmation-needed="确定要删除这些用户吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <div class="btn-group btn-group-solid">
            <button type="button" class="btn blue" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-stack-overflow"></i> 审批
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu" >
                <li>
                    <a href="javascript:;"> 审批 </a>
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
        <button type="button" id='toggleFiltering' ng-click="printsource()" class="btn blue-oleo"><i class="fa fa-print"></i> 打印</button>

    </div>


    <div id="iconbasketlistgrid" ui-grid="gridOptions" ui-grid-selection ui-grid-edit ui-grid-row-edit ui-grid-exporter ui-grid-pagination ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="iconbasketloadlistgrid"></div>
</div>

