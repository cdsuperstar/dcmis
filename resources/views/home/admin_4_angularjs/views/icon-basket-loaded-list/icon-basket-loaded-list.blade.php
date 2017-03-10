<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="iconbasketloadlistCtrl">
    <script type="text/ng-template" id="approval-detail">
        <div class="row">
            <div class ="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-youtube font-red-thunderbird"></i>
                            <span class="caption-subject font-red-thunderbird sbold">采购项目详细（编号：@{{tmpobjdata.no}}&nbsp;）</span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="soucegrid" ui-grid="soucegridOptions" ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="iconbaketsoucelistgrid"></div>
                    </div>
                </div>
            </div>
        </div>
    </script>
    <div class="table-toolbar">
        <button type="button" id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow"><i class="fa fa-search"></i> 筛选</button>
        <button type="button" id="delData" class="btn red" confirmation-needed="确定要删除这些用户吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <button type="button" id="basketshopping" class="btn blue"><i class="fa fa-contao"></i> 受理采购申请 </button>

    </div>


    <div id="iconbasketlistgrid" ui-grid="gridOptions" ui-grid-selection ui-grid-exporter ui-grid-pagination ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="iconbasketloadlistgrid"></div>
</div>

