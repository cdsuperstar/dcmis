'use strict';

angular.module("MetronicApp").controller('ambudgetlistCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            var tableDatas = Restangular.all('500_complex.json');


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
                showColumnFooter:true,
                enableVerticalScrollbar:1,
                enableHorizontalScrollbar :1,
                columnDefs: [
                    {name: '操作', field: 'id',width: '50',enableColumnMenu: false,enableColumnResizing:false,enableSorting:false,pinnedLeft:true,
                        enableHiding: false,
                        enableFiltering: false,
                        cellTemplate: '<div style="text-align: center;" class="ui-grid-cell-contents"> ' +
                        '<span class="icon-eye icon-hand" ng-click="grid.appScope.showdetail(row)"  title="查看详情"></span>&nbsp;' +
                        '<span class="fa fa-edit icon-hand" ng-click="grid.appScope.editdata(row)"  title="修改数据"></span>' +
                        ' </div>',
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                    {name: '编号', field: 'no',width: '100',enableColumnMenu: true},
                    {name: '项目名称', field: 'budgetname',width: '200',enableColumnMenu: true},
                    {name: '总金额', field: 'total',width: '80',type:'float',enableColumnMenu: true,enableHiding: false,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '项目摘要', field: 'summary',width: '200',enableColumnMenu: true,visible:true},
                    {name: '项目类别', field: 'type',width: '150',visible:true},
                    {name: '审批状态', field: 'gender',width: '100',visible:true},
                    {name: '申报人', field: 'requester',width: '100',visible:true},
                    {name: '申报部门', field: 'unit',width: '150',visible:true},
                    {name: '联系电话', field: 'phone',type:'int',width: '150',visible:true},
                    {name: '简介', field: 'about',type:'string',width: '250',visible:true},
                    {name: '开始日期', field: 'email',width: '100',visible:true,cellFilter: 'date:"yyyy-M-d"',type: 'date'},
                    {name: '截止日期', field: 'email',width: '100',visible:false,cellFilter: 'date:"yyyy-M-d"',type: 'date'},
                    {name: '添加时间', field: 'registered',width: '100',visible:true},
                    {name: '更新时间', field: 'updated_at',width: '100',visible:false},

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
                exporterMenuPdf : false, //导出pdf 开关
                exporterMenuLabel : "Export",
                exporterOlderExcelCompatibility : true,
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
                //exporterPdfDefaultStyle : {font:'MicrosoftYaHei',fontSize: 9},
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
                }
            };


            $scope.showdetail = function(row) {
                //var detaildata=angular.fromJson(row.entity);
                ngDialog.openConfirm({
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    template: 'approval-detail',
                    className: 'ngdialog-theme-default am-budgtlistdetail',
                    scope: $scope,
                    controller: ['$scope',function ($scope) {
                        $scope.tmpobjdata = row.entity;  //显示值
                        var sourceDatas = Restangular.all('data.json'); //临时数据

                        switch(row.entity.type)
                        {
                            case 1:
                            {
                                $scope.soucegridOptions={
                                    enableSorting: true,
                                    enableFiltering: false,
                                    showColumnFooter:true,
                                    showGridFooter:true,
                                    enableVerticalScrollbar:1,
                                    enableHorizontalScrollbar :1,
                                    enableGridMenu: true,
                                    //rowTemplate : '<div style="background-color: aquamarine" ng-click="grid.appScope.fnOne(row)" ng-repeat="col in colContainer.renderedColumns track by col.colDef.name" class="ui-grid-cell" ui-grid-cell></div>',
                                    columnDefs: [
                                        {name: '物资名称', field: 'asname',width: '200',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.asname; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                            footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                        {name: '金额', field: 'price',width: '80',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                        {name: '数量', field: 'amt',width: '60',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                        {name: '单位', field: 'meas',width: '60',enableColumnMenu: true},
                                        {name: '物资参数', field: 'aspara',width: '600',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.aspara; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                        },
                                        {name: '添加时间', field: 'registered',width: '100',visible:true},
                                        {name: '更新时间', field: 'updated_at',width: '100',visible:false},
                                    ],

                                    data: [],
                                    onRegisterApi: function (gridApi) {
                                        $scope.gridApi = gridApi;
                                    }
                                };
                                $scope.gridApi.core.notifyDataChange(uiGridConstants.dataChange.OPTIONS);
                                var sourceDatas = Restangular.all('data.json');
                            }
                                break;
                            case 2:
                            {
                                $scope.soucegridOptions={
                                    enableSorting: true,
                                    enableFiltering: false,
                                    showColumnFooter:true,
                                    showGridFooter:true,
                                    enableVerticalScrollbar:1,
                                    enableHorizontalScrollbar :1,
                                    enableGridMenu: true,
                                    //rowTemplate : '<div style="background-color: aquamarine" ng-click="grid.appScope.fnOne(row)" ng-repeat="col in colContainer.renderedColumns track by col.colDef.name" class="ui-grid-cell" ui-grid-cell></div>',
                                    columnDefs: [
                                        {name: '合同名称', field: 'contrname',width: '200',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.contrname; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                            footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                        {name: '合同金额', field: 'contrprice',width: '80',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                        {name: '合同编号', field: 'contrno',width: '120',enableColumnMenu: true},
                                        {name: '合同地点', field: 'contraddr',width: '120',enableColumnMenu: true},
                                        {name: '负责人', field: 'contrpicharge',width: '120',enableColumnMenu: true},
                                        {name: '负责人电话', field: 'contrpicphone',width: '120',enableColumnMenu: true},
                                        {name: '合同要求', field: 'contrworkreq',width: '600',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.contrworkreq; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                        },
                                        {name: '付款用途', field: 'paymentp',width: '120',enableColumnMenu: true},
                                        {name: '合同开始日期', field: 'contrbegindate',width: '100',visible:true},
                                        {name: '合同截止日期', field: 'contrenddate',width: '100',visible:true},
                                        {name: '添加时间', field: 'registered',width: '100',visible:true},
                                        {name: '更新时间', field: 'updated_at',width: '100',visible:false},
                                    ],
                                    data: [],
                                    onRegisterApi: function (gridApi) {
                                        $scope.gridApi = gridApi;
                                    }
                                };
                                $scope.gridApi.core.notifyDataChange(uiGridConstants.dataChange.OPTIONS);
                                var sourceDatas = Restangular.all('data.json');
                            }
                                break;
                            case 3:
                            {
                                $scope.soucegridOptions={
                                    enableSorting: true,
                                    enableFiltering: false,
                                    showColumnFooter:true,
                                    showGridFooter:true,
                                    enableVerticalScrollbar:1,
                                    enableHorizontalScrollbar :1,
                                    enableGridMenu: true,
                                    //rowTemplate : '<div style="background-color: aquamarine" ng-click="grid.appScope.fnOne(row)" ng-repeat="col in colContainer.renderedColumns track by col.colDef.name" class="ui-grid-cell" ui-grid-cell></div>',
                                    columnDefs: [
                                        {name: '合同地点', field: 'svpicphone',width: '120',enableColumnMenu: true},
                                        {name: '负责人', field: 'svpicharge',width: '120',enableColumnMenu: true},
                                        {name: '负责人电话', field: 'svaddr',width: '120',enableColumnMenu: true},
                                    ],

                                    data: [],
                                    onRegisterApi: function (gridApi) {
                                        $scope.gridApi = gridApi;
                                    }
                                };
                                $scope.gridApi.core.notifyDataChange(uiGridConstants.dataChange.OPTIONS);
                                var sourceDatas = Restangular.all('data.json');
                            }
                                break;
                            case 4:
                            {
                                $scope.soucegridOptions={
                                    enableSorting: true,
                                    enableFiltering: false,
                                    showColumnFooter:true,
                                    showGridFooter:true,
                                    enableVerticalScrollbar:1,
                                    enableHorizontalScrollbar :1,
                                    enableGridMenu: true,
                                    //rowTemplate : '<div style="background-color: aquamarine" ng-click="grid.appScope.fnOne(row)" ng-repeat="col in colContainer.renderedColumns track by col.colDef.name" class="ui-grid-cell" ui-grid-cell></div>',
                                    columnDefs: [
                                        {name: '合同地点', field: 'otaddr',width: '120',enableColumnMenu: true},
                                        {name: '负责人', field: 'otpicharge',width: '120',enableColumnMenu: true},
                                        {name: '负责人电话', field: 'otpicphone',width: '120',enableColumnMenu: true},
                                    ],

                                    data: [],
                                    onRegisterApi: function (gridApi) {
                                        $scope.gridApi = gridApi;
                                    }
                                };
                                $scope.gridApi.core.notifyDataChange(uiGridConstants.dataChange.OPTIONS);
                                var sourceDatas = Restangular.all('data.json');
                            }
                                break;
                            default:
                                console.log(row.entity.type);
                                break;
                        }

                        sourceDatas.getList().then(function (accounts) {
                            var allAccounts = accounts;
                            $scope.soucegridOptions.data = allAccounts;
                        });
                    }],

                }).then(function (dcEdition) {
                    var tmpdcdata=angular.toJson(dcEdition);


                }, function (dcEdition) {

                });


            };

            $scope.editdata = function (row) {
                console.log(row.entity.company);
                //var toEditRows = $scope.gridApi.rowEdit.getDirtyRows($scope.gridOptions);
                //修改跳至修过页面

            }

            //执行打印操作
            $scope.printsource = function () {
                //$scope.printdate=$scope.gridApi.getRow();
                var currentSelection = $scope.gridApi.selection.getSelectedRows();
                if(currentSelection.length==1){
                    var popupWindow = window.open('views/am-budget-list/am-budgetprint.html');
                    popupWindow.PrintSharedData = currentSelection[0];
                }else{
                    showMsg('选取行数错误。打印仅支持一条记录！<br>(当前状态：未选择或者选择大于2)', '错误', 'ruby');
                }
                //console.log($scope.printdate);

            }


            $scope.toggleFiltering = function(){
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
                $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
            };

            tableDatas.getList().then(function (accounts) {
                var allAccounts = accounts;
                $scope.gridOptions.data = allAccounts;
            });

        }
    ]
)
;
