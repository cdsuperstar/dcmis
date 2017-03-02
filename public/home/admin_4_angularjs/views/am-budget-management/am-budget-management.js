'use strict';

angular.module("MetronicApp").controller('budgetmanagementCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
            var currentYear = new Date().getFullYear();
            var yeararr = new Array();
            for(var val = (currentYear-3); val <= (currentYear+3); val++){
                yeararr.push(val);}
            $scope.tyear = yeararr;
            $scope.budget = { syear : currentYear};  //初始化为当前年度

            //预算类别
            $scope.listnames = [{ id: 1, name: '物资预算' }, { id: 2, name: '工程预算' }, { id: 3, name: '服务预算' }, { id: 4, name: '其他预算' }];
            $scope.budget.classlistName = 1; //初始值为物资预算


            ////////////机构
            Restangular.all('/user-department').getList().then(function (accounts) {
                $scope.untigrps = accounts;
            });



            $scope.savedata = function () {
                console.log($scope.budget);
            };

            /////////start datepicker
            $scope.startdate = new Date();   //开始日期
            $scope.enddate = new Date();     //截止日期
            $scope.format = "yyyy-MM-dd";
            $scope.altInputFormats = ['yyyy-M!-d!'];

            $scope.tmppopupstart = {opened: false};
            $scope.tmppopupend = {opened: false};
            $scope.opendatepickstart = function () {
                $scope.tmppopupstart.opened = true;
            };
            $scope.opendatepickend = function () {
                $scope.tmppopupend.opened = true;
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
