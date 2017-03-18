<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="sysannouncementCtrl">
    <script type="text/ng-template" id="sysannouncement-add">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN: ACCORDION DEMO -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="fa fa-bullhorn font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> 发送公告 </span>
                        </div>
                        <div class="tools">
                            <a href="" class="fullscreen"> </a>
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)">
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 标 题 </label>
                            <div class="col-md-8">
                                <div class="input-icon right">
                                    <i class="fa fa-warning tooltips font-red" title="必填项" data-container="body"></i>
                                    <input type="text" class="form-control" ng-model="dcEdition.title" placeholder="公告标题">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"> 内  容 </label>
                            <div class="col-md-8">
                                <div ng-model="dcEdition.content" id="summernote_sysannouncement"> </div>
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
        <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些公告数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
        <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据</button>

    </div>
    <div id="sysannouncementgrid" ui-grid="gridOptions" ui-grid-selection ui-grid-pagination ui-grid-resize-columns ui-grid-move-columns class="sysAnnouncementgrid"></div>
</div>
