<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="sysmattersCtrl">
    <script type="text/ng-template" id="sysmatters-add">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="fa fa-bullhorn font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 新事项 </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-2 control-label">申报人</label>
                            <div class="col-md-10">
                                <ui-select ng-model="dcEdition.suser_id" theme="bootstrap">
                                    <ui-select-match placeholder="选择申报人...">@{{$select.selected.name}}</ui-select-match>
                                    <ui-select-choices repeat="tmpperson.id as tmpperson in peoplegrps | filter: $select.search">
                                        <div ng-bind-html="tmpperson.name | highlight: $select.search"></div>
                                        <small ng-bind-html="tmpperson.email | highlight: $select.search"></small>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"> 标 题 </label>
                            <div class="col-md-10">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.title" placeholder="事项标题">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"> 到期时间 </label>
                            <div class="col-md-10">
                                <input class="form-control" type="datetime-local" ng-model="dcEdition.enddate" value="2017-05-23T15:00:00"  id="dateTimeInput">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"> 内  容 </label>
                            <div class="col-md-10">
                                {{--<div ng-model="dcEdition.content" id="summernote_sysannouncement"> </div>--}}
                                <textarea ng-model="dcEdition.content" class="form-control" rows="5" style="margin-top: 0px; margin-bottom: 0px; height: 200px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写事项内容（1000字以内）"></textarea>

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

    <div class="table-toolbar">
        <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-plus"></i> 增加</button>
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些事项数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>

    </div>
    <div id="sysmattersgrid" ui-grid="gridOptions" ui-grid-selection  ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-move-columns class="sysMattersgrid"></div>
</div>