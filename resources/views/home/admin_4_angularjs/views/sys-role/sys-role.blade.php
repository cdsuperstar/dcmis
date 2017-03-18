<!-- BEGIN MAIN CONTENT -->
<div data-ng-controller="rolesCtrl">
    <script type="text/ng-template" id="role-treeTemp">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-ul"></i>模块树配置器[当前配置角色： @{{ role_display_name }}]
                </div>
                <div class="tools">
                    <a href="javascript:;" class="remove" ng-click="closeThisDialog()">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div id="modelTree" class="tree-demo"></div>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:;" class="btn green" ng-click="confirm( selectedTreeData )" >
            <i class="fa fa-check"></i>  配 置 模 块 </a>
    </script>

    <div class="table-toolbar">
        <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-plus"></i> 增加</button>
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些角色数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>
        <button id="roleModelTreeSelect" type="button"  class="btn btn-info" ng-click="roleModelTreeSelecter()"><i class="fa fa-tree"></i> 设定角色模块 </button>

    </div>
    <div id="rolegrid" ui-grid="gridOptions" ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-move-columns class="sysRoleGrid"></div>
</div>
