'use strict';

angular.module("MetronicApp").controller('dcuserCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            var tableDatas = Restangular.all('/users');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: '/users/create',
                    className: 'ngdialog-theme-default sysuser',
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

            $scope.imdata = [];
            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter: false,
                enableCellEditOnFocus:true,
                columnDefs: [
                    {name: 'id', field: 'id',width: '40',enableCellEdit: false,enableColumnMenu: false,enableHiding: false,enableFiltering: false},
                    {name: '姓名', field: 'name',width: '120',enableCellEdit: true,enableColumnMenu: false,enableHiding: false},
                    {name: '邮箱', field: 'email',width: '200',enableCellEdit: true,visible:true},
                    {
                        name: '密码',
                        type:'string',
                        width: '150',
                        headerCellClass: 'nowrap="false"',
                        field: 'password',
                        cellTemplate: '<div class="ui-grid-cell-contents">******</div>',
                        enableCellEdit: true
                    },
                    {name: '用户配置', width: '120',field: 'usercfg',enableCellEdit: false,visible:true,
                        cellTemplate: '<div ng-dblclick="grid.appScope.showusercfg(row)"> {{row.entity.usercfg}}</div>'

                    },
                    {name: '系统配置', width: '120',field: 'syscfg',enableCellEdit: false,visible:true,
                        cellTemplate: '<div ng-dblclick="grid.appScope.showsyscfg(row)"> {{row.entity.syscfg}}</div>'

                    },
                    {name: '创建时间',width: '160', field: 'created_at',enableCellEdit: false,visible:true},
                    {name: '更新时间', width: '160',field: 'updated_at',enableCellEdit: false,visible:true},

                ],

                enableGridMenu: true,
                //exporterMenuCsv:false,
                //exporterMenuPdf:false,
                //--------------导入开始----------------------------------
                imdata : 'data',
                importerDataAddCallback: function ( grid, newObjects ) {
                    $scope.imdata = $scope.imdata.concat( newObjects );
                },
                //--------------导入结束----------------------------------

                //--------------导出----------------------------------
                exporterHeaderFilterUseName : true,
                exporterMenuCsv : false, //导出Excel 开关
                exporterMenuPdf : false, //导出pdf 开关
                exporterMenuLabel : "Export",
                exporterOlderExcelCompatibility : true,
                exporterCsvColumnSeparator: ',',
                exporterCsvFilename:'download.csv',
                //exporterAllDataFn: function(){
                //    return getPage(1,$scope.gridOptions.totalItems);
                //},
                //exporterFieldCallback : function ( grid, row, col, value ){
                //    if ( value == 50 ){
                //        value = "可以退休";
                //    }
                //    return value;
                //},
                //exporterHeaderFilter :function( displayName ){
                //    return 'col: ' + name;
                //},
                //导出pdf 设置 开始
                //exporterPdfCustomFormatter : function ( docDefinition ) {
                //    docDefinition.styles.headerStyle = {fontSize: 22, bold: true};
                //    docDefinition.styles.footerStyle = { bold: true, fontSize: 10 };
                //    return docDefinition;
                //},
                //exporterPdfFooter :{
                //    text: 'Powered by DcMis',
                //    style: 'footerStyle',
                //    alignment:'center'
                //},
                //exporterPdfDefaultStyle : {font:'mcroyh',fontSize: 9}, //微软雅黑
                //exporterPdfFilename:'download.pdf',
                //exporterPdfAlign:'center', //定义整体样式
                //exporterPdfHeader : function(currentPage, pageCount) {
                //    return '页码：'+ currentPage.toString() + ' of ' + pageCount;
                //},
                ////exporterPdfMaxGridWidth : 720, //Defaults to 720 (for A4 landscape), use 670 for LETTER
                //exporterPdfOrientation : 'landscape',//  'landscape' 或 'portrait' pdf横向或纵向
                //exporterPdfPageSize : 'A4',// 'A4' or 'LETTER'
                //exporterPdfTableHeaderStyle : {
                //    bold: true,
                //    fontSize: 12,
                //    italics: true,
                //    color: 'black'
                //},
                //exporterPdfTableLayout : null,
                //exporterPdfTableStyle: {
                //    margin: [0, 5, 0, 15]  //左上右下
                //},
                //exporterSuppressColumns : ['buttons'],
                //exporterSuppressMenu: false,
                //导出pdf 设置 结束
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

            $scope.showusercfg=function(row){
                var json =angular.fromJson(row.entity.usercfg);  //转换为JSON

                ngDialog.openConfirm({
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    template: 'jsoneditor',
                    className: 'ngdialog-theme-default sysuserjson',
                    scope: $scope,
                    controller: ['$scope',function ($scope) {
                        $scope.$on('ngDialog.opened', function () {
                            $scope.obj = {data: json, options: {mode: 'tree'}};

                            $scope.changeOptions = function (tmpoption) {
                                $scope.obj.options.mode = tmpoption;
                            };
                            $scope.changeData = function () {
                                $scope.obj.data = json;
                            };
                            $scope.pretty = function (obj) {
                                return obj;
                            };

                        });
                    }],

                }).then(function (dcEdition) {

                }, function (dcEdition) {

                });

            };

            $scope.showsyscfg=function(row){
                var json = row.entity.syscfg;

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
