<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a ui-sref="dashboard">主页</a>
            @foreach($aTitle as $title)
                <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">{{ $title }}</a>
            @endforeach
        </li>
    </ul>

    <!--
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown"
                    data-hover="dropdown" data-delay="1000" data-close-others="true">
                选 项 <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">
                        <i class="icon-envelope-open"></i> 新消息 </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-calendar"></i> 新便签 <span class="badge badge-success">4</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    -->
</div>
<!-- END PAGE HEADER-->
@include('home.'.$layout.'.views.'.$sModel.'.'.$sModel)


