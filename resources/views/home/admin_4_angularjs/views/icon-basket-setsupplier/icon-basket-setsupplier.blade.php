<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="iconbasketsetsupplierCtrl">
    <script type="text/ng-template" id="icon-basketsetsupplier">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 添加供应商 </span>
                        </div>
                        <div class="tools">
                            {{--<a href="" class="fullscreen"> </a>--}}
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 公司名称 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.compname" placeholder="公司名称">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 负责人  </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <input type="text" class="form-control" ng-model="dcEdition.principal" placeholder="负责人">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 联络人  </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.contacter" placeholder="联络人">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 联系电话  </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.phone" placeholder="联系电话">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 固定电话  </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <input type="text" class="form-control" ng-model="dcEdition.tel" placeholder="固定电话">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 公司地址 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <input type="text" class="form-control" ng-model="dcEdition.compaddr" placeholder="公司地址">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 备 注  </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <textarea class="form-control" ng-model="dcEdition.remark" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写备注（1000字以内）"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-action">
                            <div class="col-md-offset-2 col-md-4 col-sm-6 col-xs-6">
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
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些供应商数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> @{{ toggleFilteringsign }} </button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>

    </div>
    <div id="iconbasketsetsuppliergrid" ui-grid="gridOptions" ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-move-columns class="iconbasketsetsuppliergrid"></div>
</div>