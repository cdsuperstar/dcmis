'use strict';

angular.module("MetronicApp").controller('sysusersOwnCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            $scope.userprofile = { sex : '女',untigrps:[6]};  //有值的情况下定义选择项

            $scope.sexarr = ['男','女'];

            ////////////机构
            Restangular.all('/user-department').getList().then(function (accounts) {
                $scope.untigrps = accounts;
                console.log(accounts);
            });


            $scope.edituserprofile = function () { //修改
                Restangular.all('sys-usersown').post($scope.userprofile).then(function(res){
                    if (res.success) {
                        showMsg(res.messages.toString(), '信息', 'lime');
                    }
                    else {
                        showMsg(res.errors.toString(), '错误', 'ruby');
                    }
                });
                console.log($scope.userprofile);

            }

            $scope.showdetail = function () { //重获数据
                console.log($scope.name);
            }

            //图片上传

            /////////start datepicker
            $scope.birth = new Date();
            $scope.format = "yyyy-MM-dd";
            $scope.altInputFormats = ['yyyy-M!-d!'];

            $scope.tmppopup = {
                opened: false
            };
            $scope.opendatepick = function () {
                $scope.tmppopup.opened = true;
            };
            $scope.dateOptions = {
                customClass: getDayClass,//自定义类名
                //dateDisabled: isDisabled,//是否禁用周末
                showWeeks:false, //显示周
                startingDay:1 //从周一显示
            }


            var tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            var afterTomorrow = new Date();
            afterTomorrow.setDate(tomorrow.getDate() + 1);
            $scope.events = [
                {
                    date: tomorrow,
                    status: 'full'
                },
                {
                    date: afterTomorrow,
                    status: 'partially'
                }
            ];
            //为日期面板中的每个日期（默认42个）返回类名。传入参数为{date: obj1, mode: obj2}
            function getDayClass(obj) {
                var date = obj.date,
                    mode = obj.mode;
                if (mode === 'day') {
                    var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

                    for (var i = 0; i < $scope.events.length; i++) {
                        var currentDay = new Date($scope.events[i].date).setHours(0, 0, 0, 0);

                        if (dayToCheck === currentDay) {
                            return $scope.events[i].status;
                        }
                    }
                }
                return '';
            }
            //设置日期面板中的所有周六和周日不可选
            //function isDisabled(obj) {
            //    var date = obj.date,
            //        mode = obj.mode;
            //    return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
            //}
            //////end datepicker

        }
    ]
)
;
MetronicApp.directive('file', function() {
    return {
        restrict: 'E',
        template: '<input type="file" />',
        replace: true,
        require: 'ngModel',
        link: function(scope, element, attr, ctrl) {
            var listener = function() {
                scope.$apply(function() {
                    attr.multiple ? ctrl.$setViewValue(element[0].files) : ctrl.$setViewValue(element[0].files[0]);
                });
            }
            element.bind('change', listener);
        }
    }
});

