<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="amassetmangementlistCtrl">
    <form id="fm" class="form-horizontal" role="form">
        <div class="table-toolbar" style="margin-bottom: 0px;">
                <div class="form-group">
                    <label class="col-md-1 control-label">  年 度  </label>
                    <div class="col-md-2">
                        <ui-select ng-model="managelist.syear" theme="bootstrap">
                            <ui-select-match placeholder="选择年度..." allow-clear="true">@{{$select.selected}}</ui-select-match>
                            <ui-select-choices repeat="tmparr in tyear | filter: $select.search">
                                <div ng-bind-html="tmparr | highlight: $select.search"></div>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                    <label class="col-md-1 control-label">  月 份  </label>
                    <div class="col-md-2">
                        <ui-select ng-model="managelist.smonth" theme="bootstrap">
                            <ui-select-match placeholder="选择月份..." allow-clear="true">@{{$select.selected}}</ui-select-match>
                            <ui-select-choices repeat="tmarmr in tmonth | filter: $select.search">
                                <div ng-bind-html="tmarmr | highlight: $select.search"></div>
                            </ui-select-choices>
                        </ui-select>
                    </div>
                    <div class="col-md-4">
                        <button type="button" id="inmatterButton" class="btn yellow" ng-click="printinattredata()"><i class="fa fa-print"></i> 生成入库统计表
                        </button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" id="outmatterButton" class="btn green" ng-click="printoutattredata()"><i class="fa fa-print"></i> 生成出库统计表
                        </button>
                    </div>
                </div>
            </div>
    </form>
    <div id="amassetmangementlistgrid" ui-grid="gridOptions"  ui-grid-pinning ui-grid-exporter ui-grid-pagination ui-grid-cellNav ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns class="amassetmangementlistgrid"></div>

</div>