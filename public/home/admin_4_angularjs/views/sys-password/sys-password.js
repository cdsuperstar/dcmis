'use strict';

angular.module("MetronicApp").controller('syspasswordCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            $scope.type = 0;
            $scope.edituserpwd = function () {
                if($scope.dcEditionPWD.oldpwd && $scope.dcUser.id && $scope.dcEditionPWD.newpwd){
                    if($scope.dcEditionPWD.newpwd == $scope.dcEditionPWD.repnew){
                        if(!isPasswd($scope.dcEditionPWD.newpwd)){
                            showMsg('所设置密码只能由6-20个字母、数字、下划线组成，请重新输入！', '校验错误', 'ruby');
                            return false;
                        }
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

            //校验密码：只能输入6-20个字母、数字、下划线
            var isPasswd = function (s)
            {
                var patrn=/^(\w){6,20}$/;
                if(!patrn.exec(s)) return false;
                else  return true;
            };

        }
    ]
)
;
