'use strict';

angular.module("MetronicApp").controller('userprofilesCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            var tableDatas = Restangular.all('/users');

            $scope.addData = function () {
                ngDialog.openConfirm({
                    template: '/userprofiles/create',
                    className: 'ngdialog-theme-default userprofile',
                    scope: $scope,
                    controller: ['$scope', 'validationConfig', function ($scope, validationConfig) {
                        $scope.$validationOptions = validationConfig;
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
                });
            };

            $scope.delData = function () {
                var selectUsers = $scope.gridApi.selection.getSelectedGridRows();
                selectUsers.forEach(function (deluser) {
                        deluser.entity.remove().then(function (res) {
                            if (res.success) {
                                $scope.gridOptions.data = _.without($scope.gridOptions.data, deluser.entity);
                                showMsg(res.messages.toString(), '信息', 'lime');
                            }
                            else {
                                showMsg(res.errors.toString(), '错误', 'ruby');
                            }
                        });
                    }
                );
            };
            //$scope.editdataids = [];
            $scope.editData = function () {
                var toEditRows = $scope.gridApi.rowEdit.getDirtyRows($scope.gridOptions);
                toEditRows.forEach(function (edituser) {
                    var userWithId = _.find($scope.gridOptions.data, function (user) {
                        return user.id === edituser.entity.id;
                    });
                    userWithId.password_confirmation = userWithId.password;
                    userWithId.put().then(function (res) {
                        if (res.success) {
                            showMsg(res.messages.toString(), '信息', 'lime');
                            $scope.gridApi.rowEdit.setRowsClean(Array(userWithId));
                        } else {
                            showMsg(res.errors.toString(), '错误', 'ruby');
                        }
                    });
                });
                //$scope.editdataids=[];

            }
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
                enableVerticalScrollbar:2,
                enableHorizontalScrollbar :2,
                columnDefs: [
                    {name: 'ID', field: 'id', width: '40',enableCellEdit: false,enableColumnMenu: false,enableHiding: false,enableFiltering: false},
                    {name: '工号', field: 'no',width: '100',enableCellEdit: true,enableColumnMenu: true,pinnedLeft:true},
                    {name: '昵称', field: 'name',width: '100',enableCellEdit: true,enableColumnMenu: true,pinnedLeft:true},
                    {name: '性别', field: 'sex',width: '60',enableCellEdit: true,enableColumnMenu: true,
                        filter: {
                            term: 'sex',
                            condition: uiGridConstants.filter.STARTS_WITH,
                            flags: { caseSensitive: false },         //区分大小写,
                            type: uiGridConstants.filter.SELECT,
                            selectOptions: [ { value: '男', label: '男' }, { value: '女', label: '女' } ],
                            disableCancelFilterButton: false
                        },
                        editableCellTemplate: 'ui-grid/dropdownEditor',
                        cellFilter: 'mapGender', editDropdownValueLabel: 'label', editDropdownOptionsArray: [
                        { id:'男', label: '男' },
                        { id:'女', label: '女' }
                    ]
                    },
                    {name: '联系电话', field: 'phone',width: '120',enableCellEdit: true,enableColumnMenu: true},
                    {name: '出生日期', field: 'birth',width: '100',enableCellEdit: true,enableColumnMenu: true},
                    {name: '办公电话', field: 'tel',width: '120',enableCellEdit: true,enableColumnMenu: true},
                    {name: '办公地址', field: 'address',width: '150',enableCellEdit: true,enableColumnMenu: true},
                    {name: '个人职务', field: 'name',width: '100',enableCellEdit: true,enableColumnMenu: true},
                    {name: '所属部门', field: 'name',width: '100',enableCellEdit: true,enableColumnMenu: true},
                    {name: '个人简介', field: 'memo',width: '150',enableCellEdit: true,enableColumnMenu: true},
                ],
                enablePagination: true, //是否分页，默认为true
                enablePaginationControls: true, //使用默认的底部分页
                paginationPageSizes: [10, 30, 50],
                paginationCurrentPage: 1,
                paginationPageSize: 10,
                data: [],
                onRegisterApi: function (gridApi) {
                    $scope.gridApi = gridApi;
                    gridApi.rowEdit.on.saveRow($scope, $scope.saveRow);
                },
            };

            $scope.gridOptions.enableGridMenu = true;

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
                $scope.gridOptions.data = allAccounts;
            });

            /////////start datepicker
            //scope.dcEdition.birth = new Date();
            $scope.format = "yyyy-MM-dd";
            $scope.altInputFormats = ['yyyy-M!-d!'];

            $scope.tmpbirthday = {
                opened: false
            };
            $scope.opendatepick = function () {
                $scope.tmpbirthday.opened = true;
            };
            $scope.dateOptions = {
                customClass: getDayClass,//自定义类名
                //dateDisabled: isDisabled,//是否禁用周末
                showWeeks:false, //显示周
                startingDay:1 //从周一显示
            }


            var tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            var afterTomorrow = new Date();
            afterTomorrow.setDate(tomorrow.getDate() + 1);
            $scope.events = [
                {
                    date: tomorrow,
                    status: 'full'
                },
                {
                    date: afterTomorrow,
                    status: 'partially'
                }
            ];
            //为日期面板中的每个日期（默认42个）返回类名。传入参数为{date: obj1, mode: obj2}
            function getDayClass(obj) {
                var date = obj.date,
                    mode = obj.mode;
                if (mode === 'day') {
                    var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

                    for (var i = 0; i < $scope.events.length; i++) {
                        var currentDay = new Date($scope.events[i].date).setHours(0, 0, 0, 0);

                        if (dayToCheck === currentDay) {
                            return $scope.events[i].status;
                        }
                    }
                }
                return '';
            }
            //设置日期面板中的所有周六和周日不可选
            //function isDisabled(obj) {
            //    var date = obj.date,
            //        mode = obj.mode;
            //    return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
            //}
            //////end datepicker


        }
    ]
)
    .filter('mapGender', function() {
        var genderHash = {
            '男': '男',
            '女': '女'
        };

        return function(input) {
            if (!input){
                return '';
            } else {
                return genderHash[input];
            }
        };
    })

;

