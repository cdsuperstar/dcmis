'use strict';

angular.module("MetronicApp").controller('iconbasketsearchindexCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            var tableDatas = Restangular.all('/icon-basket-setindex');
            i18nService.setCurrentLang('zh-cn');

            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                enableCellEditOnFocus: true,
                columnDefs: [
                    {name: '编号', field: 'no', enableCellEdit: false, width: '120',enableFiltering: true,enableColumnResizing:false},
                    {name: '物资分类', field: 'class', width: '120',enableCellEdit: false,enableHiding: false},
                    {name: '物资名称',width: '180', field: 'name', enableCellEdit: false},
                    {name: '单位',width: '100',field: 'measunit', enableCellEdit: false},
                    {name: '物资简拼', width: '150',field: 'spell',enableCellEdit: false,visible:true},
                    {name: '创建时间',width: '160', field: 'created_at',enableCellEdit: false,visible:true},
                    {name: '更新时间', width: '160',field: 'updated_at',enableCellEdit: false,visible:true}

                ],
                paginationPageSizes: [10, 30, 50],
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    // gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                }
            };

            $scope.toggleFilteringsign = '筛选数据';
            $scope.toggleFiltering = function(){
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
                if(!$scope.gridOptions.enableFiltering) $scope.toggleFilteringsign = '筛选数据';
                else $scope.toggleFilteringsign = '取消筛选';
                $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
            };

            $scope.refreshData = function(){
                $scope.gridOptions.data = [];
                tableDatas.getList().then(function (accounts) {
                    var allAccounts = accounts;
                    $scope.gridOptions.data = allAccounts;
                });
            };

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

