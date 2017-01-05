<div class="form-group form-md-line-input">
    <label class="col-md-2 control-label">是否显示菜单</label>
    <div class="col-md-10">
        <select name="ismenu" class="form-control select2" ng-model="dcEdition.ismenu" placeholder="请选择是否显示...">
            <option value="1" ng-selected="dcEdition.ismenu==1">显示</option>
            <option value="0" ng-selected="dcEdition.ismenu==0">隐藏</option>
        </select>
        <div class="form-control-focus">
        </div>
        <span class="help-block">请对应选择合适的选项;</span>
    </div>
</div>