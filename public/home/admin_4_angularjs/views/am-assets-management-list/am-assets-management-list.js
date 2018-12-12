'use strict';

angular.module("MetronicApp").controller('amassetmangementlistCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
            var date = new Date();
            var currentYear = date.getFullYear();
            var currentMonth = date.getMonth() + 1;
            var yeararr = new Array();
            for(var val = (currentYear-3); val <= (currentYear+3); val++){
                yeararr.push(val);
            }
            $scope.tyear = yeararr;
            var monarr = new Array();
            //获得月份列表
            for(var yval = 1; yval <= 12; yval++){
                monarr.push(yval);
            }
            $scope.tmonth = monarr;
            //end
            $scope.managelist = { syear:currentYear,smonth:currentMonth};  //初始化为当前年月

            //预算类别列表
            Restangular.all('/am-budget-lb').getList().then(function (accounts) {
                //console.log(accounts);
                var lbarr = [];
                var tmpu = {};
                var lbHash=[] ;
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    tmpu ={value:accounts[i].id,label:accounts[i].type};
                    lbHash[accounts[i].id] = accounts[i].type;
                    lbarr.push(tmpu);
                }
                $scope.listnames = accounts;
                // $scope.gridOptions.columnDefs[3].filter.selectOptions=lbarr;
                // $scope.gridOptions.columnDefs[3].editDropdownOptionsArray=lbarr;
                $scope.gridOptions.columnDefs[3].lbHash =  lbHash;
            });

            $scope.gridOptions={
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter:true,
                showGridFooter:false,
                enableVerticalScrollbar:1,
                enableHorizontalScrollbar :1,
                enableGridMenu: true,
                columnDefs: [
                    {name: '采购日期', field: 'purchdate',width: '100',enableColumnMenu: true},
                    {name: '部门', field: 'amapplication.unitgrp.name',width: '120',enableColumnMenu: true},
                    {name: '供应商', field: 'amsupplier.compname',width: '100',enableColumnMenu: true},
                    {name: '采购类型', field: 'amapplication.ambudgettype_id',width: '100',enableColumnMenu: true,enableHiding: false,
                        cellFilter: 'dFilterHash:col.colDef.lbHash'},
                    {name: '预算单号', field: 'amapplication.no',width: '100',enableColumnMenu: true},
                    {name: '物资名称', field: 'ambaseas.name',width: '150',enableColumnMenu: true},
                    {name: '规格型号', field: 'wzsmodel',width: '120',enableColumnMenu: true},
                    {name: '单位', field: 'ambaseas.measunit',width: '60',enableColumnMenu: true},
                    {name: '数量', field: 'amt',width: '80',enableColumnMenu: true},
                    {name: '单价', field: 'bdg',width: '80',enableColumnMenu: true,cellFilter: 'currency'},
                    {name: '金额', field: 'alltotal',width: '80',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '备注', field: 'remark',width: '100',enableColumnMenu: false}

                ],

                //--------------导出----------------------------------
                exporterHeaderFilterUseName : true,
                exporterMenuCsv : true, //导出Excel 开关
                exporterMenuPdf : false, //导出pdf 开关
                exporterMenuLabel : "Export",
                exporterOlderExcelCompatibility : true,
                exporterCsvColumnSeparator: ',',
                exporterCsvFilename:'datadownload.csv',

                enablePagination: true, //是否分页，默认为true
                enablePaginationControls: true, //使用默认的底部分页
                paginationPageSizes: [10, 30, 50],
                paginationCurrentPage: 1,
                paginationPageSize: 30,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                }
            };
            var ShearchJson = "/amsubbudgets/getDateDatasOfInbound/" + $scope.managelist.syear + "/" + $scope.managelist.smonth;
            Restangular.all(ShearchJson).getList().then(function (accounts) {
                var allAccounts = accounts;
                for (var item=0;item<accounts.length;item++){
                    if (accounts[item]["alltotal"] === null) accounts[item]["alltotal"] = 0;
                    if (accounts[item]["bdg"] === null) accounts[item]["amsubbudget.price"] = 0;
                    if (accounts[item]["amt"] === null) accounts[item]["amt"] = 0;
                    accounts[item]["alltotal"] = Number(accounts[item]["amt"]) * Number(accounts[item]["bdg"]); //计算金额
                }
                // console.log(accounts);
                $scope.gridOptions.data = allAccounts;
            });

            //生成生成入库统计表
            $scope.printinattredata = function(){
                var ShearchJson = "/amsubbudgets/getDateDatasOfInbound/" + $scope.managelist.syear + "/" + $scope.managelist.smonth;
                Restangular.all(ShearchJson).getList().then(function (accounts) {
                    var allAccounts = accounts;
                    for (var item=0;item<accounts.length;item++){
                        if (accounts[item]["alltotal"] === null) accounts[item]["alltotal"] = 0;
                        if (accounts[item]["bdg"] === null) accounts[item]["amsubbudget.price"] = 0;
                        if (accounts[item]["amt"] === null) accounts[item]["amt"] = 0;
                        accounts[item]["alltotal"] = Number(accounts[item]["amt"]) * Number(accounts[item]["bdg"]); //计算金额
                    }
                    // console.log(accounts);
                    $scope.gridOptions.data = allAccounts;
                });

            };

            //生成出库统计表
            $scope.printoutattredata = function(){
                $scope.gridOptions={
                    enableSorting: true,
                    enableFiltering: false,
                    showColumnFooter:true,
                    showGridFooter:false,
                    enableVerticalScrollbar:1,
                    enableHorizontalScrollbar :1,
                    enableGridMenu: true,
                    columnDefs: [
                        {name: '领用日期', field: 'userdate',width: '100',enableColumnMenu: true},
                        {name: '部门', field: 'unitgrp.name',width: '150',enableColumnMenu: true},
                        {name: '出库单号', field: 'outbound',width: '100',enableColumnMenu: true},
                        {name: '物资名称', field: 'amsubbudget.ambaseas.name',width: '180',enableColumnMenu: true},
                        {name: '规格型号', field: 'amsubbudget.wzsmodel',width: '120',enableColumnMenu: true},
                        {name: '单位', field: 'amsubbudget.ambaseas.measunit',width: '60',enableColumnMenu: true},
                        {name: '数量', field: 'amt',width: '80',enableColumnMenu: true},
                        {name: '单价', field: 'amsubbudget.price',width: '80',enableColumnMenu: true,cellFilter: 'currency'},
                        {name: '金额', field: 'alltotal',width: '80',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                        {name: '备注', field: 'remark',width: '120',enableColumnMenu: false}

                    ],

                    //--------------导出----------------------------------
                    exporterHeaderFilterUseName : true,
                    exporterMenuCsv : true, //导出Excel 开关
                    exporterMenuPdf : false, //导出pdf 开关
                    exporterMenuLabel : "Export",
                    exporterOlderExcelCompatibility : true,
                    exporterCsvColumnSeparator: ',',
                    exporterCsvFilename:'datadownload.csv',

                    enablePagination: true, //是否分页，默认为true
                    enablePaginationControls: true, //使用默认的底部分页
                    paginationPageSizes: [10, 30, 50],
                    paginationCurrentPage: 1,
                    paginationPageSize: 30,
                    data: [],
                    onRegisterApi: function (gridApi) {
                        $scope.gridApi = gridApi;
                    }
                };
                var ShearchJson = "/amsubbudgets/getDateDatasOfOutbound/" + $scope.managelist.syear + "/" + $scope.managelist.smonth;
                Restangular.all(ShearchJson).getList().then(function (accounts) {
                    var allAccounts = accounts;
                    for (var item=0;item<accounts.length;item++){
                        if (accounts[item]["alltotal"] === null) accounts[item]["alltotal"] = 0;
                        if (accounts[item]["amsubbudget.price"] === null) accounts[item]["amsubbudget.price"] = 0;
                        if (accounts[item]["amt"] === null) accounts[item]["amt"] = 0;
                        accounts[item]["alltotal"] = Number(accounts[item]["amt"]) * Number(accounts[item]["amsubbudget.price"]); //计算金额
                    }
                    console.log(accounts);
                    $scope.gridOptions.data = allAccounts;
                });

            };


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
