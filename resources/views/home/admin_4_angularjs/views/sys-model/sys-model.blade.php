<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="dcmodelCtrl">
    <script type="text/ng-template" id="treeTemp">
        <div class="portlet light" style="padding: 5px;margin-bottom: 1px;">
            <div class="portlet-title">
                <div class="caption font-purple-studio">
                    <i class="fa fa-list-ul font-purple-studio"></i>菜单树编辑器
                </div>
                <div class="tools">
                    <a href="javascript:;" class="remove" ng-click="closeThisDialog()">
                    </a>
                </div>
            </div>
            <div class="portlet-body" style="margin-left: 15px;">
                <div id="modelTree" class="tree-demo">
                </div>
            </div>
        </div>
    </script>
    <div class="table-toolbar">
        <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-plus"></i> 增加</button>
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些模块数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>
        <button id="edittreeButton" type="button"  class="btn purple-plum" ng-click="editTree()"><i class="fa fa-list-ul"></i> 编辑菜单树</button>

    </div>
    <div id="modelgrid" ui-grid="gridOptions" ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-resize-columns ui-grid-cellNav ui-grid-move-columns class="sysModelgrid"></div>
</div>
