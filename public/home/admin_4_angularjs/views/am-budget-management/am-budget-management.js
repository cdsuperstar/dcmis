'use strict';

angular.module("MetronicApp").controller('budgetmanagementCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
            var currentYear = new Date().getFullYear();
            var yeararr = new Array();
            for(var val = (currentYear-3); val <= (currentYear+3); val++){
                yeararr.push(val);}
            var untarr = [];
            var tmpu = {};
            for(var i=0;i<yeararr.length;i++){
                tmpu ={value:yeararr[i],label:yeararr[i]};
                untarr.push(tmpu);
            }
            $scope.uigrtyear = untarr; //转换成uigrid可识别的模式[{value:xxx,lebel:'xxx'}]
            $scope.tyear = yeararr;
            console.log($scope.uigrtyear);
            //预算类别列表
            $scope.listnames = [{ id: 1, name: '物资预算' }, { id: 2, name: '工程预算' }, { id: 3, name: '服务预算' }, { id: 4, name: '其他预算' }];
            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                //console.log(accounts);
                var untarr = [];
                var tmpu = {};
                for(var i=0;i<accounts.length;i++){
                    tmpu ={value:accounts[i].id,label:accounts[i].name};
                    untarr.push(tmpu);
                }
                $scope.uigrunitgrps = JSON.stringify(untarr.name).replace(/\"/g, "'"); //转换成uigrid可识别的模式
                $scope.untigrps = accounts;
                console.log($scope.uigrunitgrps);
            });
            //
            var tableDatas = Restangular.all('500_data.json');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: 'addambudgetmanagement',
                    className: 'ngdialog-theme-default ambudgetmanagement',
                    scope: $scope,
                    controller: ['$scope', 'validationConfig', function ($scope, validationConfig) {
                        $scope.$validationOptions = validationConfig;

                        //初始化
                        $scope.dcEdition = { syear : currentYear};  //初始化为当前年度
                        //预算类别
                        $scope.dcEdition.type = 1; //初始值为物资预算
                        ////////////机构
                        $scope.dcEdition.unit = 3;  //有值的情况下定义选择项


                    }],
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    closeByEscape: true
                }).then(function (dcEdition) {

                    console.log(dcEdition)
                    // tableDatas.post(dcEdition).then(
                    //     function (res) {
                    //         if (res.success) {
                    //             $scope.gridOptions.data.push(res);
                    //             showMsg(res.messages.toString(), '信息', 'lime');
                    //         } else {
                    //             // TODO add error message to system
                    //             showMsg(res.errors.toString(), '错误', 'ruby');
                    //         }
                    //     }
                    // );

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
                showColumnFooter: true,
                enableCellEditOnFocus:true,
                columnDefs: [
                    {name: 'id', field: 'id',width: '40',enableCellEdit: false,enableColumnMenu: false,enableHiding: false,enableFiltering: false},
                    {name: '年度', field: 'syear',width: '80',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>',
                        filter: {
                            term: '1',
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.uigrtyear}
                    },
                    {name: '部门', field: 'unit',width: '200',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        filter: {
                            term: '1',
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.uigrunitgrps}
                    },
                    {name: '预算类别', field: 'type',width: '120',enableCellEdit: true,enableColumnMenu: false,enableHiding: false},
                    {name: '金额', field: 'total',width: '70',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '备注', field: 'remark',width: '180',enableCellEdit: true,enableColumnMenu: true,enableHiding: true,
                        cellTooltip: function(row){ return row.entity.remark; },
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                    },
                    {name: '创建时间',width: '160', field: 'created_at',enableCellEdit: false,visible:false},
                    {name: '更新时间', width: '160',field: 'updated_at',enableCellEdit: false,visible:false},

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

            //

        }
    ]
)
;
