<div  data-ng-controller="budgetmanagementCtrl">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN: ACCORDION DEMO -->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="icon-settings font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> 预算申请 </span>
                    </div>
                    <div class="tools">
                        <a href="" class="reload"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-2 control-label">申报项目名称</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="申报项目名称">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">申报部门</label>
                        <div class="col-md-4">
                            <select class="form-control" placeholder="部门列表">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">预算类别</label>
                        <div class="col-md-4">
                            <select class="form-control" ng-model="classlistName" ng-options="o.id as o.name for o in listnames">
                            </select>
                        </div>
                        <label class="col-md-2 control-label">申报人姓名</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="申报人姓名">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">联系电话</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="number" class="form-control" placeholder="13XXXXXXXXX">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">申报人邮箱</label>
                        <div class="col-md-4">
                            <input type="email" class="form-control" placeholder="EmailAddress"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">项目简介</label>
                        <div class="col-md-10">
                            <textarea name="xmjj" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="简略介绍项目（1000字以内）"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">备注</label>
                        <div class="col-md-10">
                            <textarea name="bz" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写申报预算项目备注信息（1000字以内）"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">确认函</label>
                        <div class="col-md-4">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="input-group input-large">
                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                        <i class="fa fa-file fileinput-exists font-yellow"></i>&nbsp;
                                        <span class="fileinput-filename"> </span>
                                    </div>
                                        <span class="input-group-addon btn default btn-file">
                                            <span class="fileinput-new"> 添加 </span>
                                            <span class="fileinput-exists"> 更改 </span>
                                            <input type="hidden"><input type="file" name="..." readonly> </span>
                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> 删除 </a>
                                </div>
                            </div>
                        </div>
                        <label class="control-label">
                            <i class="glyphicon glyphicon-hand-left tooltips font-green font-lg" data-original-title="提示" data-container="body"></i>
                            单位领导审批确认函
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-1">
                            <a href="javascript:;" class="btn red" ng-click="showdetail()">
                                <i class="fa fa-plus"></i>添加详情</a>
                        </div>
                        <div class="col-md-offset-1 col-md-1">
                            <a href="javascript:;" class="btn green">
                                <i class="fa fa-check"></i> 提交申报 </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END: ACCORDION DEMO -->
        </div>
    </div>

    <div uib-collapse="isCollapsed" class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="fa fa-plus font-red"></i>
                        <span class="caption-subject bold uppercase"> 添加物资 </span>
                    </div>
                    <div class="tools">
                        <a href="" class="reload"> </a>
                        <a href="" class="fullscreen"> </a>
                    </div>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-2 control-label">采购目录</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="采购目录">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">物资名称</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="物资名称">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">申请人</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="申请人">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">单价</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="number" class="form-control" placeholder="￥0.00">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">数量</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="0">
                             <span class="input-group-btn">
                                  <select class="btn btn-default">
                                      <option value="个">个</option>
                                      <option value="套">套</option>
                                      <option value="件">件</option>
                                      <option value="组">组</option>
                                      <option value="卷">卷</option>
                                      <option value="台">台</option>
                                      <option value="只">只</option>
                                      <option value="支">支</option>
                                      <option value="张">张</option>
                                      <option value="打">打</option>
                                      <option value="卷">卷</option>
                                      <option value="袋">袋</option>
                                      <option value="包">包</option>
                                      <option value="箱">箱</option>
                                      <option value="桶">桶</option>
                                      <option value="萝">萝</option>
                                      <option value="令">令</option>
                                      <option value="双">双</option>
                                      <option value="项">项</option>
                                  </select>
                             </span>

                            </div>
                        </div>
                        <label class="col-md-2 control-label">推荐品牌</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="推荐品牌"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">主要参数</label>
                        <div class="col-md-10">
                            <textarea name="xmjj" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="简略介绍物资主要参数（1000字以内）"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">备注</label>
                        <div class="col-md-10">
                            <textarea name="xmjj" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写物资信息备注（1000字以内）"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">附件</label>
                        <div class="col-md-4">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="input-group input-large">
                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                        <i class="fa fa-file fileinput-exists font-yellow"></i>&nbsp;
                                        <span class="fileinput-filename"> </span>
                                    </div>
                                        <span class="input-group-addon btn default btn-file">
                                            <span class="fileinput-new"> 添加 </span>
                                            <span class="fileinput-exists"> 更改 </span>
                                            <input type="hidden"><input type="file" name="..." readonly> </span>
                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> 删除 </a>
                                </div>
                            </div>
                        </div>
                        <label class="control-label">
                            <i class="glyphicon glyphicon-hand-left tooltips font-green font-lg" data-original-title="提示" data-container="body"></i>
                            如有详细技术参数请以附件形式在此处上传
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-1">
                            <a href="javascript:;" class="btn purple">
                                <i class="fa fa-file-excel-o"></i> 导入物资 </a>
                        </div>
                        <div class="col-md-offset-1 col-md-1">
                            <a href="javascript:;" class="btn green">
                                <i class="fa fa-check"></i> - 保  存 - </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
