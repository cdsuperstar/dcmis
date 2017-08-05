'use strict';

angular.module("MetronicApp").controller('ambudgetcountCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
            var currentYear = new Date().getFullYear();
            var yeararr = new Array();
            for(var val = (currentYear-3); val <= (currentYear+3); val++){
                yeararr.push(val);}
            var untarr = [];
            var tmpu = {};
            for(var i=0;i<yeararr.length;i++){
                tmpu ={value:yeararr[i],label:yeararr[i]};
                untarr.push(tmpu);
            }
            $scope.tyear = yeararr;

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
                $scope.gridOptions.columnDefs[2].lbHash =  lbHash;
            });

            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                var tmpu = {};
                var unitHash=[];
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    tmpu ={value:accounts[i].id,label:accounts[i].name};
                    unitHash[accounts[i].id]=accounts[i].name;
                }
                $scope.untigrps = accounts;
                $scope.gridOptions.columnDefs[1].unitHash =  unitHash ;
            });

            $scope.ambudgetcount = { syear:currentYear,unit:$scope.dcUser.unitid};  //初始化为当前年度

            //转换函数  遍历json
            var changeJsonData = function (mJson,mkey,mvalue,mlabel) {
                if(mvalue){
                    for (var item=0;item<mJson.length;item++){
                        if(mJson[item][mkey] == mvalue) var t = mJson[item][mlabel];
                    }
                    return t;
                }
            };
/*
* 这个只能显示某年度 某部门的数据？？
* 如果只选 2017，不选部门，或者 选部门 ，不选年度，不行么？
* 应该也可以选 某个年度 所有部门的预算啊，
* 或者选择 某个部门，看看近几年的预算啊
*
* */
            $scope.gridOptions={
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter:true,
                showGridFooter:false,
                enableVerticalScrollbar:1,
                enableHorizontalScrollbar :1,
                enableGridMenu: true,
                columnDefs: [
                    {name: '年度', field: 'syear',width: '100',enableColumnMenu: false,cellFilter: 'yearGender'},
                    {name: '部门', field: 'unit',width: '230',enableColumnMenu: false,enableHiding: false,enableFiltering: false,
                        cellFilter: 'dFilterHash:col.colDef.unitHash',unitHash:[]},
                    {name: '预算类别', field: 'type',width: '120',enableColumnMenu: true,cellFilter: 'dFilterHash:col.colDef.lbHash',lbHash:[],
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                    {name: '预算总金额', field: 'total',width: '100',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '申报金额', field: 'bdg',width: '100',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '支出金额', field: 'price',width: '100',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '预算可用金额', field: 'budgettotal',width: '100',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '实际可用金额', field: 'actualtotal',width: '100',enableColumnMenu: true,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true}
                ],
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
                console.log($scope.ambudgetcount.syear,$scope.ambudgetcount.unit);
                var theJson = [{"syear":$scope.ambudgetcount.syear,"unitgrp":$scope.ambudgetcount.unit}];
                Restangular.all('/am-budget-count/getYearUnitsBudgets').post(theJson).then(function (accounts) {
                    var allAccounts = accounts;
                    $scope.gridOptions.data = allAccounts;
                    console.log(allAccounts);
                });
            };

            var theJson = [{"syear":$scope.ambudgetcount.syear,"unitgrp":$scope.ambudgetcount.unit}];
            Restangular.all('/am-budget-count/getYearUnitsBudgets').post(theJson).then(function (accounts) {
                var allAccounts = accounts;
                $scope.gridOptions.data = allAccounts;
                console.log(allAccounts);
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
