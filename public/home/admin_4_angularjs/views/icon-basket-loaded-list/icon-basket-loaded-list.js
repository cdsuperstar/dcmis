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

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: '/sysannouncement/create',
                    className: 'ngdialog-theme-default sysannouncement',
                    scope: $scope,
                    controller: ['$scope', function ($scope) {
                        //$scope.$validationOptions = validationConfig;
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
                    console.log('Modal promise rejected. Reason: ', dcEdition);
                });
            };

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

            $scope.imdata = [];
            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter:true,
                showGridFooter:true,
                enableCellEditOnFocus:true,
                columnDefs: [
                    {name: '编号', field: 'no',width: '100',enableColumnMenu: true,
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'
                    },
                    {name: '年度', field: 'syear',width: '80',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: $scope.uigrtyear,
                        filter: {
                            term: currentYear,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.uigrtyear}
                    },
                    {name: '预算类别', field: 'type',width: '120',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: $scope.listnames,cellFilter: 'yslbGender',
                        filter: {
                            term: 1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.listnames}
                    },
                    {name: '项目名称', field: 'budgetname',width: '200',enableColumnMenu: true},
                    {name: '总金额', field: 'total',width: '80',type:'float',enableColumnMenu: true,enableHiding: false,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '申报人', field: 'requester',width: '100',visible:true},
                    {name: '部门', field: 'unit',width: '200',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        filter: {
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.uigrunitgrps}
                    },
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
