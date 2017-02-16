'use strict';

angular.module("MetronicApp").controller('iconbasketloadedCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter:true,
                enableVerticalScrollbar:1,
                enableHorizontalScrollbar :1,

                expandableRowTemplate: '<div ui-grid="row.entity.subGridOptions" ui-grid-pagination ui-grid-pinning ui-grid-resize-columns ui-grid-auto-resize ui-grid-move-columns style="height:350px;" class="iconbasketloadedgridrows"></div>',
                expandableRowHeight: 350,
                //subGridVariable will be available in subGrid scope
                expandableRowScope: {
                    subGridVariable: 'subGridScopeVariable'
                },

                columnDefs: [
                    {name: 'id', field: 'id',width: '40',enableColumnMenu: false,
                        enableHiding: false,
                        enableFiltering: false,
                        footerCellTemplate: '<div class="" style="color: #000000;">合计</div>' },
                    {name: '编号', field: 'name',width: '100',enableColumnMenu: true},
                    {name: '项目名称', field: 'name',width: '200',enableColumnMenu: true},
                    {name: '总金额', field: 'age',width: '80',type:'float',enableColumnMenu: true,enableHiding: false,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '项目摘要', field: 'email',width: '200',enableColumnMenu: true,visible:true},
                    {name: '申报类别', field: 'company',width: '150',visible:true},
                    {name: '审批状态', field: 'gender',width: '100',visible:true},
                    {name: '申报人', field: 'name',width: '100',visible:true},
                    {name: '申报部门', field: 'email',width: '150',visible:true},
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


            Restangular.all('500_complex.json').getList()
                .then(function(data) {
                    var i=0;
                    for(i = 0; i < data.length; i++){
                        data[i].subGridOptions = {
                            enableSorting: true,
                            enableFiltering: false,
                            showColumnFooter:true,
                            enableVerticalScrollbar:1,
                            enableHorizontalScrollbar :1,
                            columnDefs: [
                                {name:"Id", field:"id",width: '200'},
                                {name:"Name", field:"name",width: '200'}
                            ],
                            enablePagination: true, //是否分页，默认为true
                            enablePaginationControls: true, //使用默认的底部分页
                            paginationPageSizes: [10, 30, 50],
                            paginationCurrentPage: 1,
                            paginationPageSize: 10,
                            data: data[i].friends
                        }
                    }
                    $scope.gridOptions.data = data;
                });

            $scope.expandAllRows = function() {
                $scope.gridApi.expandable.expandAllRows();
            }

            $scope.collapseAllRows = function() {
                $scope.gridApi.expandable.collapseAllRows();
            }

            $scope.toggleFiltering = function(){
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
                $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
            };


        }
    ]
)
;
