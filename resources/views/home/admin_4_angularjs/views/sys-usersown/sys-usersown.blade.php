<div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN: ACCORDION DEMO -->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="icon-settings font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> 设置个人信息 </span>
                    </div>
                    <div class="tools">
                        <a href="" class="reload"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-2 control-label"> 昵 称 </label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="姓名">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">性 别</label>
                        <div class="col-md-4">
                            <select class="form-control" placeholder="性别">
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">联系电话</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="number" class="form-control" placeholder="1XXXXXXXXXX">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">出生日期</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control" placeholder="年-月-日（XXXX-XX-XX）"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">办公电话</label>
                        <div class="col-md-4">
                            <input type="number" class="form-control" placeholder="XXXX-XXXXXXXX">
                        </div>
                        <label class="col-md-2 control-label">办公地址</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="办公地址...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">个人职务</label>
                        <div class="col-md-4">
                            <select class="form-control" placeholder="职务列表">
                                <option value="经理">经理</option>
                                <option value="总经理">总经理</option>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">所属部门</label>
                        <div class="col-md-4">
                            <select class="form-control" placeholder="机构列表">
                                <option value="财务部">财务部</option>
                                <option value="营销部">营销部</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">个人简介</label>
                        <div class="col-md-10">
                            <textarea name="xmjj" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="个人简介（1000字以内）"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-1">
                            <a href="javascript:;" class="btn purple-plum" ng-click="showdetail()">
                                <i class="icon-reload"></i> 重获数据 </a>
                        </div>
                        <div class="col-md-offset-1 col-md-1">
                            <a href="javascript:;" class="btn green">
                                <i class="fa fa-check"></i> 确认修改 </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END: ACCORDION DEMO -->
        </div>
    </div>
</div>
