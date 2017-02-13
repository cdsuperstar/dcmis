<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="privilegemanagementCtrl">
    <div class="table-toolbar">
        <div class="col">
            <angular-jsoneditor ng-model="obj.data" options="obj.options" style="width: 100%; height: 600px;"></angular-jsoneditor>
        </div>

        <div class="col">
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
                <div class="col-md-offset-8 col-md-3 col-sm-6 col-xs-6">
                    <a href="javascript:;" class="btn blue" ng-click="savedate()">
                        <i class="fa fa-check"></i> 保 存 </a>
                </div>
            </div>

        </div>
    </div>
</div>
