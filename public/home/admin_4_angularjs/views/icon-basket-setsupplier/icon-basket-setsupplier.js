'use strict';

angular.module("MetronicApp").controller('iconbasketsetsupplierCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            var tableDatas = Restangular.all('/icon-basket-setsupplier');
            i18nService.setCurrentLang('zh-cn');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: 'icon-basketsetsupplier',
                    className: 'ngdialog-theme-default iconbasketsetsupplier',
                    scope: $scope,
                    controller: ['$scope', function ($scope) {
                        //$scope.$validationOptions = validationConfig;

                        //end
                    }],
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    closeByEscape: true
                }).then(function (dcEdition) {
                    // console.log(dcEdition);
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
                selectdcmodels.forEach(function (deldata) {
                        //console.log(deldata);
                        deldata.entity.remove().then(function (res) {
                            if (res.success) {
                                $scope.gridOptions.data = _.without($scope.gridOptions.data, deldata.entity);
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

            //edit data
            $scope.editData = function () {
                var toEditRows = $scope.gridApi.rowEdit.getDirtyRows($scope.gridOptions);
                toEditRows.forEach(function (editdata) {
                    var userWithId = _.find($scope.gridOptions.data, function (user) {
                        return user.id === editdata.entity.id;
                    });
                    userWithId.password_confirmation = userWithId.password;
                    //console.log(userWithId);
                    userWithId.put().then(function (res) {
                        console.log(res);
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
                    {name: 'ID', field: 'id', enableCellEdit: false, width: '50',enableFiltering: false,enableColumnResizing:false},
                    {name: '公司名称', field: 'compname', width: '180',enableCellEdit: true,enableHiding: false},
                    {name: '负责人',width: '100', field: 'principal', enableCellEdit: true},
                    {name: '联络人', width: '100',field: 'contacter',enableCellEdit: true,visible:true},
                    {name: '固定电话', width: '120',field: 'tel',enableCellEdit: true,visible:true},
                    {name: '联系电话', width: '120',field: 'phone',enableCellEdit: true,visible:true},
                    {name: '公司地址',width: '200',field: 'compaddr', enableCellEdit: true},
                    {name: '备注', width: '200',field: 'remark',enableCellEdit: true,visible:true},
                    {name: '创建时间',width: '160', field: 'created_at',enableCellEdit: false,visible:true},
                    {name: '更新时间', width: '160',field: 'updated_at',enableCellEdit: false,visible:true}

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

            $scope.refreshData = function(){
                $scope.gridOptions.data = [];
                tableDatas.getList().then(function (accounts) {
                    var allAccounts = accounts;
                    $scope.gridOptions.data = allAccounts;
                });
            }

            tableDatas.getList().then(function (accounts) {
                var allAccounts = accounts;
                $scope.datawzgrps = accounts;
                $scope.gridOptions.data = allAccounts;
                //console.log( $scope.gridOptions.data);
            });

        }
    ]
)
;

