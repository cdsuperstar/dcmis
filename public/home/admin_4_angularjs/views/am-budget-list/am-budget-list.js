'use strict';

angular.module("MetronicApp").controller('ambudgetlistCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            var tableDatas = Restangular.all('/users');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: 'views/sys-users/sys-edit-users.html',
                    className: 'ngdialog-theme-default',
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
                showColumnFooter:true,
                enableCellEditOnFocus:true,
                enableVerticalScrollbar:1,
                enableHorizontalScrollbar :1,
                columnDefs: [
                    {name: 'id', field: 'id',width: '5%',enableCellEdit: false,enableColumnMenu: false,enableHiding: false,enableFiltering: false,footerCellTemplate: '<span class="ui-grid-cell-contents" style="color: #000000">合计</span>' },
                    {name: '项目名称', field: 'name',enableCellEdit: true},
                    {name: '总金额', field: 'name',type:'float',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '项目摘要', field: 'email',enableCellEdit: true,visible:true},
                    {name: '申报类别', field: 'email',enableCellEdit: true,visible:true},
                    {name: '申报人', field: 'email',enableCellEdit: true,visible:true},
                    {name: '申报部门', field: 'email',enableCellEdit: true,visible:true},
                    {name: '联系电话', field: 'email',type:'int',enableCellEdit: true,visible:true},
                    {name: '开始日期', field: 'email',enableCellEdit: true,visible:false,cellFilter: 'date:"yyyy-M-d"',type: 'date'},
                    {name: '截止日期', field: 'email',enableCellEdit: true,visible:true,cellFilter: 'date:"yyyy-M-d"',type: 'date'},
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
                exporterMenuCsv : true, //导出Excel 开关
                exporterMenuPdf : true, //导出pdf 开关
                exporterMenuLabel : "Export",
                exporterOlderExcelCompatibility : true,
                exporterPdfCustomFormatter : function ( docDefinition ) {
                    docDefinition.styles.headerStyle = {fontSize: 22, bold: true};
                    docDefinition.styles.footerStyle = { bold: true, fontSize: 10 };
                    return docDefinition;
                },
                exporterPdfFooter :{
                    text: 'Powered by DcMis',
                    style: 'footerStyle',
                    alignment:'center'
                },
                exporterPdfDefaultStyle : {font:'MicrosoftYaHei',fontSize: 9},
                exporterPdfFilename:'download.pdf',
                exporterPdfAlign:'center', //定义整体样式
                exporterPdfHeader : function(currentPage, pageCount) {
                    return '页码：'+ currentPage.toString() + ' of ' + pageCount;
                },
                //exporterPdfMaxGridWidth : 720, //Defaults to 720 (for A4 landscape), use 670 for LETTER
                exporterPdfOrientation : 'landscape',//  'landscape' 或 'portrait' pdf横向或纵向
                exporterPdfPageSize : 'A4',// 'A4' or 'LETTER'
                exporterPdfTableHeaderStyle : {
                    bold: true,
                    fontSize: 12,
                    italics: true,
                    color: 'black'
                },
                exporterPdfTableLayout : null,
                exporterPdfTableStyle: {
                    margin: [0, 5, 0, 15]  //左上右下
                },
                exporterSuppressColumns : ['buttons'],
                exporterSuppressMenu: false,
                //--------------导出结束----------------------------------


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

            tableDatas.getList().then(function (accounts) {
                var allAccounts = accounts;
                $scope.gridOptions.data = allAccounts;
            });

        }
    ]
)
;
