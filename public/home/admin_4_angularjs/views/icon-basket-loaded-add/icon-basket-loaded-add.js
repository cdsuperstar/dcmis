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
                // console.log(accounts);
                $scope.untigrps = accounts;
            });
            //物资列表
            Restangular.all('wz.json').getList().then(function (accounts) {
                $scope.datawzgrps = accounts;
            });
            //人员列表
            Restangular.all('/sys-users').getList().then(function (accounts) {
                $scope.peoplegrps = accounts;
            });
            $scope.basket = { syear:currentYear,type:1};  //初始化为当前年度

            $scope.SPFilter = function (tArray,actual) {
                    return listnames.name;
            };

            //转换函数  遍历数组
            // var changeArrData = function (mArray,mkey,mvalue,mlabel) {
            //     for (var x in mArray){
            //         if(mArray[x][mkey] == mvalue) var t = mArray[x][mlabel];
            //     }
            //     return t;
            // };
            //转换函数  遍历json
            var changeJsonData = function (mJson,mkey,mvalue,mlabel) {
                if(mvalue){
                    for (var item=0;item<mJson.length;item++){
                        if(mJson[item][mkey] == mvalue) var t = mJson[item][mlabel];
                    }
                    return t;
                }
            };

            $scope.checkform = function() {
                console.log($scope.basket);
                if(!$scope.basket.summary){
                    showMsg('必要信息未填写！', '错误', 'ruby');
                    return false;
                }
            }

            $scope.savedata = function() {
                console.log($scope.basket);
                if(!$scope.basket.summary){
                    showMsg('必要信息未填写！', '错误', 'ruby');
                    return false;
                }
            }

            $scope.stepthrid = function () {
                //转换开始
                $scope.listtyname = changeJsonData($scope.listnames,'value',$scope.basket.type,'label');
                $scope.listusname = changeJsonData($scope.peoplegrps,'id',$scope.basket.requester,'name');
                $scope.listunname = changeJsonData($scope.untigrps,'id',$scope.basket.unit,'name');
                // console.log($scope.basket.unit+'--->'+$scope.listunname);
                //转换结束

                //导航开始
                $scope.isMaterialbudget = false;
                $scope.isProjectbudget = true;
                $scope.isServicebudget = true;
                $scope.isOthersbudget = true;
                switch($scope.basket.type)
                {
                    case 1:{
                        $scope.isMaterialbudget = false;
                        $scope.isProjectbudget = true;
                        $scope.isServicebudget = true;
                        $scope.isOthersbudget = true;
                    }
                    break;
                    case 2:{
                        $scope.isMaterialbudget = true;
                        $scope.isProjectbudget = false;
                        $scope.isServicebudget = true;
                        $scope.isOthersbudget = true;
                    }
                        break;
                    case 3:{
                        $scope.isMaterialbudget = true;
                        $scope.isProjectbudget = true;
                        $scope.isServicebudget = false;
                        $scope.isOthersbudget = true;
                    }
                        break;
                    default:
                    {
                        $scope.isMaterialbudget = true;
                        $scope.isProjectbudget = true;
                        $scope.isServicebudget = true;
                        $scope.isOthersbudget = false;
                    }
                        break;
                }
                //导航结束



            }
            $scope.changestep = function() {
                // console.log($scope.basket.type);
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
                                {name: '物资名称', field: 'asname',width: '200',enableCellEdit: false,enableColumnMenu: true,
                                    footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                {name: '规格、型号', field: 'aspara',width: '200',enableColumnMenu: true,
                                    cellTooltip: function(row){ return row.entity.aspara; },
                                    //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                },
                                {name: '数量', field: 'amt',width: '60',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                {name: '单位', field: 'meas',width: '60',enableColumnMenu: true,enableCellEdit: false,editableCellTemplate: 'ui-grid/dropdownEditor',
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
                        var sourceDatas = Restangular.all('data.json');

                        $scope.addData = function () {
                            ngDialog.openConfirm({
                                template: 'add-material',
                                className: 'ngdialog-theme-default iconaddmaterial',
                                scope: $scope,
                                controller: ['$scope', function ($scope) {
                                    //$scope.$validationOptions = validationConfig;
                                    // console.log($scope.aswzfl);
                                    //二级联动start 物品分类
                                    //distinct json mclass字段  开始
                                    var lookup = {};
                                    var items = $scope.datawzgrps;
                                    var result = [];
                                    for (var item, i = 0; item = items[i++];) {
                                        var name = item.mclass;

                                        if (!(name in lookup)) {
                                            lookup[name] = 1;
                                            result.push(name);
                                        }
                                    }
                                    //结束
                                    $scope.wzfl =result; //将物资分类的数组赋过去
                                    $scope.dcaddMaterial={aswzfl:$scope.wzfl[0]}; //初始化第一个分类为默认值
                                    $scope.wzgrps = $filter("filter")($scope.datawzgrps,{mclass:$scope.dcaddMaterial.aswzfl}); //初始化第一个分类的值为默认值

                                    $scope.chanagewzdata = function() {
                                        $scope.dcaddMaterial.asname = undefined; //如果分类改变，该值置为空
                                        $scope.wzgrps = $filter("filter")($scope.datawzgrps,{mclass:$scope.dcaddMaterial.aswzfl});
                                    }
                                    //end

                                }],
                                showClose: false,
                                setBodyPadding: 1,
                                overlay: true,        //是否用div覆盖当前页面
                                closeByDocument:false,  //是否点覆盖div 关闭会话
                                disableAnimation:true,  //是否显示动画
                                closeByEscape: true
                            }).then(function (dcaddMaterial) {
                                console.log(dcaddMaterial);
                                // tableDatas.post(dcaddMaterial).then(
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
                            }, function (dcaddMaterial) {
                                console.log('Modal promise rejected. Reason: ', dcaddMaterial);
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
                                {name: '工程地点', field: 'contraddr',width: '120',enableColumnMenu: true},
                                {name: '负责人', field: 'contrpicharge',width: '120',enableColumnMenu: true},
                                {name: '负责人电话', field: 'contrpicphone',width: '120',enableColumnMenu: true}
                            ],
                            data: [],
                            onRegisterApi: function (gridApi) {
                                $scope.gridApi = gridApi;
                            }
                        };
                        var sourceDatas = Restangular.all('data.json');

                        $scope.addData = function () {
                            ngDialog.openConfirm({
                                template: 'add-contr',
                                className: 'ngdialog-theme-default iconaddmaterial',
                                scope: $scope,
                                controller: ['$scope', function ($scope) {
                                    //$scope.$validationOptions = validationConfig;
                                    // console.log($scope.aswzfl);

                                }],
                                showClose: false,
                                setBodyPadding: 1,
                                overlay: true,        //是否用div覆盖当前页面
                                closeByDocument:false,  //是否点覆盖div 关闭会话
                                disableAnimation:true,  //是否显示动画
                                closeByEscape: true
                            }).then(function (dcaddContr) {
                                console.log(dcaddContr);
                                // tableDatas.post(dcaddContr).then(
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
                            }, function (dcaddContr) {
                                console.log('Modal promise rejected. Reason: ', dcaddContr);
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
                        sourceDatas.getList().then(function (accounts) {
                            var allAccounts = accounts;
                            $scope.soucegridOptions.data = allAccounts;
                        });

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
                                {name: '服务内容', field: 'svrname',width: '150',enableColumnMenu: true,
                                    cellTooltip: function(row){ return row.entity.contrname; },
                                    //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                    cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                    footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                {name: '预算金额', field: 'svrprice',width: '80',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                {name: '服务期限', field: 'svrworkreq',width: '200',enableColumnMenu: true,
                                    cellTooltip: function(row){ return row.entity.contrworkreq; },
                                    //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                },
                                {name: '地点', field: 'svaddr',width: '150',enableColumnMenu: true},
                                {name: '负责人', field: 'svpicharge',width: '120',enableColumnMenu: true},
                                {name: '负责人电话', field: 'svpicphone',width: '120',enableColumnMenu: true}
                            ],
                            data: [],
                            onRegisterApi: function (gridApi) {
                                $scope.gridApi = gridApi;
                            }
                        };
                        var sourceDatas = Restangular.all('data.json');

                        $scope.addData = function () {
                            ngDialog.openConfirm({
                                template: 'add-sv',
                                className: 'ngdialog-theme-default iconaddmaterial',
                                scope: $scope,
                                controller: ['$scope', function ($scope) {
                                    //$scope.$validationOptions = validationConfig;
                                    // console.log($scope.aswzfl);

                                }],
                                showClose: false,
                                setBodyPadding: 1,
                                overlay: true,        //是否用div覆盖当前页面
                                closeByDocument:false,  //是否点覆盖div 关闭会话
                                disableAnimation:true,  //是否显示动画
                                closeByEscape: true
                            }).then(function (dcaddSv) {
                                console.log(dcaddSv);
                                // tableDatas.post(dcaddSv).then(
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
                            }, function (dcaddSv) {
                                console.log('Modal promise rejected. Reason: ', dcaddSv);
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
                        sourceDatas.getList().then(function (accounts) {
                            var allAccounts = accounts;
                            $scope.soucegridOptions.data = allAccounts;
                        });

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
                                {name: '采购内容', field: 'otrname',width: '150',enableColumnMenu: true,
                                    cellTooltip: function(row){ return row.entity.contrname; },
                                    //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                    cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                    footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                {name: '预算金额', field: 'otrprice',width: '80',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                {name: '其他说明', field: 'otrworkreq',width: '200',enableColumnMenu: true,
                                    cellTooltip: function(row){ return row.entity.contrworkreq; },
                                    //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                },
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

                        $scope.addData = function () {
                            ngDialog.openConfirm({
                                template: 'add-ot',
                                className: 'ngdialog-theme-default iconaddmaterial',
                                scope: $scope,
                                controller: ['$scope', function ($scope) {
                                    //$scope.$validationOptions = validationConfig;
                                    // console.log($scope.aswzfl);

                                }],
                                showClose: false,
                                setBodyPadding: 1,
                                overlay: true,        //是否用div覆盖当前页面
                                closeByDocument:false,  //是否点覆盖div 关闭会话
                                disableAnimation:true,  //是否显示动画
                                closeByEscape: true
                            }).then(function (dcaddOt) {
                                console.log(dcaddOt);
                                // tableDatas.post(dcaddOt).then(
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
                            }, function (dcaddOt) {
                                console.log('Modal promise rejected. Reason: ', dcaddOt);
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
                        sourceDatas.getList().then(function (accounts) {
                            var allAccounts = accounts;
                            $scope.soucegridOptions.data = allAccounts;
                        });

                        //end
                    }
                        break;
                    default:
                        console.log($scope.basket.type);
                        break;
                }
            }
            //

        }
    ]
)
;
