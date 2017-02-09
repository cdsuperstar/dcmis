<div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN: ACCORDION DEMO -->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="icon-settings font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> 添加系统用户 </span>
                    </div>
                    <div class="tools">
                        <a href="" class="fullscreen"> </a>
                    </div>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-2 control-label"> 姓 名 </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" ng-model="dcEdition.name" placeholder="姓名">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">邮箱</label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="email" class="form-control" ng-model="dcEdition.email" placeholder="E-Mail...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">密码</label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="password" class="form-control" ng-model="dcEdition.password" placeholder="******">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">确认密码</label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="password" class="form-control" ng-model="dcEdition.password_confirmation" placeholder="******">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" align="center">
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
</div>
