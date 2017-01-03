'use strict';

MetronicApp.controller('userCtrl',
    ['$scope', 'Restangular',
        function ($scope, Restangular) {
            var baseAccounts = Restangular.all('/users');

            $scope.addData = function () {
                console.log($scope.gridApi.rowEdit.getDirtyRows());
            };

            $scope.delData = function () {
                var selectUsers = $scope.gridApi.selection.getSelectedGridRows();
                selectUsers.forEach(function (deluser) {
                        console.log(deluser);
                        deluser.entity.remove().then(function (res) {
                            if (res.success) {
                                $scope.gridOptions.data = _.without($scope.gridOptions.data, deluser.entity);
                                showMsg(res.messages.toString(), '信息', 'lime');
                            }
                            else {
                                showMsg(res.errors.toString(), '错误', 'ruby');
                            }
                            console.log(res);
                        });
                    }
                );
            };

            $scope.saveRow = function (rowEntity) {
                var userWithId = _.find($scope.gridOptions.data, function (user) {
                    return user.id === rowEntity.id;
                });
                userWithId.password_confirmation = userWithId.password;
                $scope.gridApi.rowEdit.setSavePromise(rowEntity, userWithId.put().then(function(res){
                    console.log(res);
                    if (res.success) {
                        rowEntity = JSON.parse(res.data);
                        showMsg(res.messages.toString(), '信息', 'lime');
                    } else {
                        // TODO add error message to system
                        showMsg(res.errors.toString(), '错误', 'ruby');
                        console.log('update failed!');
                    }
                }));
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
                //console.log($scope.gridOptions.data);
            });

        }
    ]
)
;

//showMsg('hello','测试','ruby',10000);
