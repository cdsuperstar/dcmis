<!-- BEGIN PAGE -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit"></i> [{{ $title }}]
                </div>
                <div class="tools">
                    <a href="" class="reload">
                    </a>
                    <a href="" class="collapse">
                    </a>
                    <a href="" class="remove" ng-click="closeThisDialog(dcEdition)">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="portlet light">
                    <div class="portlet-body form">
                        <form role="form" name="dcEditionFm" class="form-horizontal" id="">
                            <div class="form-body">
                            @foreach($fields as $field=>$fieldval)
                                    @include('assets.widgets.'.$field)
                                @endforeach
                            </div>
                            <div>
                                <div class="row">

                                <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-12 ngdialog-buttons">
                                        <button type="button" class="btn blue" ng-click="confirm(dcEdition)" ng-disabled="dcEditionFm.$invalid"> - 确定保存 -</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="button" class="btn yellow" ng-click="closeThisDialog(dcEdition)"> - 取消保存 -</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE -->