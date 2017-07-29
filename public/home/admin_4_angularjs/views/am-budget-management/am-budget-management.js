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
            $scope.uigrtyear = untarr; //转换成uigrid可识别的模式[{value:xxx,label:'xxx'}]
            $scope.tyear = yeararr;
            //console.log($scope.uigrtyear);
            //预算类别列表
            Restangular.all('/am-budget-lb').getList().then(function (accounts) {
                //console.log(accounts);
                var lbarr = [];
                var tmpu = {};
                var lbHash=[] ;
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    tmpu ={value:accounts[i].id,label:accounts[i].type};
                    lbHash[accounts[i].id] = accounts[i].type;
                    lbarr.push(tmpu);
                }
                $scope.listnames = lbarr; //转换成uigrid可识别的模式

                $scope.gridOptions.columnDefs[2].filter.selectOptions=lbarr;
                $scope.gridOptions.columnDefs[2].editDropdownOptionsArray=lbarr;
                $scope.gridOptions.columnDefs[2].lbHash =  lbHash;
            });

            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                //console.log(accounts);
                var untarr = [];
                var tmpu = {};
                var unitHash=[];
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    tmpu ={value:accounts[i].id,label:accounts[i].name};
                    unitHash[accounts[i].id]=accounts[i].name;
                    untarr.push(tmpu);
                }
                $scope.uigrunitgrps = untarr; //转换成uigrid可识别的模式
                $scope.untigrps = accounts;
                $scope.gridOptions.columnDefs[3].filter.selectOptions=untarr;
                $scope.gridOptions.columnDefs[3].editDropdownOptionsArray=untarr;
                $scope.gridOptions.columnDefs[3].unitHash =  unitHash ;
            });
            //
            var tableDatas = Restangular.all('/am-budget-management');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: 'addambudgetmanagement',
                    className: 'ngdialog-theme-default ambudgetmanagement',
                    scope: $scope,
                    controller: ['$scope', 'validationConfig', function ($scope, validationConfig) {
                        $scope.$validationOptions = validationConfig;

                        //初始化
                        $scope.addBudget = { syear : currentYear,type:1,unit:3};  //初始化为当前年度
                        // //预算类别
                        // $scope.addBudget.type = "lb01"; //初始值为物资预算
                        // ////////////机构
                        // $scope.addBudget.unit = 3;  //有值的情况下定义选择项


                    }],
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    closeByEscape: true
                }).then(function (addBudget) {
                    if(!addBudget.syear||!addBudget.type||!addBudget.unit||!addBudget.total){
                        showMsg('必要的信息未填写！', '错误', 'ruby');
                    }else{
                        //console.log(addBudget)
                        tableDatas.post(addBudget).then(
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
                    }
                }, function (addBudget) {
                });
            };

            $scope.delData = function () {
                var selectDatas = $scope.gridApi.selection.getSelectedGridRows();
                selectDatas.forEach(function (deldata) {
                        deldata.entity.remove().then(function (res) {
                            if (res.success) {
                                $scope.gridOptions.data = _.without($scope.gridOptions.data, deldata.entity);
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
                toEditRows.forEach(function (editdata) {
                    var userWithId = _.find($scope.gridOptions.data, function (user) {
                        return user.id === editdata.entity.id;
                    });
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
                    {name: '年度', field: 'syear',width: '100',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>',
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: $scope.uigrtyear,cellFilter: 'yearGender',
                        filter: {
                            term: currentYear,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.uigrtyear}
                    },
                    {name: '预算类别', field: 'type',width: '120',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.lbHash',lbHash:[],
                        filter: {
                            term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: []}
                    },
                    {name: '部门', field: 'unit',width: '230',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.unitHash',unitHash:[],
                        filter: {
                            term:3,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '金额', field: 'total',width: '100',cellFilter: 'currency',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '备注', field: 'remark',width: '100',enableCellEdit: true,enableColumnMenu: true,enableHiding: true,
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
    .filter('yearGender', function() {
        return function(input) {
            if (!input){
                return '';
            } else {
                return input;
            }
        };
    })

    .filter('dFilterHash',function(){
        return function(v,h){
            if (h=== undefined) return '';
            if (h[v]===undefined) return '';
            return h[v];
        }
    })
;
