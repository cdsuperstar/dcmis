<!-- BEGIN MAIN CONTENT -->
<div data-ng-controller="rolesCtrl">
    <script type="text/ng-template" id="role-treeTemp">
        <div class="modal-header" style="padding: 1px;">
            <button type="button" title="关闭窗口" class="bootbox-close-button close" data-dismiss="modal" ng-click="closeThisDialog()" aria-hidden="true">&times;</button>
            <h3 class="modal-title font-blue-steel">
                <i class="fa fa-list-ul"></i>  模块树配置器
            </h3>
            <div style="text-align: right;">
                <h5 class="font-red-soft">[当前配置角色： @{{ role_display_name }}]</h5>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col col-md-6" style="border-right:1px solid #e5e5e5;">
                    模块列表（右键展开权限列表）
                    <div id="modelTree" class="tree-demo"></div>
                </div>
                <div class="col col-md-6">
                    权限列表
                    <div class="mt-checkbox-list">

                        <label class="mt-checkbox mt-checkbox-outline" ng-repeat="dt in privileges"> @{{dt.id}} @{{dt.display_name}}
                                <input type="checkbox" value="@{{dt.id}}" name="tprvil" ng-checked="privilegeasset.indexOf(dt.id) > -1" ng-click="pupdateSelection($event,dt.id)">
                            <span></span>
                        </label>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="padding: 1px;">
            <div style="text-align: right;">
                <a href="javascript:;" class="btn btn-info" ng-click="confirm( selectedTreeData )" >
                    <i class="fa fa-check"></i>  模 块 配 置 完 成 </a>
            </div>
        </div>
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
