'use strict';

angular.module("MetronicApp").controller('iconbasketsetindexCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            var tableDatas = Restangular.all('/icon-basket-setindex');
            i18nService.setCurrentLang('zh-cn');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: 'add-material',
                    className: 'ngdialog-theme-default addmaterial',
                    scope: $scope,
                    controller: ['$scope', function ($scope) {
                        //$scope.$validationOptions = validationConfig;
                        //二级联动start 物品分类
                        //distinct json mclass字段  开始
                        var lookup = {};
                        var items = $scope.datawzgrps;
                        var result = [];
                        for (var item, i = 0; item = items[i++];) {
                            var name = item.class;
                            var tmno = item.no;

                            if (!(name in lookup)) {
                                lookup[name] = 1;
                                result.push(name);
                            }
                        }
                        //结束
                        $scope.tmclass =result; //将物资分类的数组赋过去
                        $scope.tmno=tmno; //显示最近编号

                        // $scope.dcEdition={mclass:$scope.tmclass[0]}; //初始化第一个分类为默认值

                        //end
                    }],
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    closeByEscape: true
                }).then(function (dcEdition) {
                    console.log(dcEdition);
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
                    {name: '编号', field: 'no', enableCellEdit: false, width: '120',enableFiltering: true,enableColumnResizing:false},
                    {name: '物资分类', field: 'class', width: '120',enableCellEdit: false,enableHiding: false},
                    {name: '物资名称',width: '180', field: 'name', enableCellEdit: true},
                    {name: '单位',width: '100',field: 'measunit', enableCellEdit: true},
                    {name: '物资简拼', width: '150',field: 'spell',enableCellEdit: true,visible:true},
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

