<div class="form-group form-md-line-input">
    <label class="col-md-2 control-label">select2属性名</label>
    <div class="col-md-10">
        <select id="dcMultiselect2"  ng-model="dcEdition.role" class="form-control select2" multiple>
            <option value="amdin">管理员</option>
            <option value="admin1">管理员1</option>
            <option value="admin2">管理员2</option>
            <option value="admin3">管理员3</option>
        </select>
    </div>
</div>
<script type="text/javascript">
    $('#dcMultiselect2').select2({
        placeholder: "请选择数据...",
        allowClear: true
    });
</script>
