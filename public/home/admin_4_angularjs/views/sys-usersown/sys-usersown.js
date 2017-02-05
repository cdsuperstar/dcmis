'use strict';

angular.module("MetronicApp").controller('sysusersOwnCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            $scope.sexarr = [
                {id: 1, name: '男'},
                {id: 2, name: '女'},
            ];

            $scope.sex = { value: $scope.sexarr[0] };

            ////////////multipleselect
            $scope.categories =[
                {"id":1,"ykth":"10201401573","name":"高成刚"},
                {"id":2,"ykth":"10201400124","name":"李娴"},
                {"id":3,"ykth":"10201400939","name":"朱创业"},
                {"id":4,"ykth":"10201402485","name":"路婷婷"},
                {"id":5,"ykth":"10201401940","name":"何铭"},
                {"id":6,"ykth":"10201401802","name":"涂涯"},
                {"id":7,"ykth":"2015020765","name":"李伟博"}
                ];

            $scope.categories.selected = [$scope.categories[1],$scope.categories[3],$scope.categories[6]];


            $scope.edituserprofile = function () {



            }


            /////////start datepicker
            $scope.dat = new Date();
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
