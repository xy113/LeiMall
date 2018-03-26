<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>登录</title>
    <meta name="keywords" content="{$_G[keywords]}">
    <meta name="description" content="{$_G[description]}">
    <link rel="icon" href="/static/images/common/favicon.png">
    <link rel="stylesheet" type="text/css" href="/static/css/account.css">
    <script src="/static/js/jquery.js" type="text/javascript"></script>
    <script src="/static/js/common.js" type="text/javascript"></script>
    <script src="/static/js/jquery.form.js" type="text/javascript"></script>
    <script src="/static/js/jquery.dsxui.js" type="text/javascript"></script>
</head>
<body>
<div id="ajaxlogin">
    <form method="post" id="loginForm" autocomplete="off" action="{U:('m=account&c=login&a=chklogin')}">
        <input type="hidden" name="formhash" value="{FORMHASH}">
        <div class="input-box">
            <i class="iconfont icon-my"></i>
            <input type="text" class="text" name="account_{FORMHASH}" placeholder="登录名/手机号/邮箱" maxlength="50" id="account">
        </div>
        <div class="input-box">
            <i class="iconfont icon-lock"></i>
            <input type="password" class="text" name="password_{FORMHASH}" placeholder="登录密码" id="password">
        </div>
        <div class="input-box">
            <i class="iconfont icon-attention_light"></i>
            <input type="text" class="text" name="captchacode" placeholder="验证码" maxlength="4" style="width: 160px;" id="captcha">
            <img src="/index.php?m=plugin&c=captcha" onclick="this.src='/index.php?m=plugin&c=captcha&'+Math.random()" title="看不清，换一张" class="captcha">
        </div>
        <input type="submit" class="login-button" value="登录">
        <div class="line">
            <a>忘记密码</a>
            <a href="{U:('m=account&c=register')}" target="_top">免费注册</a>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function () {
        function checkLogin() {
            var account = $("#account").val();
            if(!DSXValidate.IsUserName(account) && !DSXValidate.IsMobile(account) && !DSXValidate.IsEmail(account)){
                DSXUI.error('账号输入错误');
                return false;
            }
            var password = $("#password").val();
            if(!DSXValidate.IsPassword(password)){
                DSXUI.error('密码错误');
                return false;
            }
            var captcha = $("#captcha").val();
            if(captcha.length != 4){
                DSXUI.error('验证码错误');
                return false;
            }
            $.ajax({
                type:'POST',
                url:"{U:('m=account&c=login&a=chklogin&inajax=1')}",
                async:false,
                dataType:"json",
                data:$("#loginForm").serializeArray(),
                success: function(json){
                    if(json.errcode == 0){
                        if (parent.window.afterLogin){
                            parent.window.afterLogin(json);
                        }
                    }else {
                        $(".captcha").attr('src','/index.php?m=common&c=captcha&'+Math.random());
                        DSXUI.error(json.errmsg);
                    }
                }
            });
            return false;
        }
        $("#loginForm").on('submit', checkLogin);
    });
</script>
</body>
</html>
