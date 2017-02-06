'use strict';

angular.module("MetronicApp").controller('budgetmanagementCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            $scope.ismaterial=true;
            $scope.isproject=true;
            $scope.isother=true;
            $scope.listnames = [{ id: 1, name: '物资预算' }, { id: 2, name: '工程预算' }, { id: 3, name: '服务预算' }, { id: 4, name: '其他预算' }];

            $scope.classlistName=1; //初始值为物资预算

            $scope.showdetail = function(){
                console.log($scope.classlistName);
                if($scope.classlistName==1){
                    $scope.ismaterial = !$scope.ismaterial;
                    $scope.isproject=true;
                    $scope.isother=true;
                }else if($scope.classlistName==2){
                    $scope.isproject = !$scope.isproject;
                    $scope.ismaterial=true;
                    $scope.isother=true;
                }else{
                    $scope.isother = !$scope.isother;
                    $scope.ismaterial=true;
                    $scope.isproject=true;
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


            /////////start datepicker
            $scope.startdate = new Date();
            $scope.enddate = new Date();
            $scope.gcstartdate = new Date();
            $scope.gcenddate = new Date();
            $scope.format = "yyyy-MM-dd";
            $scope.altInputFormats = ['yyyy-M!-d!'];

            $scope.tmppopupstart = {opened: false};
            $scope.tmppopupend = {opened: false};
            $scope.tmppopupgcstart = {opened: false};
            $scope.tmppopupgcend = {opened: false};
            $scope.opendatepickstart = function () {
                $scope.tmppopupstart.opened = true;
            };
            $scope.opendatepickend = function () {
                $scope.tmppopupend.opened = true;
            };
            $scope.opendatepickgcstart = function () {
                $scope.tmppopupgcstart.opened = true;
            };
            $scope.opendatepickgcend = function () {
                $scope.tmppopupgcend.opened = true;
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
