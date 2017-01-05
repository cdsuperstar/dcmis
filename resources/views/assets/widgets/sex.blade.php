<div class="form-group form-md-line-input">
    <label class="col-md-2 control-label">性别</label>
    <div class="col-md-10">
        <select id="dcMultiselect1" name="sex" class="form-control select2" ng-model="dcEdition.sex" placeholder="请选择数据...">
            <option value="1" ng-selected="dcEdition.sex==1">男</option>
            <option value="0" ng-selected="dcEdition.sex==0">女</option>
        </select>
        <div class="form-control-focus">
        </div>
        <span class="help-block">请对应选择合适的选项;</span>
    </div>
</div>