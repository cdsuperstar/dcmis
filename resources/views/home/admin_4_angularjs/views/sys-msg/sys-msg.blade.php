<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="sysmsgCtrl">
    <div class="inbox">
        <div class="row">
            <div class="col-md-3">
                <div class="inbox-sidebar" style="border: 1px solid #e7ecf1;">
                    <div class="form-group">
                        <a href="javascript:;" data-title="人员列表" class="btn green compose-btn btn-block">
                            <i class="icon-users"></i> 会话列表 </a>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="搜索..." ng-model="tmpsearch">
                    </div>
                    <ul class="inbox-nav scroller" style="height: 465px;margin-top:5px; ">
                        <li ng-class="{active: activesign == x.id}" ng-repeat="x in people | filter:tmpsearch | orderBy : 'name'" ng-if="x.id != dcUser.id">
                            <a href="javascript:;" ng-click="showmsg(x.id)">
                                <span aria-hidden="true" class="icon-user"></span>&nbsp;
                                @{{x.name}}
                                <span class="badge badge-danger" ng-show="x.unread > 0"> @{{x.unread}} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="inbox-body" style="border: 1px solid #e7ecf1;padding: 15px;">
                    <div class="inbox-header">
                        <div class="form-group" style="margin-bottom: 80px;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <textarea class="form-control" id="msgcontent" name="msgcontent" rows="3" ng-model="sendMsgcontent" maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="请输入发送消息内容（1000字以内）"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <button type="button"  class="emotion btn yellow" title="插入表情"><i class="icon-emoticon-smile"></i></button>
                                <button type="button" class="btn red" title="删除消息记录" confirmation-needed="确定要删除当前会话的所有消息记录吗？" ng-click="delALLchartdata()"><i class="fa fa-trash"></i> 清空 </button>
                                <div class="pull-right">
                                    <button type="button" class="btn green" title="发送当前消息" ng-click="sendMsg()"><i class="icon-paper-plane"></i> 发送 </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div id="speecscroll" class="spscroller" style="height: 450px; width: 100%;margin-top: 15px; background-color:#fdfaf7 ;border-radius:4px;padding-right: 8px;">
                                    <div ng-class="m.recver_id == dcUser.id ? 'leftd':'rightd'" ng-repeat="m in chartMsgs">
                                        <div class="rightimg" ng-if = "m.recver_id == dcUser.id">
                                            <strong>@{{ m.sendername }}</strong> [@{{ m.created_at }}]
                                        </div>
                                        <div class="leftimg" ng-if = "m.sender_id == dcUser.id">
                                            <strong>@{{ m.sendername }}</strong> [@{{ m.created_at }}]
                                        </div>
                                        <div ng-class="m.recver_id == dcUser.id ? 'speech left':'speech right'" ng-bind-html="replace_em(m.body)">
                                            <div ng-class="m.recver_id == dcUser.id ? 'rightimg':'leftimg'" class="leftimg"><a href="javascript:;" title="删除此条记录" confirmation-needed="确定要删除此条消息记录吗？" ng-click="delchartdata(m.id)"><i class="fa fa-trash"></i> </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('.emotion').qqFace({
            assign:'msgcontent', //给输入框赋值
            path:'/css/arclist/'    //表情图片存放的路径
        });
//        $(".sub_btn").click(function(){
//
//            var str = $("#saytext").val();
//
//            $("#show").html(replace_em(str));
//
//        });
    });

        //查看结果

//        function replace_em(str){
//
//            str = str.replace(/\</g,'&lt;');
//
//            str = str.replace(/\>/g,'&gt;');
//
//            str = str.replace(/\n/g,'<br/>');
//
//            str = str.replace(/\[em_([0-9]*)\]/g,'<img src="arclist/$1.gif" border="0" />');
//
//            return str;
//
//        }

</script>