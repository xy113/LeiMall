@extends('layouts.user')

@section('title', '账户安全')

@section('content')
    <div class="console-title">
        <h2>账户安全</h2>
    </div>
    <div id="userinfo-table-wrap">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="formtable">
            <tbody>
            <tr>
                <td width="100">用户名</td>
                <td width="340">{{$user['username']}}</td>
                <td></td>
            </tr>
            <tr>
                <td width="100">账号ID</td>
                <td width="340">{{$user['uid']}}</td>
                <td></td>
            </tr>
            <tr>
                <td>手　机</td>
                @if($user['mobile'])
                    <td>{{$user['mobile']}}</td>
                    <td><a class="a-bind-link" id="a-bind-mobile">更换手机号</a></td>
                @else
                    <td>没有绑定手机号</td>
                    <td><a class="a-bind-link" id="a-bind-mobile">绑定手机号</a></td>
                @endif
            </tr>
            <tr>
                <td>邮　箱</td>
                @if($user['email'])
                    <td>{{$user['email']}}</td>
                    <td><a class="a-bind-link" id="a-bind-email">更换邮箱</a></td>
                @else
                    <td>没有绑定邮箱</td>
                    <td><a class="a-bind-link" id="a-bind-email">定新邮箱</a></td>
                @endif
            </tr>
            <tr>
                <td>密　码</td>
                <td>******</td>
                <td><a class="a-bind-link" id="a-modi-password">修改密码</a></td>
            </tr>
            </tbody>
        </table>
    </div>

    <script type="text/x-template" id="J-bind-mobile-tpl">
        <div style="padding:20px;">
            <form method="post" id="J-bind-mobile-form" action="{{url('/user/settings/bindemail')}}">
                {{csrf_field()}}
                <input type="hidden" name="formsubmit" value="yes">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="formtable">
                    <tbody>
                    <tr>
                        <td width="60">手机号</td>
                        <td width="220"><input type="text" class="input-text" name="mobile" maxlength="11" required="true" regular="/^1[3|5|8]\d{9}$/" prompt="请输入手机号" error="$lang[mobile_incorrect]"></td>
                        <td>输入11位手机号</td>
                    </tr>
                    <tr>
                        <td>验证码</td>
                        <td>
                            <input type="text" class="input-text" name="captchacode" maxlength="4" required="true" regular="/^[\S]{4}$/" prompt="请输入验证码" error="$lang[captchacode_incorrect]" style="width:120px;">
                            <img src="/?m=plugin&c=captcha" id="J-captcha" style="vertical-align:middle; height:28px; width:75px;">
                        </td>
                        <td><a onclick="document.getElementById('J-captcha').src='/?m=plugin&c=captcha&t='+Math.random()">更换验证码</a></td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </script>
    <script type="text/x-template" id="J-bind-email-tpl">
        <div style="padding:20px;">
            <form method="post" id="J-bind-email-form" action="{U:('c=setting&a=bindemail')}">
                <input type="hidden" name="formsubmit" value="yes">
                <input type="hidden" name="formhash" value="{FORMHASH}">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="formtable">
                    <tbody>
                    <tr>
                        <td width="60">邮　箱</td>
                        <td width="220"><input type="text" class="input-text" name="email" required="true" regular="/^[-._A-Za-z0-9]+@([A-Za-z0-9]+\.)+[A-Za-z]{2,3}$/" prompt="请输入邮箱地址" error="$lang[email_incorrect]"></td>
                        <td>请输入邮箱</td>
                    </tr>
                    <tr>
                        <td>验证码</td>
                        <td>
                            <input type="text" class="input-text" name="captchacode" maxlength="4" required="true" regular="/^[\S]{4}$/" prompt="请输入验证码" error="$lang[captchacode_incorrect]" style="width:120px;">
                            <img src="/?m=plugin&c=captcha" id="J-captcha" style="vertical-align:middle; height:28px; width:75px;">
                        </td>
                        <td><a onclick="document.getElementById('J-captcha').src='/?m=plugin&c=captcha&t='+Math.random()">更换验证码</a></td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </script>
    <script type="text/x-template" id="J-modi-password-tpl">
        <div style="padding:20px;">
            <form method="post" id="J-modi-password-form" action="{U:('c=setting&a=password')}">
                <input type="hidden" name="formsubmit" value="yes">
                <input type="hidden" name="formhash" value="{FORMHASH}">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="formtable">
                    <tbody>
                    <tr>
                        <td width="60">原密码</td>
                        <td width="220"><input type="password" class="input-text" name="password" required="true" regular="/^.{6,20}$/" prompt="请输入原密码" error="{$lang[password_incorrect]}"></td>
                        <td>请输入原密码</td>
                    </tr>
                    <tr>
                        <td width="60">新密码</td>
                        <td><input type="password" class="input-text" name="newpassword" required="true" regular="/^.{6,20}$/" prompt="请输入原密码" error="{$lang[password_incorrect]}"></td>
                        <td>请输入新密码，6-16位之间</td>
                    </tr>
                    <tr>
                        <td>验证码</td>
                        <td>
                            <input type="text" class="input-text" name="captchacode" style="width:120px;" required="true" regular="/^[\S]{4}$/" prompt="请输入验证码" error="$lang[captchacode_incorrect]">
                            <img src="/?m=plugin&c=captcha" id="J-captcha" style="vertical-align:middle; height:28px; width:75px;">
                        </td>
                        <td><a onclick="document.getElementById('J-captcha').src='/?m=plugin&c=captcha&t='+Math.random()">更换验证码</a></td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </script>
    <script type="text/javascript">
        $("#a-bind-mobile").click(function(e) {
            DSXUI.dialog({
                content:$("#J-bind-mobile-tpl").html(),
                title:'绑定手机号',
                width:'450',
                hideFooter:false,
                onConfirm:function(dlg){
                    var form = $("#J-bind-mobile-form");
                    if(form.validate()) {
                        form.ajaxSubmit({
                            dataType:'json',
                            success:function(json){
                                if(json.errcode == 0){
                                    dlg.close();
                                    DSXUI.success('绑定成功', DSXUtil.reFresh);
                                }else {
                                    DSXUI.error(json.errmsg);
                                    $("#J-captcha").attr("src","/?m=common&c=captcha&t="+Math.random());
                                }
                            }
                        });
                    }
                }
            });
        });
        $("#a-bind-email").click(function(e) {
            DSXUI.dialog({
                title:'绑定邮箱',
                width:'450',
                hideFooter:false,
                content:$("#J-bind-email-tpl").html(),
                onConfirm:function(dlg){
                    var form = $("#J-bind-email-form");
                    if(form.validate()){
                        form.ajaxSubmit({
                            dataType:'json',
                            success:function(json){
                                if(json.errcode == 0){
                                    dlg.close();
                                    DSXUI.success('绑定成功', DSXUtil.reFresh);
                                }else {
                                    DSXUI.error(json.errmsg);
                                    $("#J-captcha").attr("src","/?m=common&c=captcha&t="+Math.random());
                                }
                            }
                        });
                    }
                }
            });
        });
        $("#a-modi-password").click(function(e) {
            DSXUI.dialog({
                title:'修改密码',
                width:'450',
                hideFooter:false,
                content:$("#J-modi-password-tpl").html(),
                onConfirm:function(dlg){
                    var form = $("#J-modi-password-form");
                    if(form.validate()){
                        form.ajaxSubmit({
                            dataType:'json',
                            success:function(json){
                                if(json.errcode === 0){
                                    dlg.close();
                                    DSXUI.success('修改成功', DSXUtil.reFresh);
                                }else {
                                    DSXUI.error(json.errmsg);
                                    $("#J-captcha").attr("src","/?m=plugin&c=captcha&t="+Math.random());
                                }
                            }
                        });
                    }
                },
            });
        });
    </script>
@stop
