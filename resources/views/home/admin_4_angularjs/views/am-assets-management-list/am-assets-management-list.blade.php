<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="amassetmangementlistCtrl">
    <script type="text/ng-template" id="assets-managementlist">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="icon-settings font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 固定资产变更 </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="alert alert-info">
                            <strong>原领用人:</strong> xxxx <br>
                            <strong>原领用单位:</strong> 成都理工大学资产经营有限公司
                        </div>
                        <div class="alert alert-warning">
                            * 变更登记 如变更登记的数量小于领用数量，请变更后在 资产登记 模块 ，对新领用人进行登记资产；
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 领用人 </label>
                            <div class="col-md-8">
                                <ui-select ng-model="dcEdition.requester" theme="bootstrap">
                                    <ui-select-match placeholder="选择人员...">@{{$select.selected.name}}</ui-select-match>
                                    <ui-select-choices repeat="tmpperson.id as tmpperson in peoplegrps | filter: $select.search">
                                        <div ng-bind-html="tmpperson.name | highlight: $select.search"></div>
                                        <small ng-bind-html="tmpperson.email | highlight: $select.search"></small>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 领用部门 </label>
                            <div class="col-md-8">
                                <ui-select ng-model="basket.unit" theme="bootstrap">
                                    <ui-select-match placeholder="选择部门...">@{{$select.selected.name}}</ui-select-match>
                                    <ui-select-choices
                                            repeat="category.id as category in untigrps | filter: $select.search">
                                        <div ng-bind-html="category.name | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 变更数量 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                    <input type="number" class="form-control" ng-model="dcEdition.amt" placeholder="变更数量">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 备 注 </label>
                            <div class="col-md-8">
                                <textarea ng-model="dcEdition.remark" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写备注内容（1000字以内）"></textarea>
                            </div>
                        </div>
                        <div class="form-action" align="center">
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
    {{--每个人进来只能看到自己领用的物资--}}
    <div class="table-toolbar">
{{--变更时注意是否 整体变更，如果不是整体变更，需要在数量是减少及增加新的记录--}}
        <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-pencil"></i> 变更领用登记 </button>
        {{--移除登记时，需要增加库存，如没有库存，则增加新的记录--}}
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要移除这些领用数据吗？" ng-click="delData()"><i class="fa fa-sign-out"></i> 领用登记移除 </button>
        {{--如果报废，则将物资使用状态置为报废，报废为不可逆，不能撤销 --}}
        <button id="delData" type="button" class="btn grey-mint" confirmation-needed="确定要报废这些固定资产数据吗？" ng-click="del1Data()"><i class="fa fa-trash"></i> 固定资产报废 </button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选数据 </button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据 </button>

        <div class="btn-group btn-group-solid pull-right">
            <button id="refreshButton" type="button"  class="btn green-meadow" ng-click="exportxls()"><i class="fa fa-file-excel-o"> </i>  导出Excel</button>
        </div>
    </div>
    <div id="amassetmangementlistgrid" ui-grid="gridOptions"  ui-grid-pinning ui-grid-exporter ui-grid-selection ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="amassetmangementlistgrid"></div>
</div>