'use strict';

angular.module("MetronicApp").controller('rolesCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog', 'uiGridConstants', 'i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog, uiGridConstants, i18nService) {
            i18nService.setCurrentLang('zh-cn');

            var tableDatas = Restangular.all('/sys-role');

            $scope.roleModelTreeSelecter = function () {
                if($scope.gridApi.selection.getSelectedRows().length==0) return false;

                ngDialog.openConfirm({
                    template: 'role-treeTemp',
                    className: 'ngdialog-theme-default rolengdialogcontent',
                    scope: $scope,
                    controller: ['$scope', 'Restangular', function ($scope, Restangular) {
                        //$scope.$validationOptions = validationConfig;
                        $scope.$on('ngDialog.opened', function () {

                            $scope.role_display_name=$scope.gridApi.selection.getSelectedRows()[0].display_name;
                            $("#modelTree").jstree({
                                "plugins": ["state", "types", "json_data", "checkbox","wholerow","contextmenu"],
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
                                        'url': '/sys-model/tree',
                                        'data': function (node) {
                                            return {'id': node.id};
                                        }
                                    }
                                },
                                "checkbox":{
                                    three_state: false,
                                    whole_node : false,
                                    tie_selection : true,
                                    cascade: 'undetermined'
                                },
                                "types": {
                                    "default": {
                                        "icon": "fa fa-folder icon-state-warning icon-lg"
                                    },
                                    "file": {
                                        "icon": "fa fa-file icon-state-warning icon-lg"
                                    }
                                }
                            })
                                .bind("changed.jstree", function (e,data) {
                                    $scope.selectedTreeData=data.instance.get_selected();
                                })
                                //.bind("check_node.jstree", function (e,data) {
                                //    console.log('checked!');
                                //
                                //})
                                .bind("show_contextmenu.jstree",function (e,data) {
                                    $("#privilegeTree").jstree({
                                        "plugins": ["state", "types", "json_data", "checkbox","wholerow"],
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
                                                'url': '/sys-model/tree',
                                                'data': function (node) {
                                                    return {'id': node.id};
                                                }
                                            }
                                        },
                                        "checkbox":{
                                            three_state: false,
                                            whole_node : false,
                                            tie_selection : true,
                                            cascade: 'undetermined'
                                        },
                                        "types": {
                                            "default": {
                                                "icon": "fa fa-folder icon-state-warning icon-lg"
                                            },
                                            "file": {
                                                "icon": "fa fa-file icon-state-warning icon-lg"
                                            }
                                        }
                                    })
                                        .bind("changed.jstree", function (e,data) {
                                            $scope.selectedTreeData=data.instance.get_selected();
                                        })
                                        //.bind("check_node.jstree", function (e,data) {
                                        //    console.log('checked!');
                                        //
                                        //})
                                        .bind("ready.jstree", function (e,data) {
                                            data.instance.uncheck_all();
                                            var role = $scope.gridApi.selection.getSelectedRows()[0];
                                            role.getList('rolemodels').then(function(res){
                                                $.each(res, function(idx, obj) {
                                                    data.instance.check_node(obj.id)
                                                });
                                            });
                                        })
                                    ;

                                    console.log(e);
                                })
                                .bind("ready.jstree", function (e,data) {
                                    data.instance.uncheck_all();
                                    var role = $scope.gridApi.selection.getSelectedRows()[0];
                                    role.getList('rolemodels').then(function(res){
                                        $.each(res, function(idx, obj) {
                                            data.instance.check_node(obj.id)
                                        });
                                    });
                                })
                            ;
                        });
                    }],
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    closeByEscape: true
                }).then(function (selectedTreeData) {
                    var role = $scope.gridApi.selection.getSelectedRows()[0];
                    role.post(JSON.stringify(selectedTreeData)).then(function(res){
                        if (res.success) {
                            showMsg(res.messages.toString(), '信息', 'lime');
                        } else {
                            showMsg(res.errors.toString(), '错误', 'ruby');
                        }
                    });
                }, function (dcEdition) {
                    //console.log('cancel');
                });
            }

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: '/sys-role/create',
                    className: 'ngdialog-theme-default sysrole',
                    scope: $scope,
                    controller: ['$scope', 'validationConfig', function ($scope, validationConfig) {
                        $scope.$validationOptions = validationConfig;
                    }],
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument: false,  //是否点覆盖div 关闭会话
                    disableAnimation: true,  //是否显示动画
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
            //$scope.editdataids = [];
            $scope.editData = function () {
                var toEditRows = $scope.gridApi.rowEdit.getDirtyRows($scope.gridOptions);
                toEditRows.forEach(function (edituser) {
                    var userWithId = _.find($scope.gridOptions.data, function (user) {
                        return user.id === edituser.entity.id;
                    });
                    userWithId.password_confirmation = userWithId.password;
                    userWithId.put().then(function (res) {
                        if (res.success) {
                            showMsg(res.messages.toString(), '信息', 'lime');
                            $scope.gridApi.rowEdit.setRowsClean(Array(userWithId));
                        } else {
                            showMsg(res.errors.toString(), '错误', 'ruby');
                        }
                    });
                });
                //$scope.editdataids=[];

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
                showColumnFooter: false,
                enableCellEditOnFocus: true,
                enableVerticalScrollbar: 2,
                enableHorizontalScrollbar: 2,
                columnDefs: [
                    {
                        name: 'id',
                        width: '40',
                        field: 'id',
                        enableCellEdit: false,
                        enableColumnMenu: false,
                        enableHiding: true,
                        enableFiltering: false
                    },
                    {
                        name: '名称',
                        width: '150',
                        field: 'name',
                        enableCellEdit: true,
                        enableColumnMenu: false,
                        enableHiding: true
                    },
                    {name: '显示名称', width: '150', field: 'display_name', enableCellEdit: true, visible: true},
                    {name: '描述', width: '260', field: 'description', enableCellEdit: true, visible: true},
                    {name: '添加时间', width: '150', field: 'created_at', enableCellEdit: false, visible: true},
                    {name: '更新时间', width: '150', field: 'updated_at', enableCellEdit: false, visible: true},
                ],
                enablePagination: true, //是否分页，默认为true
                enablePaginationControls: true, //使用默认的底部分页
                paginationPageSizes: [10, 30, 50],
                paginationCurrentPage: 1,
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                },
            };

            $scope.gridOptions.enableGridMenu = true;

            $scope.toggleFiltering = function () {
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
                $scope.gridApi.core.notifyDataChange(uiGridConstants.dataChange.COLUMN);
            };

            $scope.refreshData = function () {
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
