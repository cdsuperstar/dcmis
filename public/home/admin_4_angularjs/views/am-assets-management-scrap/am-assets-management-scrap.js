'use strict';

angular.module("MetronicApp").controller('amassetmangementscrapCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

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
                $scope.gridOptions.columnDefs[6].filter.selectOptions=untarr;
                $scope.gridOptions.columnDefs[6].editDropdownOptionsArray=untarr;
                $scope.gridOptions.columnDefs[6].unitHash =  unitHash ;
            });

            //人员列表
            Restangular.all('/sys-users').getList().then(function (accounts) {
                var userarr = [];
                var tmpu = {};
                var userHash=[];
                for(var i=0;i<accounts.length;i++){
                    tmpu ={value:accounts[i].id,label:accounts[i].name};
                    userHash[accounts[i].id]=accounts[i].name;
                    userarr.push(tmpu);
                }
                $scope.gridOptions.columnDefs[5].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[5].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[5].userHash =  userHash ;
                $scope.gridOptions.columnDefs[10].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[10].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[10].userHash =  userHash ;
            });

            var tableDatas = Restangular.all('/am-assets-management-scrap/getAssToScrap');

            $scope.editData = function () { //修改报废的原因
                var toEditRows = $scope.gridApi.rowEdit.getDirtyRows($scope.gridOptions);
                toEditRows.forEach(function (edituser) {
                    var userWithId = _.find($scope.gridOptions.data, function (user) {
                        return user.id === edituser.entity.id;
                    });
                    userWithId.route = "/amassregs";
                    userWithId.put().then(function (res) {
                        if (res.success) {
                            showMsg(res.messages.toString(), '信息', 'lime');
                            $scope.gridApi.rowEdit.setRowsClean(Array(userWithId));
                        } else {
                            showMsg(res.errors.toString(), '错误', 'ruby');
                        }
                    });
                });
            };
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
                columnDefs: [
                    {name: '物资编号', field: 'amasbudget.wzno',width: '120',enableCellEdit: false,enableColumnMenu: true},
                    {name: '物资名称', field: 'amasbudget.ambaseas.name',width: '150',enableCellEdit: false,enableColumnMenu: true,pinnedLeft:true,
                        cellTooltip: function(row){ return row.entity.amasbudget.ambaseas.name; },
                        //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                    {name: '单位', field: 'amasbudget.ambaseas.measunit',width: '50',enableCellEdit: false,enableColumnMenu: true,editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownRowEntityOptionsArrayPath: 'tmeas.options', editDropdownIdLabel: 'value'
                    },
                    {name: '规格、型号', field: 'amasbudget.wzsmodel',width: '150',enableColumnMenu: true,enableCellEdit: false,
                        cellTooltip: function(row){ return row.entity.aspara; },
                        //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                    },
                    {name: '领用数量', field: 'amt',width: '80',enableCellEdit: false,enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '领用人', field: 'asuser',width: '80',enableCellEdit: false,enableColumnMenu: true,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.userHash',userHash:[],
                        filter: {
                            term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '领用单位', field: 'unitgrps_id',width: '200',enableCellEdit: false,enableColumnMenu: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.unitHash',unitHash:[],
                        filter: {
                            term:3,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '领用时间', field: 'userdate',width: '120',enableCellEdit: false,enableColumnMenu: true},
                    {name: '有效期', field: 'validdate',width: '120',enableCellEdit: false,enableColumnMenu: true},
                    {name: '领用备注', field: 'remark',width: '150',enableColumnMenu: true,enableCellEdit: true,
                        cellTooltip: function(row){ return row.entity.remark; },
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                    },
                    {name: '报废人', field: 'scrapuser',width: '80',enableCellEdit: true,enableColumnMenu: true,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.userHash',userHash:[],
                        filter: {
                            term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },

                    {name: '报废时间', field: 'scrapdate',width: '120',type:'date',enableColumnMenu: true},
                    {name: '物资状态', field: 'state',width: '80',editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                        editDropdownValueLabel: 'isstate', editDropdownOptionsArray: [
                        { id: '正常', isstate: '正常' },
                        { id: '报废', isstate: '报废' }],
                        filter: {
                            term: '',
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [
                                { value: '正常', label: '正常' },
                                { value: '报废', label: '报废' }
                            ]}
                    },
                    {name: '报废备注', field: 'scrapremark',width: '150',enableColumnMenu: true,enableCellEdit: true,
                        cellTooltip: function(row){ return row.entity.scrapremark; },
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                    },

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
                // console.log(accounts);
                $scope.gridOptions.data = allAccounts;
            });

        }
    ]
)
    .filter('dFilterHash',function(){
        return function(v,h){
            if (h=== undefined) return '';
            if (h[v]===undefined) return '';
            return h[v];
        }
    })
;
