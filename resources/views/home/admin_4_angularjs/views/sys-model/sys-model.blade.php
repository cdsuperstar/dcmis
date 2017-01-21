<div class="row" data-ng-controller="dcmodelCtrl">
    <!-- END start search CONTENT -->
    <script type="text/ng-template" id="treeTemp">
        <div class="portlet red-pink box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-puzzle"></i>模块树编辑器
                </div>
                <div class="tools">
                    <a href="javascript:;" class="remove" ng-click="closeThisDialog()">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="modelTree" class="tree-demo">
                </div>
            </div>
        </div>
    </script>
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <button type="button" id="addData" class="btn btn-success" ng-click="addData()">增加</button>
    <button type="button" id="delData" class="btn btn-danger" confirmation-needed="确定要删除这些模块吗？" ng-click="delData()">删除</button>
    <button type="button"  class="btn btn-info" ng-click="editData()">保存</button>
    <button type="button"  class="btn btn-info" ng-click="editTree()"> -- 编辑菜单树 -- </button>
    <div id="usergrid" ui-grid="gridOptions" ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-resize-columns ui-grid-cellNav ui-grid-move-columns class="sysModelgrid"></div>
</div>