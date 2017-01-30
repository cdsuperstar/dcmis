<div class="page-sidebar navbar-collapse collapse" style="margin-top: 10px;">
    <script type="text/ng-template" id="categoryTree">
        <a href="#@{{ ::tree.dcmodel.url }}" ng-if="::tree.children.length==0">
            <i class="@{{ ::tree.dcmodel.icon }}"></i>
            <span class="title">@{{ ::tree.dcmodel.title }}</span>
        </a>
        <a href="javascript:;" ng-if="::tree.children.length>0">
            <i class="@{{ ::tree.dcmodel.icon }}"></i>
            <span class="title">@{{ ::tree.dcmodel.title }}</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu" ng-if="::tree.children.length>0" ng-class="">
            <li ng-repeat="tree in ::tree.children" ng-include="'categoryTree'">
            </li>
        </ul>
    </script>
        <ul ng-repeat="tree in ::mdTreeJson " class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" ng-class="{'page-sidebar-menu-closed': settings.layout.pageSidebarClosed}">
            {{--<li class="heading">--}}
                {{--<h3>菜单栏</h3>--}}
            {{--</li>--}}
            <li class="sidebar-search-wrapper">
            </li>
            <li ng-repeat="tree in ::tree.children" ng-include="'categoryTree'"></li>
        </ul>
</div>