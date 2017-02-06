<div class="portlet-body" data-ng-controller="budgetmanagementCtrl">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-md-2 control-label">项目名称</label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="text" class="form-control" placeholder="项目名称">
                </div>
            </div>
            <label class="col-md-2 control-label">总金额</label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="number" class="form-control" placeholder="¥0.00">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">项目摘要</label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="text" class="form-control" placeholder="项目摘要">
                </div>
            </div>
            <label class="col-md-2 control-label">申报人</label>
            <div class="col-md-4">
                <ui-select ng-model="person.selected" theme="bootstrap">
                    <ui-select-match placeholder="选择申报人...">@{{$select.selected.name}}</ui-select-match>
                    <ui-select-choices repeat="item in people | filter: $select.search">
                        <div ng-bind-html="item.name | highlight: $select.search"></div>
                        <small ng-bind-html="item.ykth | highlight: $select.search"></small>
                    </ui-select-choices>
                </ui-select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">预算类别</label>
            <div class="col-md-4">
                <select class="form-control" ng-model="classlistName" ng-options="o.id as o.name for o in listnames">
                </select>
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
            <label class="col-md-2 control-label">开始日期</label>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" uib-datepicker-popup="@{{format}}" ng-model="startdate" is-open="tmppopupstart.opened" ng-required="true" close-text="关闭"
                           clear-text="清空" current-text="今天" alt-input-formats="altInputFormats" datepicker-options="dateOptions" placeholder="XXXX-XX-XX"/>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-model="birth" ng-click="opendatepickstart()"><i class="glyphicon glyphicon-calendar"></i></button>
                </span>
                </div>
            </div>
            <label class="col-md-2 control-label">结束日期</label>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" uib-datepicker-popup="@{{format}}" ng-model="enddate" is-open="tmppopupend.opened" ng-required="true" close-text="关闭"
                           clear-text="清空" current-text="今天" alt-input-formats="altInputFormats" datepicker-options="dateOptions" placeholder="XXXX-XX-XX"/>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-model="birth" ng-click="opendatepickend()"><i class="glyphicon glyphicon-calendar"></i></button>
                </span>
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
            <div class="col-md-5">
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
            <div class="col-md-3">
                <label class="control-label"  data-container="body">
                    <i class="glyphicon glyphicon-hand-left tooltips font-green font-lg" data-original-title="提示"></i>
                    单位领导审批确认函
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-3 col-md-2 col-sm-6 col-xs-6">
                <a href="javascript:;" class="btn red" ng-click="showdetail()">
                    <i class="fa fa-plus"></i>添加详情</a>
            </div>
            <div class="col-md-offset-1 col-md-3 col-sm-6 col-xs-6">
                <a href="#" ng-click="savedate()" class="btn green">
                    <i class="fa fa-check"></i> 提交申报 </a>
            </div>
        </div>
    </form>
    <div uib-collapse="isother" class="row">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-plus font-red"></i>
                    <span class="caption-subject bold uppercase"> 添加详细资料 </span>
                </div>
                <div class="tools">
                    <a href="" class="fullscreen"> </a>
                </div>
            </div>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-md-2 control-label">金额</label>
                    <div class="col-md-4">
                        <div class="input-icon right">
                            <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                            <input type="number" class="form-control" placeholder="¥0.00">
                        </div>
                    </div>
                    <label class="col-md-2 control-label">地点</label>
                    <div class="col-md-4">
                        <div class="input-icon right">
                            <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                            <input type="text" class="form-control" placeholder="地点">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">负责人</label>
                    <div class="col-md-4">
                        <div class="input-icon right">
                            <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                            <input type="text" class="form-control" placeholder="负责人">
                        </div>
                    </div>
                    <label class="col-md-2 control-label">负责人电话</label>
                    <div class="col-md-4">
                        <div class="input-icon right">
                            <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                            <input type="number" class="form-control" placeholder="13XXXXXXXXX">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">备注</label>
                    <div class="col-md-10">
                        <textarea name="xmjj" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写备注信息（1000字以内）"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-3 col-sm-6 col-xs-6">
                        <a href="javascript:;" class="btn green">
                            <i class="fa fa-check"></i> - 保  存 - </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div uib-collapse="isproject" class="row">
        <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="fa fa-plus font-red"></i>
                        <span class="caption-subject bold uppercase"> 添加工程资料 </span>
                    </div>
                    <div class="tools">
                        <a href="" class="fullscreen"> </a>
                    </div>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-2 control-label">合同名称</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="合同名称">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">合同金额</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="number" class="form-control" placeholder="¥0.00">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">负责人</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="负责人">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">负责人电话</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="number" class="form-control" placeholder="13XXXXXXXXX">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">合同编号</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="合同编号">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">付款用途</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="付款用途">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">收款单位</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="收款单位">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">施工地点</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="地点">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">银行账号</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="银行账号">
                            </div>
                        </div>
                        <label class="col-md-2 control-label">收款单位开户行</label>
                        <div class="col-md-4">
                            <div class="input-icon right">
                                <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                                <input type="text" class="form-control" placeholder="收款单位开户行">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">开工日期</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" uib-datepicker-popup="@{{format}}" ng-model="gcstartdate" is-open="tmppopupgcstart.opened" ng-required="true" close-text="关闭"
                                       clear-text="清空" current-text="今天" alt-input-formats="altInputFormats" datepicker-options="dateOptions" placeholder="XXXX-XX-XX"/>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-model="birth" ng-click="opendatepickgcstart()"><i class="glyphicon glyphicon-calendar"></i></button>
                </span>
                            </div>
                        </div>
                        <label class="col-md-2 control-label">竣工日期</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" uib-datepicker-popup="@{{format}}" ng-model="gcenddate" is-open="tmppopupgcend.opened" ng-required="true" close-text="关闭"
                                       clear-text="清空" current-text="今天" alt-input-formats="altInputFormats" datepicker-options="dateOptions" placeholder="XXXX-XX-XX"/>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-model="birth" ng-click="opendatepickgcend()"><i class="glyphicon glyphicon-calendar"></i></button>
                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">工期要求</label>
                        <div class="col-md-10">
                            <textarea name="xmjj" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="填写工期要求（1000字以内）"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-2 col-sm-6 col-xs-6">
                            <a href="javascript:;" class="btn purple">
                                <i class="fa fa-file-excel-o"></i> 导入数据 </a>
                        </div>
                        <div class="col-md-offset-1 col-md-3 col-sm-6 col-xs-6">
                            <a href="javascript:;" class="btn green">
                                <i class="fa fa-check"></i> - 保  存 - </a>
                        </div>
                    </div>
                </form>
            </div>
    </div>
    <div uib-collapse="ismaterial" class="row">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-plus font-red"></i>
                    <span class="caption-subject bold uppercase"> 添加物资资料 </span>
                </div>
                <div class="tools">
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
                    <div class="col-md-5">
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
                    <div class="col-md-5">
                        <label class="control-label" data-container="body">
                            <i class="glyphicon glyphicon-hand-left tooltips font-green font-lg" data-original-title="提示"></i>
                            如有详细技术参数请以附件形式在此处上传
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-2 col-sm-6 col-xs-6">
                        <a href="javascript:;" class="btn purple">
                            <i class="fa fa-file-excel-o"></i> 导入物资 </a>
                    </div>
                    <div class="col-md-offset-1 col-md-3 col-sm-6 col-xs-6">
                        <a href="javascript:;" class="btn green">
                            <i class="fa fa-check"></i> - 保  存 - </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

