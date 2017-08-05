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
                $scope.listnames = accounts;
            });
            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                //console.log(accounts);
                $scope.untigrps = accounts;
            });
            //人员列表
            Restangular.all('/sys-users').getList().then(function (accounts) {
                $scope.peoplegrps = accounts;
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
            var url = "/am-budget-count/getYearUnitsBudgets/"+currentYear+"/"+$scope.dcUser.unitid;
            $scope.formsearch = function () {
                var year = $scope.ambudgetcount.syear;
                var unit_id = $scope.ambudgetcount.unit;
                if(year) url = "/am-budget-count/getYearUnitsBudgets/"+year+"/"+$scope.dcUser.unitid;
                if(unit_id) url = "/am-budget-count/getYearUnitsBudgets/"+currentYear+"/"+unit_id;
                if(year && unit_id) url = "/am-budget-count/getYearUnitsBudgets/"+year+"/"+unit_id;

                console.log(url);
                Restangular.all(url).getList().then(function (accounts) {
                    var allAccounts = accounts;
                    console.log(allAccounts);
                });
            };
            console.log(url);
            Restangular.all(url).getList().then(function (accounts) {
                var allAccounts = accounts;
                console.log(allAccounts);
            });
        }
    ]
)
;
