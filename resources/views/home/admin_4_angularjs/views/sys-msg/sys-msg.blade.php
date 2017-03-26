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
                    <ul class="inbox-nav scroller" style="height: 470px;margin-top:5px; ">
                        <li class="" ng-repeat="x in people | filter:tmpsearch | orderBy : 'name'">
                            <a href="javascript:;" data-type="inbox" data-title="Inbox"> @{{x.name}}
                                <span class="badge badge-danger"> 3 </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="inbox-body" style="border: 1px solid #e7ecf1;padding: 15px;">
                    <div class="inbox-header">
                        <div class="form-group">
                            <label class="col-md-1 control-label bold" style="margin-top: 22px;"> 内 容 </label>
                            <div class="col-md-11">
                                <textarea class="form-control" id="msgcontent" name="msgcontent" rows="3" ng-model="dcEdition.content" maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="请输入消息内容（1000字以内）"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12" style="margin-top: 10px;padding-left:1px;">
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <button type="button" class="btn purple-plum" title="群发消息" ng-click="addData()"><i class="icon-plane"></i> 群发 </button>
                                    <button type="button" class="btn red" title="删除消息记录" confirmation-needed="确定要删除当前会话的所有消息记录吗？" ng-click="delData()"><i class="fa fa-trash"></i> 清空 </button>
                                    <button type="button"  class="emotion btn yellow" title="插入表情"><i class="icon-emoticon-smile"></i></button>
                                </div>
                                <div class="col-md-1 col-sm-3 col-xs-3 pull-right" style="padding-right: 5px;">
                                    <button type="button" class="btn green" title="发送当前消息"><i class="icon-paper-plane"></i> 发送 </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div id="speecscroll" class="spscroller" style="height: 450px; overflow: auto; width: auto;margin-top: 15px; background-color:#f5f8fd ;border-radius:4px;">

                                    <div class="leftd">
                                        <div class="speechtime">2017-02-10 10:42</div>
                                        <div class="leftimg"><strong>张三</strong> </div>
                                        <div class="speech left" >
                                            你好!在晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!
                                        </div>
                                        <div class="leftimg"><a href="javascript:;" title="删除此条记录" confirmation-needed="确定要删除此条消息记录吗？"><i class="fa fa-trash"></i> </a></div>
                                    </div>
                                    <div class="rightd">
                                        <div class="speechtime">2017-02-10 10:42</div>
                                        <div class="rightimg"><strong>李四</strong> </div>
                                        <div class="speech right" >
                                            请把资料准备好!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上
                                        </div>
                                        <div class="rightimg"><a href="javascript:;" title="删除此条记录" confirmation-needed="确定要删除此条消息记录吗？"><i class="fa fa-trash"></i> </a></div>
                                    </div>
                                    <div class="leftd">
                                        <div class="speechtime">2017-02-10 10:42</div>
                                        <div class="leftimg"><strong>张三</strong> </div>
                                        <div class="speech left" >
                                            你好!在晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!
                                        </div>
                                        <div class="leftimg"><a href="javascript:;" title="删除此条记录" confirmation-needed="确定要删除此条消息记录吗？"><i class="fa fa-trash"></i> </a></div>
                                    </div>
                                    <div class="rightd">
                                        <div class="speechtime">2017-02-10 10:42</div>
                                        <div class="rightimg"><strong>李四</strong> </div>
                                        <div class="speech right" >
                                            请把资料准备好!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上
                                        </div>
                                        <div class="rightimg"><a href="javascript:;" title="删除此条记录" confirmation-needed="确定要删除此条消息记录吗？"><i class="fa fa-trash"></i> </a></div>
                                    </div>
                                    <div class="leftd">
                                        <div class="speechtime">2017-02-10 10:42</div>
                                        <div class="leftimg"><strong>张三</strong> </div>
                                        <div class="speech left" >
                                            你好!在晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!
                                        </div>
                                        <div class="leftimg"><a href="javascript:;" title="删除此条记录" confirmation-needed="确定要删除此条消息记录吗？"><i class="fa fa-trash"></i> </a></div>
                                    </div>
                                    <div class="rightd">
                                        <div class="speechtime">2017-02-10 10:42</div>
                                        <div class="rightimg"><strong>李四</strong> </div>
                                        <div class="speech right" >
                                            请把资料准备好!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上
                                        </div>
                                        <div class="rightimg"><a href="javascript:;" title="删除此条记录" confirmation-needed="确定要删除此条消息记录吗？"><i class="fa fa-trash"></i> </a></div>
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

    //    //查看结果
    //
    //    function replace_em(str){
    //
    //        str = str.replace(/\</g,'&lt;');
    //
    //        str = str.replace(/\>/g,'&gt;');
    //
    //        str = str.replace(/\n/g,'<br/>');
    //
    //        str = str.replace(/\[em_([0-9]*)\]/g,'<img src="arclist/$1.gif" border="0" />');
    //
    //        return str;
    //
    //    }

</script>