<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="syspasswordCtrl">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-md-2 control-label">旧密码</label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="password" class="form-control" ng-model="dcEditionPWD.oldpwd" placeholder="旧密码">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">新密码</label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="password" class="form-control" ng-model="dcEditionPWD.newpwd" placeholder="新密码">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">确认密码</label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="password" class="form-control" ng-model="dcEditionPWD.repnew" placeholder="确认密码">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-1 col-md-3 col-sm-6 col-xs-6">
                <a href="javascript:;" class="btn green" ng-click="edituserpwd()">
                    <i class="fa fa-check"></i> 确认修改 </a>
            </div>
        </div>


    </form>
</div>

<!-- END MAIN CONTENT -->
<!-- BEGIN MAIN JS & CSS -->

<!-- BEGIN MAIN JS & CSS -->