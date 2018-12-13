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
                    {name: '部门', field: 'unitname',width: '120',enableColumnMenu: true},
                    {name: '供应商', field: 'amsuppliername',width: '100',enableColumnMenu: true},
                    {name: '采购类型', field: 'ambudgettypename',width: '100',enableColumnMenu: true},
                    {name: '预算单号', field: 'amapplicationno',width: '100',enableColumnMenu: true},
                    {name: '物资名称', field: 'ambaseasname',width: '150',enableColumnMenu: true},
                    {name: '规格型号', field: 'wzsmodel',width: '120',enableColumnMenu: true},
                    {name: '单位', field: 'measunit',width: '60',enableColumnMenu: true},
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
                exporterCsvFilename:'indatadownload.csv',

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
                if(accounts.length === 0){
                    showMsg('当前年度月份无入库数据 0 ！', '信息', 'ruby');
                    return false;
                }
                for (var item=0;item<accounts.length;item++){
                    if (accounts[item]["alltotal"] === null) accounts[item]["alltotal"] = 0;
                    if (accounts[item]["bdg"] === null) accounts[item]["bdg"] = 0;
                    if (accounts[item]["amt"] === null) accounts[item]["amt"] = 0;
                    accounts[item]["alltotal"] = Number(accounts[item]["amt"]) * Number(accounts[item]["bdg"]); //计算金额

                    //转换到到第一级
                    if(accounts[item]["amapplication_id"]) accounts[item]["unitname"] = accounts[item].amapplication.unitgrp.name;
                    if(accounts[item]["amsupplier_id"]) accounts[item]["amsuppliername"] = accounts[item].amsupplier.compname;
                    if(accounts[item]["amapplication_id"]) accounts[item]["amapplicationno"] = accounts[item].amapplication.no;
                    accounts[item]["ambaseasname"] = accounts[item].ambaseas.name;
                    accounts[item]["measunit"] = accounts[item].ambaseas.measunit;
                    accounts[item]["ambudgettypename"] = accounts[item].amapplication.ambudgettype.type;
                    //转换结束
                    // console.log(accounts[item].amapplication.unitgrp.name);
                }
                // console.log(accounts);
                $scope.gridOptions.data = accounts;
            });

            //生成生成入库统计表
            $scope.printinattredata = function(){
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
                        {name: '部门', field: 'unitname',width: '120',enableColumnMenu: true},
                        {name: '供应商', field: 'amsuppliername',width: '100',enableColumnMenu: true},
                        {name: '采购类型', field: 'ambudgettypename',width: '100',enableColumnMenu: true},
                        {name: '预算单号', field: 'amapplicationno',width: '100',enableColumnMenu: true},
                        {name: '物资名称', field: 'ambaseasname',width: '150',enableColumnMenu: true},
                        {name: '规格型号', field: 'wzsmodel',width: '120',enableColumnMenu: true},
                        {name: '单位', field: 'measunit',width: '60',enableColumnMenu: true},
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
                    exporterCsvFilename:'indatadownload.csv',

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
                    if(accounts.length === 0){
                        showMsg('当前年度月份无入库数据 0 ！', '信息', 'ruby');
                        return false;
                    }
                    for (var item=0;item<accounts.length;item++){
                        if (accounts[item]["alltotal"] === null) accounts[item]["alltotal"] = 0;
                        if (accounts[item]["bdg"] === null) accounts[item]["bdg"] = 0;
                        if (accounts[item]["amt"] === null) accounts[item]["amt"] = 0;
                        accounts[item]["alltotal"] = Number(accounts[item]["amt"]) * Number(accounts[item]["bdg"]); //计算金额

                        //转换到到第一级
                        if(accounts[item]["amapplication_id"]) accounts[item]["unitname"] = accounts[item].amapplication.unitgrp.name;
                        if(accounts[item]["amsupplier_id"]) accounts[item]["amsuppliername"] = accounts[item].amsupplier.compname;
                        if(accounts[item]["amapplication_id"]) accounts[item]["amapplicationno"] = accounts[item].amapplication.no;
                        accounts[item]["ambaseasname"] = accounts[item].ambaseas.name;
                        accounts[item]["measunit"] = accounts[item].ambaseas.measunit;
                        accounts[item]["ambudgettypename"] = accounts[item].amapplication.ambudgettype.type;
                        //转换结束
                        // console.log(accounts[item].amapplication.unitgrp.name);
                    }
                    // console.log(accounts);
                    $scope.gridOptions.data = accounts;
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
                        {name: '部门', field: 'unitname',width: '150',enableColumnMenu: true},
                        {name: '出库单号', field: 'outbound',width: '100',enableColumnMenu: true},
                        {name: '物资名称', field: 'ambaseasname',width: '180',enableColumnMenu: true},
                        {name: '规格型号', field: 'wzsmodel',width: '120',enableColumnMenu: true},
                        {name: '单位', field: 'measunit',width: '60',enableColumnMenu: true},
                        {name: '数量', field: 'amt',width: '80',enableColumnMenu: true},
                        {name: '单价', field: 'bdg',width: '80',enableColumnMenu: true,cellFilter: 'currency'},
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
                    exporterCsvFilename:'outdatadownload.csv',

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
                    if(accounts.length === 0){
                        showMsg('当前年度月份无出库数据 0 ！', '信息', 'ruby');
                        return false;
                    }

                    for (var item=0;item<accounts.length;item++){
                        //转换到到第一级
                        if(accounts[item]["unitgrp_id"]) accounts[item]["unitname"] = accounts[item].unitgrp.name;
                        if(accounts[item]["amsubbudget_id"]) accounts[item]["ambaseasname"] = accounts[item].amsubbudget.ambaseas.name;
                        if(accounts[item]["amsubbudget_id"]) accounts[item]["wzsmodel"] = accounts[item].amsubbudget.wzsmodel;
                        accounts[item]["measunit"] = accounts[item].amsubbudget.ambaseas.measunit;
                        accounts[item]["bdg"] = accounts[item].amsubbudget.price;
                        //转换结束

                        if (accounts[item]["alltotal"] === null) accounts[item]["alltotal"] = 0;
                        if (accounts[item]["bdg"] === null) accounts[item]["bdg"] = 0;
                        if (accounts[item]["amt"] === null) accounts[item]["amt"] = 0;
                        accounts[item]["alltotal"] = Number(accounts[item]["amt"]) * Number(accounts[item]["bdg"]); //计算金额
                    }
                    // console.log(accounts);
                    $scope.gridOptions.data = accounts;
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
