<div class="portlet-body" data-ng-controller="budgetmanagementCtrl">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-md-2 control-label">年度</label>
            <div class="col-md-4">
                <ui-select ng-model="budget.syear" theme="bootstrap">
                    <ui-select-match placeholder="选择年度...">@{{$select.selected}}</ui-select-match>
                    <ui-select-choices repeat="tmparr in tyear | filter: $select.search">
                        @{{tmparr}}
                    </ui-select-choices>
                </ui-select>
            </div>
            <label class="col-md-2 control-label">预算类别</label>
            <div class="col-md-4">
                <ui-select ng-model="budget.classlistName">
                    <ui-select-match placeholder="选择类别...">@{{$select.selected.name}}</ui-select-match>
                    <ui-select-choices
                            repeat="tmplist.id as tmplist in listnames track by tmplist.id">
                        @{{tmplist.name}}
                    </ui-select-choices>
                </ui-select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">预算部门</label>
            <div class="col-md-4">
                <ui-select ng-model="budget.untigrps">
                    <ui-select-match placeholder="选择部门...">@{{$select.selected.name}}</ui-select-match>
                    <ui-select-choices
                            repeat="category.id as category in untigrps track by category.id">
                        @{{category.name}}
                    </ui-select-choices>
                </ui-select>
            </div>
            <label class="col-md-2 control-label">总金额</label>
            <div class="col-md-4">
                <div class="input-icon right">
                    <i class="fa fa-warning tooltips font-red" data-original-title="必填项" data-container="body"></i>
                    <input type="number" class="form-control" ng-model="budget.total" placeholder="¥0.00">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-3 col-md-2 col-sm-6 col-xs-6">
                <a href="javascript:;" class="btn green" ng-click="savedata()">
                    <i class="fa fa-save"></i> 设 置 </a>
            </div>
        </div>
    </form>
</div>

<SCRIPT LANGUAGE="JavaScript">
    window.onload = function()
    {
        var sel = document.createElement('select');
        var date = new Date();
        for(var i=0;i<5;i++)
        {
            var opt = document.createElement("option");
            opt.value = i;
            opt.innerHTML = (date.getYear()-i-1)+"-"+(date.getYear()-i);
            sel.appendChild(opt);
        }
        document.body.appendChild(sel);
    }
</SCRIPT>