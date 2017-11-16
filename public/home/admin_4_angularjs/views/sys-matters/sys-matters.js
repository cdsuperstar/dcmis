'use strict';

angular.module("MetronicApp").controller('sysmattersCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            var tableDatas = Restangular.all('/dcmatters/getMySendIndex');
            i18nService.setCurrentLang('zh-cn');
            //时间日期控件赋初始值
            $scope.dcEdition = {enddate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate(), new Date().getHours()+1, 0),suser_id:$scope.dcUser.id};

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
                $scope.peoplegrps = accounts;
                $scope.gridOptions.columnDefs[1].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[1].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[1].unitHash =  userHash ;
                $scope.gridOptions.columnDefs[5].filter.selectOptions=userarr;
                $scope.gridOptions.columnDefs[5].editDropdownOptionsArray=userarr;
                $scope.gridOptions.columnDefs[5].unitHash =  userHash ;
            });


            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: 'sysmatters-add',
                    className: 'ngdialog-theme-default sysmatters',
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
                    dcEdition.ruser_id = $scope.dcUser.id;
                    dcEdition.enddate = new Date(dcEdition.enddate).toString().split("GMT")[0];
                    // dcEdition.enddate = Date.UTC(dcEdition.enddate);
                    // console.log(dcEdition);
                    tableDatas = Restangular.all('/dcmatters');
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
                    // console.log('Modal promise rejected. Reason: ', dcEdition);
                });
            };

            $scope.delData = function () {
                var selectdcmodels = $scope.gridApi.selection.getSelectedGridRows();
                selectdcmodels.forEach(function (deluser) {
                        //console.log(deluser);
                    deluser.entity.route = "/dcmatters";
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


            //edit data
            $scope.editData = function () {
                var toEditRows = $scope.gridApi.rowEdit.getDirtyRows($scope.gridOptions);
                toEditRows.forEach(function (edituser) {
                    var userWithId = _.find($scope.gridOptions.data, function (user) {
                        return user.id === edituser.entity.id;
                    });
                    userWithId.route = "/dcmatters";
                    // console.log(userWithId);
                    userWithId.put().then(function (res) {
                        // console.log(res);
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
                enableCellEditOnFocus: true,
                    columnDefs: [
                    {name: 'id', field: 'id', enableCellEdit: false, width: '40',enableFiltering: false,enableColumnResizing:false},
                    {name: '提醒人', field: 'suser_id',width: '100',enableColumnMenu: false,enableHiding: false,enableCellEdit: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.unitHash',userHash:[],
                        filter: {
                            term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '标题', field: 'title', width: '200',enableCellEdit: true,enableHiding: false},
                    {name: '事项内容',width: '350', field: 'content', enableCellEdit: true},
                    {name: '到期时间',width: '150',field: 'enddate', enableCellEdit: true,cellFilter: 'date:"yyyy-MM-dd HH:mm:ss"'},
                    {name: '发送人', field: 'ruser_id',width: '100',enableColumnMenu: false,enableHiding: false,enableCellEdit: false,
                        editDropdownIdLabel:'value',editDropdownValueLabel: 'label',editableCellTemplate: 'ui-grid/dropdownEditor',
                        editDropdownOptionsArray: [],cellFilter: 'dFilterHash:col.colDef.unitHash',userHash:[],
                        filter: {
                            term:1,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [] }
                    },
                    {name: '添加时间', width: '150',field: 'created_at',enableCellEdit: false,visible:true},
                    {name: '更新时间', width: '150',field: 'updated_at',enableCellEdit: false,visible:false}
                    ],
                paginationPageSizes: [10, 30, 50],
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                },
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
                var allAccounts = accounts;
                // for(var i=0;i<allAccounts.length;i++){
                //     allAccounts[i].enddate=new Date(allAccounts[i].enddate);
                // }
                $scope.gridOptions.data = allAccounts;
                //console.log( $scope.gridOptions.data);
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

