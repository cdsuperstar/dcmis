'use strict';

angular.module("MetronicApp").controller('amassetmangementaddCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                // console.log(accounts);
                $scope.untigrps = accounts;
            });
            //人员列表
            Restangular.all('/sys-users').getList().then(function (accounts) {
                $scope.peoplegrps = accounts;
            });

            var tableDatas = Restangular.all('/sys-users');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: 'assets-managementadd',
                    className: 'ngdialog-theme-default amassetmangementadd',
                    scope: $scope,
                    controller: ['$scope', 'validationConfig', function ($scope, validationConfig) {
                        $scope.$validationOptions = validationConfig;
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

            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter: false,
                enableCellEditOnFocus:true,
                columnDefs: [
                    {name: '物资名称', field: 'asname',width: '200',enableColumnMenu: true,
                        cellTooltip: function(row){ return row.entity.asname; },
                        //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                    {name: '规格、型号', field: 'aspara',width: '200',enableColumnMenu: true,
                        cellTooltip: function(row){ return row.entity.aspara; },
                        //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                    },
                    {name: '库存数量', field: 'amt',width: '100',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '单位', field: 'meas',width: '60',enableColumnMenu: true,editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownRowEntityOptionsArrayPath: 'tmeas.options', editDropdownIdLabel: 'value'
                    },
                    {name: '备注', field: 'remark',width: '150',enableColumnMenu: true}
                ],

                enableGridMenu: true,
                //exporterMenuCsv:false,
                //exporterMenuPdf:false,
                //--------------导出----------------------------------
                exporterHeaderFilterUseName : true,
                exporterMenuCsv : false, //导出Excel 开关
                exporterMenuPdf : false, //导出pdf 开关
                exporterMenuLabel : "Export",
                exporterOlderExcelCompatibility : true,
                exporterCsvColumnSeparator: ',',
                exporterCsvFilename:'download.csv',

                enablePagination: true, //是否分页，默认为true
                enablePaginationControls: true, //使用默认的底部分页
                paginationPageSizes: [10, 30, 50],
                paginationCurrentPage: 1,
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                }
            };

            $scope.exportxls = function(){
                var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
                $scope.gridApi.exporter.csvExport( 'all', 'all', myElement );
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
            });

        }
    ]
)
;
