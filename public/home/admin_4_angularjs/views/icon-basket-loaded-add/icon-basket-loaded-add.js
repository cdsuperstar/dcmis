'use strict';

angular.module("MetronicApp").controller('iconbasketloadedCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
            var currentYear = new Date().getFullYear();
            var yeararr = new Array();
            for(var val = (currentYear-3); val <= (currentYear+3); val++){
                yeararr.push(val);}
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

            $scope.showdetail = function(){
                 //console.log($scope.basket.type);
                ngDialog.openConfirm({
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    template: 'iconbasketload',
                    className: 'ngdialog-theme-default iconbasketload',
                    scope: $scope,
                    controller: ['$scope',function ($scope) {
                        var sourceDatas = Restangular.all('data.json'); //临时数据

                        switch($scope.basket.type)
                        {
                            case 1:
                            {
                                //start
                                $scope.soucegridOptions={
                                    enableSorting: true,
                                    enableFiltering: false,
                                    showColumnFooter:true,
                                    showGridFooter:true,
                                    enableVerticalScrollbar:1,
                                    enableHorizontalScrollbar :1,
                                    enableGridMenu: true,
                                    //--------------导入开始----------------------------------
                                    imdata : 'data',
                                    importerDataAddCallback: function ( grid, newObjects ) {
                                        $scope.imdata = $scope.imdata.concat( newObjects );
                                    },
                                    //--------------导入结束----------------------------------
                                    //--------------导出----------------------------------
                                    exporterHeaderFilterUseName : true,
                                    exporterMenuCsv : true, //导出Excel 开关
                                    exporterMenuPdf : false, //导出pdf 开关
                                    exporterMenuLabel : "Export",
                                    exporterOlderExcelCompatibility : true,
                                    exporterCsvColumnSeparator: ',',
                                    exporterCsvFilename:'download.csv',
                                    //rowTemplate : '<div style="background-color: aquamarine" ng-click="grid.appScope.fnOne(row)" ng-repeat="col in colContainer.renderedColumns track by col.colDef.name" class="ui-grid-cell" ui-grid-cell></div>',
                                    columnDefs: [
                                        {name: '物资名称', field: 'asname',width: '200',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.asname; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                            footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                        {name: '金额', field: 'price',width: '80',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                        {name: '数量', field: 'amt',width: '60',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                        {name: '单位', field: 'meas',width: '60',enableColumnMenu: true,editableCellTemplate: 'ui-grid/dropdownEditor',
                                            editDropdownRowEntityOptionsArrayPath: 'tmeas.options', editDropdownIdLabel: 'value'
                                        },
                                        {name: '物资参数', field: 'aspara',width: '200',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.aspara; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                        }
                                    ],
                                    data: [],
                                    onRegisterApi: function (gridApi) {
                                        $scope.gridApi = gridApi;
                                    }
                                };
                                var sourceDatas = Restangular.all('data.json');

                                $scope.addData = function() {
                                    var n = $scope.soucegridOptions.data.length + 1;
                                    $scope.soucegridOptions.data.push({
                                        "asname": "新建物资 " + n,
                                        "price": "0",
                                        "amt": "1",
                                        "meas": "个",
                                        "aspara": "参数"
                                    });
                                };
                                $scope.delData = function () {

                                };
                                $scope.editData = function () {

                                };
                                $scope.saveRow = function (rowEntity) {
                                    //$scope.editdataids.push(rowEntity.id);
                                    // var promise = $q.defer();
                                    // $scope.gridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
                                    //promise.resolve();
                                    // promise.reject();
                                };
                                $scope.toggleFiltering = function(){
                                    $scope.soucegridOptions.enableFiltering = !$scope.soucegridOptions.enableFiltering;
                                    $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
                                };
                                //end

                            }
                                break;
                            case 2:
                            {
                                //start
                                $scope.soucegridOptions={
                                    enableSorting: true,
                                    enableFiltering: false,
                                    showColumnFooter:true,
                                    showGridFooter:true,
                                    enableVerticalScrollbar:1,
                                    enableHorizontalScrollbar :1,
                                    enableGridMenu: true,
                                    //--------------导入开始----------------------------------
                                    imdata : 'data',
                                    importerDataAddCallback: function ( grid, newObjects ) {
                                        $scope.imdata = $scope.imdata.concat( newObjects );
                                    },
                                    //--------------导入结束----------------------------------
                                    //--------------导出----------------------------------
                                    exporterHeaderFilterUseName : true,
                                    exporterMenuCsv : true, //导出Excel 开关
                                    exporterMenuPdf : false, //导出pdf 开关
                                    exporterMenuLabel : "Export",
                                    exporterOlderExcelCompatibility : true,
                                    exporterCsvColumnSeparator: ',',
                                    exporterCsvFilename:'download.csv',
                                    //rowTemplate : '<div style="background-color: aquamarine" ng-click="grid.appScope.fnOne(row)" ng-repeat="col in colContainer.renderedColumns track by col.colDef.name" class="ui-grid-cell" ui-grid-cell></div>',
                                    columnDefs: [
                                        {name: '采购内容', field: 'contrname',width: '150',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.contrname; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                            footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                        {name: '工程概算', field: 'contrprice',width: '80',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                        {name: '工期要求', field: 'contrworkreq',width: '200',enableColumnMenu: true,
                                            cellTooltip: function(row){ return row.entity.contrworkreq; },
                                            //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                            cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                        },
                                        {name: '地点', field: 'contraddr',width: '120',enableColumnMenu: true},
                                        {name: '负责人', field: 'contrpicharge',width: '120',enableColumnMenu: true},
                                        {name: '负责人电话', field: 'contrpicphone',width: '120',enableColumnMenu: true}
                                    ],
                                    data: [],
                                    onRegisterApi: function (gridApi) {
                                        $scope.gridApi = gridApi;
                                    }
                                };
                                var sourceDatas = Restangular.all('data.json');

                                $scope.addData = function() {
                                    var n = $scope.soucegridOptions.data.length + 1;
                                    $scope.soucegridOptions.data.push({
                                        "contrname": "新建工程 " + n,
                                        "contrprice": "0",
                                        "contrworkreq": "工期要求",
                                        "contraddr": "地点",
                                        "contrpicharge": "负责人",
                                        "contrpicphone": "负责电话"
                                    });
                                };
                                $scope.delData = function () {

                                };
                                $scope.editData = function () {

                                };
                                $scope.saveRow = function (rowEntity) {
                                    //$scope.editdataids.push(rowEntity.id);
                                    var promise = $q.defer();
                                    $scope.gridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
                                    //promise.resolve();
                                    promise.reject();
                                };
                                $scope.toggleFiltering = function(){
                                    $scope.soucegridOptions.enableFiltering = !$scope.soucegridOptions.enableFiltering;
                                    $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
                                };
                                //end

                            }
                                break;
                            case 3:
                            {

                                //start
                                $scope.soucegridOptions={
                                    enableSorting: true,
                                    enableFiltering: false,
                                    showColumnFooter:true,
                                    showGridFooter:true,
                                    enableVerticalScrollbar:1,
                                    enableHorizontalScrollbar :1,
                                    enableGridMenu: true,
                                    //--------------导入开始----------------------------------
                                    imdata : 'data',
                                    importerDataAddCallback: function ( grid, newObjects ) {
                                        $scope.imdata = $scope.imdata.concat( newObjects );
                                    },
                                    //--------------导入结束----------------------------------
                                    //--------------导出----------------------------------
                                    exporterHeaderFilterUseName : true,
                                    exporterMenuCsv : true, //导出Excel 开关
                                    exporterMenuPdf : false, //导出pdf 开关
                                    exporterMenuLabel : "Export",
                                    exporterOlderExcelCompatibility : true,
                                    exporterCsvColumnSeparator: ',',
                                    exporterCsvFilename:'download.csv',
                                    //rowTemplate : '<div style="background-color: aquamarine" ng-click="grid.appScope.fnOne(row)" ng-repeat="col in colContainer.renderedColumns track by col.colDef.name" class="ui-grid-cell" ui-grid-cell></div>',
                                    columnDefs: [
                                        {name: '合同地点', field: 'svaddr',width: '150',enableColumnMenu: true},
                                        {name: '负责人', field: 'svpicharge',width: '120',enableColumnMenu: true},
                                        {name: '负责人电话', field: 'svpicphone',width: '120',enableColumnMenu: true}
                                    ],
                                    data: [],
                                    onRegisterApi: function (gridApi) {
                                        $scope.gridApi = gridApi;
                                    }
                                };
                                var sourceDatas = Restangular.all('data.json');

                                $scope.addData = function() {
                                    var n = $scope.soucegridOptions.data.length + 1;
                                    $scope.soucegridOptions.data.push({
                                        "svaddr": "新建服务 " + n,
                                        "svpicharge": "负责人",
                                        "svpicphone": "负责电话"
                                    });
                                };
                                $scope.delData = function () {

                                };
                                $scope.editData = function () {

                                };
                                $scope.saveRow = function (rowEntity) {
                                    //$scope.editdataids.push(rowEntity.id);
                                    var promise = $q.defer();
                                    $scope.gridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
                                    //promise.resolve();
                                    promise.reject();
                                };
                                $scope.toggleFiltering = function(){
                                    $scope.soucegridOptions.enableFiltering = !$scope.soucegridOptions.enableFiltering;
                                    $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
                                };
                                //end

                            }
                                break;
                            case 4:
                            {

                                //start
                                $scope.soucegridOptions={
                                    enableSorting: true,
                                    enableFiltering: false,
                                    showColumnFooter:true,
                                    showGridFooter:true,
                                    enableVerticalScrollbar:1,
                                    enableHorizontalScrollbar :1,
                                    enableGridMenu: true,
                                    //--------------导入开始----------------------------------
                                    imdata : 'data',
                                    importerDataAddCallback: function ( grid, newObjects ) {
                                        $scope.imdata = $scope.imdata.concat( newObjects );
                                    },
                                    //--------------导入结束----------------------------------
                                    //--------------导出----------------------------------
                                    exporterHeaderFilterUseName : true,
                                    exporterMenuCsv : true, //导出Excel 开关
                                    exporterMenuPdf : false, //导出pdf 开关
                                    exporterMenuLabel : "Export",
                                    exporterOlderExcelCompatibility : true,
                                    exporterCsvColumnSeparator: ',',
                                    exporterCsvFilename:'download.csv',
                                    //rowTemplate : '<div style="background-color: aquamarine" ng-click="grid.appScope.fnOne(row)" ng-repeat="col in colContainer.renderedColumns track by col.colDef.name" class="ui-grid-cell" ui-grid-cell></div>',
                                    columnDefs: [
                                        {name: '合同地点', field: 'otaddr',width: '150',enableColumnMenu: true},
                                        {name: '负责人', field: 'otpicharge',width: '120',enableColumnMenu: true},
                                        {name: '负责人电话', field: 'otpicphone',width: '120',enableColumnMenu: true}
                                    ],
                                    data: [],
                                    onRegisterApi: function (gridApi) {
                                        $scope.gridApi = gridApi;
                                    }
                                };
                                var sourceDatas = Restangular.all('data.json');

                                $scope.addData = function() {
                                    var n = $scope.soucegridOptions.data.length + 1;
                                    $scope.soucegridOptions.data.push({
                                        "otaddr": "新建其他 " + n,
                                        "otpicharge": "负责人",
                                        "otpicphone": "负责电话"
                                    });
                                };
                                $scope.delData = function () {

                                };
                                $scope.editData = function () {

                                };
                                $scope.saveRow = function (rowEntity) {
                                    //$scope.editdataids.push(rowEntity.id);
                                    var promise = $q.defer();
                                    $scope.gridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
                                    //promise.resolve();
                                    promise.reject();
                                };
                                $scope.toggleFiltering = function(){
                                    $scope.soucegridOptions.enableFiltering = !$scope.soucegridOptions.enableFiltering;
                                    $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
                                };
                                //end
                            }
                                break;
                            default:
                                console.log($scope.basket.type);
                                break;
                        }

                        sourceDatas.getList().then(function (accounts) {
                            var allAccounts = accounts;
                            for(var i = 0; i < accounts.length; i++){
                                accounts[i].tmeas = {options: [
                                    {value:'个'},
                                    {value:'套'},
                                    {value:'件'},
                                    {value:'组'},
                                    {value:'卷'},
                                    {value:'台'},
                                    {value:'只'},
                                    {value:'支'},
                                    {value:'张'},
                                    {value:'打'},
                                    {value:'卷'},
                                    {value:'袋'},
                                    {value:'包'},
                                    {value:'箱'},
                                    {value:'桶'},
                                    {value:'萝'},
                                    {value:'令'},
                                    {value:'双'},
                                    {value:'项'}
                                    ]}
                            }
                            $scope.soucegridOptions.data = allAccounts;
                        });
                    }],

                }).then(function (dcEdition) {
                    var tmpdcdata=angular.toJson(dcEdition);


                }, function (dcEdition) {

                });

            }
///

        }
    ]
)
;
