'use strict';

angular.module("MetronicApp").controller('userdepartmentCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            var tableDatas = Restangular.all('/user-department');
            i18nService.setCurrentLang('zh-cn');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: '/user-department/create',
                    className: 'ngdialog-theme-default userdepartment',
                    scope: $scope,
                    controller: ['$scope', function ($scope) {
                        //$scope.$validationOptions = validationConfig;
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
                    console.log('Modal promise rejected. Reason: ', dcEdition);
                });
            };

            $scope.delData = function () {
                var selectdcmodels = $scope.gridApi.selection.getSelectedGridRows();
                selectdcmodels.forEach(function (deluser) {
                        //console.log(deluser);
                        deluser.entity.remove().then(function (res) {
                            if (res.success) {
                                $scope.gridOptions.data = _.without($scope.gridOptions.data, deluser.entity);
                                showMsg(res.messages.toString(), '信息', 'lime');
                            }
                            else {
                                showMsg(res.errors.toString(), '错误', 'ruby');
                            }
                            //console.log(res);
                        });
                    }
                );
            };

            $scope.editTree = function () {
                ngDialog.openConfirm({
                    template: 'treeTemp',
                    className: 'ngdialog-theme-default userdepartmenttree',
                    scope: $scope,
                    controller: ['$scope', 'Restangular',function ($scope,Restangular) {
                        //$scope.$validationOptions = validationConfig;
                        $scope.$on('ngDialog.opened', function () {

                            $("#modelTree").jstree({
                                "core": {
                                    "themes": {
                                        "responsive": false
                                    },
                                    // so that create works
                                    "check_callback": function (operation, node, parent, position, more) {
                                        if (operation === "copy_node" || operation === "move_node") {
                                            if (parent.id === "#") {
                                                return false; // prevent moving a child above or below the root
                                            }
                                        }
                                        return true; // allow everything else
                                    },
                                    'data': {
                                        'url': '/user-department/tree',
                                        'data': function (node) {
                                            return { 'id' : node.id };
                                        }
                                    }
                                },
                                "types": {
                                    "default": {
                                        "icon": "fa fa-folder icon-state-warning icon-lg"
                                    },
                                    "file": {
                                        "icon": "fa fa-file icon-state-warning icon-lg"
                                    }
                                },
                                "plugins": ["dnd", "state", "types", "json_data"]
                            }).bind("move_node.jstree", function (e, data) {
                                //console.log('the item being dragged ', data);
                                Restangular.all("/user-department/movenode").post(data).then(
                                    function (res) {
                                        //console.log(res);
                                        if (res.success) {
                                            showMsg(res.messages.toString(), '信息', 'lime');
                                            //console.log("save success", res);
                                        }
                                    }
                                );
                            })
                                .bind("changed.jstree", function (e, data) {
                                    //console.log("The selected nodes are:");
                                    //console.log(data);
                                });
                        });
                    }],
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    closeByEscape: true
                }).then(function (dcEdition) {

                }, function (dcEdition) {

                });
            };

            //edit data
            $scope.editData = function () {
                var toEditRows = $scope.gridApi.rowEdit.getDirtyRows($scope.gridOptions);
                toEditRows.forEach(function (edituser) {
                    var userWithId = _.find($scope.gridOptions.data, function (user) {
                        return user.id === edituser.entity.id;
                    });
                    userWithId.password_confirmation = userWithId.password;
                    //console.log(userWithId);
                    userWithId.put().then(function (res) {
                        //console.log(res);
                        if (res.success) {
                            showMsg(res.messages.toString(), '信息', 'lime');
                            $scope.gridApi.rowEdit.setRowsClean(Array(userWithId));
                        } else {
                            showMsg(res.errors.toString(), '错误', 'ruby');
                        }
                    });
                });

            }
            $scope.saveRow = function (rowEntity) {
                //$scope.editdataids.push(rowEntity.id);
                var promise = $q.defer();
                $scope.gridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
                //promise.resolve();
                promise.reject();
            };

            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                enableCellEditOnFocus: true,
                columnDefs: [
                    {name: 'id', field: 'id', width: '40',enableCellEdit: false,enableColumnMenu: false,enableHiding: false,enableFiltering: false},
                    // {name: '编号', field: 'no',width: '80',enableCellEdit: true,enableColumnMenu: false,enableHiding: false},
                    {name: '名称', field: 'name',width: '150',enableCellEdit: true,enableColumnMenu: false,enableHiding: false},
                    {name: '介绍', field: 'brief',width: '300',enableCellEdit: true,visible:true},
                    {name: '添加时间', field: 'created_at',width: '150',enableCellEdit: false,visible:true},
                    {name: '更新时间',width: '150', field: 'updated_at',enableCellEdit: false,visible:true},

                ],
                paginationPageSizes: [10, 30, 50],
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                },
            };

            $scope.toggleFilteringsign = '筛选数据';
            $scope.toggleFiltering = function(){
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
                if(!$scope.gridOptions.enableFiltering) $scope.toggleFilteringsign = '筛选数据';
                else $scope.toggleFilteringsign = '取消筛选';
                $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
            };

            tableDatas.getList().then(function (accounts) {
                var allAccounts = accounts;
                $scope.gridOptions.data = allAccounts;
                //console.log( $scope.gridOptions.data);
            });

        }
    ]
)
    .filter('mapIsmenu', function () {
        var genderHash = {
            1: '是',
            0: '否'
        };

        return function (input) {
            if (input == null) {
                return '';
            } else {
                return genderHash[input];
            }
        };
    });