'use strict';

angular.module("MetronicApp").controller('syspasswordCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            $scope.edituserpwd = function () {
                if($scope.dcEditionPWD.oldpwd && $scope.dcUser.id && $scope.dcEditionPWD.newpwd){
                    if($scope.dcEditionPWD.newpwd == $scope.dcEditionPWD.repnew){
                        var tableDatas = Restangular.all('/sys-users/setMyPassword');
                        var dcEditionP = {"oldpwd":$scope.dcEditionPWD.oldpwd,"newpwd":$scope.dcEditionPWD.newpwd};
                        tableDatas.post(dcEditionP).then(
                            function (res) {
                                if (res.success) {
                                    showMsg(res.messages.toString(), '信息', 'lime');
                                } else {
                                    // TODO add error message to system
                                    showMsg(res.errors.toString(), '错误', 'ruby');
                                }
                            }
                        );
                    }else showMsg('所设置密码两次输入不一致（校验错误），请重新输入！', '错误', 'ruby');
                }
            };

        }
    ]
)
;
