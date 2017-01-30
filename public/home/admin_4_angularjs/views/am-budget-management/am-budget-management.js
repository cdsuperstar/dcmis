'use strict';

angular.module("MetronicApp").controller('budgetmanagementCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            $scope.isCollapsed=true;
            $scope.listnames = [{ id: 1, name: '物资预算' }, { id: 2, name: '工程预算' }, { id: 3, name: '服务预算' }, { id: 4, name: '其他预算' }];

            $scope.classlistName=1; //初始值为物资预算

            $scope.showdetail = function(){
                console.log($scope.classlistName);
                if($scope.classlistName==2){

                }else if($scope.classlistName==1){
                    $scope.isCollapsed = !$scope.isCollapsed;
                }else{
                    showMsg('当前 预算类别 不支持 添加详情 ！', '信息', 'lime');
                }
            }


            $scope.person = {};
            $scope.people = [
                {"id":1,"ykth":"10201401573","name":"高成刚"},
                {"id":2,"ykth":"10201400124","name":"李娴"},
                {"id":3,"ykth":"10201400939","name":"朱创业"},
                {"id":4,"ykth":"10201402485","name":"路婷婷"},
                {"id":5,"ykth":"10201401940","name":"何铭"},
                {"id":6,"ykth":"10201401802","name":"涂涯"},
                {"id":7,"ykth":"2015020765","name":"李伟博"}
            ];






            $scope.savedata = function () {
                showMsg($scope.userslist, '信息', 'lime');
            };





        }
    ]
)
;
