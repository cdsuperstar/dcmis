'use strict';

angular.module("MetronicApp").controller('amassetmangementscrapCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                //console.log(accounts);
                var untarr = [];
                var tmpu = {};
                var unitHash=[];
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    tmpu ={value:accounts[i].id,label:accounts[i].name};
                    unitHash[accounts[i].id]=accounts[i].name;
                    untarr.push(tmpu);
                }
                $scope.gridOptions.columnDefs[6].filter.selectOptions=untarr;
                $scope.gridOptions.columnDefs[6].editDropdownOptionsArray=untarr;
                $scope.gridOptions.columnDefs[6].unitHash =  unitHash ;
            });

            //人员列表
            Restangular.all('/sys-users').getList().then(function (accounts) {
                var userarr = [];
                var tmpu = {};
                var userHash=[];
                for(var i=0;i<accounts.length;i++){
                    tmpu ={value:accounts[i].id,label:accounts[i].name};
                    userHash[accounts[i].id]=accounts[i].name;
                    userarr.push(tmpu);
                }
                $scope.gridOptions.columnDefs[5].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[5].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[5].userHash =  userHash ;
                $scope.gridOptions.columnDefs[11].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[11].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[11].userHash =  userHash ;
            });

            var tableDatas = Restangular.all('/am-assets-management-scrap/getAssToScrap');

            $scope.editData = function () { //修改报废的原因
                var toEditRows = $scope.gridApi.rowEdit.getDirtyRows($scope.gridOptions);
                toEditRows.forEach(function (editdata) {
                    var userWithId = _.find($scope.gridOptions.data, function (user) {
                        return user.id === editdata.entity.id;
                    });
                    userWithId.route = "/amassregs";
                    var tmpdata = new Date(userWithId.scrapdate);
                    if(tmpdata) userWithId.scrapdate = tmpdata.getFullYear()+"-"+(tmpdata.getMonth()+1)+"-"+tmpdata.getDate();
                    userWithId.put().then(function (res) {
                        if (res.success) {
                            showMsg(res.messages.toString(), '信息', 'lime');
                            $scope.gridApi.rowEdit.setRowsClean(Array(userWithId));
                        } else {
                            showMsg(res.errors.toString(), '错误', 'ruby');
                        }
                    });
                });
            };
            $scope.saveRow = function (rowEntity) {
                //$scope.editdataids.push(rowEntity.id);
                var promise = $q.defer();
                $scope.gridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
                //promise.resolve();
                promise.reject();
            };

            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter: true,
                enableCellEditOnFocus:true,
                columnDefs: [
                    {name: '物资编号', field: 'amsubbudget.wzno',width: '120',enableCellEdit: false,enableColumnMenu: true},
                    {name: '物资名称', field: 'amsubbudget.ambaseas.name',width: '150',enableCellEdit: false,enableColumnMenu: true,pinnedLeft:true,
                        cellTooltip: function(row){ return row.entity.amsubbudget.ambaseas.name; },
                        //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                    {name: '单位', field: 'amsubbudget.ambaseas.measunit',width: '50',enableCellEdit: false,enableColumnMenu: true,editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownRowEntityOptionsArrayPath: 'tmeas.options', editDropdownIdLabel: 'value'
                    },
                    {name: '规格、型号', field: 'amsubbudget.wzsmodel',width: '150',enableColumnMenu: true,enableCellEdit: false,
                        cellTooltip: function(row){ return row.entity.aspara; },
                        //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                    },
                    {name: '领用数量', field: 'amt',width: '80',enableCellEdit: false,enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '领用人', field: 'asuser',width: '80',enableCellEdit: false,enableColumnMenu: true,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.userHash',userHash:[],
                        filter: {
                            // term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '领用单位', field: 'unitgrp_id',width: '200',enableCellEdit: false,enableColumnMenu: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.unitHash',unitHash:[],
                        filter: {
                            // term:3,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '领用时间', field: 'userdate',width: '150',enableCellEdit: false,enableColumnMenu: true},
                    {name: '有效期', field: 'validdate',width: '100',enableCellEdit: false,type:'date',enableColumnMenu: true,cellFilter: 'date:"yyyy-MM-dd"'},
                    {name: '物资状态', field: 'amsubbudget.asstate',width: '120',enableColumnMenu: true,
                        editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                        editDropdownValueLabel: 'isasstate', editDropdownOptionsArray: [
                        { id: '固定资产', isasstate: '固定资产' },
                        { id: '非固定资产', isasstate: '非固定资产' }],
                        filter: {
                            // term: '',
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [
                                { value: '固定资产', label: '固定资产' },
                                { value: '非固定资产', label: '非固定资产' }]}
                    },
                    {name: '领用备注', field: 'remark',width: '150',enableColumnMenu: true,enableCellEdit: false,
                        cellTooltip: function(row){ return row.entity.remark; },
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                    },
                    {name: '报废人', field: 'scrapuser',width: '80',enableCellEdit: true,enableColumnMenu: true,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.userHash',userHash:[],
                        filter: {
                            // term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },

                    {name: '报废时间', field: 'scrapdate',width: '120',type:'date',cellFilter: 'date:"yyyy-MM-dd"',enableColumnMenu: true},
                    {name: '报废状态', field: 'state',width: '80',editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                        editDropdownValueLabel: 'isstate', editDropdownOptionsArray: [
                        { id: '正常', isstate: '正常' },
                        { id: '报废', isstate: '报废' }],
                        filter: {
                            // term: '',
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [
                                { value: '正常', label: '正常' },
                                { value: '报废', label: '报废' }
                            ]}
                    },
                    {name: '报废备注', field: 'scrapremark',width: '150',enableColumnMenu: true,enableCellEdit: false,
                        cellTooltip: function(row){ return row.entity.scrapremark; },
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP"><span class=" icon-note icon-hand" ng-click="grid.appScope.showdetail(row)"  title="登记领用"></span>{{COL_FIELD CUSTOM_FILTERS}}</div>'
                    }

                ],

                enableGridMenu: true,
                //exporterMenuCsv:false,
                //exporterMenuPdf:false,
                //--------------导出----------------------------------
                exporterHeaderFilterUseName : true,
                exporterMenuCsv : false, //导出Excel 开关
                exporterMenuPdf : false, //导出pdf 开关
                exporterMenuLabel : "Export",
                exporterOlderExcelCompatibility : true,
                exporterCsvColumnSeparator: ',',
                exporterCsvFilename:'download.csv',

                enablePagination: true, //是否分页，默认为true
                enablePaginationControls: true, //使用默认的底部分页
                paginationPageSizes: [10, 30, 50],
                paginationCurrentPage: 1,
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                }
            };

            $scope.showdetail = function(row) {
                // console.log(row.entity.appstate);
                var detaildata=angular.fromJson(row.entity.id);
                ngDialog.openConfirm({
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    template: 'assets-management-scrap',
                    className: 'ngdialog-theme-default assetsmanagementscrap',
                    scope: $scope,
                    controller: ['$scope',function ($scope) {
                        // console.log($scope);
                        $scope.tmpobjno = row.entity.amsubbudget.wzno;  //取当取当期物资的no
                        $scope.tmpobjname = row.entity.amsubbudget.ambaseas.name;  //取当前物资的name
                        $scope.scrapremark = row.entity.scrapremark;//赋初始值
                    }]

                }).then(function (dcEdition) {
                    // console.log(dcEdition);
                    if(row.entity.scrapremark != dcEdition){
                        row.entity.scrapremark = dcEdition;
                        $scope.gridApi.rowEdit.setRowsDirty(Array(row.entity) );
                    }
                }, function (dcEdition) {

                });
            };

            $scope.exportxls = function(){
                var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
                $scope.gridApi.exporter.csvExport( 'all', 'all', myElement );
            };

            $scope.toggleFilteringsign = '筛选数据';
            $scope.toggleFiltering = function(){
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
                if(!$scope.gridOptions.enableFiltering) $scope.toggleFilteringsign = '筛选数据';
                else $scope.toggleFilteringsign = '取消筛选';
                $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
            };

            $scope.printoutformdata = function () {
                var date = new Date();
                var userunitid = "";
                var unitname = "";
                //数据
                var datastr = "";
                var selectdcmodels = $scope.gridApi.selection.getSelectedGridRows();
                selectdcmodels.forEach(function (changedata) {
                        // console.log(changedata.entity.unitgrp_id);
                        userunitid = changedata.entity.unitgrp_id;
                        datastr="<tr>\n" +
                            "<td style='vertical-align:middle;text-align: center;'>" + changedata.entity.amsubbudget.wzno + "</td>\n" +
                            "<td style='vertical-align:middle;text-align: center;'>" + changedata.entity.amsubbudget.ambaseas.name + "</td>\n" +
                            "<td style='vertical-align:middle;text-align: center;'>" + (changedata.entity.amsubbudget.wzsmodel ? changedata.entity.amsubbudget.wzsmodel :"") + "</td>\n" +
                            "<td style='vertical-align:middle;text-align: center;'>" + (changedata.entity.amsubbudget.ambaseas.measunit ? changedata.entity.amsubbudget.ambaseas.measunit : "") + "</td>\n" +
                            "<td style='vertical-align:middle;text-align: center;'>" + changedata.entity.amt + "</td>\n" +
                            "<td style='vertical-align:middle;text-align: center;'>¥" + changedata.entity.amsubbudget.price + "</td>\n" +
                            "<td style='vertical-align:middle;text-align: center;'>¥" + (changedata.entity.amt * changedata.entity.amsubbudget.price).toFixed(2) + "</td>\n" +
                            "<td style='vertical-align:middle;text-align: center;'>" + (changedata.entity.amsubbudget.remark ?  changedata.entity.amsubbudget.remark : "") + "</td>\n" +
                            "</tr>\n" + datastr;
                    }
                );

                //机构名称
                unitname = $scope.gridOptions.columnDefs[6].unitHash[userunitid];


                var head_str = "<html><head><title>出库通知单 - 打印</title></head>" +
                    "<body style='margin:0px;'><p><h2 align='center'>成都理工大资产经营有限责任公司</h2></p><p><h3 align='center'>物资出库通知单</h3></p>"+
                    "<table class='table table-bordered table-hover' width='800' border='0' style='border-collapse:collapse;' align='center' cellpadding='8px'>\n" +
                    "<tr>\n" +
                    "<td width='500' style='vertical-align:middle;text-align: left;'>领用单位："+unitname+"</td>\n" +
                    "<td width='300' style='vertical-align:middle;text-align: right;'>制单日期："+date.getFullYear()+"年"+(date.getMonth()+1)+"月"+date.getDate()+"日 "+"</td>\n" +
                    "</tr>\n" +
                    "</table>"; //先生成头部
                var htmstr = "<table class='table table-bordered table-hover' width='800' border='1' style='border-collapse:collapse;' align='center' cellpadding='8px'>\n" +
                    "<tr>\n" +
                    "<th style='vertical-align:middle;text-align: center;'>编号</th>\n" +
                    "<th style='vertical-align:middle;text-align: center;'>名称</th>\n" +
                    "<th style='vertical-align:middle;text-align: center;'>规格</th>\n" +
                    "<th style='vertical-align:middle;text-align: center;'>单位</th>\n" +
                    "<th style='vertical-align:middle;text-align: center;'>数量</th>\n" +
                    "<th style='vertical-align:middle;text-align: center;'>单价</th>\n" +
                    "<th style='vertical-align:middle;text-align: center;'>总金额</th>\n" +
                    "<th style='vertical-align:middle;text-align: center;'>备注</th>\n" +
                    "</tr>\n" + datastr +
                    "</table></body></html>"; //生成尾部

                var foot_str = "<table class='table table-bordered table-hover' width='800' border='0' style='border-collapse:collapse;' align='center' cellpadding='8px'>\n" +
                    "<tr>\n" +
                    "<td colspan='8' style='vertical-align:middle;text-align: left;'>编号：[<b>No 201809001</b>]&nbsp;&nbsp;&nbsp;库管员：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;采购人：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;领用人：</td>\n" +
                    "</tr>\n" +
                    "</table></body></html>"; //生成尾部

                var newh = window.open();
                newh.document.body.innerHTML = head_str + htmstr + foot_str; //构建新网页
            };

            $scope.refreshData = function(){
                $scope.gridOptions.data = [];
                tableDatas.getList().then(function (accounts) {
                    var allAccounts = accounts;
                    $scope.gridOptions.data = allAccounts;
                });
            };

            tableDatas.getList().then(function (accounts) {
                var allAccounts = accounts;
                for(var i=0;i<allAccounts.length;i++){
                    if(allAccounts[i].scrapdate) allAccounts[i].scrapdate=new Date(allAccounts[i].scrapdate);
                }
                // console.log(accounts);
                $scope.gridOptions.data = allAccounts;
            });

        }
    ]
)
    .filter('dFilterHash',function(){
        return function(v,h){
            if (h=== undefined) return '';
            if (h[v]===undefined) return '';
            return h[v];
        }
    })
;
