'use strict';

angular.module("MetronicApp").controller('iconbasketloadplanCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
            var date = new Date();
            var currentYear = date.getFullYear();
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
            $scope.datetimestr =  date.getFullYear()+"年"+(date.getMonth()+1)+"月"+date.getDate()+"日 "+ date.toLocaleTimeString(); //获得日期字串
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
                $scope.listnames = accounts;
                $scope.gridOptions.columnDefs[8].filter.selectOptions=lbarr;
                $scope.gridOptions.columnDefs[8].editDropdownOptionsArray=lbarr;
                $scope.gridOptions.columnDefs[8].lbHash =  lbHash;
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
                $scope.gridOptions.columnDefs[10].filter.selectOptions=untarr;
                $scope.gridOptions.columnDefs[10].editDropdownOptionsArray=untarr;
                $scope.gridOptions.columnDefs[10].unitHash =  unitHash ;
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
                $scope.gridOptions.columnDefs[4].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[4].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[4].userHash =  userHash ;
                $scope.gridOptions.columnDefs[9].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[9].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[9].userHash =  userHash ;
            });
            //物资列表
            Restangular.all('/icon-basket-setindex').getList().then(function (accounts) {
                $scope.datawzgrps = accounts;
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

            $scope.basket = { syear:currentYear,type:1};  //初始化为当前年度
            $scope.iswzstatus = false; //是否显示固定资产标记

            //
            var tableDatas = Restangular.all('/icon-basket-loaded-list');

            $scope.gridOptions = {
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter:false,
                showGridFooter:false,
                columnDefs: [
                    {name: '详情', field: 'id',width: '50',enableColumnMenu: false,enableColumnResizing:false,enableSorting:false,pinnedLeft:true,
                        enableHiding: false,enableCellEdit: false,enableFiltering: false,
                        cellTemplate: '<div style="text-align: center;" class="ui-grid-cell-contents"> ' +
                        '<span class="icon-eye icon-hand" ng-click="grid.appScope.showdetail(row)"  title="查看详情"></span>&nbsp;' +
                        ' </div>'},
                    {name: '项目编号', field: 'no',width: '110',enableCellEdit: false,},
                    {name: '项目名称', field: 'name',width: '200',enableCellEdit: false,},
                    {name: '审批状态', field: 'appstate',width: '100',enableCellEdit: false,enableColumnMenu: true,
                        filter: {
                            term: '审批未通过',
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [
                                { value: '审批通过', label: '审批通过' },
                                { value: '审批未通过', label: '审批未通过' }
                            ]}
                    },
                    {name: '审批人', field: 'apper',width: '100',enableCellEdit: false,enableColumnMenu: true,visible:false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.userHash',userHash:[],
                        filter: {
                            term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '审批时间', field: 'appdate',width: '100',enableCellEdit: false,enableColumnMenu: true,visible:false},
                    {name: '采购进度', field: 'progress',width: '100',enableCellEdit: false,enableColumnMenu: true},
                    {name: '年度', field: 'syear',width: '100',enableCellEdit: false,enableColumnMenu: false,enableHiding: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: $scope.uigrtyear,cellFilter: 'yearGender',
                        filter: {
                            term: currentYear,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: $scope.uigrtyear}
                    },
                    {name: '预算类别', field: 'ambudgettype_id',width: '120',enableCellEdit: false,enableColumnMenu: false,enableHiding: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.lbHash',lbHash:[],
                        filter: {
                            term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: []}
                    },
                    {name: '申请人', field: 'requester',width: '100',enableColumnMenu: false,enableHiding: false,enableCellEdit: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.userHash',userHash:[],
                        filter: {
                            term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '部门', field: 'unitgrps_id',width: '230',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.unitHash',unitHash:[],
                        filter: {
                            term:3,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '是否终止', field: 'isterm',width: '100',editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                        editDropdownValueLabel: 'isterm', editDropdownOptionsArray: [
                        { id: '是', isterm: '是' },
                        { id: '否', isterm: '否' }],
                        filter: {
                            term: '',
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [
                                { value: '是', label: '是' },
                                { value: '否', label: '否' }
                            ]}
                    },
                    {name: '终止原因', field: 'termreason',width: '200',enableCellEdit: true}
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
                    gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                    $scope.gridApi.grid.registerRowsProcessor( $scope.singleFilter, 200 );
                }
            };

            $scope.showdetail = function(row) {
                // console.log(row.entity.appstate);
                if(row.entity.appstate == '审批通过' || (confirm("该采购申请表的审批状态为 未审批 或 审批未通过 ，确定要继续操作吗？") == true)) {
                }else {
                    return false;
                }
                var detaildata=angular.fromJson(row.entity.id);
                ngDialog.openConfirm({
                    showClose: false,
                    setBodyPadding: 1,
                    overlay: true,        //是否用div覆盖当前页面
                    closeByDocument:false,  //是否点覆盖div 关闭会话
                    disableAnimation:true,  //是否显示动画
                    template: 'baket-load-plan',
                    className: 'ngdialog-theme-default iconbasketloadplan',
                    scope: $scope,
                    controller: ['$scope',function ($scope) {
                        $scope.tmpobjdata = row.entity.id;  //取当前项目申请表的id
                        $scope.tmpobjno = row.entity.no;  //取当前项目申请表的no
                        $scope.tmpobjname = row.entity.name;  //取当前项目申请表的name
                        //取当前类别的模板类型
                        if(!row.entity.ambudgettype_id) row.entity.ambudgettype_id=1;
                        if($scope.listnames===undefined){
                        } else {
                            $scope.templatesign = changeJsonData($scope.listnames,'id',row.entity.ambudgettype_id,'template');
                        }
                        //end
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
                            $scope.soucegridOptions.columnDefs[6].filter.selectOptions=supplierarr;
                            $scope.soucegridOptions.columnDefs[6].editDropdownOptionsArray=supplierarr;
                            $scope.soucegridOptions.columnDefs[6].supplierHash =  supplierHash ;
                        });

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
                            onRegisterApi: function (soucegridApi) {
                                $scope.soucegridApi = soucegridApi;
                                soucegridApi.rowEdit.on.saveRow($scope, $scope.savebranchRow);
                            }
                        };
                        var sourceDatas = Restangular.all('/icon-basket-loaded-list/getSubsFromAppID/'+row.entity.id);
                        sourceDatas.getList().then(function (accounts) {
                            for (var item=0;item<accounts.length;item++){
                                if(accounts[item]["wzno"]) {
                                    accounts[item]["wzname"] = changeJsonData($scope.datawzgrps,'no',accounts[item]["wzno"],'name');//获取物资名称
                                    accounts[item]["wzmeasunit"] = changeJsonData($scope.datawzgrps,'no',accounts[item]["wzno"],'measunit');//获取物资单位
                                    if (accounts[item]["purchprice"]) accounts[item]["wztotal"] = accounts[item]["amt"] * accounts[item]["purchprice"];//计算物资小计
                                    else accounts[item]["wztotal"] = accounts[item]["amt"] * accounts[item]["bdg"];//计算物资小计
                                }
                            }
                            $scope.soucegridOptions.data = accounts;
                            // console.log(accounts);
                        });

                        $scope.changeStatus = function (field,applystatus) {//转换各种状态
                            var selectdcmodels = $scope.soucegridApi.selection.getSelectedGridRows();
                            selectdcmodels.forEach(function (deldata) {
                                    Restangular.all('/amsubbudgets/setStatus/'+deldata.entity.id+'/'+field+'/'+applystatus).post().then(function (res) {
                                        if (res.success) {
                                            deldata.entity[field] = applystatus;
                                            row.entity.progress=res.progress;
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

                        $scope.editbranchData = function () {
                            var toEditRows = $scope.soucegridApi.rowEdit.getDirtyRows($scope.soucegridOptions);
                            toEditRows.forEach(function (edituser) {
                                var userWithId = _.find($scope.soucegridOptions.data, function (user) {
                                    return user.id === edituser.entity.id;
                                });
                                userWithId.route = "/amsubbudgets";//采购字表的route
                                userWithId.put().then(function (res) {
                                    if (res.success) {
                                        showMsg(res.messages.toString(), '信息', 'lime');
                                        $scope.soucegridApi.rowEdit.setRowsClean(Array(userWithId));
                                    } else {
                                        showMsg(res.errors.toString(), '错误', 'ruby');
                                    }
                                });
                            });
                        };
                        $scope.savebranchRow = function (rowEntity) {
                            //$scope.editdataids.push(rowEntity.id);
                            var promise = $q.defer();
                            $scope.soucegridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
                            //promise.resolve();
                            promise.reject();
                        };
                        $scope.togglebranchFiltering = function(){
                            $scope.soucegridOptions.enableFiltering = !$scope.soucegridOptions.enableFiltering;
                            $scope.soucegridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
                        };
                        // console.log(row.entity.ambudgettype_id);
                        switch($scope.templatesign)
                        {
                            case "1":
                            {
                                //start
                                $scope.iswzstatus = true; //是否显示固定资产标记
                                $scope.soucegridOptions.columnDefs=[
                                    {name: '物资编号', field: 'wzno',width: '100',enableCellEdit: false,enableColumnMenu: true,visible:true,pinnedLeft:true},
                                    {name: '物资名称', field: 'wzname',width: '200',enableColumnMenu: true,enableCellEdit: false,pinnedLeft:true,
                                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                    {name: '单位', field: 'wzmeasunit',width: '60',enableCellEdit: false,enableColumnMenu: true},
                                    {name: '规格、型号', field: 'wzsmodel',width: '200',enableColumnMenu: true,
                                        cellTooltip: function(row){ return row.entity.aspara; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    },
                                    {name: '小计', field: 'wztotal',width: '100', enableCellEdit: false,cellFilter: 'currency',aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true,enableColumnMenu: true},
                                    {name: '合同编号', field: 'contrno',width: '150',enableColumnMenu: true},
                                    {name: '供应商编号', field: 'amsupplier_id',width: '200',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.supplierHash',supplierHash:[],
                                        filter: {
                                            type: uiGridConstants.filter.SELECT,
                                            selectOptions: [] }
                                    },
                                    {name: '数量', field: 'amt',width: '60',enableCellEdit: false,enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                    {name: '预算单价', field: 'bdg',width: '80',enableCellEdit: false,cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                    {name: '采购单价', field: 'price',width: '80',enableCellEdit: true,cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
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
                                    {name: '报销状态', field: 'reimstate',width: '100',enableColumnMenu: true,
                                        editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                                        editDropdownValueLabel: 'isreimstate', editDropdownOptionsArray: [
                                        { id: '已报销', isreimstate: '已报销' },
                                        { id: '未报销', isreimstate: '未报销' }],
                                        filter: {
                                            term: '',
                                            type: uiGridConstants.filter.SELECT,
                                            selectOptions: [
                                                { value: '已报销', label: '已报销' },
                                                { value: '未报销', label: '未报销' }]}
                                    },
                                    {name: '物资状态', field: 'asstate',width: '120',enableColumnMenu: true,
                                        editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                                        editDropdownValueLabel: 'isasstate', editDropdownOptionsArray: [
                                        { id: '固定资产', isasstate: '固定资产' },
                                        { id: '非固定资产', isasstate: '非固定资产' }],
                                        filter: {
                                            term: '',
                                            type: uiGridConstants.filter.SELECT,
                                            selectOptions: [
                                                { value: '固定资产', label: '固定资产' },
                                                { value: '非固定资产', label: '非固定资产' }]}
                                    },
                                    {name: '备注', field: 'remark',width: '150',enableColumnMenu: true,enableCellEdit: true,
                                        cellTooltip: function(row){ return row.entity.aspara; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    }
                                ];

                            }
                                break;
                            case "2":
                            {
                                $scope.iswzstatus = false; //是否显示固定资产标记
                                $scope.soucegridOptions.columnDefs=[
                                    {name: '工程项目名称', field: 'name',width: '150',enableColumnMenu: true,enableCellEdit: false,pinnedLeft:true,
                                        cellTooltip: function(row){ return row.entity.contrname; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                    {name: '工期要求', field: 'req',width: '200',enableColumnMenu: true,enableCellEdit: false,
                                        cellTooltip: function(row){ return row.entity.contrworkreq; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    },
                                    {name: '工程地点', field: 'addr',width: '120',enableCellEdit: false,enableColumnMenu: true},
                                    {name: '工程预算', field: 'bdg',width: '80',cellFilter: 'currency',enableCellEdit: false,enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                    {name: '负责人', field: 'picharge',width: '120',enableCellEdit: false,enableColumnMenu: true},
                                    {name: '负责人电话', field: 'picphone',width: '120',enableCellEdit: false,enableColumnMenu: true},
                                    {name: '供应商编号', field: 'amsupplier_id',width: '200',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.supplierHash',supplierHash:[],
                                        filter: {
                                            term:3,
                                            type: uiGridConstants.filter.SELECT,
                                            selectOptions: [] }
                                    },
                                    {name: '合同编号', field: 'contrno',width: '150',enableColumnMenu: true},
                                    {name: '采购单价', field: 'price',width: '80',enableCellEdit: true,cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
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
                                    {name: '报销状态', field: 'reimstate',width: '100',enableColumnMenu: true,
                                        editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                                        editDropdownValueLabel: 'isreimstate', editDropdownOptionsArray: [
                                        { id: '已报销', isreimstate: '已报销' },
                                        { id: '未报销', isreimstate: '未报销' }],
                                        filter: {
                                            term: '',
                                            type: uiGridConstants.filter.SELECT,
                                            selectOptions: [
                                                { value: '已报销', label: '已报销' },
                                                { value: '未报销', label: '未报销' }]}
                                    },
                                    {name: '备注', field: 'remark',width: '150',enableColumnMenu: true,enableCellEdit: true,
                                        cellTooltip: function(row){ return row.entity.aspara; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    }
                                ];

                            }
                                break;
                            case "3":
                            {
                                $scope.iswzstatus = false; //是否显示固定资产标记
                                $scope.soucegridOptions.columnDefs=[
                                    {name: '服务内容', field: 'name',width: '150',enableColumnMenu: true,enableCellEdit: false,pinnedLeft:true,
                                        cellTooltip: function(row){ return row.entity.contrname; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                    {name: '服务期限', field: 'req',width: '200',enableColumnMenu: true,enableCellEdit: false,
                                        cellTooltip: function(row){ return row.entity.contrworkreq; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    },
                                    {name: '地点', field: 'addr',width: '150',enableCellEdit: false,enableColumnMenu: true},
                                    {name: '预算金额', field: 'bdg',width: '80',enableCellEdit: false,cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                    {name: '负责人', field: 'picharge',width: '120',enableCellEdit: false,enableColumnMenu: true},
                                    {name: '负责人电话', field: 'picphone',width: '120',enableCellEdit: false,enableColumnMenu: true},
                                    {name: '供应商编号', field: 'amsupplier_id',width: '200',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.supplierHash',supplierHash:[],
                                        filter: {
                                            term:3,
                                            type: uiGridConstants.filter.SELECT,
                                            selectOptions: [] }
                                    },
                                    {name: '合同编号', field: 'contrno',width: '150',enableColumnMenu: true},
                                    {name: '采购单价', field: 'price',width: '80',enableCellEdit: true,cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
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
                                    {name: '报销状态', field: 'reimstate',width: '100',enableColumnMenu: true,
                                        editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                                        editDropdownValueLabel: 'isreimstate', editDropdownOptionsArray: [
                                        { id: '已报销', isreimstate: '已报销' },
                                        { id: '未报销', isreimstate: '未报销' }],
                                        filter: {
                                            term: '',
                                            type: uiGridConstants.filter.SELECT,
                                            selectOptions: [
                                                { value: '已报销', label: '已报销' },
                                                { value: '未报销', label: '未报销' }]}
                                    },
                                    {name: '备注', field: 'remark',width: '150',enableColumnMenu: true,enableCellEdit: true,
                                        cellTooltip: function(row){ return row.entity.aspara; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    }
                                ];

                            }
                                break;
                            case "4":
                            {
                                $scope.iswzstatus = false; //是否显示固定资产标记
                                $scope.soucegridOptions.columnDefs=[
                                    {name: '采购内容', field: 'name',width: '150',enableColumnMenu: true,enableCellEdit: false,pinnedLeft:true,
                                        cellTooltip: function(row){ return row.entity.contrname; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                        footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                                    {name: '其他说明', field: 'reg',width: '200',enableCellEdit: false,enableColumnMenu: true,
                                        cellTooltip: function(row){ return row.entity.contrworkreq; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    },
                                    {name: '合同地点', field: 'addr',width: '150',enableCellEdit: false,enableColumnMenu: true},
                                    {name: '预算金额', field: 'bdg',width: '80',enableCellEdit: false,cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                                    {name: '负责人', field: 'picharge',width: '120',enableCellEdit: false,enableColumnMenu: true},
                                    {name: '负责人电话', field: 'picphone',width: '120',enableCellEdit: false,enableColumnMenu: true},
                                    {name: '供应商编号', field: 'amsupplier_id',width: '200',enableCellEdit: true,enableColumnMenu: false,enableHiding: false,
                                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.supplierHash',supplierHash:[],
                                        filter: {
                                            term:3,
                                            type: uiGridConstants.filter.SELECT,
                                            selectOptions: [] }
                                    },
                                    {name: '合同编号', field: 'contrno',width: '150',enableColumnMenu: true},
                                    {name: '采购单价', field: 'price',width: '80',enableCellEdit: true,cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
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
                                    {name: '报销状态', field: 'reimstate',width: '100',enableColumnMenu: true,
                                        editableCellTemplate: 'ui-grid/dropdownEditor',enableCellEdit: true,
                                        editDropdownValueLabel: 'isreimstate', editDropdownOptionsArray: [
                                        { id: '已报销', isreimstate: '已报销' },
                                        { id: '未报销', isreimstate: '未报销' }],
                                        filter: {
                                            term: '',
                                            type: uiGridConstants.filter.SELECT,
                                            selectOptions: [
                                                { value: '已报销', label: '已报销' },
                                                { value: '未报销', label: '未报销' }]}
                                    },
                                    {name: '备注', field: 'remark',width: '150',enableColumnMenu: true,enableCellEdit: true,
                                        cellTooltip: function(row){ return row.entity.aspara; },
                                        cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                    }
                                ];

                            }
                                break;
                            default:
                                console.log(row.entity.type);
                                break;
                        }
                    }]

                }).then(function (dcEdition) {

                }, function (dcEdition) {

                });


            };

            $scope.acceptpurchase = function (applystatus) {//受理采购申请（审批通过、审批未通过）
                var selectdcmodels = $scope.gridApi.selection.getSelectedGridRows();
                selectdcmodels.forEach(function (deldata) {
                    //console.log(deldata.entity.id);
                    Restangular.all('/icon-basket-loaded-plan/setStatus/'+deldata.entity.id+'/appstate/'+applystatus).post().then(function (res) {
                            if (res.success) {
                                deldata.entity.appstate = applystatus;
                                deldata.entity.apper = $scope.dcUser.id;
                                deldata.entity.appdate = $scope.datetimestr;
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

            $scope.editData = function () { //修改是否终止及原因
                var toEditRows = $scope.gridApi.rowEdit.getDirtyRows($scope.gridOptions);
                toEditRows.forEach(function (edituser) {
                    var userWithId = _.find($scope.gridOptions.data, function (user) {
                        return user.id === edituser.entity.id;
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
            };

            $scope.saveRow = function (rowEntity) {
                //$scope.editdataids.push(rowEntity.id);
                var promise = $q.defer();
                $scope.gridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
                //promise.resolve();
                promise.reject();
            };

            $scope.Filteringtoggle = function(){
                $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
                $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
            };

            $scope.toggleFiltering = function(){
                $scope.gridApi.grid.refresh();
            };
            $scope.singleFilter = function( renderableRows ){
                // console.log($scope.basket.syear);
                var yearmatcher = new RegExp($scope.basket.syear);
                var unitmatcher = Number($scope.basket.unitgrps_id);
                var namematcher = new RegExp($scope.basket.name);

                // var matcher = new RegExp($scope.filterValue);
                renderableRows.forEach( function( row ) {
                    var match = true;
                    if ( $scope.basket.name && !row.entity['name'].match(namematcher) ){
                        match = false;
                    }
                    if ( $scope.basket.syear && !row.entity['syear'].match(yearmatcher) ){
                        match = false;
                    }
                    if ( $scope.basket.ambudgettype_id && $scope.basket.ambudgettype_id != row.entity['ambudgettype_id']){
                        match = false;
                    }
                    if ( unitmatcher && unitmatcher != Number(row.entity['unitgrps_id'])){
                        match = false;
                    }
                    if ( $scope.basket.requester && $scope.basket.requester != row.entity['requester']){
                        match = false;
                    }
                    if ( !match ){
                        row.visible = false;
                    }
                });
                return renderableRows;
            };

            tableDatas.getList().then(function (accounts) {
                var allAccounts = accounts;
                $scope.gridOptions.data = allAccounts;
                // console.log( $scope.gridOptions.data);
            });

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
