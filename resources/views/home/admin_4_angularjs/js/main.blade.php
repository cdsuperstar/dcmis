/***
 Metronic AngularJS App Main Script
 ***/

/* Metronic App */
var MetronicApp = angular.module("MetronicApp", [
    "ngAnimate",
    "ui.router",
    "ui.bootstrap",
    "oc.lazyLoad",
    "ngSanitize",
    "restangular",
    "ngTouch",
    "ui.grid",
    "ngDialog",
    "ui.grid.edit",
    "ui.grid.rowEdit",
    "ui.grid.cellNav",
    "ui.grid.pagination",
    "ui.grid.selection",
    "ui.grid.moveColumns",
    "ui.grid.resizeColumns",
    "ui.grid.exporter",
    "ui.select",
    "ngTagsInput"
]);

MetronicApp.value('validationConfig', {
    debounce: 500,
    displayOnlyLastErrorMsg: false,
    preValidateFormElements: false
});

/* Configure ocLazyLoader(refer: https://github.com/ocombe/ocLazyLoad) */
MetronicApp.config(['$ocLazyLoadProvider', function ($ocLazyLoadProvider) {
    $ocLazyLoadProvider.config({
// global configs go here
    });
}]);

//AngularJS v1.3.x workaround for old style controller declarition in HTML
MetronicApp.config(['$controllerProvider', function ($controllerProvider) {
// this option might be handy for migrating old apps, but please don't use it
// in new ones!
    $controllerProvider.allowGlobals();
}]);

/********************************************
 END: BREAKING CHANGE in AngularJS v1.3.x:
 *********************************************/

/* Setup global settings */
MetronicApp.factory('settings', ['$rootScope', function ($rootScope) {
// supported languages
    var settings = {
        layout: {
            pageSidebarClosed: false, // sidebar menu state
            pageContentWhite: true, // set page content layout
            pageBodySolid: false, // solid body color state
            pageAutoScrollOnLoad: 1000 // auto scroll to top on page load
        },
        assetsPath: '../assets',
        globalPath: '../assets/global',
        layoutPath: '../assets/layouts/layout4',
    };

    $rootScope.settings = settings;

    return settings;
}]);

/* Setup App Main Controller */
MetronicApp.controller('AppController', ['$scope', '$rootScope', function ($scope, $rootScope) {
    $scope.$on('$viewContentLoaded', function () {
//App.initComponents(); // init core components
//Layout.init(); //  Init entire layout(header, footer, sidebar, etc) on page load if the partials included in server side instead of loading with ng-include directive
    });
    $scope.mdTreeJson = JSON.parse('{!! addslashes($mdTreeJson) !!}');
    $scope.dcBroadcast=[];
    $scope.dcMessage=[];
}])
;
/***
 Layout Partials.
 By default the partials are loaded through AngularJS ng-include directive. In case they loaded in server side(e.g: PHP include function) then below partial
 initialization can be disabled and Layout.init() should be called on page load complete as explained above.
 ***/

/* Setup Layout Part - Header */
MetronicApp.controller('HeaderController', ['$scope', function ($scope) {
    $scope.ReadNotifiCnt=0;
    window.Echo.channel('dcBroadcast')
        .listen('normal', (e) => {
            $scope.dcBroadcast.unshift(e);
            $scope.$apply();
        });

    $scope.checkNotifi=function(){
        $scope.ReadNotifiCnt=$scope.dcBroadcast.length;
    }
    $scope.$on('$includeContentLoaded', function () {
        Layout.initHeader(); // init header
    });
}]);

/* Setup Layout Part - Sidebar */
MetronicApp.controller('SidebarController', ['$state', '$scope', function ($state, $scope) {
    $scope.loaded = false;
    $scope.$on('$includeContentLoaded', function () {
        if (!$scope.loaded)Layout.initSidebar($state); // init sidebar
        $scope.loaded = true;
    });
}]);
/* Setup Layout Part - Sidebar */
MetronicApp.controller('PageHeadController', ['$scope', function ($scope) {
    $scope.$on('$includeContentLoaded', function () {
        //Demo.init(); // init theme panel
    });
}]);

/* Setup Layout Part - Quick Sidebar */
MetronicApp.controller('QuickSidebarController', ['$scope', function ($scope) {
    $scope.$on('$includeContentLoaded', function () {
        setTimeout(function () {
            QuickSidebar.init(); // init quick sidebar
        }, 2000)
    });
}]);

/* Setup Layout Part - Theme Panel */
MetronicApp.controller('ThemePanelController', ['$scope', function ($scope) {
    $scope.$on('$includeContentLoaded', function () {
        //Demo.init(); // init theme panel
    });
}]);

/* Setup Layout Part - Footer */
MetronicApp.controller('FooterController', ['$scope', function ($scope) {
    $scope.$on('$includeContentLoaded', function () {
        Layout.initFooter(); // init footer
    });
}]);

MetronicApp.directive('confirmationNeeded', function () {
    return {
        priority: 1,
        terminal: true,
        link: function (scope, element, attr) {
            var msg = attr.confirmationNeeded || "确定要删除该条数据吗？";
            var clickAction = attr.ngClick;
            element.bind('click', function () {
                if (window.confirm(msg)) {
                    scope.$eval(clickAction)
                }
            });
        }
    };
});

/* Setup Rounting For All Pages */
MetronicApp.config(['$stateProvider', '$urlRouterProvider', function ($stateProvider, $urlRouterProvider) {
// Redirect any unmatched url
    $urlRouterProvider.otherwise("/dashboard.html");

    $stateProvider

// Dashboard
@foreach($dcModels as $model)
        .state('{{$model->name}}', {
            url: "{!! $model->url !!}",
            templateUrl: "{!! $model->templateurl !!}",
            icon: {pageIcon: '{{$model->icon}}'},
            data: {pageTitle: '{{$model->title}}'},
            controller: "GeneralPageController",
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'MetronicApp',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before a LINK element with this ID. Dynamic CSS files must be loaded between core and theme css files
                        files: [
                            {!! $model->files !!}
                    ]
                    });
                }]
            }
        })
@endforeach

}]);

function showMsg(msg,title,style,secs,hor,ver,stk){
    if(!title)title='提示';
    if(!style)style='teal';
    if(!secs)secs=5000;
    if(!hor)hor='bottom';
    if(!ver)ver='right';
    if(!stk)stk=false;
    var settings = {
        theme: style,
        sticky: stk,
        horizontalEdge: hor,
        verticalEdge: ver,
        life:secs,
        heading:title,
        zindex:11500
    };
    $.notific8(msg, settings);
}

/* Init global settings and run the app */
MetronicApp.run(["$rootScope", "settings", "$state", function ($rootScope, settings, $state) {
    $rootScope.$state = $state; // state to be accessed from view
    $rootScope.$settings = settings; // state to be accessed from view
}]);