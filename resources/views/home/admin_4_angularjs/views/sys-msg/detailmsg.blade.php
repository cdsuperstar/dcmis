<!-- BEGIN MAIN CONTENT -->
<div class="portlet-body" data-ng-controller="sysmsgCtrl">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;">
        <div class="comment">
            <div class="com_form">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button"  class="emotion btn yellow" title="添加表情"><i class="icon-emoticon-smile"></i></button>
                    </div>
                    <textarea class="form-control" id="msgcontent" name="msgcontent" rows="1" ng-model="dcEdition.content" maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="请输入消息内容（1000字以内）"></textarea>
                    <div class="input-group-btn">
                        <button type="button" class="btn green" title="发送"><i class="icon-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div id="speecscroll" class="spscroller" style="height: 400px; overflow: auto; width: auto;">

            <div class="leftd">
                <div class="speechtime">2017-02-10 10:42</div>
                <div class="leftimg"><strong>张三</strong> </div>
                <div class="speech left" >
                    你好!在晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!
                </div>
            </div>
            <div class="rightd">
                <div class="speechtime">2017-02-10 10:42</div>
                <div class="rightimg"><strong>李四</strong> </div>
                <div class="speech right" >
                    请把资料准备好!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上
                </div>
            </div>
            <div class="leftd">
                <div class="speechtime">2017-02-10 10:42</div>
                <div class="leftimg"><strong>张三</strong> </div>
                <div class="speech left" >
                    你好!在晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!
                </div>
            </div>
            <div class="rightd">
                <div class="speechtime">2017-02-10 10:42</div>
                <div class="rightimg"><strong>李四</strong> </div>
                <div class="speech right" >
                    请把资料准备好!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上
                </div>
            </div>
            <div class="leftd">
                <div class="speechtime">2017-02-10 10:42</div>
                <div class="leftimg"><strong>张三</strong> </div>
                <div class="speech left" >
                    你好!在晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!
                </div>
            </div>
            <div class="rightd">
                <div class="speechtime">2017-02-10 10:42</div>
                <div class="rightimg"><strong>李四</strong> </div>
                <div class="speech right" >
                    请把资料准备好!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上好!我在!明天早上8点要开会!晚上
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
