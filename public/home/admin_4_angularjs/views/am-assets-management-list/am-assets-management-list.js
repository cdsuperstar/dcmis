'use strict';

angular.module("MetronicApp").controller('amassetmangementlistCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
            var date = new Date();
            var currentYear = date.getFullYear();
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
            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                var unitHash=[];
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    if(accounts[i].id === $scope.dcUser.unitid) var tmpu = accounts[i].name;
                    unitHash[accounts[i].id] = accounts[i].name;
                }
                $scope.unit_name = tmpu;
                $scope.gridOptions.columnDefs[1].unitHash =  unitHash ;
            });
            //供应商列表
            Restangular.all('/icon-basket-setsupplier').getList().then(function (accounts) {
                // console.log(accounts);
                var supplierarr = [];
                var tmpu = {};
                var supplierHash=[];
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    tmpu ={value:accounts[i].id,label:accounts[i].compname};
                    supplierHash[accounts[i].id]=accounts[i].compname;
                    // supplierarr.push(tmpu);
                }
                $scope.suppliergrps = accounts;
                // $scope.gridOptions.columnDefs[2].filter.selectOptions=supplierarr;
                // $scope.gridOptions.columnDefs[2].editDropdownOptionsArray=supplierarr;
                $scope.gridOptions.columnDefs[2].supplierHash =  supplierHash ;
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
                    {name: '日期', field: 'syear',width: '100',enableColumnMenu: true},
                    {name: '部门', field: 'unitgrp_id',width: '120',enableColumnMenu: true,enableHiding: false,enableFiltering: false,
                        cellFilter: 'dFilterHash:col.colDef.unitHash',unitHash:[]},
                    {name: '供应商编号', field: 'amsupplier_id',width: '180',enableColumnMenu: true,enableHiding: false,
                        cellFilter: 'dFilterHash:col.colDef.supplierHash'},
                    {name: '采购类型', field: 'amsubbudget.purchway',width: '100',enableColumnMenu: true},
                    {name: '预算单号', field: 'syear',width: '100',enableColumnMenu: true},
                    {name: '物资名称', field: 'amsubbudget.ambaseas.name',width: '150',enableColumnMenu: true},
                    {name: '规格型号', field: 'amsubbudget.wzsmodel',width: '120',enableColumnMenu: true},
                    {name: '单位', field: 'amsubbudget.ambaseas.measunit',width: '60',enableColumnMenu: true},
                    {name: '数量', field: 'amt',width: '80',enableColumnMenu: true},
                    {name: '单价', field: 'amsubbudget.price',width: '80',enableColumnMenu: true,cellFilter: 'currency'},
                    {name: '金额', field: 'alltotal',width: '80',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '备注', field: 'syear',width: '100',enableColumnMenu: false}

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
            // var ShearchJson = [{"syear":currentYear,"unitgrp":$scope.dcUser.unitid}];
            // Restangular.all('/am-assets-management-scrap/getAssToScrap').post(ShearchJson).then(function (accounts) {
            // Restangular.all('/am-assets-management-scrap/getAssToScrap').post().then(function (accounts) {
            Restangular.all('/am-assets-management-scrap/getAssToScrap').getList().then(function (accounts) {
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

            //生成生成入库统计表
            $scope.printinattredata = function(){

            };

            //生成出库统计表
            $scope.printoutattredata = function(){


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
