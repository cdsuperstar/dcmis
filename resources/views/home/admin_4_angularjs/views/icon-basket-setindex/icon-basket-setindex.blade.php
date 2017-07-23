<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="iconbasketsetindexCtrl">
    <script type="text/ng-template" id="add-material">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 添加物资目录 </span>
                            <span class="caption-helper"> 最近物资编号为:[@{{ tmno }}] </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 物资编号 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.no" placeholder="最近物资编号为:[@{{ tmno }}]">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 物资分类 </label>
                            <div class="col-md-8">
                                <ui-select ng-model="dcEdition.class" theme="bootstrap">
                                    <ui-select-match placeholder="选择分类...">@{{$select.selected}}</ui-select-match>
                                    <ui-select-choices repeat="tmparr in tmclass | filter: $select.search">
                                        <div ng-bind-html="tmparr | highlight: $select.search"></div>
                                    </ui-select-choices>
                                    <ui-select-no-choice>
                                        <font color="red">暂无相关分类信息，请与联系开发人员...</font>
                                    </ui-select-no-choice>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 物资名称 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.name" placeholder="物资名称">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 单  位 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.measunit" placeholder="单位">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 物资简拼 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.spell" placeholder="物资简拼">
                                </div>
                            </div>
                        </div>
                        <div class="form-action">
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
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些事项数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>

    </div>
    <div id="iconbasketsetindexgrid" ui-grid="gridOptions" ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-move-columns class="iconbasketsetindexgrid"></div>
</div>