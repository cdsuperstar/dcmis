<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200"
        ng-class="{'page-sidebar-menu-closed': settings.layout.pageSidebarClosed}">
        <li class="heading">
            <h3>GENERAL</h3>
        </li>
        <li class="start nav-item">
            <a ui-sref="dashboard">
                <i class="icon-home"></i>
                <span class="title">Dashboard1</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;">
                <i class="icon-settings"></i>
                <span class="title">AngularJS Features</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a ui-sref="uibootstrap">
                        <i class="icon-puzzle"></i> UI Bootstrap</span>
                    </a>
                </li>
                <li>
                    <a ui-sref="fileupload">
                        <i class="icon-paper-clip"></i> File Upload</span>
                    </a>
                </li>
                <li>
                    <a ui-sref="uiselect">
                        <i class="icon-check"></i> UI Select</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="javascript:;">
                <i class="icon-wrench"></i>
                <span class="title">jQuery Plugins</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a ui-sref="formtools">
                        <i class="icon-puzzle"></i> Form Tools </a>
                </li>
                <li>
                    <a ui-sref="pickers">
                        <i class="icon-calendar"></i> Date & Time Pickers </a>
                </li>
                <li>
                    <a ui-sref="dropdowns">
                        <i class="icon-refresh"></i> Custom Dropdowns </a>
                </li>
                <li>
                    <a ui-sref="tree">
                        <i class="icon-share"></i> Tree View </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-briefcase"></i> Datatables
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a ui-sref="datatablesmanaged">
                                <i class="icon-tag"></i> Managed Datatables </a>
                        </li>
                        <li>
                            <a ui-sref="datatablesajax">
                                <i class="icon-refresh"></i> Ajax Datatables </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a ui-sref="profile.dashboard" id="sidebar_menu_link_profile">
                <i class="icon-user"></i>
                <span class="title">User Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a ui-sref="todo">
                <i class="icon-check"></i>
                <span class="title">Task & Todo</span>
            </a>
        </li>
        <li class="nav-item">
            <a ui-sref="blank">
                <i class="icon-refresh"></i>
                <span class="title">Blank Page</span>
            </a>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>