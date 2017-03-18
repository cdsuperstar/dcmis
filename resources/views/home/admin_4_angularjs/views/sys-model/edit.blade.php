<div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN: ACCORDION DEMO -->
            <div class="portlet light" style="padding: 5px;margin-bottom: 1px;">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="icon-settings font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> 添加模块 </span>
                    </div>
                    <div class="tools">
                        <a href="" class="fullscreen"> </a>
                    </div>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-3 control-label"> 模块名称 </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" ng-model="dcEdition.name" placeholder="模块名称/ID">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> 模块标题 </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" ng-model="dcEdition.title" placeholder="模块标题">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> 是否显示 </label>
                        <div class="col-md-8">
                            <select class="form-control" ng-model="dcEdition.ismenu">
                                <option value='' disabled selected style='display:none;'>请选择是否显示在菜单上...</option>
                                <option value="1" ng-selected="dcEdition.ismenu==1">显示</option>
                                <option value="0" ng-selected="dcEdition.ismenu==0">隐藏</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> 模块图标 </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" ng-model="dcEdition.icon" placeholder="模块图标">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> 引入文件 </label>
                        <div class="col-md-8">
                            <textarea class="form-control" ng-model="dcEdition.files" rows="3" ng-model="dcEdition.brief" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写引入文件（1000字以内）"></textarea>
                        </div>
                    </div>
                    <div class="form-action" style="text-align: center;">
                        <div class="col-md-offset-1 col-md-4 col-sm-6 col-xs-6">
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
</div>
