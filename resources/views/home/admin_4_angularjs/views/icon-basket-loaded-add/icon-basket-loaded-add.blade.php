<div class="tabbable" data-ng-controller="iconbasketloadedCtrl">
    <form id="fm" class="form-horizontal" role="form">
        <div class="mt-element-step">
            <ul class="nav step-thin">
                <li class="col-md-4 bg-grey mt-step-col active">
                    <a href="" data-target="#tab1" data-toggle="tab">
                        <div class="mt-step-number bg-white font-grey">1</div>
                        <div class="mt-step-title uppercase font-grey-cascade"> 基本信息 </div>
                    </a>
                </li>
                <li class="col-md-4 bg-grey mt-step-col">
                    <a href="" data-target="#tab2" data-toggle="tab" ng-click="changestep()">
                        <div class="mt-step-number bg-white font-grey">2</div>
                        <div class="mt-step-title uppercase font-grey-cascade"> 添加详情 </div>
                    </a>
                </li>
                <li class="col-md-4 bg-grey mt-step-col">
                    <a href="" data-target="#tab3" data-toggle="tab" ng-click="stepthrid()">
                        <div class="mt-step-number bg-white font-grey">3</div>
                        <div class="mt-step-title uppercase font-grey-cascade"> 提交申报 </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content" style="margin-top: 15px;">
            <div class="tab-pane active" id="tab1">
                <div class="form-group">
                    <label class="col-md-2 control-label"> 年  度 </label>
                    <div class="col-md-4">
                        <ui-select ng-model="basket.syear" theme="bootstrap">
                            <ui-select-match placeholder="选择年度...">@{{$select.selected}}</ui-select-match>
                            <ui-select-choices repeat="tmparr in tyear | filter: $select.search">
                                <div ng-bind-html="tmparr | highlight: $select.search"></div>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                    <label class="col-md-2 control-label"> 类  别 </label>
                    <div class="col-md-4">
                        <ui-select ng-model="basket.type" theme="bootstrap">
                            <ui-select-match placeholder="选择类别...">@{{$select.selected.label}}</ui-select-match>
                            <ui-select-choices
                                    repeat="tmplist.value as tmplist in listnames track by tmplist.value">
                                @{{tmplist.label}}
                            </ui-select-choices>
                        </ui-select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label"> 部  门 </label>
                    <div class="col-md-4">
                        <ui-select ng-model="basket.unit" theme="bootstrap">
                            <ui-select-match placeholder="选择部门...">@{{$select.selected.name}}</ui-select-match>
                            <ui-select-choices
                                    repeat="category.id as category in untigrps | filter: $select.search">
                                <div ng-bind-html="category.name | highlight: $select.search"></div>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                    <label class="col-md-2 control-label">申报人</label>
                    <div class="col-md-4">
                        <ui-select ng-model="basket.requester" theme="bootstrap">
                            <ui-select-match placeholder="选择申报人...">@{{$select.selected.name}}</ui-select-match>
                            <ui-select-choices repeat="tmpperson.id as tmpperson in peoplegrps | filter: $select.search">
                                <div ng-bind-html="tmpperson.name | highlight: $select.search"></div>
                                <small ng-bind-html="tmpperson.email | highlight: $select.search"></small>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label"> 项目名称 </label>
                    <div class="col-md-4">
                        <div class="input-icon right">
                            <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                            <input type="text" ng-model="basket.summary" class="form-control" placeholder="项目名称">
                        </div>
                    </div>
                    <label class="col-md-2 control-label">总金额</label>
                    <div class="col-md-4">
                        <input type="number" ng-model="basket.total" class="form-control" placeholder="¥0.00" readonly>
                        <p class="help-block">该项自动计算，毋须填写。</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab2"  data-ng-init="changestep()">
                <button id="addData" type="button" class="btn btn-success" ng-click="addData()"><i class="fa fa-plus"></i> 增加</button>
                <button id="delData" type="button" class="btn btn-danger" confirmation-needed="确定要删除这些数据吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
                <button id="saveData" type="button"  class="btn btn-info" ng-click="editData()"><i class="fa fa-check"></i> 保存</button>
                <button id='toggleFiltering' type="button"class="btn yellow" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选</button>
                <div class="portlet-body">
                    <div ui-grid="soucegridOptions" ui-grid-exporter ui-grid-importer ui-grid-selection ui-grid-edit ui-grid-row-edit ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="iconbasketloadedgrid"></div>
                </div>
            </div>
            <div class="tab-pane" id="tab3">
                <table class="table table-bordered table-hover">
                    <tbody>
                    <tr>
                        <th colspan="2" style="text-align:center;">预算年度</th>
                        <td colspan="2">@{{ basket.syear }}</td>
                        <th colspan="3" style="text-align:center;">预算名称</th>
                        <td colspan="8">@{{ basket.summary }}</td>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align:center;">申请单位</th>
                        <td colspan="6">@{{ listunname }} [@{{ basket.unit }}]</td>
                        <th colspan="3" style="text-align:center;">预算类别</th>
                        <td colspan="3">@{{ listtyname }} [@{{ basket.type }}]</td>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align:center;">申请人</th>
                        <td colspan="6">@{{ listusname }} [@{{ basket.requester }}]</td>
                        <th colspan="3" style="text-align:center;">申请日期</th>
                        <td colspan="3">2017-03-10</td>
                    </tr>
                    <tr>
                        <th rowspan="3" style=" text-align: center;line-height: 30px;">采购物资</th>
                        <th style="text-align:center;">序号</th>
                        <th colspan="3" style="text-align:center;">采购项目名称</th>
                        <th colspan="3" style="text-align:center;">规格、型号</th>
                        <th style="text-align:center;">数量</th>
                        <th style="text-align:center;">单位</th>
                        <th style="text-align:center;">预算单价</th>
                        <th colspan="2" style="text-align:center;">备注</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td colspan="3">采购项目名称</td>
                        <td colspan="3">规格、型号</td>
                        <td>数量</td>
                        <td>单位</td>
                        <td>预算单价</td>
                        <td colspan="2">备注</td>
                    </tr>
                    <tr>
                        <th colspan="7" style="text-align:center;">本次预算金额合计（元）</th>
                        <th colspan="5" style="text-align:center;"> </th>
                    </tr>
                    <tr>
                        <th colspan="4" style="text-align:center;">年预算总金额（元）</th>
                        <th colspan="2" style="text-align:center;"> </th>
                        <th colspan="4" style="text-align:center;">累计执行金额（元）</th>
                        <th colspan="3" style="text-align:center;"> </th>
                    </tr>
                    </tbody>
                </table>


                <div class="form-group">
                    <div class="col-md-offset-2 col-md-2 col-sm-4 col-xs-4">
                        <a href="#" ng-click="savedata()" class="btn green">
                            <i class="fa fa-check"></i> 提交申报 </a>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-4">
                        <a href="#" ng-click="savedata()" class="btn blue-oleo">
                            <i class="fa fa-print"></i> - 打 印 - </a>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>