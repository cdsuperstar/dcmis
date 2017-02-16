<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="dcuserCtrl">
    <script type="text/ng-template" id="jsoneditor">
        <div class="portlet yellow box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-puzzle"></i>JSON编辑器
                </div>
                <div class="tools">
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="table-toolbar">
                        <div class="col col-md-6">
                            <angular-jsoneditor ng-model="obj.data" options="obj.options" style="width: 100%; height: 600px;"></angular-jsoneditor>
                        </div>

                        <div class="col col-md-6">
                            <div class="pdL4">
                                <div class="form-group">
                                    <div class="btn-group">
                                        <button type="button" class="btn yellow" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-check-circle"></i>
                                            视图设置
                                        </button>
                                        <ul class="dropdown-menu" >
                                            <li>
                                                <a href="javascript:;" ng-click="changeOptions('tree')"> 树形模式 </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" ng-click="changeOptions('form')"> 表单模式 </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" ng-click="changeOptions('text')"> 文本模式 </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" ng-click="changeOptions('code')"> 代码模式 </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" ng-click="changeOptions('view')"> 浏览模式 </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn green" ng-click="changeData()"><i class="fa fa-refresh"></i>
                                        重置数据
                                    </button>
                                </div>
                                <div class="form-group">
                                    <pre style="height: 80px; word-break:break-all;">@{{pretty(obj.data)}}</pre>
                                </div>
                                <div class="form-group">
                                    增加值：<input type="text" ng-model="obj.data.String">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <a href="javascript:;" class="btn blue" ng-click="savejsondate()">
                                        <i class="fa fa-check"></i> 保 存 </a>
                                </div>
                                <div class="col-md-offset-1 col-md-4 col-sm-6 col-xs-6">
                                    <a href="javascript:;" class="btn purple-plum" ng-click="closeThisDialog(dcEdition)">
                                        <i class="icon-reload"></i>  关闭窗口  </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <div class="table-toolbar">

        <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-plus"></i> 增加</button>
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些用户数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>

        <div class="btn-group btn-group-solid pull-right">
            <a class="btn green-meadow" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-file-excel-o"> </i>  导入/导出
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
    </div>
    <div id="usergrid" ui-grid="gridOptions" ui-grid-exporter ui-grid-importer ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="sysusergrid"></div>
</div>