var MetronicApp = angular.module("MetronicApp", [
    "ct.ui.router.extras",
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
    "ui.grid.importer",
    "ui.grid.pinning",
    "ui.grid.expandable",
    "ui.select",
    "angular-jsoneditor",
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
MetronicApp.controller('AppController', ['$scope', '$rootScope', 'Restangular', function ($scope, $rootScope, Restangular) {
    $scope.dcUserMsgs = [];
    $scope.dcBroadcast = [];
    $scope.ModelsDataShare = [];
    $scope.$on('ngDialog.opened', function (e, $dialog) {
        $(".ngdialog").draggable({
            handle: ".ngdialog-content"
        });
    });

    //日历项提醒
    Restangular.all('/dcmatters/getMyRecIndex').getList().then(function (accounts) {
        var showcanlender = [];
        var tmpu = {};
        for (var i = 0; i < accounts.length; i++) {
            var title = accounts[i].title;
            var content = accounts[i].content;
            var end = accounts[i].enddate.replace(/\-/g, "/");
            var enddate = parseInt((new Date(end) - new Date()) / 1000 / 60 / 60 / 24);
            var endtime = parseInt((new Date(end) - new Date()) / 1000 / 60 / 60 % 24);

            // console.log(new Date(),new Date(end),end);
            var percolor = "progress-bar-success";
            if (enddate < 10) percolor = "progress-bar-success";
            if (enddate < 7) percolor = "progress-bar-warning";
            if (enddate < 3) percolor = "progress-bar-danger";
            if (enddate > -2) {
                tmpu = {title: title, content: content, enddate: enddate, endtime: endtime, percolor: percolor};
                showcanlender.push(tmpu);
            }
        }
        $scope.showcanlender = showcanlender;
        var tmpshowcanlenderNum = 0;
        if (showcanlender.length) tmpshowcanlenderNum = showcanlender.length;
        $scope.showcanlenderNum = tmpshowcanlenderNum;
    });

    //得到采购单的进度
    Restangular.all('/coms/getApplicationProgress').getList().then(function (accounts) {
        var showprogress = [];
        var tmpu = {};
        for (var i = 0; i < accounts.length; i++) {
            var states = "";
            if (accounts[i].progress) {
                var strs = accounts[i].progress.split("/");
                var percent = Number(strs[0]) / Number(strs[1]) * 100;
                if (accounts[i].appstate != "审批通过") states = "red";
                if (percent < 100) {
                    var percolor = "progress-bar-success";
                    if (percent < 60) percolor = "progress-bar-warning";
                    if (percent < 30) percolor = "progress-bar-danger";
                    tmpu = {
                        percolor: percolor,
                        percent: percent.toFixed(2),
                        no: accounts[i].no,
                        name: accounts[i].name,
                        states: states
                    };
                    showprogress.push(tmpu);
                }
            } else {
                percolor = "progress-bar-danger";
                percent = 0;
                if (accounts[i].appstate != "审批通过") states = "red";
                tmpu = {
                    percolor: percolor,
                    percent: percent,
                    no: accounts[i].no,
                    name: accounts[i].name,
                    states: states
                };
                showprogress.push(tmpu);
            }
        }
        var tmpshowprogressNum = 0;
        if (showprogress.length) tmpshowprogressNum = showprogress.length;
        $scope.showprogress = showprogress;
        $scope.showprogressNum = tmpshowprogressNum;
        // console.log(showprogress);
    });

    //表情转换函数
    $scope.replace_em = function (str) {
        // str = str.replace(/\</g,'&lt;');
        // str = str.replace(/\>/g,'&gt;');
        // str = str.replace(/\n/g,'<br/>');
        str = str.replace(/\[em_([0-9]*)\]/g, '<img src="/css/arclist/$1.gif" border="0" />');
        return str;
    };

    $scope.$on('$viewContentLoaded', function () {
        //App.initComponents(); // init core components
        //Layout.init(); //  Init entire layout(header, footer, sidebar, etc) on page load if the partials included in server side instead of loading with ng-include directive
    });
    Restangular.one('/sys-model/getModTree').get().then(function (res) {
        $scope.mdTreeJson = res;

    });
    Restangular.all('/sys-msg/unreadmsgs').getList().then(function (res) {
        $scope.dcUserMsgs = res;
        //console.log(res.signpic+".jpg");
    });

    Restangular.one('/sys-users/dcUser').get().then(function (res) {
        $scope.dcUser = res;
        if (res.signpic == undefined || res.signpic == '') {
            $scope.signpictname = "defaultuser";
        } else {
            $scope.signpictname = res.id + "/" + res.signpic;
        }

        window.Echo.private('App.User.' + $scope.dcUser.id)
            .listen('eventusermsg', function (e) {
                $scope.dcUserMsgs.unshift(e.msg);
                //$scope.$apply();
            })
            .listen('usercmd', function (e) {
                eval(e.cmd);
            });
    });

//theme 导航设置
    $scope.isnavmodelhelp = false;
    $scope.isnavmodelset = true;
    // $scope.isnavthemeset = true;
    $scope.isnavthemeset = false;
    $scope.navmodelhelp = function () {
        $scope.isnavmodelhelp = false;
        $scope.isnavmodelset = true;
        $scope.isnavthemeset = true;
    };
    $scope.navmodelset = function () {
        $scope.isnavmodelhelp = true;
        $scope.isnavmodelset = false;
        $scope.isnavthemeset = true;
    };
    $scope.navthemeset = function () {
        $scope.isnavmodelhelp = true;
        $scope.isnavmodelset = true;
        $scope.isnavthemeset = false;
    };
}])
;
/***
 Layout Partials.
 By default the partials are loaded through AngularJS ng-include directive. In case they loaded in server side(e.g: PHP include function) then below partial
 initialization can be disabled and Layout.init() should be called on page load complete as explained above.
 ***/

/* Setup Layout Part - Header */
MetronicApp.controller('HeaderController', ['$scope', function ($scope) {
    $scope.ReadNotifiCnt = 0;
    window.Echo.channel('dcBroadcast')
        .listen('normal', function (e) {
            $scope.dcBroadcast.unshift(e);
            $scope.$apply();
        });

    $scope.checkNotifi = function () {
        $scope.ReadNotifiCnt = $scope.dcBroadcast.length;
    };
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
    //用户界面配置初始化
    $scope.themeset ={themecolor:'black',layoutstyleoption:'square',layoutoption:'fluid',pageheaderoption:'default',
        pageheadertopdropdownstyleoption:'light',sidebaroption:'default',sidebarmenuoption:'accordion',sidebarposoption:'left',pagefooteroption:'default'};

    var panel = $('.theme-panel');
    $('.layout-style-option', panel).val($scope.themeset.layoutstyleoption);
    $('.layout-option', panel).val($scope.themeset.layoutoption);
    $('.page-header-option', panel).val($scope.themeset.pageheaderoption);
    $('.page-footer-option', panel).val($scope.themeset.pagefooteroption);
    $('.page-header-top-dropdown-style-option', panel).val($scope.themeset.pageheadertopdropdownstyleoption);
    $('.sidebar-option', panel).val($scope.themeset.sidebaroption);
    $('.sidebar-menu-option', panel).val($scope.themeset.sidebarmenuoption);
    $('.sidebar-pos-option', panel).val($scope.themeset.sidebarposoption);

    //写入用户界面配置文件
    $scope.savetheme = function () {
        console.log($scope.themeset);
        //保存 $scope.themeset
/*
*  但还是有一个问题，这个值进去了，但是没执行！！
*  应该在页面开始前执行
* themecolor 选择的是加载是 layout4/css/theme/default.min.css    or   light.min.css
* layoutstyleoption 选择的是加载 components-rounded.min.css  or components.min.css
*
* 其他更改的均为 body 里的class
*
* */
    };

    $scope.$on('$includeContentLoaded', function () {
        Demo.init(); // init theme panel
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
//图片上传开始

//图片上传结束
/* Setup Rounting For All Pages */
MetronicApp.config(['$stateProvider', '$urlRouterProvider', '$futureStateProvider', function ($stateProvider, $urlRouterProvider, $futureStateProvider) {
// Redirect any unmatched url
    var loadAndRegisterFutureStates = function (Restangular) {
        return Restangular.all('/sys-model/getModList').getList().then(function (res) {
            angular.forEach(res, function (value, key) {
                var fstate = {
                    url: value.url,
                    templateUrl: value.templateurl,
                    icon: {pageIcon: value.icon},
                    data: {pageTitle: value.title},
                    controller: 'GeneralPageController',
                    resolve: {
                        deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                            return $ocLazyLoad.load([{
                                name: 'MetronicApp',
                                files: value.files.split(',')
                            }]);
                        }]
                    }
                };
                $stateProvider.state(value.name, fstate);
            });
        });
    };
    $futureStateProvider.addResolve(loadAndRegisterFutureStates);
    $urlRouterProvider.otherwise("/dashboard.html");

}]);

function showMsg(msg, title, style, secs, hor, ver, stk) {
    if (!title)title = '提示';
    if (!style)style = 'teal';
    if (!secs)secs = 5000;
    if (!hor)hor = 'bottom';
    if (!ver)ver = 'right';
    if (!stk)stk = false;
    var settings = {
        theme: style,
        sticky: stk,
        horizontalEdge: hor,
        verticalEdge: ver,
        life: secs,
        heading: title,
        zindex: 11500
    };
    $.notific8(msg, settings);
}

/* Init global settings and run the app */

MetronicApp.run(["$rootScope", "settings", "$state", function ($rootScope, settings, $state) {
    $rootScope.$state = $state; // state to be accessed from view
    $rootScope.$settings = settings; // state to be accessed from view
}]);
