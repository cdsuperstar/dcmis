<div class="portlet-body" data-ng-controller="sysusersOwnCtrl">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-md-2 control-label"> 个人头像  </label>
            <div class="col-md-4">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;">
                        <img alt="" src="/images/users/@{{ pictname }}.jpg" style="max-height: 92px;">
                        {{--<img src="/css/sysimg/150.jpg" alt="示例图片" >--}}
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 100px;">
                    </div>
                    <span class="btn yellow btn-file btn-sm"><span class="fileinput-new"><i class="fa fa-upload"></i> 选择</span>
                    <span class="fileinput-exists"> 更换 </span>
                        {{--<input type="file" ng-model="userprofile.signpic">--}}
                        <file name="image" ng-model="userprofile.signpic" accept="image/png,image/jpg,image/jpeg" />

                        </span>
                    <a href="#" class="btn red btn-sm fileinput-exists" data-dismiss="fileinput"> 移除 </a>
                </div>
            </div>
            <div class="from-group">
                <label class="col-md-2 control-label">  工 号 </label>
                <div class="col-md-4">
                    <label class="control-label">@{{ userprofile.no }}</label>
                </div>
            </div>
            <div class="from-group">
                &nbsp;
            </div>
            <div class="from-group">
                <label class="col-md-2 control-label">  姓 名 </label>
                <div class="col-md-4">
                    <div class="input-icon right">
                        <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                        <input type="text" class="form-control" ng-model="userprofile.name" placeholder="姓名">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">性 别 </label>
            <div class="col-md-4">
                <ui-select ng-model="userprofile.sex" theme="bootstrap">
                    <ui-select-match>@{{$select.selected}}</ui-select-match>
                    <ui-select-choices repeat="tsexarr in sexarr | filter: $select.search">
                        @{{tsexarr}}
                    </ui-select-choices>
                </ui-select>
            </div>
            <label class="col-md-2 control-label">出生日期</label>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" uib-datepicker-popup="@{{format}}" ng-model="userprofile.birth" is-open="tmppopup.opened" ng-required="true" close-text="关闭"
                           clear-text="清空" current-text="今天" alt-input-formats="altInputFormats" datepicker-options="dateOptions" placeholder="@{{ userprofile.birth }}"/>
                    <span class="input-group-btn">
                            <button type="button" class="btn btn-default" ng-model="birth" ng-click="opendatepick()"><i class="glyphicon glyphicon-calendar"></i></button>
                        </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">联系电话</label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="text" class="form-control" ng-model="userprofile.phone" placeholder="1XXXXXXXXXX">
                </div>
            </div>
            <label class="col-md-2 control-label">所属部门</label>
            <div class="col-md-4">
                <ui-select
                        multiple
                        ng-model="userprofile.untigrps" limit="1">
                    <ui-select-match placeholder="选择部门...">@{{$item.name}}</ui-select-match>
                    <ui-select-choices
                            repeat="category.id as category in untigrps | filter: $select.search">
                        <div ng-bind-html="category.name | highlight: $select.search"></div>
                    </ui-select-choices>
                </ui-select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">办公电话</label>
            <div class="col-md-4">
                <input type="text" class="form-control" ng-model="userprofile.tel" placeholder="XXXX-XXXXXXXX">
            </div>
            <label class="col-md-2 control-label">办公地址</label>
            <div class="col-md-4">
                <input type="text" class="form-control" ng-model="userprofile.address" placeholder="办公地址...">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">个人简介</label>
            <div class="col-md-10">
                <textarea name="xmjj" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  ng-model="userprofile.memo" maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="个人简介（1000字以内）"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-3 col-md-2 col-sm-6 col-xs-6">
                <a href="javascript:;" class="btn purple-plum" ng-click="showdetail()">
                    <i class="icon-reload"></i> 重获数据 </a>
            </div>
            <div class="col-md-offset-1 col-md-3 col-sm-6 col-xs-6">
                <a href="javascript:;" class="btn green" ng-click="edituserprofile()">
                    <i class="fa fa-check"></i> 确认修改 </a>
            </div>
        </div>


    </form>
</div>
