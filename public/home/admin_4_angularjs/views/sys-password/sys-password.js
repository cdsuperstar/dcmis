'use strict';

angular.module("MetronicApp").controller('syspasswordCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            if($scope.password.old && $scope.dcUser.id){
                if($scope.password.new == $scope.password.repnew){
                    var tableDatas = Restangular.all('/sys-users/setMyPassword');
                    tableDatas.post(dcEdition).then(
                        function (res) {
                            if (res.success) {
                                $scope.gridOptions.data.push(res);
                                showMsg(res.messages.toString(), '信息', 'lime');
                            } else {
                                // TODO add error message to system
                                showMsg(res.errors.toString(), '错误', 'ruby');
                            }
                        }
                    );
                }else showMsg('所设置密码两次输入不一致（校验错误），请重新输入！', '错误', 'ruby');
            }
        }
    ]
)
;
