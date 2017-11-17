'use strict';

angular.module("MetronicApp").controller('amassetmangementaddCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

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
                $scope.listnames = accounts;
                $scope.gridOptions.columnDefs[4].filter.selectOptions=lbarr;
                $scope.gridOptions.columnDefs[4].editDropdownOptionsArray=lbarr;
                $scope.gridOptions.columnDefs[4].lbHash =  lbHash;
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
                $scope.untigrps = accounts;
                $scope.gridOptions.columnDefs[9].filter.selectOptions=untarr;
                $scope.gridOptions.columnDefs[9].editDropdownOptionsArray=untarr;
                $scope.gridOptions.columnDefs[9].unitHash =  unitHash ;
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
                $scope.gridOptions.columnDefs[6].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[6].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[6].userHash =  userHash ;
                $scope.gridOptions.columnDefs[8].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[8].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[8].userHash =  userHash ;
            });

            //供应商列表
            Restangular.all('/icon-basket-setsupplier').getList().then(function (accounts) {
                // console.log(accounts);
                var supplierarr = [];
                var tmpu = {};
                var supplierHash=[];
                for(var i=0;i<accounts.length;i++){
                    //accounts[i].name = JSON.stringify(accounts[i].name).replace(/\"/g, "'");
                    tmpu ={value:accounts[i].id,label:accounts[i].compname};
                    supplierHash[accounts[i].id]=accounts[i].compname;
                    supplierarr.push(tmpu);
                }
                $scope.suppliergrps = accounts;
                $scope.gridOptions.columnDefs[23].filter.selectOptions=supplierarr;
                $scope.gridOptions.columnDefs[23].editDropdownOptionsArray=supplierarr;
                $scope.gridOptions.columnDefs[23].supplierHash =  supplierHash ;
            });

            $scope.dcEdition = { unitgrp_id:$scope.dcUser.unitid,asuser:$scope.dcUser.id};  //初始化当前用户数据


            var tableDatas = Restangular.all('/am-assets-management-add/getAppAss');

            // $scope.editData = function () {
            //     var toEditRows = $scope.gridApi.rowEdit.getDirtyRows($scope.gridOptions);
            //     toEditRows.forEach(function (editdata) {
            //         var userWithId = _.find($scope.gridOptions.data, function (user) {
            //             return user.id === editdata.entity.id;
            //         });
            //         userWithId.route = "/amsubbudgets";//采购字表的route
            //         userWithId.put().then(function (res) {
            //             console.log(res);
            //             if (res.success) {
            //                 showMsg(res.messages.toString(), '信息', 'lime');
            //                 $scope.gridApi.rowEdit.setRowsClean(Array(userWithId));
            //             } else {
            //                 showMsg(res.errors.toString(), '错误', 'ruby');
            //             }
            //         });
            //     });
            //
            // };
            // $scope.saveRow = function (rowEntity) {
            //     //$scope.editdataids.push(rowEntity.id);
            //     var promise = $q.defer();
            //     $scope.gridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
            //     //promise.resolve();
            //     promise.reject();
            // };

            // $scope.changeStatus = function (field,applystatus) {//转换各种状态
            //     var selectdcmodels = $scope.gridApi.selection.getSelectedGridRows();
            //     selectdcmodels.forEach(function (deldata) {
            //             Restangular.all('/amsubbudgets/setStatus/'+deldata.entity.id+'/'+field+'/'+applystatus).post().then(function (res) {
            //                 if (res.success) {
            //                     deldata.entity[field] = applystatus;
            //                     showMsg(res.messages.toString(), '信息', 'lime');
            //                 }
            //                 else {
            //                     showMsg(res.errors.toString(), '错误', 'ruby');
            //                 }
            //                 //console.log(res);
            //             });
            //         }
            //     );
            // };

            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter: true,
                enableCellEditOnFocus:true,
                columnDefs: [
                    {name: '登记', field: 'id',width: '50',enableColumnMenu: false,enableColumnResizing:false,enableSorting:false,pinnedLeft:true,
                        enableCellEdit: false,enableFiltering: false,
                        cellTemplate: '<div style="text-align: center;" class="ui-grid-cell-contents"> ' +
                        '<span class=" icon-share-alt icon-hand" ng-click="grid.appScope.showdetail(row)"  title="登记领用"></span>&nbsp;' +
                        ' </div>'},
                    {name: '采购单年度', field: 'amapplication.syear',width: '100',enableColumnMenu: true,enableCellEdit: false,visible:false},
                    {name: '采购单编号', field: 'amapplication.no',width: '120',enableCellEdit: false,visible:false,enableColumnMenu: true},
                    {name: '采购单名称', field: 'amapplication.name',width: '150',enableCellEdit: false,visible:false,enableColumnMenu: true},
                    {name: '采购单类别', field: 'amapplication.ambudgettype_id',width: '120',visible:false,enableCellEdit: false,enableColumnMenu: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.lbHash',lbHash:[],
                        filter: {
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: []}
                    },

                    {name: '采购单审批状态', field: 'amapplication.appstate',width: '120',visible:false,enableCellEdit: false,enableColumnMenu: true},
                    {name: '采购单审批人', field: 'amapplication.apper',width: '110',visible:false,enableColumnMenu: false,enableCellEdit: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.userHash',userHash:[],
                        filter: {
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '采购单审批时间', field: 'amapplication.appdate',width: '150',visible:false,enableCellEdit: false,enableColumnMenu: true},
                    {name: '采购单申请人', field: 'amapplication.requester',width: '110',visible:false,enableColumnMenu: false,enableCellEdit: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.userHash',userHash:[],
                        filter: {
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '采购单申请部门', field: 'amapplication.unitgrp_id',width: '150',visible:false,enableCellEdit: false,enableColumnMenu: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.unitHash',unitHash:[],
                        filter: {
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '采购单申请日期', field: 'amapplication.created_at',width: '150',visible:false,enableCellEdit: false,enableColumnMenu: true},
                    {name: '物资编号', field: 'wzno',width: '100',enableCellEdit: false,enableColumnMenu: true,visible:false,pinnedLeft:true},
                    {name: '物资名称', field: 'ambaseas.name',width: '150',enableColumnMenu: true,enableCellEdit: false,pinnedLeft:true,
                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                    {name: '单位', field: 'ambaseas.measunit',width: '60',enableCellEdit: false,enableColumnMenu: true},
                    {name: '规格、型号', field: 'wzsmodel',width: '200',enableColumnMenu: true,
                        cellTooltip: function(row){ return row.entity.aspara; },
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                    },
                    {name: '采购数量', field: 'amt',width: '80',enableCellEdit: false,enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '库存数量', field: 'regamt',width: '80',enableCellEdit: false,enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '预算单价', field: 'bdg',width: '80',enableCellEdit: false,cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    {name: '采购单价', field: 'price',width: '80',enableCellEdit: true,cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                    // {name: '小计', field: 'wztotal',width: '100', enableCellEdit: false,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true,enableColumnMenu: true},
                    {name: '采购方式', field: 'purchway',width: '120',enableColumnMenu: true,
                        editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                        editDropdownValueLabel: 'ispurchway', editDropdownOptionsArray: [
                        { id: '取消采购', ispurchway: '取消采购' },
                        { id: '自行采购', ispurchway: '自行采购' },
                        { id: '询价采购', ispurchway: '询价采购' },
                        { id: '定点采购', ispurchway: '定点采购' },
                        { id: '公开招标', ispurchway: '公开招标' },
                        { id: '邀请招标', ispurchway: '邀请招标' },
                        { id: '竞争性谈判', ispurchway: '竞争性谈判' },
                        { id: '单一来源采购', ispurchway: '单一来源采购' },
                        { id: '协议供货采购', ispurchway: '协议供货采购' }],
                        filter: {
                            term: '',
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [
                                { value: '取消采购', label: '取消采购' },
                                { value: '自行采购', label: '自行采购' },
                                { value: '询价采购', label: '询价采购' },
                                { value: '定点采购', label: '定点采购' },
                                { value: '公开招标', label: '公开招标' },
                                { value: '邀请招标', label: '邀请招标' },
                                { value: '竞争性谈判', label: '竞争性谈判' },
                                { value: '单一来源采购', label: '单一来源采购' },
                                { value: '协议供货采购', label: '协议供货采购' }
                            ]}
                    },
                    {name: '采购状态', field: 'purchstate',width: '100',enableColumnMenu: true,
                        editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                        editDropdownValueLabel: 'ispurchstate', editDropdownOptionsArray: [
                        { id: '已采购', ispurchstate: '已采购' },
                        { id: '未采购', ispurchstate: '未采购' }],
                        filter: {
                            term: '',
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [
                                { value: '已采购', label: '已采购' },
                                { value: '未采购', label: '未采购' }]}
                    },
                    {name: '合同编号', field: 'contrno',width: '150',enableColumnMenu: true},
                    {name: '供应商编号', field: 'amsupplier_id',width: '200',enableCellEdit: true,enableColumnMenu: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.supplierHash',supplierHash:[],
                        filter: {
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    // {name: '报销状态', field: 'reimstate',width: '100',enableColumnMenu: true,
                    //     editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                    //     editDropdownValueLabel: 'isreimstate', editDropdownOptionsArray: [
                    //     { id: '已报销', isreimstate: '已报销' },
                    //     { id: '未报销', isreimstate: '未报销' }],
                    //     filter: {
                    //         type: uiGridConstants.filter.SELECT,
                    //         selectOptions: [
                    //             { value: '已报销', label: '已报销' },
                    //             { value: '未报销', label: '未报销' }]}
                    // },
                    {name: '物资状态', field: 'asstate',width: '120',enableColumnMenu: true,
                        editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                        editDropdownValueLabel: 'isasstate', editDropdownOptionsArray: [
                        { id: '固定资产', isasstate: '固定资产' },
                        { id: '非固定资产', isasstate: '非固定资产' }],
                        filter: {
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [
                                { value: '固定资产', label: '固定资产' },
                                { value: '非固定资产', label: '非固定资产' }]}
                    },
                    {name: '备注', field: 'remark',width: '150',enableColumnMenu: true,enableCellEdit: true,
                        cellTooltip: function(row){ return row.entity.aspara; },
                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                    }                ],

                enableGridMenu: true,
                //--------------导出----------------------------------
                exporterHeaderFilterUseName : true,
                exporterMenuCsv : false, //导出Excel 开关
                exporterMenuPdf : false, //导出pdf 开关
                exporterMenuLabel : "Export",
                exporterOlderExcelCompatibility : true,
                exporterCsvColumnSeparator: ',',
                exporterCsvFilename:'Allmatterdownload.csv',

                enablePagination: true, //是否分页，默认为true
                enablePaginationControls: true, //使用默认的底部分页
                paginationPageSizes: [10, 30, 50],
                paginationCurrentPage: 1,
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    // gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                }
            };

            $scope.showdetail = function(row) {
                // console.log(row.entity.appstate);
                var detaildata=angular.fromJson(row.entity.id);
                if(row.entity.purchstate != '已采购'){
                    showMsg('该物品尚未采购到位，不能登记领取信息！', '错误', 'ruby');
                    return false;
                }
                ngDialog.openConfirm({
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    template: 'asset-load-list',
                    className: 'ngdialog-theme-default amassetmangementmeatter',
                    scope: $scope,
                    controller: ['$scope',function ($scope) {
                        // console.log(row.entity);
                        $scope.tmpobjdata = row.entity.id;  //取当前物资的id
                        $scope.tmpobjno = row.entity.wzno;  //取当取当期物资的no
                        $scope.tmpobjname = row.entity.ambaseas.name;  //取当前物资的name

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
                            $scope.soucegridOptions.columnDefs[1].filter.selectOptions=untarr;
                            $scope.soucegridOptions.columnDefs[1].editDropdownOptionsArray=untarr;
                            $scope.soucegridOptions.columnDefs[1].unitHash =  unitHash ;
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
                            $scope.soucegridOptions.columnDefs[0].filter.selectOptions=userarr;
                            $scope.soucegridOptions.columnDefs[0].editDropdownOptionsArray=userarr;
                            $scope.soucegridOptions.columnDefs[0].userHash =  userHash ;
                        });

                        $scope.addbranchData = function () {
                            ngDialog.openConfirm({
                                template: 'assets-managementadd',
                                className: 'ngdialog-theme-default amassetmangementadd',
                                scope: $scope,
                                controller: ['$scope', 'validationConfig', function ($scope, validationConfig) {

                                }],
                                showClose: false,
                                setBodyPadding: 1,
                                overlay: true,        //是否用div覆盖当前页面
                                closeByDocument:false,  //是否点覆盖div 关闭会话
                                disableAnimation:true,  //是否显示动画
                                closeByEscape: true
                            }).then(function (dcEdition) {
                                if($scope.souceamttoal < dcEdition.amt){
                                    showMsg('领用数量不能大于库存数量！', '错误', 'ruby');
                                    return false;
                                }
                                var date = new Date();
                                dcEdition.userdate =  date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate()+" "+ date.getHours()+":"+date.getMinutes()+":"+date.getSeconds(); //获得日期字串
                                dcEdition.state = "正常";
                                dcEdition.amsubbudget_id = $scope.tmpobjdata;
                                if(dcEdition.validdate != undefined){
                                    var tmpdata = new Date(dcEdition.validdate);
                                    if(tmpdata) dcEdition.validdate = tmpdata.getFullYear()+"-"+(tmpdata.getMonth()+1)+"-"+tmpdata.getDate();
                                }
                                console.log(dcEdition);
                                var posttableDatas = Restangular.all('/amassregs');
                                posttableDatas.post(dcEdition).then(
                                    function (res) {
                                        if (res.success) {
                                            // console.log(res);
                                            $scope.soucegridOptions.data.push(res);
                                            row.entity.regamt = res.regamt;
                                            $scope.souceamttoal = res.regamt;
                                            showMsg(res.messages.toString(), '信息', 'lime');
                                        } else {
                                            // TODO add error message to system
                                            showMsg(res.errors.toString(), '错误', 'ruby');
                                        }
                                    }
                                );
                            }, function (dcEdition) {
                            });
                        };

                        $scope.soucegridOptions={
                            enableSorting: true,
                            enableFiltering: false,
                            showColumnFooter:true,
                            showGridFooter:false,
                            enableVerticalScrollbar:1,
                            enableHorizontalScrollbar :1,
                            enableGridMenu: true,
                            //rowTemplate : '<div style="background-color: aquamarine" ng-click="grid.appScope.fnOne(row)" ng-repeat="col in colContainer.renderedColumns track by col.colDef.name" class="ui-grid-cell" ui-grid-cell></div>',
                            columnDefs: [
                                {name: '领用人', field: 'asuser',width: '80',enableCellEdit: true,enableColumnMenu: true,pinnedLeft:true,
                                    editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                                    editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.userHash',userHash:[],
                                    footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>',
                                    filter: {
                                        term:1,
                                        type: uiGridConstants.filter.SELECT,
                                        selectOptions: [] }
                                },
                                // {name: '领用单位', field: 'unitgrp_id',width: '230',enableCellEdit: true,enableColumnMenu: false,
                                //     editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                                //     editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.unitHash',unitHash:[],
                                //     filter: {
                                //         term:3,
                                //         type: uiGridConstants.filter.SELECT,
                                //         selectOptions: [] }
                                // },
                                {name: '领用数量', field: 'amt',width: '80',enableCellEdit: true,enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                {name: '领用时间', field: 'userdate',width: '120',enableCellEdit: false,enableColumnMenu: true},
                                {name: '有效期', field: 'validdate',width: '120',type:'date',cellFilter: 'date:"yyyy-MM-dd"',enableCellEdit: true,enableColumnMenu: true},
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
                                {name: '备注', field: 'remark',width: '150',enableColumnMenu: true,enableCellEdit: true,
                                    cellTooltip: function(row){ return row.entity.aspara; },
                                    cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                }
                            ],
                            data: [],
                            onRegisterApi: function (soucegridApi) {
                                $scope.soucegridApi = soucegridApi;
                                soucegridApi.rowEdit.on.saveRow($scope, $scope.savebranchRow);
                            }
                        };
                        var sourceDatas = Restangular.all('/am-assets-management-add/getTheAssReg/'+row.entity.id);
                        sourceDatas.getList().then(function (accounts) {
                            var listdata = accounts[0].amassregs;
                            Restangular.restangularizeCollection(null, accounts[0].amassregs, '/amassregs');
                            var amttotal = 0;
                            for (var item=0;item<listdata.length;item++){
                                // listdata[item]["validdate"] = new Date(listdata[item]["validdate"]);
                                listdata[item].validdate = new Date(listdata[item].validdate);
                                if(listdata[item]["amt"]) { //计算物资数量合计
                                    amttotal += Number(listdata[item]["amt"]);
                                }
                            }
                            $scope.souceamttoal = Number(row.entity.amt) - amttotal; //获得当前物资领取总数

                             $scope.soucegridOptions.data = listdata;
                            //console.log(row.entity.amt,amttotal,$scope.souceamttoal);
                            // console.log(listdata);
                        });

                        // $scope.changeStatus = function (field,applystatus) {//转换各种状态
                        //     var selectdcmodels = $scope.soucegridApi.selection.getSelectedGridRows();
                        //     selectdcmodels.forEach(function (deldata) {
                        //             Restangular.all('/amsubbudgets/setStatus/'+deldata.entity.id+'/'+field+'/'+applystatus).post().then(function (res) {
                        //                 if (res.success) {
                        //                     deldata.entity[field] = applystatus;
                        //                     row.entity.progress=res.progress;
                        //                     showMsg(res.messages.toString(), '信息', 'lime');
                        //                 }
                        //                 else {
                        //                     showMsg(res.errors.toString(), '错误', 'ruby');
                        //                 }
                        //                 //console.log(res);
                        //             });
                        //         }
                        //     );
                        // };

                        $scope.editbranchData = function () {
                            var toEditRows = $scope.soucegridApi.rowEdit.getDirtyRows($scope.soucegridOptions);
                            toEditRows.forEach(function (edituser) {
                                var userWithId = _.find($scope.soucegridOptions.data, function (user) {
                                    return user.id === edituser.entity.id;
                                });
                                userWithId.put().then(function (res) {
                                    if (res.success) {
                                        showMsg(res.messages.toString(), '信息', 'lime');
                                        row.entity.regamt = res.regamt;
                                        $scope.souceamttoal = res.regamt;
                                        if(Number(res.regamt) < 0) showMsg('请注意数据的一致性，库存小于 0 ！', '信息', 'ruby');
                                        $scope.soucegridApi.rowEdit.setRowsClean(Array(userWithId));
                                    } else {
                                        showMsg(res.errors.toString(), '错误', 'ruby');
                                    }
                                });
                            });
                        };

                        $scope.delbranchData = function () {
                            var selectdcmodels = $scope.soucegridApi.selection.getSelectedGridRows();
                            selectdcmodels.forEach(function (deldata) {
                                    deldata.entity.remove().then(function (res) {
                                        if (res.success) {
                                            $scope.soucegridOptions.data = _.without($scope.soucegridOptions.data, deldata.entity);
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

                        $scope.savebranchRow = function (rowEntity) {
                            //$scope.editdataids.push(rowEntity.id);
                            var promise = $q.defer();
                            $scope.soucegridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
                            //promise.resolve();
                            promise.reject();
                        };
                        $scope.toggleFilteringsign = '筛选数据';
                        $scope.togglebranchFiltering = function(){
                            $scope.soucegridOptions.enableFiltering = !$scope.soucegridOptions.enableFiltering;
                            if(!$scope.soucegridOptions.enableFiltering) $scope.toggleFilteringsign = '筛选数据';
                            else $scope.toggleFilteringsign = '取消筛选';
                            $scope.soucegridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
                        };
                        // console.log(row.entity.ambudgettype_id);
                    }]

                }).then(function (dcEdition) {

                }, function (dcEdition) {

                });
            };


            $scope.exportxls = function(){
                var myElement = angular.element(document.querySelectorAll(".custom-csv-link-location"));
                $scope.gridApi.exporter.csvExport( 'all', 'all', myElement );
            };

            $scope.toggleFilteringsign = '筛选数据';
            $scope.toggleFiltering = function(){
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
                if(!$scope.gridOptions.enableFiltering) $scope.toggleFilteringsign = '筛选数据';
                else $scope.toggleFilteringsign = '取消筛选';
                $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
            };

            $scope.refreshData = function(){
                $scope.gridOptions.data = [];
                tableDatas.getList().then(function (accounts) {
                    var allAccounts = accounts;
                    $scope.gridOptions.data = allAccounts;
                });
            };

            tableDatas.getList().then(function (accounts) {
                // console.log(accounts);
                for (var item=0;item<accounts.length;item++){
                    if(accounts[item]["wzno"]) {
                        if (accounts[item]["purchprice"]) accounts[item]["wztotal"] = accounts[item]["amt"] * accounts[item]["purchprice"];//计算物资小计
                        else accounts[item]["wztotal"] = accounts[item]["amt"] * accounts[item]["bdg"];//计算物资小计
                    }
                }
                $scope.gridOptions.data = accounts;
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
