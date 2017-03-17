'use strict';

angular.module("MetronicApp").controller('iconbasketsetindexCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            var tableDatas = Restangular.all('wz.json');
            i18nService.setCurrentLang('zh-cn');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: 'add-material',
                    className: 'ngdialog-theme-default addmaterial',
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
                    {name: '编号', field: 'mno', enableCellEdit: true, width: '100',enableFiltering: true,enableColumnResizing:false},
                    {name: '物资分类', field: 'mclass', width: '100',enableCellEdit: true,enableHiding: false},
                    {name: '物资名称',width: '180', field: 'name', enableCellEdit: true},
                    {name: '单位',width: '50',field: 'munit', enableCellEdit: true},
                    {name: '物资简拼', width: '150',field: 'mspell',enableCellEdit: true,visible:true},
                    {name: '添加时间', width: '150',field: 'created_at',enableCellEdit: false,visible:false},

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
                $scope.gridOptions.data = allAccounts;
                //console.log( $scope.gridOptions.data);
            });

            $scope.tmclass=[
                '安全防护',
                '搬钳工具',
                '办公工具',
                '办公胶类',
                '办公文具',
                '财务用品',
                '插头插座',
                '厨房用品',
                '床上用品',
                '打印耗材',
                '电器',
                '电梯配件',
                '电线电源',
                '阀门类',
                '各类锁',
                '各类用笔',
                '各类纸张',
                '工作服装',
                '管材类',
                '焊材类',
                '家具',
                '建筑材料',
                '胶类',
                '接头类',
                '金属丝',
                '开关控制',
                '空调配件',
                '量具工具',
                '螺丝钉',
                '绿化用品',
                '门窗件',
                '配电管材',
                '其它材料',
                '其它用品',
                '气体',
                '清洁用品',
                '生活用品',
                '水龙头',
                '通讯材料',
                '维修工具',
                '文件袋夹',
                '消防监控',
                '小型电器',
                '易损易耗',
                '油类',
                '油漆',
                '照明电子',
                '钻头类',
            ];

        }
    ]
)
;

