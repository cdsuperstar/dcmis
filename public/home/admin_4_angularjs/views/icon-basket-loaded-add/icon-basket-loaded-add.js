'use strict';

angular.module("MetronicApp").controller('iconbasketloadedCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //获得年度列表
            var date = new Date();
            var currentYear = date.getFullYear();
            var yeararr = new Array();
            for(var val = (currentYear-3); val <= (currentYear+3); val++){
                yeararr.push(val);}
            //预算类别列表
            Restangular.all('/am-budget-lb').getList().then(function (accounts) {
                $scope.listnames = accounts;
            });
            //机构列表
            Restangular.all('/user-department').getList().then(function (accounts) {
                $scope.untigrps = accounts;
            });
            //物资列表
            Restangular.all('/icon-basket-setindex').getList().then(function (accounts) {
                $scope.datawzgrps = accounts;
            });
            //人员列表
            Restangular.all('/sys-users').getList().then(function (accounts) {
                $scope.peoplegrps = accounts;
            });

            ////////////页面初始化区域
            $scope.Midifysign = false; //默认非修改状态
            $scope.tyear = yeararr;
            $scope.imdata=[];
            $scope.datetimestr =  date.getFullYear()+"年"+(date.getMonth()+1)+"月"+date.getDate()+"日 "+ date.toLocaleTimeString(); //获得日期字串
            $scope.printsign = false; //打印按钮隐藏
            $scope.subsign = true;  //默认显示提交申报按钮
            $scope.basket = { syear:currentYear,unitgrps_id:$scope.dcUser.unitid,requester:$scope.dcUser.id,ambudgettypes_id:1};  //初始化当前用户数据
            //初始化结束

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
            //求和函数  遍历json
            var SumJsonData = function (mJson,mkey,mamt) {
                var total = 0;
                for (var item=0;item<mJson.length;item++){
                    if(!mamt) total += mJson[item][mkey];
                    else total += mJson[item][mkey] * mJson[item][mamt];
                }
                return total;
            };

            //修改状态初始化
            // $scope.ModelsDataShare['icon-basket-loaded-list-ModifySubdata'];
            // $scope.ModelsDataShare['icon-basket-loaded-list-Modifydata'];
            // console.log($scope.ModelsDataShare);
            if($scope.ModelsDataShare['icon-basket-loaded-list-Modifydata'] != null && $scope.ModelsDataShare['icon-basket-loaded-list-ModifySubdata'] != null){
                $scope.basket = {
                    syear:Number($scope.ModelsDataShare['icon-basket-loaded-list-Modifydata'][0]['entity']['syear']),
                    unitgrps_id:Number($scope.ModelsDataShare['icon-basket-loaded-list-Modifydata'][0]['entity']['unitgrps_id']),
                    requester:Number($scope.ModelsDataShare['icon-basket-loaded-list-Modifydata'][0]['entity']['requester']),
                    ambudgettypes_id:Number($scope.ModelsDataShare['icon-basket-loaded-list-Modifydata'][0]['entity']['ambudgettypes_id']),
                    name:$scope.ModelsDataShare['icon-basket-loaded-list-Modifydata'][0]['entity']['name'],
                    no:$scope.ModelsDataShare['icon-basket-loaded-list-Modifydata'][0]['entity']['no'],
                    id:Number($scope.ModelsDataShare['icon-basket-loaded-list-Modifydata'][0]['entity']['id'])
                };
                var modifydetaildata = $scope.ModelsDataShare['icon-basket-loaded-list-ModifySubdata'];
                for(var i=0;i<modifydetaildata.length;i++){
                    $scope.imdata.push(modifydetaildata[i]);
                }
                $scope.Midifysign = true;
            }
            //修改状态初始化结束

            $scope.saveformdata = function() {
                if(!$scope.basket.name || $scope.imdata == null || angular.equals({}, $scope.imdata) || $scope.imdata.length == 0){
                    showMsg('必要信息未填写！( 项目名称未填写 或 数据列表为空! )', '错误', 'ruby');
                    return false;
                }else {
                    var res = angular.merge($scope.basket, $scope.imdata);
                    $scope.printsign = true;
                    $scope.subsign = false;
                     //console.log(res);
                    Restangular.all('/icon-basket-loaded-add/storeReq').post(res).then(function(storeRes){
                        if (storeRes.success) {
                            showMsg(storeRes.messages.toString(), '信息', 'lime');
                        } else {
                            // TODO add error message to system
                            showMsg(storeRes.errors.toString(), '错误', 'ruby');
                        }
                    });
                    // console.log(res);
                }
            };

            $scope.printformdata = function () {
                var htmstr='';
                var head_str = "<html><head><title>采购审批表 - 打印</title><link href='http://" +window.location.host+
                    "/home/assets/global/plugins/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'/></head><body style='margin:0px;'><p><h2 align='center'>成都理工大资产经营有限责任公司</h2></p>"; //先生成头部
                if($scope.basket.templatesign==1) htmstr = "<p><h3 align='center'>物资采购审批表</h3></p>"+document.getElementById('isMaterialbudget').innerHTML;
                if($scope.basket.templatesign==2) htmstr = "<p><h3 align='center'>工程/服务采购审批表</h3></p>"+document.getElementById('isProjectbudget').innerHTML;
                if($scope.basket.templatesign==3) htmstr = "<p><h3 align='center'>工程/服务采购审批表</h3></p>"+document.getElementById('isServicebudget').innerHTML;
                if($scope.basket.templatesign==4) htmstr = "<p><h3 align='center'>工程/服务采购审批表</h3></p>"+document.getElementById('isOthersbudget').innerHTML;
                var foot_str = "</body></html>"; //生成尾部
                // var older = document.body.innerHTML;
                // var new_str = document.getElementById('isMaterialbudget').innerHTML; //获取指定打印区域
                // var old_str = document.body.innerHTML; //获得原本页面的代码
                var newh = window.open();
                newh.document.body.innerHTML = head_str + htmstr + foot_str; //构建新网页

                $scope.subsign = false;

                // newh.print(); //打印刚才新建的网页
                // location.reload(); //打印结束后reload本页面
                // window.location.href="#/icon-basket-loaded-add.html";
                // document.body.innerHTML = older; //将网页还原
                // return false;
            };
            $scope.dumpimdata=function () {
                $scope.imdata=[];
            };

            //准换数字左边补0
            var padleft = function(num, n) {
                var y='00000000000000000000000000000'+num; //爱几个0就几个，自己够用就行
                return y.substr(y.length-n);
            };

            $scope.stepthrid = function () {
                //年预算总金额
                $scope.yearbudgettotal = 0;
                Restangular.all('/am-budget-management/getYearDatas/'+$scope.basket.syear).getList().then(function (accounts) {
                    for (var item=0;item<accounts.length;item++){
                        if(accounts[item]['syear'] == $scope.basket.syear && accounts[item]['unit'] == $scope.dcUser.unitid && accounts[item]['type'] == $scope.basket.ambudgettypes_id)
                            $scope.yearbudgettotal = accounts[item]['total'];
                    }

                });

                //转换开始
                $scope.listtyname = changeJsonData($scope.listnames,'id',$scope.basket.ambudgettypes_id,'type');
                $scope.listusname = changeJsonData($scope.peoplegrps,'id',$scope.basket.requester,'name');
                $scope.listunname = changeJsonData($scope.untigrps,'id',$scope.basket.unitgrps_id,'name');
                // console.log($scope.basket.unitgrps_id+'--->'+$scope.listunname);
                //转换结束
                //生成采购编号
                if($scope.Midifysign == false){
                    if(!$scope.basket.ambudgettypes_id) $scope.basket.ambudgettypes_id=1;
                    var templatespell = changeJsonData($scope.listnames,'id',$scope.basket.ambudgettypes_id,'spell');
                    $scope.basket.no=currentYear+templatespell+"0001";
                    Restangular.all('/icon-basket-loaded-add/getLastNo').getList().then(function (accounts) {
                        var tmpno = 0;
                        for(var i=0;i<accounts.length;i++){
                            if(currentYear==accounts[i].no.substr(0,4)){
                                if(accounts[i].no.substr(6.4) > tmpno) tmpno = Number(accounts[i].no.substr(6.4))+1;
                                $scope.basket.no = currentYear+templatespell+padleft(tmpno,5);
                            }else {
                                $scope.basket.no=currentYear+templatespell+"0001";
                            }
                        }
                    });
                }
                //end
                //导航开始
                $scope.isMaterialbudget = false;
                $scope.isProjectbudget = true;
                $scope.isServicebudget = true;
                $scope.isOthersbudget = true;
                switch($scope.basket.templatesign)
                {
                    case "1":{
                        $scope.isMaterialbudget = false;
                        $scope.isProjectbudget = true;
                        $scope.isServicebudget = true;
                        $scope.isOthersbudget = true;
                    }
                    break;
                    case "2":{
                        $scope.isMaterialbudget = true;
                        $scope.isProjectbudget = false;
                        $scope.isServicebudget = true;
                        $scope.isOthersbudget = true;
                    }
                        break;
                    case "3":{
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
                //计算总金额
                $scope.totalimdata = SumJsonData($scope.imdata,'bdg','');
                $scope.wztotalimdata = SumJsonData($scope.imdata,'bdg','amt');
            };
            $scope.soucegridOptions={
                enableSorting: true,
                enableFiltering: false,
                showColumnFooter:true,
                showGridFooter:true,
                enableVerticalScrollbar:1,
                enableHorizontalScrollbar :1,
                enableGridMenu: true,
                //--------------导入开始----------------------------------
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
                exporterCsvFilename:'Datadownload.csv',
                columnDefs: [],
                data: 'imdata',
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                }
            };
            $scope.delData = function () {
                var selectDatas = $scope.gridApi.selection.getSelectedGridRows();
                selectDatas.forEach(function (del) {
                    $scope.imdata = _.without($scope.imdata, del.entity);
                    }
                );
                $scope.$apply();
            };
            $scope.saveRow = function (rowEntity) {
                var promise = $q.defer();
                $scope.gridApi.rowEdit.setSavePromise(rowEntity, promise.promise);
                promise.resolve();
            };


            $scope.changestep = function() {

                //取当前类别的模板类型
                if(!$scope.basket.ambudgettypes_id) $scope.basket.ambudgettypes_id=1;
                if($scope.listnames===undefined){
                } else {
                    $scope.basket.templatesign = changeJsonData($scope.listnames,'id',$scope.basket.ambudgettypes_id,'template');
                }
                //end
                switch($scope.basket.templatesign)
                {
                    case "1":
                    {
                        //重新获取物资名称及单位
                        if($scope.imdata != null){
                            for(var i=0;i<$scope.imdata.length;i++){
                                $scope.imdata[i]['wzname'] = changeJsonData($scope.datawzgrps,'no',$scope.imdata[i]['wzno'],'name');//获取物资名称
                                $scope.imdata[i]['wzmeasunit'] = changeJsonData($scope.datawzgrps,'no',$scope.imdata[i]['wzno'],'measunit');//获取物资单位
                            }
                        }
                        //start
                        $scope.soucegridOptions.columnDefs=[
                            {name: '物资编号', field: 'wzno',width: '100',enableCellEdit: false,enableColumnMenu: true,pinnedLeft:true,visible:false},
                            {name: '物资名称', field: 'wzname',width: '200',enableCellEdit: false,enableColumnMenu: true,pinnedLeft:true,
                                footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                            {name: '单位', field: 'wzmeasunit',width: '60',enableCellEdit: false,enableColumnMenu: true,pinnedLeft:true},
                            {name: '规格、型号', field: 'wzsmodel',width: '200',enableColumnMenu: true,
                                cellTooltip: function(row){ return row.entity.aspara; },
                                //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                            },
                            {name: '数量', field: 'amt',width: '60',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                            {name: '预算单价', field: 'bdg',width: '80',cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                            {name: '备注', field: 'remark',width: '150',enableColumnMenu: true}
                        ];

                        $scope.addData = function () {
                            // console.log($scope.imdata);
                            ngDialog.openConfirm({
                                template: 'add-material',
                                className: 'ngdialog-theme-default iconaddmaterial',
                                scope: $scope,
                                controller: ['$scope', function ($scope) {
                                    //二级联动start 物品分类
                                    //distinct json class字段  开始
                                    var lookup = {};
                                    var items = $scope.datawzgrps;
                                    var result = [];
                                    for (var item, i = 0; item = items[i++];) {
                                        var name = item.class;

                                        if (!(name in lookup)) {
                                            lookup[name] = 1;
                                            result.push(name);
                                        }
                                    }
                                    //结束
                                    $scope.wzfl =result; //将物资分类的数组赋过去
                                    $scope.dcaddMaterial={aswzfl:$scope.wzfl[0]}; //初始化第一个分类为默认值
                                    $scope.wzgrps = $filter("filter")($scope.datawzgrps,{class:$scope.dcaddMaterial.aswzfl}); //初始化第一个分类的值为默认值

                                    $scope.chanagewzdata = function() {
                                        $scope.dcaddMaterial.wzno = undefined; //如果分类改变，该值置为空
                                        $scope.wzgrps = $filter("filter")($scope.datawzgrps,{class:$scope.dcaddMaterial.aswzfl});
                                    };
                                    //end

                                }],
                                showClose: false,
                                setBodyPadding: 1,
                                overlay: true,        //是否用div覆盖当前页面
                                closeByDocument:false,  //是否点覆盖div 关闭会话
                                disableAnimation:true,  //是否显示动画
                                closeByEscape: true
                            }).then(function (dcaddMaterial) {
                                if(dcaddMaterial.wzno){
                                    dcaddMaterial.wzname = changeJsonData($scope.datawzgrps,'no',dcaddMaterial.wzno,'name');//获取物资名称
                                    dcaddMaterial.wzmeasunit = changeJsonData($scope.datawzgrps,'no',dcaddMaterial.wzno,'measunit');//获取物资单位
                                    // console.log(dcaddMaterial);
                                    // $scope.soucegridOptions.data.push(dcaddMaterial);
                                    $scope.imdata.push(dcaddMaterial);
                                    showMsg('添加成功!编号：'+dcaddMaterial.wzno, '信息', 'lime');
                                }else {
                                    showMsg('添加失败!编号：'+dcaddMaterial.wzno, '错误', 'ruby');
                                }
                            }, function (dcaddMaterial) {
                                // console.log('Modal promise rejected. Reason: ', dcaddMaterial);
                            });
                        };
                        //end

                    }
                        break;
                    case "2":
                    {
                        //start
                        $scope.soucegridOptions.columnDefs=[
                            {name: '工程项目名称', field: 'name',width: '150',enableColumnMenu: true,
                                cellTooltip: function(row){ return row.entity.contrname; },
                                //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                            {name: '工程预算', field: 'bdg',width: '80',cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                            {name: '工期要求', field: 'req',width: '200',enableColumnMenu: true,
                                cellTooltip: function(row){ return row.entity.contrworkreq; },
                                //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                            },
                            {name: '工程地点', field: 'addr',width: '120',enableColumnMenu: true},
                            {name: '负责人', field: 'picharge',width: '120',enableColumnMenu: true},
                            {name: '负责人电话', field: 'picphone',width: '120',enableColumnMenu: true}
                        ];

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
                                // console.log(dcaddContr);
                                if(dcaddContr.name){
                                    $scope.imdata.push(dcaddContr);
                                    showMsg('添加成功!工程项目名称：'+dcaddContr.name, '信息', 'lime');
                                }else {
                                    showMsg('添加失败!工程项目名称：'+dcaddContr.name, '错误', 'ruby');
                                }
                            }, function (dcaddContr) {
                                // console.log('Modal promise rejected. Reason: ', dcaddMaterial);
                            });
                        };

                        //end

                    }
                        break;
                    case "3":
                    {

                        //start
                        $scope.soucegridOptions.columnDefs=[
                            {name: '服务内容', field: 'name',width: '150',enableColumnMenu: true,
                                cellTooltip: function(row){ return row.entity.contrname; },
                                //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                            {name: '预算金额', field: 'bdg',width: '80',cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                            {name: '服务期限', field: 'req',width: '200',enableColumnMenu: true,
                                cellTooltip: function(row){ return row.entity.contrworkreq; },
                                //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                            },
                            {name: '地点', field: 'addr',width: '150',enableColumnMenu: true},
                            {name: '负责人', field: 'picharge',width: '120',enableColumnMenu: true},
                            {name: '负责人电话', field: 'picphone',width: '120',enableColumnMenu: true}
                        ];

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
                                // console.log(dcaddSv);
                                if(dcaddSv.name){
                                    $scope.imdata.push(dcaddSv);
                                    showMsg('添加成功!服务内容：'+dcaddSv.name, '信息', 'lime');
                                }else {
                                    showMsg('添加失败!服务内容：'+dcaddSv.name, '错误', 'ruby');
                                }
                            }, function (dcaddSv) {
                                // console.log('Modal promise rejected. Reason: ', dcaddMaterial);
                            });

                        };
                        //end

                    }
                        break;
                    case "4":
                    {

                        //start
                        $scope.soucegridOptions.columnDefs=[
                            {name: '采购内容', field: 'name',width: '150',enableColumnMenu: true,
                                cellTooltip: function(row){ return row.entity.contrname; },
                                //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>',
                                footerCellTemplate: '<div class="ui-grid-bottom-panel" style="text-align: center;color: #000000">合计</div>'},
                            {name: '预算金额', field: 'bdg',width: '80',cellFilter: 'currency',enableColumnMenu: true,aggregationType: uiGridConstants.aggregationTypes.sum,aggregationHideLabel: true},
                            {name: '其他说明', field: 'otremark',width: '200',enableColumnMenu: true,
                                cellTooltip: function(row){ return row.entity.contrworkreq; },
                                //cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents souce-cell-wrap" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                                cellTemplate: '<div class="ui-grid-row ui-grid-cell-contents" title="TOOLTIP">{{COL_FIELD CUSTOM_FILTERS}}</div>'
                            },
                            {name: '合同地点', field: 'addr',width: '150',enableColumnMenu: true},
                            {name: '负责人', field: 'picharge',width: '120',enableColumnMenu: true},
                            {name: '负责人电话', field: 'picphone',width: '120',enableColumnMenu: true}
                        ];

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
                                // console.log(dcaddOt);
                                if(dcaddOt.name){
                                    $scope.imdata.push(dcaddOt);
                                    showMsg('添加成功!采购内容：'+dcaddOt.name, '信息', 'lime');
                                }else {
                                    showMsg('添加失败!采购内容：'+dcaddOt.name, '错误', 'ruby');
                                }
                            }, function (dcaddOt) {
                                // console.log('Modal promise rejected. Reason: ', dcaddMaterial);
                            });
                        };
                        //end
                    }
                        break;
                    default:
                        // console.log($scope.basket.ambudgettypes_id);
                        break;
                }
            };
            //

        }
    ]
)
;
