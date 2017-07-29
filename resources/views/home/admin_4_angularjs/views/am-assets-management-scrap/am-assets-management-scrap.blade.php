<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="amassetmangementscrapCtrl">
    <script type="text/ng-template" id="assets-management-scrap">
        <form class="form-horizontal" role="form">
            <div class="row">
                <div class ="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-social-youtube font-red-thunderbird"></i>
                                <span class="caption-subject font-red-thunderbird sbold">填写报废备注信息（编号：@{{tmpobjno}}&nbsp;   物资名称：@{{ tmpobjname }}）</span>
                            </div>
                            <div class="tools">
                                {{--<a href="" class="fullscreen" data-original-title="全屏" title="全屏"> </a>--}}
                                <a href="javascript:;" class="remove"  ng-click="closeThisDialog(dcEdition)" data-original-title="关闭" title="关闭">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea ng-model="scrapremark" class="form-control" rows="5" style="margin-top: 0px; margin-bottom: 0px; height: 300px;"  maxlength="3000" onchange="this.value=this.value.substring(0, 3000)" onkeydown="this.value=this.value.substring(0, 3000)" onkeyup="this.value=this.value.substring(0, 3000)" placeholder="填写备注内容（3000字以内）"></textarea>
                                </div>
                            </div>
                            <div class="form-action" align="center">
                                <div class="col-md-4 col-sm-6 col-xs-6">
                                    <a href="javascript:;" class="btn green" ng-click="confirm(scrapremark)">
                                        <i class="fa fa-check"></i>  确 认 </a>
                                </div>

                                <div class="col-md-4 col-sm-6 col-xs-6">
                                    <a href="javascript:;" class="btn purple-plum" ng-click="closeThisDialog(scrapremark)">
                                        <i class="icon-reload"></i>  取 消  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </script>
    <div class="table-toolbar">
        <button id="saveData" type="button"  class="btn btn-primary" ng-click="editData()"><i class="fa fa-check"></i> 保存数据 </button>
        {{--<div class="btn-group btn-group-solid">--}}
            {{--<button type="button" id="icon-basketset" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sign-out"></i> 物资状态处理  <i class="fa fa-angle-down"></i>--}}
            {{--</button>--}}
            {{--<ul class="dropdown-menu" >--}}
                {{--<li>--}}
                    {{--<a href="javascript:;" confirmation-needed="确定将这些物资状态置为【正常】吗？" ng-click="changeStatus('purchway','正常')"> 物资状态【正常】 </a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a href="javascript:;" confirmation-needed="确定要报废这些资产吗？"  ng-click="changeStatus('purchway','报废')"> 物资状态【报废】 </a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
        <button id='toggleFiltering' type="button"class="btn btn-warning" ng-click="toggleFiltering()" ><i class="fa fa-search"></i> 筛选数据 </button>
        <button id="refreshButton" type="button"  class="btn purple-plum" ng-click="refreshData()"><i class="fa fa-refresh"></i> 重获数据 </button>

        <div class="btn-group btn-group-solid pull-right">
            <button id="refreshButton" type="button"  class="btn green-meadow" ng-click="exportxls()"><i class="fa fa-file-excel-o"> </i>  导出Excel</button>
        </div>
    </div>
    <div id="amassetmangementscrapgrid" ui-grid="gridOptions"  ui-grid-edit ui-grid-row-edit ui-grid-pinning ui-grid-exporter ui-grid-selection ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="amassetmangementscrapgrid"></div>
</div>