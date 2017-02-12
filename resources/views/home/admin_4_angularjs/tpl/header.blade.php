<!-- BEGIN HEADER INNER -->
<div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
        <a ui-sref="dashboard">
            <img src="@{{settings.layoutPath}}/img/logo-light.png" alt="资产管理系统" class="logo-default"/>
            <!----155*25 PNG --->
            {{--<span class="text-logo bold uppercase">资产管理系统</span>--}}
        </a>
        <div class="menu-toggler sidebar-toggler">
            <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
        </div>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
       data-target=".navbar-collapse"> </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!----ADD COMMPANY LOGOPIC--->
    <div class="page-actions">
        <div class="btn-group">
{{--            <img src="@{{settings.layoutPath}}/img/commpany-logo.png" alt="公司logo" class="logo-default"/>--}}
            <!----330*30 PNG --->
        </div>
    </div>
    <!-- BEGIN PAGE ACTIONS -->
    <!-- DOC: Remove "hide" class to enable the page header actions -->
    {{--<div class="page-actions">--}}
    {{--<div class="btn-group">--}}
    {{--<button type="button" class="btn red-haze btn-sm dropdown-toggle" data-toggle="dropdown"--}}
    {{--data-hover="dropdown" data-close-others="true">--}}
    {{--<span class="hidden-sm hidden-xs">Actions&nbsp;</span>--}}
    {{--<i class="fa fa-angle-down"></i>--}}
    {{--</button>--}}
    {{--<ul class="dropdown-menu" role="menu">--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<i class="icon-docs"></i> New Post </a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<i class="icon-tag"></i> New Comment </a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<i class="icon-share"></i> Share </a>--}}
    {{--</li>--}}
    {{--<li class="divider"></li>--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<i class="icon-flag"></i> Comments--}}
    {{--<span class="badge badge-success">4</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--<li>--}}
    {{--<a href="#">--}}
    {{--<i class="icon-users"></i> Feedbacks--}}
    {{--<span class="badge badge-danger">2</span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- END PAGE ACTIONS -->
    <!-- BEGIN PAGE TOP -->
    <div class="page-top">
        <!-- BEGIN HEADER SEARCH BOX -->
        <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
        {{--<form class="search-form" action="#" method="GET">--}}
        {{--<div class="input-group">--}}
        {{--<input type="text" class="form-control input-sm" placeholder="Search..." name="query">--}}
        {{--<span class="input-group-btn">--}}
        {{--<a href="javascript:;" class="btn submit">--}}
        {{--<i class="icon-magnifier"></i>--}}
        {{--</a>--}}
        {{--</span>--}}
        {{--</div>--}}
        {{--</form>--}}
        <!-- END HEADER SEARCH BOX -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="separator hide"></li>
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-notification dropdown-light" id="header_notification_bar" ng-click="checkNotifi()">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true" title="通知提醒">
                        <i class="icon-bell"></i>
                        <span class="badge badge-success"> @{{  dcBroadcast.length-ReadNotifiCnt }} </span>
                    </a>
                    <ul class="dropdown-menu" >
                        <li class="external">
                            <h3>
                                <span class="bold"> @{{  dcBroadcast.length-ReadNotifiCnt }} 条未读</span>通知</h3>
                            {{--<a href="#/profile/dashboard">view all</a>--}}
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                <li ng-repeat="sNotifi in dcBroadcast">
                                    <a href="javascript:;">
                                        <span class="time"> @{{  sNotifi.sNotifi.datetime }} </span>
                                        <span class="details">
                                            <span class="label label-sm label-icon label-warning">
                                                <i class="fa fa-bell-o"></i>
                                            </span> @{{  sNotifi.sNotifi.text }}  </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- END NOTIFICATION DROPDOWN -->
                <li class="separator hide"></li>
                <!-- BEGIN INBOX DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-inbox dropdown-light" id="header_inbox_bar">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true" title="消息提醒">
                        <i class="icon-envelope-open"></i>
                        <span class="badge badge-danger"> @{{ dcUserMsgs.length }} </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>你有
                                <span class="bold">@{{ dcUserMsgs.length }} 条新</span> 消息</h3>
                            <a href="#/profile/dashboard">view all</a>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                <li ng-repeat="messageitem in dcUserMsgs" >
                                    <a href="#">
                                        <span class="photo">
                                            <img src="../assets/layouts/layout4/img/avatar2.jpg" class="img-circle"
                                                 alt=""> </span>
                                        <span class="subject">
                                            <span class="from"> @{{ messageitem.sendername }} </span>
                                            <span class="time"> @{{ messageitem.created_at }}</span>
                                        </span>
                                        <span class="message"> @{{ messageitem.body }} </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- END INBOX DROPDOWN -->
                <li class="separator hide"></li>
                <!-- BEGIN TODO DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-tasks dropdown-light" id="header_task_bar">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true" title="事项提醒">
                        <i class="icon-calendar"></i>
                        <span class="badge badge-primary"> 3 </span>
                    </a>
                    <ul class="dropdown-menu extended tasks">
                        <li class="external">
                            <h3>You have
                                <span class="bold">12 pending</span> tasks</h3>
                            <a href="#/profile/dashboard">view all</a>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                <li>
                                    <a href="javascript:;">
                                        <span class="task">
                                            <span class="desc">New release v1.2 </span>
                                            <span class="percent">30%</span>
                                        </span>
                                        <span class="progress">
                                            <span style="width: 40%;" class="progress-bar progress-bar-success"
                                                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="task">
                                            <span class="desc">Application deployment</span>
                                            <span class="percent">65%</span>
                                        </span>
                                        <span class="progress">
                                            <span style="width: 65%;" class="progress-bar progress-bar-danger"
                                                  aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">65% Complete</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="task">
                                            <span class="desc">Mobile app release</span>
                                            <span class="percent">98%</span>
                                        </span>
                                        <span class="progress">
                                            <span style="width: 98%;" class="progress-bar progress-bar-success"
                                                  aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">98% Complete</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="task">
                                            <span class="desc">Database migration</span>
                                            <span class="percent">10%</span>
                                        </span>
                                        <span class="progress">
                                            <span style="width: 10%;" class="progress-bar progress-bar-warning"
                                                  aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">10% Complete</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="task">
                                            <span class="desc">Web server upgrade</span>
                                            <span class="percent">58%</span>
                                        </span>
                                        <span class="progress">
                                            <span style="width: 58%;" class="progress-bar progress-bar-info"
                                                  aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">58% Complete</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="task">
                                            <span class="desc">Mobile development</span>
                                            <span class="percent">85%</span>
                                        </span>
                                        <span class="progress">
                                            <span style="width: 85%;" class="progress-bar progress-bar-success"
                                                  aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">85% Complete</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="task">
                                            <span class="desc">New UI release</span>
                                            <span class="percent">38%</span>
                                        </span>
                                        <span class="progress progress-striped">
                                            <span style="width: 38%;" class="progress-bar progress-bar-important"
                                                  aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">38% Complete</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="separator hide"></li>
                <li class="dropdown dropdown-user dropdown-light">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true" title="当前用户">
                        <span class="username username-hide-on-mobile bold" style="text-align: left;"> @{{  dcUser.name }} </span>
                        <img alt="" class="img-circle" src="../assets/layouts/layout4/img/avatar9.jpg">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default" style="width: 60px;">
                        <li>
                            <a href="#/profile/dashboard">
                                <i class="icon-key"></i> 更改密码 </a>
                        </li>
                        <li>
                            <a href="#/sys-usersown.html">
                                <i class="icon-user"></i> 个人信息 </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-question"></i> 帮助中心
                            </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="#">
                                <i class="icon-lock"></i> 锁定屏幕 </a>
                        </li>
                        <li>
                            <a href="/logout">
                                <i class="icon-arrow-right"></i> 注销登录 </a>
                        </li>
                    </ul>

                </li>
                <!-- END TODO DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR DROPDOWN -->
                <li class="dropdown dropdown-extended quick-sidebar-toggler">
                    <span class="sr-only">Toggle Quick Sidebar</span>
                    <i class="icon-logout"></i>
                </li>
                <!-- END QUICK SIDEBAR DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END PAGE TOP -->
</div>
<!-- END HEADER INNER -->