'use strict';

angular.module("MetronicApp").controller('ambudgetlbCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {

            var tableDatas = Restangular.all('/am-budget-lb');
            i18nService.setCurrentLang('zh-cn');
            //预算类别模板
            $scope.templatelist = [{ value: 1, label: '物资模板' }, { value: 2, label: '工程模板' }, { value: 3, label: '服务模板' }, { value: 4, label: '其他模板' }];


            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: 'add-ambudgetlb',
                    className: 'ngdialog-theme-default ambudgetlb',
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
                    console.log(dcEdition);
                    tableDatas.post(dcEdition).then(
                        function (res) {
                            if (res.success) {
                                $scope.gridOptions.data.push(res);
                                showMsg(res.messages.toString(), '信息', 'lime');
                            } else {
                                //TODO add error message to system
                                showMsg(res.errors.toString(), '错误', 'ruby');
                            }
                        }
                    );
                }, function (dcEdition) {
                    //console.log('Modal promise rejected. Reason: ', dcEdition);
                });
            };

            $scope.delData = function () {
                var selectbudgetlb = $scope.gridApi.selection.getSelectedGridRows();
                selectbudgetlb.forEach(function (deldata) {
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

            //edit data  (only read)

            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                enableCellEditOnFocus: true,
                columnDefs: [
                    {name: '编号', field: 'no', enableCellEdit: true, width: '120',enableFiltering: true,enableColumnResizing:false},
                    {name: '类别名称',width: '260', field: 'type', enableCellEdit: true},  //主要用来生成编号
                    {name: '类别简拼', width: '150',field: 'spell',enableCellEdit: true,visible:true},
                    {name: '类别模板', width: '150',field: 'template',enableCellEdit: true,visible:true,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: $scope.templatelist,cellFilter: 'templateGender',
                        filter: {
                            term: 1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.templatelist}
                    },
                    {name: '创建时间',width: '160', field: 'created_at',enableCellEdit: false,visible:true},
                    {name: '更新时间', width: '160',field: 'updated_at',enableCellEdit: false,visible:true}

                ],
                paginationPageSizes: [10, 30, 50],
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
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

                //找最大值
                //var maxid = Math.max.apply(Math,allAccounts.map(function(item){return item.id;}));
                // $scope.maxno = eval($scope.gridOptions.data)[eval($scope.gridOptions.data).length-1]["no"];
                // $scope.maxno = $scope.gridOptions.data[$scope.gridOptions.data.length-1]["no"];
                //console.log( $scope.gridOptions.data);
            });

        }
    ]
)

    .filter('templateGender', function() {
        var templateHash = {
            1: '物资模板',
            2: '工程模板',
            3: '服务模板',
            4: '其他模板'
        };

        return function(input) {
            if (!input){
                return '';
            } else {
                return templateHash[input];
            }
        };
    })

;

