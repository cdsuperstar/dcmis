<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"><!--<![endif]--><!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <title>系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="login " name="description">
    <meta content="" name="author">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="/css/gg/gg.css" rel="stylesheet" type="text/css">
    <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
          type="text/css">
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css">
    <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="../assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico">
</head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="index.html">
        <img src="../assets/pages/img/logo-big.png" alt=""> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="{{ url('/login') }}" method="POST" novalidate="novalidate">
        {{ csrf_field() }}
        <h3 class="form-title">登录到您的账号</h3>

        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password. </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">用户名</label>

            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="邮箱"
                       name="email"></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">密码</label>

            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="密码"
                       name="password"></div>
        </div>
        <div class="form-actions">
            <label class="rememberme mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" value="1">记住我 <span></span>
            </label>
            <button type="submit" class="btn green pull-right">登录</button>
        </div>
        <div class="login-options">
            <h4>或者用以下登录方式</h4>
            <ul class="social-icons">
                <li>
                    <a class="facebook" data-original-title="微信" href="javascript:;"> </a>
                </li>


            </ul>
        </div>
        <div class="forget-password">
            <h4>忘记密码了？</h4>

            <p> 没关系, 点击
                <a href="javascript:;" id="forget-password">这里</a>来重置您的密码。</p>
        </div>
        <div class="create-account">
            <p>还没有登录帐户？<a href="javascript:;" id="register-btn">建立一个帐户</a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="index.html" method="post" novalidate="novalidate">
        <h3>Forget Password ?</h3>

        <p> Enter your e-mail address below to reset your password. </p>

        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email"
                       name="email"></div>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn red btn-outline">Back</button>
            <button type="submit" class="btn green pull-right"> Submit</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="{{url('/register')}}" method="post" novalidate="novalidate">
        {{ csrf_field() }}

        <h3>注册</h3>

        <p>请输入您帐户的注册信息: </p>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">姓名</label>

            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="姓名" name="name"></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>

            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="用户名（邮箱）"
                       name="email"></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">密码</label>

            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix valid" type="password" autocomplete="off"
                       id="register_password" placeholder="密码" name="password"
                       data-com.agilebits.onepassword.user-edited="yes" aria-required="true" aria-invalid="false"
                       aria-describedby="register_password-error"></div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>

            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix valid" type="password" autocomplete="off"
                           placeholder="重新输入您的密码" name="password_confirmation"
                           data-com.agilebits.onepassword.user-edited="yes" aria-invalid="false"
                           aria-describedby="rpassword-error"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="tnc">我同意
                <a href="javascript:;">服务条款</a> &amp;
                <a href="javascript:;">隐私权政策</a>
                <span></span>
            </label>

            <div id="register_tnc_error"></div>
        </div>
        <div class="form-actions">
            <button id="register-back-btn" type="button" class="btn red btn-outline">返回</button>
            <button type="submit" id="register-submit-btn" class="btn green pull-right">注册</button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> 2017 © DozenCat team.</div>
<!-- END COPYRIGHT -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../assets/pages/scripts/login-4.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->


<div class="backstretch"
     style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 352px; width: 1440px; z-index: -999999; position: fixed;">
    <img style="position: absolute; margin: 0px; padding: 0px; border: none; width: 1440px; height: 1080.38px; max-height: none; max-width: none; z-index: -999999; left: 0px; top: -364.191px;"
         src="../assets/pages/media/bg/1.jpg"></div>
</body>
</html>