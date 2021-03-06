@extends('layouts.member')

@section('content')
    <div class="console-title">
        <ul class="tab">
            <li><a href="/member/settings/userinfo">基本信息</a></li>
            <li><a href="/member/settings/security">安全设置</a></li>
            <li class="on"><a>实名认证</a></li>
        </ul>
    </div>
    <div class="blank"></div>
    <div class="avatar-div">
        <form method="post" enctype="multipart/form-data" id="upload-avatar-form" action="/?m={$G[m]}&c={$G[c]}&a=uploadavatar">
            <div class="avatar"><img id="avatar-image" src="{echo avatar($G[uid])}"></div>
            <div class="avatar-content">
                <a class="button upload-button">
                    <span>上传头像</span>
                    <input type="file" id="J-file" name="filedata">
                </a>
            </div>
            <div class="avatar-content">支持JPG,JPEG,GIF,PNG格式</div>
        </form>
    </div>
    <div class="userinfo-div">
        <form method="post" id="userinfoForm">
            <input type="hidden" name="formsubmit" value="yes">
            <input type="hidden" name="formhash" value="{FORMHASH}">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="formtable">
                <tr>
                    <td width="64">性别</td>
                    <td>
                        {loop $lang[sex_items] $k $v}
                        <input type="radio" value="$k" name="userinfo[usersex]"{if $k==$userinfo[usersex]} checked="checked"{/if}{if $userinfo[locked]} disabled="disabled"{/if}> $v
                        {/loop}
                    </td>
                    <td width="40">生日</td>
                    <td><input type="text" class="input-text" name="userinfo[birthday]" onclick="WdatePicker()" value="{$userinfo[birthday]}" readonly></td>
                </tr>
                <tr>
                    <td>星座</td>
                    <td>
                        <select class="input-select" name="userinfo[star]">
                            {loop $lang[star_items] $k $v}
                            <option value="{$k}"{if $k==$userinfo[star]} selected="selected"{/if}>{$v}</option>
                            {/loop}
                        </select>
                    </td>
                    <td>血型</td>
                    <td>
                        <select class="input-select" name="userinfo[blood]">
                            {loop $lang[blood_items] $k $v}
                            <option value="{$k}"{if $k==$userinfo[blood]} selected="selected"{/if}>{$v}</option>
                            {/loop}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>QQ</td>
                    <td><input type="text" class="input-text" name="userinfo[qq]" value="{$userinfo[qq]}"></td>
                    <td>微信</td>
                    <td><input type="text" class="input-text" name="userinfo[weixin]" value="{$userinfo[weixin]}"></td>
                </tr>
                <tr>
                    <td>所在地</td>
                    <td colspan="3">
                        <select class="input-select dist select" id="province" name="userinfo[province]" style="width:auto;">
                            <option value="">请选择</option>
                        </select>
                        <select class="input-select dist select" id="city" name="userinfo[city]" style="width:auto;">
                            <option value="">请选择</option>
                        </select>
                        <select class="input-select dist select" id="county" name="userinfo[county]" style="width:auto;">
                            <option value="">请选择</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>个人描述</td>
                    <td colspan="3"><textarea name="userinfo[introduction]" class="textarea" draggable="false" style="width:500px; height:80px;">{$userinfo[introduction]}</textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3"><button type="button" class="button" id="update-info-button">更新资料</button></td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        DSXUtil.bindDistrict("#province", 0, '{$userinfo[province]}', '', function(province){
            DSXUtil.bindDistrict("#city", province, '{$userinfo[city]}', '', function(city){
                DSXUtil.bindDistrict("#county", city, '{$userinfo[county]}', '');
            });
        });
        $("#update-info-button").click(function(e) {
            $("#userinfoForm").ajaxSubmit({
                dataType:'json',
                success:function(json){
                    if(json.errcode == 0){
                        DSXUI.success('资料更新成功');
                    }else {
                        DSXUI.error(json.errmsg);
                    }
                }
            });
        });
        $("#J-file").change(function(){
            var loading;
            $("#upload-avatar-form").ajaxSubmit({
                dataType:'json',
                beforeSend:function(){
                    loading = DSXUI.showloading('照片上传中...');
                },
                success:function(json){
                    if(json.errcode == 0){
                        loading.close();
                        $("#avatar-image").attr('src', json.data.avatar+'#'+Math.random());
                    }
                }
            });
        });
    </script>
@stop
