<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="syspasswordCtrl">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-md-2 control-label">旧密码</label>
            <div class="col-md-4">
                <div class="input-icon right" id="box">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="@{{type ? 'text' : 'password'}}" class="form-control" ng-model="dcEditionPWD.oldpwd" placeholder="旧密码">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">新密码</label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="@{{type ? 'text' : 'password'}}" class="form-control" ng-model="dcEditionPWD.newpwd" placeholder="6-20个字母、数字、下划线组成">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">确认密码</label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="@{{type ? 'text' : 'password'}}" class="form-control" ng-model="dcEditionPWD.repnew" placeholder="再输入一次">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-3 col-sm-6 col-xs-6">
                <div class="mt-checkbox-list">
                    <label class="mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" ng-model="type" /> 显示/隐藏秘密
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <a href="javascript:;" class="btn green" ng-click="edituserpwd()">
                    <i class="fa fa-check"></i> 确认修改 </a>
            </div>
        </div>


    </form>
</div>

<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS & CSS -->
<!-- BEGIN MAIN JS & CSS -->