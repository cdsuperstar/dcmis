<div class="form-group form-md-line-input">
    <label class="col-md-2 control-label">日期区间</label>
    <div class="col-md-10">
        <div class="input-group date-picker input-daterange" data-date-format="yyyy-mm-dd">
            <input type="text" class="form-control" name="from" style="text-align:left; vertical-align:middle" ng-model="dcEdition.startdate" validation="{{ $fieldval }}" placeholder="请选择日期&时间" >
            <div class="form-control-focus">
            </div>
                <span class="input-group-addon">
                to </span>
            <input type="text" class="form-control" name="to" style="text-align:left; vertical-align:middle" ng-model="dcEdition.enddate" validation="{{ $fieldval }}" placeholder="请选择日期&时间" >
            <div class="form-control-focus">
            </div>
        </div>
        <div class="form-control-focus">
        </div>
    </div>
</div>