<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="ambudgetlistCtrl">
    <script type="text/ng-template" id="approval-detail">
        <div class="row">
            <div class ="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-social-youtube font-red-thunderbird"></i>
                            <span class="caption-subject font-red-thunderbird sbold">预算项目预览（编号：@{{tmpobjdata.no}}&nbsp;）</span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">项目名称：</label>
                                <div class="col-md-6" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.budgetname}}&nbsp;
                                </div>
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">项目类别：</label>
                                <div class="col-md-2" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.type}}&nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">项目摘要：</label>
                                <div class="col-md-6" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.summary}}&nbsp;
                                </div>
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">总金额：</label>
                                <div class="col-md-2" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.total}}&nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">申请人：</label>
                                <div class="col-md-2" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.requester}}&nbsp;
                                </div>
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">申请部门：</label>
                                <div class="col-md-2" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.unit}}&nbsp;
                                </div>
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">审批状态：</label>
                                <div class="col-md-2" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    <small> @{{tmpobjdata.isappr}}&nbsp;</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">开始日期：</label>
                                <div class="col-md-2" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.begindate}}&nbsp;
                                </div>
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">截止日期：</label>
                                <div class="col-md-2" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.enddate}}&nbsp;
                                </div>
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">审批人：</label>
                                <div class="col-md-2" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.theappr}}&nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">项目简介：</label>
                                <div class="col-md-10" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.introduce}}&nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">备注：</label>
                                <div class="col-md-10" style="word-wrap:break-word;word-break:break-all;border:1px solid #ffffff; border-bottom-color: #ccc;">
                                    @{{tmpobjdata.remark}}&nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-12 control-label" style="margin-top: 5px;word-wrap:break-word;word-break:break-all;">附件详情：</label>
                            <div class="col-md-12">
                                <div id="soucegrid" ui-grid="soucegridOptions" ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="am-soucelistgrid"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </script>
    <div class="table-toolbar">
        <button type="button" id='toggleFiltering' ng-click="toggleFiltering()" class="btn yellow"><i class="fa fa-search"></i> 筛选</button>
        <button type="button" id="delData" class="btn red" confirmation-needed="确定要删除这些用户吗？" ng-click="delData()"><i class="fa fa-trash"></i> 删除</button>
        <div class="btn-group btn-group-solid">
            <button type="button" class="btn blue" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-stack-overflow"></i> 审批
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu" >
                <li>
                    <a href="javascript:;"> 审批 </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="javascript:;"> 批量审批通过 </a>
                </li>
                <li>
                    <a href="javascript:;"> 批量审批不通过 </a>
                </li>
            </ul>
        </div>
        <button type="button" id='toggleFiltering' ng-click="printsource()" class="btn blue-oleo"><i class="fa fa-print"></i> 打印</button>

    </div>


    <div id="ambudgetgrid" ui-grid="gridOptions" ui-grid-selection ui-grid-exporter ui-grid-pagination ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="am-budgetlistgrid"></div>
</div>

