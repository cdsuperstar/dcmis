'use strict';

angular.module("MetronicApp").controller('ambudgetcountCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
            var currentYear = new Date().getFullYear();
            var yeararr = new Array();
            for(var val = (currentYear-3); val <= (currentYear+3); val++){
                yeararr.push(val);
            }
            $scope.tyear = yeararr;

            //预算类别列表
            Restangular.all('/am-budget-lb').getList().then(function (accounts) {
                //console.log(accounts);
                var lbHash=[] ;
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    lbHash[accounts[i].id] = accounts[i].type;
                }
                $scope.gridOptions.columnDefs[2].lbHash =  lbHash;
            });

            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                var unitHash=[];
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    unitHash[accounts[i].id]=accounts[i].name;
                }
                $scope.untigrps = accounts;
                $scope.gridOptions.columnDefs[1].unitHash =  unitHash ;
            });

            $scope.ambudgetcount = { syear:currentYear,unit:$scope.dcUser.unitid};  //初始化为当前年度

            $scope.gridOptions={
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter:true,
                showGridFooter:false,
                enableVerticalScrollbar:1,
                enableHorizontalScrollbar :1,
                columnDefs: [
                    {name: '年度', field: 'syear',width: '60',enableColumnMenu: false,cellFilter: 'yearGender'},
                    {name: '部门', field: 'unit',width: '180',enableColumnMenu: false,enableHiding: false,enableFiltering: false,
                        cellFilter: 'dFilterHash:col.colDef.unitHash',unitHash:[]},
                    {name: '预算类别', field: 'type',width: '80',enableColumnMenu: true,cellFilter: 'dFilterHash:col.colDef.lbHash',lbHash:[],
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                    {name: '预算总金额', field: 'total',width: '110',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '申报金额', field: 'bdg',width: '110',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '支出金额', field: 'price',width: '110',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '预算可用金额', field: 'budgettotal',width: '110',enableColumnMenu: true,
                        headerTooltip: '【1000-10000】范围背景为黄色 【0-1000】范围背景为淡红色',
                        cellClass: function(grid, row, col, rowRenderIndex, colRenderIndex) {
                            if (grid.getCellValue(row,col) <= 1000 ) {
                                return 'cellwarning';
                            }
                            if (grid.getCellValue(row,col) <= 10000 ) {
                                return 'cellinfo';
                            }
                        },
                        cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '实际可用金额', field: 'actualtotal',width: '110',enableColumnMenu: true,
                        headerTooltip: '【1000-10000】范围背景为黄色 【0-1000】范围背景为淡红色',
                        cellClass: function(grid, row, col, rowRenderIndex, colRenderIndex) {
                            if (grid.getCellValue(row,col) <= 1000 ) {
                                return 'cellwarning';
                            }
                            if (grid.getCellValue(row,col) <= 10000 ) {
                                return 'cellinfo';
                            }
                        },
                        cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true}
                ],

                //--------------导出----------------------------------
                exporterHeaderFilterUseName : true,
                exporterMenuCsv : true, //导出Excel 开关
                exporterMenuPdf : false, //导出pdf 开关
                exporterMenuLabel : "Export",
                exporterCsvColumnSeparator: ',',
                exporterOlderExcelCompatibility : true,   //解决导出乱码的问题(支持低版本的Excel)
                enableGridMenu: true, //是否显示grid 菜单
                exporterCsvFilename:'exportbudgetcount.csv',
                exporterFieldCallback: function( grid, row, col, input ) {
                    switch( col.field ){
                        case 'unit':
                            return $scope.gridOptions.columnDefs[1].unitHash[input];
                            break;
                        case 'type':
                            return $scope.gridOptions.columnDefs[2].lbHash[input];
                            break;
                        default:
                            return input;
                            break;
                    }
                },

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

            $scope.formsearch = function () {
                var ShearchJson = [{"syear":$scope.ambudgetcount.syear,"unitgrp":$scope.ambudgetcount.unit}];
                // console.log($scope.ambudgetcount.unit);
                Restangular.all('/am-budget-count/getYearUnitsBudgets').post(ShearchJson).then(function (accounts) {
                    for (var item=0;item<accounts.length;item++){
                        if (accounts[item]["total"] === null) accounts[item]["total"] = 0;
                        if (accounts[item]["bdg"] === null) accounts[item]["bdg"] = 0;
                        if (accounts[item]["price"] === null) accounts[item]["price"] = 0;
                        accounts[item]["budgettotal"] = Number(accounts[item]["total"]) - Number(accounts[item]["bdg"]); //计算预算可用金额
                        accounts[item]["actualtotal"] = Number(accounts[item]["total"]) - Number(accounts[item]["price"]); //计算实际可用金额
                    }
                    var allAccounts = accounts;
                    $scope.gridOptions.data = allAccounts;
                });
            };

            var ShearchJson = [{"syear":$scope.ambudgetcount.syear,"unitgrp":$scope.ambudgetcount.unit}];
            Restangular.all('/am-budget-count/getYearUnitsBudgets').post(ShearchJson).then(function (accounts) {
                for (var item=0;item<accounts.length;item++){
                    if (accounts[item]["total"] === null) accounts[item]["total"] = 0;
                    if (accounts[item]["bdg"] === null) accounts[item]["bdg"] = 0;
                    if (accounts[item]["price"] === null) accounts[item]["price"] = 0;
                    accounts[item]["budgettotal"] = Number(accounts[item]["total"]) - Number(accounts[item]["bdg"]); //计算预算可用金额
                    accounts[item]["actualtotal"] = Number(accounts[item]["total"]) - Number(accounts[item]["price"]); //计算实际可用金额
                }
                var allAccounts = accounts;
                $scope.gridOptions.data = allAccounts;
                // console.log(allAccounts);
            });

        }
    ]
)
    .filter('yearGender', function() {
        return function(input) {
            if (!input){
                return '';
            } else {
                return input;
            }
        };
    })

    .filter('dFilterHash',function(){
        return function(v,h){
            if (h=== undefined) return '';
            if (h[v]===undefined) return '';
            return h[v];
        }
    })
;
