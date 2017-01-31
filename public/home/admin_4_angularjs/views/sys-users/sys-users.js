'use strict';

angular.module("MetronicApp").controller('dcuserCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            var tableDatas = Restangular.all('/users');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: '/sys-users/sys-edit-users',
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
                showColumnFooter: true,
                enableCellEditOnFocus:true,
                enableVerticalScrollbar:2,
                enableHorizontalScrollbar :2,
                columnDefs: [
                    {name: 'id', field: 'id', enableCellEdit: false,enableColumnMenu: false,enableHiding: false,enableFiltering: false,footerCellTemplate: '<span class="ui-grid-cell-contents" style="color: #000000">合计</span>' },
                    {name: '姓名', field: 'name',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '邮箱', field: 'email',enableCellEdit: true,visible:false},
                    {
                        name: '密码',
                        field: 'password',
                        cellTemplate: '<div class="ui-grid-cell-contents">******</div>',
                        enableCellEdit: true
                    },
                    {name: '添加时间', field: 'created_at',enableCellEdit: false,visible:true},
                    {name: '更新时间', field: 'updated_at',enableCellEdit: false,visible:false},

                ],

                enableGridMenu: true,
                //exporterMenuCsv:false,
                //exporterMenuPdf:false,

                //--------------导出----------------------------------
                exporterAllDataFn: function(){
                    return getPage(1,$scope.gridOptions.totalItems);
                },
                exporterCsvColumnSeparator: ',',
                exporterCsvFilename:'download.csv',
                //exporterFieldCallback : function ( grid, row, col, value ){
                //    if ( value == 50 ){
                //        value = "可以退休";
                //    }
                //    return value;
                //},
                //exporterHeaderFilter :function( displayName ){
                //    return 'col: ' + name;
                //},
                exporterHeaderFilterUseName : true,
                exporterMenuCsv : true,
                exporterMenuLabel : "Export",
                exporterMenuPdf : true,
                exporterOlderExcelCompatibility : true,
                exporterPdfCustomFormatter : function ( docDefinition ) {
                    docDefinition.styles.footerStyle = { bold: true, fontSize: 10 };
                    return docDefinition;
                },
                exporterPdfFooter :{
                    text: 'Powered by DcMis',
                    style: '',
                    alignment:'center'
                },
                exporterPdfDefaultStyle : {
                    fontSize: 11,font:'微软雅黑' //font 设置自定义字体

                },
                exporterPdfFilename:'download.pdf',
                /* exporterPdfFooter : {
                 columns: [
                 'Left part',
                 { text: 'Right part', alignment: 'right' }
                 ]
                 },
                 或 */
                //exporterPdfFooter: function(currentPage, pageCount) {
                //    return currentPage.toString() + ' of ' + pageCount;
                //},
                exporterPdfHeader : function(currentPage, pageCount) {
                    return currentPage.toString() + ' of ' + pageCount;
                },
                exporterPdfMaxGridWidth : 720,
                exporterPdfOrientation : 'landscape',//  'landscape' 或 'portrait' pdf横向或纵向
                exporterPdfPageSize : 'A4',// 'A4' or 'LETTER'
                exporterPdfTableHeaderStyle : {
                    bold: true,
                    fontSize: 12,
                    color: 'black'
                },
                exporterPdfTableLayout : null,
                exporterPdfTableStyle: {
                    margin: [0, 5, 0, 15]
                },
                exporterSuppressColumns : ['buttons'],
                exporterSuppressMenu: false,


                enablePagination: true, //是否分页，默认为true
                enablePaginationControls: true, //使用默认的底部分页
                paginationPageSizes: [10, 30, 50],
                paginationCurrentPage: 1,
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                }
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

            $scope.export = function(signdata){
                if (signdata == 'csv') {
                    var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
                    $scope.gridApi.exporter.csvExport( "all", "all", myElement );
                } else if (signdata == 'pdf') {
                    $scope.gridApi.exporter.pdfExport( "all", "all" );
                };
            };

            tableDatas.getList().then(function (accounts) {
                var allAccounts = accounts;
                $scope.gridOptions.data = allAccounts;
            });

        }
    ]
)
;
