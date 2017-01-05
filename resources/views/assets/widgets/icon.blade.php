<div class="form-group form-md-line-input">
    <label class="col-md-2 control-label" for="name">图标</label>
    <div class="col-md-10">
        <input type="text" name="icon" class="form-control" ng-model="dcEdition.icon" validation="{{ $fieldval }}" placeholder="请输入图标代码">
        <i class="{{ $fieldval }}"></i>
        <div class="form-control-focus">
        </div>
    </div>
</div>