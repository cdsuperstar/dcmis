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




        }
    ]
)
;
