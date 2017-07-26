'use strict';

angular.module("MetronicApp").controller('iconbasketloadlistCtrl',
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

                $scope.gridOptions.columnDefs[6].filter.selectOptions=lbarr;
                $scope.gridOptions.columnDefs[6].editDropdownOptionsArray=lbarr;
                $scope.gridOptions.columnDefs[6].lbHash =  lbHash;
            });

            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                //console.log(accounts);
                var tmpu = {};
                var unitHash=[];
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    tmpu ={value:accounts[i].id,label:accounts[i].name};
                    unitHash[accounts[i].id]=accounts[i].name;
                }
                $scope.gridOptions.columnDefs[8].unitHash =  unitHash ;
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
                $scope.uigrusergrps = userarr; //转换成uigrid可识别的模式
                $scope.peoplegrps = accounts;
                $scope.gridOptions.columnDefs[7].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[7].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[7].unitHash =  userHash ;
            });
            //转换函数  遍历json
            var changeJsonData = function (mJson,mkey,mvalue,mlabel) {
                if(mvalue){
                    for (var item=0;item<mJson.length;item++){
                        if(mJson[item][mkey] == mvalue) var t = mJson[item][mlabel];
                    }
                    return t;
                }
            };
            //
            var tableDatas = Restangular.all('/icon-basket-loaded-add');

            $scope.delData = function () {
                var selectdcmodels = $scope.gridApi.selection.getSelectedGridRows();
                selectdcmodels.forEach(function (deldata) {
                        //console.log(deldata);
                    deldata.entity.remove().then(function (res) {
                            if (res.success) {
                                $scope.gridOptions.data = _.without($scope.gridOptions.data, deldata.entity);
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
                showColumnFooter:false,
                showGridFooter:false,
                columnDefs: [
                    {name: '详情', field: 'id',width: '50',enableColumnMenu: false,enableColumnResizing:false,enableSorting:false,pinnedLeft:true,
                        enableHiding: false,
                        enableFiltering: false,
                        cellTemplate: '<div style="text-align: center;" class="ui-grid-cell-contents"> ' +
                        '<span class="icon-eye icon-hand" ng-click="grid.appScope.showdetail(row)"  title="查看详情"></span>&nbsp;' +
                        ' </div>'},
                    {name: '项目编号', field: 'no',width: '100'},
                    {name: '项目名称', field: 'name',width: '200'},
                    {name: '审批状态', field: 'appstate',width: '100',enableColumnMenu: true},
                    {name: '采购状态', field: 'progress',width: '100',enableColumnMenu: true},
                    {name: '年度', field: 'syear',width: '100',enableColumnMenu: false,enableHiding: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: $scope.uigrtyear,cellFilter: 'yearGender',
                        filter: {
                            term: currentYear,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.uigrtyear}
                    },
                    {name: '预算类别', field: 'ambudgettypes_id',width: '120',enableColumnMenu: false,enableHiding: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.lbHash',lbHash:[],
                        filter: {
                            term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: []}
                    },
                    {name: '申请人', field: 'requester',width: '100',enableColumnMenu: false,enableHiding: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.unitHash',userHash:[],
                        filter: {
                            term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '部门', field: 'unitgrps_id',width: '230',enableColumnMenu: false,enableHiding: false,enableFiltering: false,
                        cellFilter: 'dFilterHash:col.colDef.unitHash',unitHash:[]
                    }
                ],

                enableGridMenu: true,

                //--------------导出----------------------------------
                exporterHeaderFilterUseName : true,
                exporterMenuCsv : true, //导出Excel 开关
                exporterMenuPdf : false, //导出pdf 开关
                exporterMenuLabel : "Export",
                exporterOlderExcelCompatibility : true,
                exporterCsvColumnSeparator: ',',
                exporterCsvFilename:'datadownload.csv',

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
                        $scope.tmpobjdata = row.entity.id;  //取当前项目申请表的id
                        //取当前类别的模板类型
                        if(!row.entity.type) row.entity.type=1;
                        if($scope.listnames===undefined){
                        } else {
                            $scope.templatesign = changeJsonData($scope.listnames,'id',row.entity.type,'template');
                        }
                        //end
                        $scope.soucegridOptions={
                            enableSorting: true,
                            enableFiltering: false,
                            showColumnFooter:true,
                            showGridFooter:true,
                            enableVerticalScrollbar:1,
                            enableHorizontalScrollbar :1,
                            enableGridMenu: true,
                            //rowTemplate : '<div style="background-color: aquamarine" ng-click="grid.appScope.fnOne(row)" ng-repeat="col in colContainer.renderedColumns track by col.colDef.name" class="ui-grid-cell" ui-grid-cell></div>',
                            columnDefs: [],
                            data: [],
                            onRegisterApi: function (gridApi) {
                                $scope.gridApi = gridApi;
                            }
                        };
                        switch($scope.templatesign)
                        {
                            case "1":
                            {
                                $scope.soucegridOptions.columnDefs=[
                                    {name: '物资编号', field: 'wzno',width: '100',enableColumnMenu: true,pinnedLeft:true,visible:false},
                                    {name: '物资名称', field: 'wzname',width: '200',enableColumnMenu: true,pinnedLeft:true,
                                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                    {name: '单位', field: 'wzmeasunit',width: '60',enableColumnMenu: true,pinnedLeft:true},
                                    {name: '规格、型号', field: 'wzsmodel',width: '200',enableColumnMenu: true,
                                        cellTooltip: function(row){ return row.entity.aspara; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    },
                                    {name: '数量', field: 'amt',width: '60',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                    {name: '预算单价', field: 'bdg',width: '80',cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                    {name: '备注', field: 'remark',width: '150',enableColumnMenu: true}
                                ];

                                var sourceDatas = Restangular.all('data.json');

                            }
                                break;
                            case "2":
                            {
                                $scope.soucegridOptions.columnDefs=[
                                    {name: '工程项目名称', field: 'name',width: '150',enableColumnMenu: true,
                                        cellTooltip: function(row){ return row.entity.contrname; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                    {name: '工程预算', field: 'bdg',width: '80',cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                    {name: '工期要求', field: 'req',width: '200',enableColumnMenu: true,
                                        cellTooltip: function(row){ return row.entity.contrworkreq; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    },
                                    {name: '工程地点', field: 'addr',width: '120',enableColumnMenu: true},
                                    {name: '负责人', field: 'picharge',width: '120',enableColumnMenu: true},
                                    {name: '负责人电话', field: 'picphone',width: '120',enableColumnMenu: true}
                                ];

                                var sourceDatas = Restangular.all('data.json');

                            }
                                break;
                            case "3":
                            {
                                $scope.soucegridOptions.columnDefs=[
                                    {name: '服务内容', field: 'name',width: '150',enableColumnMenu: true,
                                        cellTooltip: function(row){ return row.entity.contrname; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                    {name: '预算金额', field: 'bdg',width: '80',cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                    {name: '服务期限', field: 'req',width: '200',enableColumnMenu: true,
                                        cellTooltip: function(row){ return row.entity.contrworkreq; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    },
                                    {name: '地点', field: 'addr',width: '150',enableColumnMenu: true},
                                    {name: '负责人', field: 'picharge',width: '120',enableColumnMenu: true},
                                    {name: '负责人电话', field: 'picphone',width: '120',enableColumnMenu: true}
                                ];

                                var sourceDatas = Restangular.all('data.json');

                            }
                                break;
                            case "4":
                            {

                                $scope.soucegridOptions.columnDefs=[
                                    {name: '采购内容', field: 'name',width: '150',enableColumnMenu: true,
                                        cellTooltip: function(row){ return row.entity.contrname; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                    {name: '预算金额', field: 'bdg',width: '80',cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                    {name: '其他说明', field: 'otremark',width: '200',enableColumnMenu: true,
                                        cellTooltip: function(row){ return row.entity.contrworkreq; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    },
                                    {name: '合同地点', field: 'addr',width: '150',enableColumnMenu: true},
                                    {name: '负责人', field: 'picharge',width: '120',enableColumnMenu: true},
                                    {name: '负责人电话', field: 'picphone',width: '120',enableColumnMenu: true}
                                ];

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
                    }]

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
