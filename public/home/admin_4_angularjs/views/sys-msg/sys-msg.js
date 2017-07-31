'use strict';

angular.module("MetronicApp").controller('sysmsgCtrl',
    ['$scope', 'Restangular', '$q', '$filter', 'ngDialog','uiGridConstants','i18nService',
        function ($scope, Restangular, $q, $filter, ngDialog,uiGridConstants,i18nService) {
            i18nService.setCurrentLang('zh-cn');

            //人员列表
            Restangular.all('/sys-users').getList().then(function (accounts) {
                Restangular.all('/sys-msg/getMyUnreadCounts/'+$scope.dcUser.id).getList().then(function (myunreadaccounts) {
                    for(var i=0;i<accounts.length;i++){
                        for(var j=0;j<myunreadaccounts.length;j++){
                            if(accounts[i].id == myunreadaccounts[j].sender_id){
                                accounts[i].unread = myunreadaccounts[j].count;
                            }
                        }
                    }
                    $scope.people =accounts;
                });
            });
            //end

            if($scope.activesign){
                //取与当前选定用户的消息记录
                Restangular.all('/sys-msg/getMyChatMsgs/'+$scope.activesign).getList().then(function (chartaccounts) {
                    $scope.chartMsgs = chartaccounts;
                });
            }
            $scope.showmsg = function(id){
                $scope.activesign = id; //置点击事件样式
                var userWithId = _.find($scope.people, function (data) {
                    return data.id === id;
                });
                for(var i = $scope.dcUserMsgs.length - 1 ;i>=0;i--){
                    if($scope.dcUserMsgs[i].sender_id == id)$scope.dcUserMsgs.splice(i,1);
                }
                userWithId.unread = 0;
                //取与当前选定用户的消息记录
                Restangular.all('/sys-msg/getMyChatMsgs/'+id).getList().then(function (chartaccounts) {
                    $scope.chartMsgs = chartaccounts;
                });
            };

            $scope.replace_em = function(str){
                // str = str.replace(/\</g,'&lt;');
                // str = str.replace(/\>/g,'&gt;');
                // str = str.replace(/\n/g,'<br/>');
                str = str.replace(/\[em_([0-9]*)\]/g,'<img src="/css/arclist/$1.gif" border="0" />');
                return str;
            };

            $scope.sendMsg = function () {  //发送消息
                if($scope.sendMsgcontent === undefined || $scope.activesign == null) return false;
                var sendData = [{"body":$scope.sendMsgcontent,"recver_id":$scope.activesign}];
                // console.log($scope.dcUserMsgs);
                Restangular.all('/sys-msg/sendMsg').post(sendData).then(function (res) {
                    if (res[0].id != undefined) {
                        Restangular.restangularizeElement(null, res[0], '/sys-msg');
                        $scope.chartMsgs.unshift(res[0]);
                    }
                    else {
                        showMsg('发送失败！', '错误', 'ruby');
                    }
                });
            };

            $scope.delchartdata = function (id) {  //删除单条消息
                var userWithId = _.find($scope.chartMsgs, function (data) {
                    return data.id === id;
                });
                userWithId.route = "sys-msg";
                userWithId.remove().then(function (res) {
                    $scope.chartMsgs = _.without($scope.chartMsgs, userWithId);
                });
            };

            $scope.delALLchartdata = function () {  //删除与当前用户的所有消息
                if($scope.activesign == null) return false;
                Restangular.all('/sys-msg/clearMsg/'+$scope.activesign).post().then(function (res) {
                    for(var j=0;j<$scope.chartMsgs.length;j++){
                        $scope.chartMsgs = [];
                    }
                });
            };


            $scope.delData = function () {
                var selectUsers = $scope.gridApi.selection.getSelectedGridRows();
                selectUsers.forEach(function (deluser) {
                        deluser.entity.remove().then(function (res) {
                            if (res.success) {
                                //$scope.gridOptions.data = _.without($scope.gridOptions.data, deluser.entity);
                                showMsg(res.messages.toString(), '信息', 'lime');
                            }
                            else {
                                showMsg(res.errors.toString(), '错误', 'ruby');
                            }
                        });
                    }
                );
            };


        }
    ]
)
;
