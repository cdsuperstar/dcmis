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
            $scope.uigrtyear = untarr; //转换成uigrid可识别的模式[{value:xxx,lebel:'xxx'}]
            $scope.tyear = yeararr;
            //预算类别列表
            $scope.listnames = [{ value: 1, label: '物资预算' }, { value: 2, label: '工程预算' }, { value: 3, label: '服务预算' }, { value: 4, label: '其他预算' }];
            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                //console.log(accounts);
                $scope.untigrps = accounts;
            });
            //人员列表
            Restangular.all('/sys-users').getList().then(function (accounts) {
                $scope.peoplegrps = accounts;
            });
            $scope.ambudgetcount = { syear:currentYear,type:1};  //初始化为当前年度


            var tableDatas = Restangular.all('500_complex.json'); //获取数据



        }
    ]
)
;
