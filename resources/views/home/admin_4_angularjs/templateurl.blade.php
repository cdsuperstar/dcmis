<!-- BEGIN PAGE HEADER-->
{{--<div class="page-bar">--}}
    {{--<ul class="page-breadcrumb breadcrumb">--}}
        {{--<li>--}}
            {{--<a ui-sref="dashboard">主页</a>--}}
            {{--@foreach($aTitle as $title)--}}
                {{--<i class="fa fa-circle"></i>--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<a href="#">{{ $title }}</a>--}}
            {{--@endforeach--}}
        {{--</li>--}}
    {{--</ul>--}}
{{--</div>--}}
<!-- END PAGE HEADER-->
@include('home.'.$layout.'.views.'.$sModel.'.'.$sModel)


