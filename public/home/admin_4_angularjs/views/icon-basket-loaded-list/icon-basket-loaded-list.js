'use strict';

angular.module("MetronicApp").controller('iconbasketloadlistCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
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
            //预算类别列表
            $scope.listnames = [{ value: 1, label: '物资预算' }, { value: 2, label: '工程预算' }, { value: 3, label: '服务预算' }, { value: 4, label: '其他预算' }];
            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                //console.log(accounts);
                $scope.untigrps = accounts;
            });
            //人员列表
            Restangular.all('/sys-users').getList().then(function (accounts) {
                $scope.peoplegrps = accounts;
            });
            $scope.basket = { syear:currentYear,type:1};  //初始化为当前年度

            //
            var tableDatas = Restangular.all('500_complex.json');


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

            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter:true,
                showGridFooter:true,
                columnDefs: [
                    {name: '详情', field: 'id',width: '50',enableColumnMenu: false,enableColumnResizing:false,enableSorting:false,pinnedLeft:true,
                        enableHiding: false,
                        enableFiltering: false,
                        cellTemplate: '<div style="text-align: center;" class="ui-grid-cell-contents"> ' +
                        '<span class="icon-eye icon-hand" ng-click="grid.appScope.showdetail(row)"  title="查看详情"></span>&nbsp;' +
                        ' </div>'},
                    {name: '编号', field: 'no',width: '100',enableColumnMenu: true,
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'
                    },
                    {name: '年度', field: 'syear',width: '80',
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: $scope.uigrtyear,
                        filter: {
                            term: currentYear,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.uigrtyear}
                    },
                    {name: '预算类别', field: 'type',width: '120',
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: $scope.listnames,cellFilter: 'yslbGender',
                        filter: {
                            term: 1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.listnames}
                    },
                    {name: '项目名称', field: 'budgetname',width: '200'},
                    {name: '总金额', field: 'total',width: '80',type:'float',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '申报人', field: 'requester',width: '100',},
                    {name: '部门', field: 'unit',width: '200',
                        filter: {
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.uigrunitgrps}
                    },
                    {name: '审批状态', field: 'urchasingstatus',width: '100',enableColumnMenu: true},
                    {name: '采购状态', field: 'urchasingstatus',width: '100',enableColumnMenu: true}
                ],

                enableGridMenu: true,

                //--------------导出----------------------------------
                exporterHeaderFilterUseName : true,
                exporterMenuCsv : true, //导出Excel 开关
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

            $scope.showdetail = function(row) {
                //var detaildata=angular.fromJson(row.entity);
                ngDialog.openConfirm({
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    template: 'basket-load-list',
                    className: 'ngdialog-theme-default iconbasketloadlist',
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
                                        {name: '规格、型号', field: 'aspara',width: '200',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.aspara; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                        },
                                        {name: '数量', field: 'amt',width: '60',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                        {name: '单位', field: 'meas',width: '60',enableColumnMenu: true,editableCellTemplate: 'ui-grid/dropdownEditor',
                                            editDropdownRowEntityOptionsArrayPath: 'tmeas.options', editDropdownIdLabel: 'value'
                                        },
                                        {name: '预算单价', field: 'price',width: '80',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                        {name: '备注', field: 'remark',width: '150',enableColumnMenu: true}
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
                                        {name: '工程项目名称', field: 'contrname',width: '150',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.contrname; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                            footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                        {name: '工程预算', field: 'contrprice',width: '80',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                        {name: '工期要求', field: 'contrworkreq',width: '200',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.contrworkreq; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                        },
                                        {name: '工程  地点', field: 'contraddr',width: '120',enableColumnMenu: true},
                                        {name: '负责人', field: 'contrpicharge',width: '120',enableColumnMenu: true},
                                        {name: '负责人电话', field: 'contrpicphone',width: '120',enableColumnMenu: true}
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

            $scope.toggleFiltering = function(){
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
                $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
            };

            tableDatas.getList().then(function (accounts) {
                var allAccounts = accounts;
                $scope.gridOptions.data = allAccounts;
                //console.log( $scope.gridOptions.data);
            });
            //

        }
    ]
)
    .filter('yslbGender', function() {
        var yslbHash = {
            1: '物资预算',
            2: '工程预算',
            3: '服务预算',
            4: '其他预算'
        };
        return function(input) {
            if (!input){
                return '';
            } else {
                return yslbHash[input];
            }
        };
    })
;
