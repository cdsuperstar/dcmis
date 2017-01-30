'use strict';

angular.module("MetronicApp").controller('dcmodelCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            var tableDatas = Restangular.all('/dcmodels');
            i18nService.setCurrentLang('zh-cn');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: '/dcmodels/create',
                    className: 'ngdialog-theme-default',
                    scope: $scope,
                    controller: ['$scope', function ($scope) {
                        //$scope.$validationOptions = validationConfig;
                    }],
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: false,
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
                    className: 'ngdialog-theme-default',
                    scope: $scope,
                    controller: ['$scope', 'Restangular',function ($scope,Restangular) {
                        //$scope.$validationOptions = validationConfig;

                        $scope.$on('ngDialog.opened', function () {
                            //console.log($scope.$parent.$parent.mdTreeJson);
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
                                        'url': '/dcmodels/dcmodelMove/tree',
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
                            })
                                .bind("move_node.jstree", function (e, data) {
                                    //console.log('the item being dragged ', data);
                                    Restangular.all("/dcmodels/dcmodelMove/movenode").post(data).then(
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
                    overlay: false,
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
                enableVerticalScrollbar:2,
                enableHorizontalScrollbar :2,
                    columnDefs: [
                    {name: 'id', field: 'id', enableCellEdit: false, width: '5%'},
                    {name: '名称', field: 'name', enableCellEdit: true,enableHiding: false,},
                    {name: '标题', field: 'title', enableCellEdit: true,enableHiding: false,},
                    {
                        name: '菜单', field: 'ismenu', enableCellEdit: true, width: '5%',
                        editableCellTemplate: 'ui-grid/dropdownEditor',
                        enableHiding: false,
                        cellFilter: 'mapIsmenu', editDropdownValueLabel: 'isMenu', editDropdownOptionsArray: [
                        {id: 1, isMenu: '是'},
                        {id: 0, isMenu: '否'}
                    ]
                    },
                    {name: '图标', field: 'icon', enableCellEdit: true},
                    {name: 'URL', field: 'url', enableCellEdit: true},
                    {name: '模板URL', field: 'templateurl', enableCellEdit: true},
                    {name: '引用文件', field: 'files', enableCellEdit: true},
                    {name: '添加时间', field: 'created_at',enableCellEdit: false,visible:true},
                    {name: '更新时间', field: 'updated_at',enableCellEdit: false,visible:false},

                    ],
                paginationPageSizes: [10, 30, 50],
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                },
            };

            $scope.toggleFiltering = function(){
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
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
    })
;

