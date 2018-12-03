'use strict';

angular.module("MetronicApp").controller('amassetmangementlistCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
            var date = new Date();
            var currentYear = date.getFullYear();
            var yeararr = new Array();
            for(var val = (currentYear-3); val <= (currentYear+3); val++){
                yeararr.push(val);
            }
            $scope.tyear = yeararr;
            var monarr = new Array();
            //获得月份列表
            for(var yval = 1; yval <= 12; yval++){
                monarr.push(yval);
            }
            $scope.tmonth = monarr;
            //end




        }
    ]
)
;
