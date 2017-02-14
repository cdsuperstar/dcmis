'use strict';

angular.module("MetronicApp").controller('sysmsgCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //接收者数据
            $scope.people = [
                { name: 'Adam',      email: 'adam@email.com',      age: 12, country: 'United States' },
                { name: 'Amalie',    email: 'amalie@email.com',    age: 12, country: 'Argentina' },
                { name: 'Estefanía', email: 'estefania@email.com', age: 21, country: 'Argentina' },
                { name: 'Adrian',    email: 'adrian@email.com',    age: 21, country: 'Ecuador' },
                { name: 'Wladimir',  email: 'wladimir@email.com',  age: 30, country: 'Ecuador' },
                { name: 'Samantha',  email: 'samantha@email.com',  age: 30, country: 'United States' },
                { name: 'Nicole',    email: 'nicole@email.com',    age: 43, country: 'Colombia' },
                { name: 'Natasha',   email: 'natasha@email.com',   age: 54, country: 'Ecuador' },
                { name: 'Michael',   email: 'michael@email.com',   age: 15, country: 'Colombia' },
                { name: 'Nicolás',   email: 'nicolas@email.com',    age: 43, country: 'Colombia' }
            ];

            $scope.multiplePeple = {};
            $scope.multiplePeple.selectedPeople = [];




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

            //end
            var tableDatas = Restangular.all('/users');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: '/usermsgs/create',
                    className: 'ngdialog-theme-default sysmsg',
                    scope: $scope,
                    controller: ['$scope', 'validationConfig', function ($scope, validationConfig) {
                        $scope.$validationOptions = validationConfig;
                    }],
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    closeByEscape: true
                }).then(function (dcEdition) {

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
                }, function (dcEdition) {
                });
            };


            //$scope.showdetailmsg = function () {
            //    ngDialog.openConfirm({
            //        template: '/usermsgs/showdetailmsg',
            //        className: 'ngdialog-theme-default showdetailmsg',
            //        scope: $scope,
            //        controller: ['$scope', 'validationConfig', function ($scope, validationConfig) {
            //            $scope.$validationOptions = validationConfig;
            //        }],
            //        showClose: false,
            //        setBodyPadding: 1,
            //        overlay: true,        //是否用div覆盖当前页面
            //        closeByDocument:false,  //是否点覆盖div 关闭会话
            //        disableAnimation:true,  //是否显示动画
            //        closeByEscape: true
            //    }).then(function (dcEdition) {
            //
            //        tableDatas.post(dcEdition).then(
            //            function (res) {
            //                if (res.success) {
            //                    $scope.gridOptions.data.push(res);
            //                    showMsg(res.messages.toString(), '信息', 'lime');
            //                } else {
            //                    // TODO add error message to system
            //                    showMsg(res.errors.toString(), '错误', 'ruby');
            //                }
            //            }
            //        );
            //    }, function (dcEdition) {
            //    });
            //};

            $scope.delData = function () {
                var selectUsers = $scope.gridApi.selection.getSelectedGridRows();
                selectUsers.forEach(function (deluser) {
                        deluser.entity.remove().then(function (res) {
                            if (res.success) {
                                $scope.gridOptions.data = _.without($scope.gridOptions.data, deluser.entity);
                                showMsg(res.messages.toString(), '信息', 'lime');
                            }
                            else {
                                showMsg(res.errors.toString(), '错误', 'ruby');
                            }
                        });
                    }
                );
            };

            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                enableCellEditOnFocus:true,
                columnDefs: [
                    {name: 'id', field: 'id', width: '40',enableColumnMenu: false,enableHiding: false,enableFiltering: false},
                    {name: '发送者', field: 'name',width: '150',enableColumnMenu: false},
                    {name: '接收者', field: 'name',width: '150',enableColumnMenu: false},
                    {name: '消息内容', field: 'name',width: '550',enableColumnMenu: false},
                    {name: '发送时间', field: 'created_at',width: '150',enableColumnMenu: false},
                    {name: '浏览时间', field: 'updated_at',width: '150',enableColumnMenu: false},
                ],
                enablePagination: true, //是否分页，默认为true
                enablePaginationControls: true, //使用默认的底部分页
                paginationPageSizes: [10, 30, 50],
                paginationCurrentPage: 1,
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                },
            };

            $scope.gridOptions.enableGridMenu = true;

            $scope.toggleFiltering = function(){
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
                $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
            };

            $scope.refreshData = function(){
                $scope.gridOptions.data = [];
                tableDatas.getList().then(function (accounts) {
                    var allAccounts = accounts;
                    $scope.gridOptions.data = allAccounts;
                });
            }

            tableDatas.getList().then(function (accounts) {
                var allAccounts = accounts;
                $scope.gridOptions.data = allAccounts;
            });

        }
    ]
)
;
