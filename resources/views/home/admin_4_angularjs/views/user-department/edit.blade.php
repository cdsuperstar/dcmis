<div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN: ACCORDION DEMO -->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="icon-settings font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> 添加组织机构 </span>
                    </div>
                    <div class="tools">
                        <a href="" class="fullscreen"> </a>
                    </div>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-2 control-label"> 名 称 </label>
                        <div class="col-md-8">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" ng-model="dcEdition.name" placeholder="名称">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"> 介 绍 </label>
                        <div class="col-md-10">
                            <textarea name="xmjj" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写组织机构介绍（1000字以内）"></textarea>
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
