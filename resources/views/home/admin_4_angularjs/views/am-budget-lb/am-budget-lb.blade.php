<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="ambudgetlbCtrl">
    <script type="text/ng-template" id="add-ambudgetlb">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 添加预算类别 </span>
                            <span class="caption-helper"><font color="red">   预算类别不允许修改  </font></span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 类别编号 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.no" placeholder="当前最后编号为：@{{ gridOptions.data[gridOptions.data.length-1]['no'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">  类别名称 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.type" placeholder="名称">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">  类别简拼  </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.spell" placeholder="简拼">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">  类别模板  </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <ui-select ng-model="dcEdition.template">
                                        <ui-select-match placeholder="选择模板...">@{{$select.selected.label}}</ui-select-match>
                                        <ui-select-choices
                                                repeat="tmplist.value as tmplist in templatelist track by tmplist.value">
                                            @{{tmplist.label}}
                                        </ui-select-choices>
                                    </ui-select>
                                </div>
                            </div>
                        </div>
                        <div class="form-action" style="text-align: center;">
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn green" ng-click="confirm(dcEdition)" ng-disabled="dcEditionFm.$invalid">
                                    <i class="fa fa-check"></i>  确 认 </a>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <a href="javascript:;" class="btn purple-plum" ng-click="closeThisDialog(dcEdition)">
                                    <i class="icon-reload"></i>  取 消  </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END: ACCORDION DEMO -->
            </div>
        </div>
    </script>
    <div class="table-toolbar">
        <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-plus"></i> 增加</button>
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些预算类别数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        {{--<button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>--}}
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>

    </div>
    <div id="ambudgetlbgrid" ui-grid="gridOptions" ui-grid-selection ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-move-columns class="ambudgetlbgrid"></div>
</div>