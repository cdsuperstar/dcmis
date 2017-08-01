<!-- BEGIN PAGE TITLE -->
<div class="row">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="@{{$state.current.icon.pageIcon}} font-dark"></i>
                <span class="caption-subject bold uppercase" data-ng-bind="$state.current.data.pageTitle"></span>
            </div>
            <div class="tools">
                <!-- BEGIN THEME PANEL -->
                <div class="btn-group btn-theme-panel">
                    <a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-settings"></i>
                    </a>

                    <div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
                        <div class="row" style="margin-left: 5px;">
                            <ul class="nav nav-tabs">
                                {{--<li class="">--}}
                                    {{--<a href="#" ng-click="navmodelhelp()"><i class="icon-question"></i>　模块帮助　</a>--}}
                                {{--</li>--}}
                                {{--<li class="">--}}
                                    {{--<a href="#" ng-click="navmodelset()"><i class="icon-wrench"></i>　模块设置　</a>--}}
                                {{--</li>--}}
                                <li class="">
                                    <a href="#" ng-click="navthemeset()"><i class="icon-disc"></i>　主题设置　</a>
                                </li>
                            </ul>
                        </div>
                        {{--<div uib-collapse="isnavmodelhelp" class="row">--}}
                            {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                                {{--<div>--}}
                                    {{--模块帮助Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table--}}
                                    {{--craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar--}}
                                    {{--helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art--}}
                                    {{--party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div uib-collapse="isnavmodelset" class="row">--}}
                            {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                                {{--<div>--}}
                                    {{--模块设置Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table--}}
                                    {{--craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar--}}
                                    {{--helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art--}}
                                    {{--party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div uib-collapse="isnavthemeset" class="row">
                            <form id="themeset" role="form">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <h3>主题颜色</h3>
                                <ul class="theme-colors">
                                    <li class="theme-color theme-color-default" ng-class="{active: themeset.themecolor == 'black'}" data-theme="default">
                                        <span class="theme-color-view"></span>
                                        <span class="theme-color-name">黑色</span>
                                    </li>
                                    <li class="theme-color theme-color-light" ng-class="{active: themeset.themecolor == 'white'}" data-theme="light">
                                        <span class="theme-color-view"></span>
                                        <span class="theme-color-name">白色</span>
                                    </li>
                                </ul>
                                <div class="btn-group" style="margin-top: 180px; margin-left: 30px;">
                                    <button type="button"  class="btn btn-circle btn-info" ng-click="savetheme()">　保存设置　</button>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12 seperator">
                                <h3>页面样式</h3>
                                <ul class="theme-settings">
                                    <li> 主题样式
                                        <select class="layout-style-option form-control input-small input-sm" ng-model="themeset.layoutstyleoption">
                                            <option value="square" ng-selected="themeset.layoutstyleoption == 'square'">　方形　</option>
                                            <option value="rounded" ng-selected="themeset.layoutstyleoption == 'rounded'">　圆形　</option>
                                        </select>
                                    </li>
                                    <li> 布局设置
                                        <select class="layout-option form-control input-small input-sm" ng-model="themeset.layoutoption">
                                            <option value="fluid" ng-selected="themeset.layoutoption == 'fluid'">适应屏幕</option>
                                            <option value="boxed" ng-selected="themeset.layoutoption == 'boxed'">适应窗口</option>
                                        </select>
                                    </li>
                                    <li> 标题栏置顶
                                        <select class="page-header-option form-control input-small input-sm" ng-model="themeset.pageheaderoption">
                                            <option value="fixed" ng-selected="themeset.pageheaderoption == 'fixed'">　固定　</option>
                                            <option value="default" ng-selected="themeset.pageheaderoption == 'default'">　默认　</option>
                                        </select>
                                    </li>
                                    <li> 顶部菜单
                                        <select class="page-header-top-dropdown-style-option form-control input-small input-sm" ng-model="themeset.pageheadertopdropdownstyleoption">
                                            <option value="light" ng-selected="themeset.pageheadertopdropdownstyleoption == 'light'">　明亮　</option>
                                            <option value="dark" ng-selected="themeset.pageheadertopdropdownstyleoption == 'dark'">　昏暗　</option>
                                        </select>
                                    </li>
                                    <li> 菜单栏置顶
                                        <select class="sidebar-option form-control input-small input-sm" ng-model="themeset.sidebaroption">
                                            <option value="fixed" ng-selected="themeset.sidebaroption == 'fixed'">　固定　</option>
                                            <option value="default" ng-selected="themeset.sidebaroption == 'default'">　默认　</option>
                                        </select>
                                    </li>
                                    <li> 菜单样式
                                        <select class="sidebar-menu-option form-control input-small input-sm" ng-model="themeset.sidebarmenuoption">
                                            <option value="accordion" ng-selected="themeset.sidebarmenuoption == 'accordion'">向下展开</option>
                                            <option value="hover" ng-selected="themeset.sidebarmenuoption == 'hover'">右侧显示</option>
                                        </select>
                                    </li>
                                    <li> 菜单页面位置
                                        <select class="sidebar-pos-option form-control input-small input-sm" ng-model="themeset.sidebarposoption">
                                            <option value="left" ng-selected="themeset.sidebarposoption == 'left'">　左侧　</option>
                                            <option value="right" ng-selected="themeset.sidebarposoption == 'right'">　右侧　</option>
                                        </select>
                                    </li>
                                    <li> 页面底部
                                        <select class="page-footer-option form-control input-small input-sm" ng-model="themeset.pagefooteroption">
                                            <option value="fixed" ng-selected="themeset.pagefooteroption == 'fixed'">　固定　</option>
                                            <option value="default" ng-selected="themeset.pagefooteroption == 'default'">　默认　</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END THEME PANEL -->
            </div>
        </div>
        <div ui-view class="fade-in-up"></div>
    </div>
</div>

<!-- END PAGE TITLE -->


