'use strict';

angular.module("MetronicApp").controller('dcuserCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog',
        function ($scope, Restangular, $q, $filter, ngDialog) {
            var baseAccounts = Restangular.all('/users');

            $scope.addData = function () {
                //var n = $scope.gridOpts.data.length + 1;
                //$scope.gridOptions.data.push({
                //    "id": "",
                //    "name": "" ,
                //    "email": "",
                //    "password": "",
                //});
                ngDialog.openConfirm({
                    template: '/users/create',
                    className: 'ngdialog-theme-default',
                    scope: $scope,
                    controller: ['$scope', 'validationConfig', function ($scope, validationConfig) {
                        $scope.$validationOptions = validationConfig;
                    }],
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: false,
                    closeByEscape: true
                }).then(function (dcEdition) {
                    console.log("save success", dcEdition);

                    baseAccounts.post(dcEdition).then(
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
                var selectUsers = $scope.gridApi.selection.getSelectedGridRows();
                selectUsers.forEach(function (deluser) {
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
            //$scope.editdataids = [];
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
                            var dataRows = toEditRows.map(function (gridRow) {
                                if (userWithId.id === gridRow.entity.id)return gridRow.entity;
                            });
                            $scope.gridApi.rowEdit.setRowsClean(dataRows);
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
                enableFiltering: true,
                columnDefs: [
                    {name: 'id', field: 'id', enableCellEdit: false},
                    {name: 'name', field: 'name'},
                    {name: 'email', field: 'email'},
                    {
                        name: 'password',
                        field: 'password',
                        cellTemplate: '<div class="ui-grid-cell-contents">******</div>'
                    }
                ],
                paginationPageSizes: [10, 30, 50],
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                },
            };

            baseAccounts.getList().then(function (accounts) {
                var allAccounts = accounts;
                $scope.gridOptions.data = allAccounts;
                console.log( $scope.gridOptions.data);
            });

        }
    ]
)
;

//showMsg('hello','测试','ruby',10000);
