<div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN: ACCORDION DEMO -->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="icon-settings font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> 发送消息 </span>
                    </div>
                    <div class="tools">
                        <a href="" class="fullscreen"> </a>
                    </div>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-md-3 control-label"> 接收者 </label>
                        <div class="col-md-8">
                            <ui-select multiple
                                       ng-model="multiplePeple.selectedPeople" title="请选择接收者">
                                <ui-select-match placeholder="请选择接收者...">@{{$item.name}} - @{{$item.depart}}</ui-select-match>
                                <ui-select-choices group-by="'depart'" repeat="person in people | filter:{name: $select.search.name,ykth: $select.search.ykth}">
                                    <span ng-bind-html="person.name | highlight: $select.search"></span>
                                    <small ng-bind-html="person.ykth | highlight: $select.search"></small>
                                </ui-select-choices>
                            </ui-select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> 消息内容 </label>
                        <div class="col-md-8">
                            <textarea name="xmjj" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 91px;"  ng-model="dcEdition.content" maxlength="1000" onchange="this.value=this.value.substring(0, 1000)" onkeydown="this.value=this.value.substring(0, 1000)" onkeyup="this.value=this.value.substring(0, 1000)" placeholder="请输入消息内容（1000字以内）"></textarea>
                        </div>
                    </div>
                    <div class="form-group" align="center">
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <a href="javascript:;" class="btn green" ng-click="confirm(dcEdition)" ng-disabled="dcEditionFm.$invalid">
                                <i class="fa fa-check"></i>  发 送 </a>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <a href="javascript:;" class="btn purple-plum" ng-click="closeThisDialog(dcEdition)">
                                <i class="icon-reload"></i>  取 消  </a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END: ACCORDION DEMO -->
        </div>
    </div>
</div>
