<div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN: ACCORDION DEMO -->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="icon-settings font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> 添加用户信息 </span>
                    </div>
                    <div class="tools">
                        <a href="" class="fullscreen"> </a>
                    </div>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-2 control-label"> 昵 称 </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" ng-model="dcEdition.name" placeholder="姓名">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">性 别</label>
                        <div class="col-md-4">
                            <select class="form-control" ng-model="dcEdition.sex">
                                <option value='' disabled selected style='display:none;'>请选择性别</option>
                                <option value="1" ng-selected="dcEdition.sex=='男'">男</option>
                                <option value="0" ng-selected="dcEdition.sex=='女'">女</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">联系电话</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="number" class="form-control" ng-model="dcEdition.phone" placeholder="1XXXXXXXXXX">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">出生日期</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" uib-datepicker-popup="@{{format}}" ng-model="dcEdition.birth" is-open="tmpbirthday.opened" ng-required="true" close-text="关闭"
                                       clear-text="清空" current-text="今天" alt-input-formats="altInputFormats" datepicker-options="dateOptions" placeholder="XXXX-XX-XX"/>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-model="birth" ng-click="opendatepick()"><i class="glyphicon glyphicon-calendar"></i></button>
                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">办公电话</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control" ng-model="dcEdition.tel" placeholder="XXXX-XXXXXXXX">
                        </div>
                        <label class="col-md-2 control-label">办公地址</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" ng-model="dcEdition.address" placeholder="办公地址...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">个人职务</label>
                        <div class="col-md-4">
                            <select class="form-control" placeholder="职务列表">
                                <option value="总经理">总经理</option>
                                <option value="经理">经理</option>
                                <option value="董事">董事</option>
                                <option value="总监">总监</option>
                                <option value="主任">主任</option>
                                <option value="部长">部长</option>
                                <option value="主管">主管</option>
                                <option value="普通员工">普通员工</option>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">所属部门</label>
                        <div class="col-md-4">
                            <ui-select
                                    multiple
                                    ng-model="categories.selected"
                                    on-select="selectCategory($item, $model)"
                                    on-remove="deselectCategory($item, $model)">
                                <ui-select-match placeholder="选择部门...">@{{$item.name}}</ui-select-match>
                                <ui-select-choices
                                        repeat="category in categories track by category.id">
                                    @{{category.name}}
                                </ui-select-choices>
                            </ui-select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">个人简介</label>
                        <div class="col-md-10">
                            <textarea name="xmjj" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  ng-model="dcEdition.memo" maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="个人简介（1000字以内）"></textarea>
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
