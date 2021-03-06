@extends('layouts.admin')

@section('content')
    <div class="content-div">
        <form method="post" id="menuForm">
            {{csrf_field()}}
            <input type="hidden" name="formsubmit" value="yes">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formtable">
                <tbody>
                <tr>
                    <td width="80">菜单名称</td>
                    <td><input title="" type="text" class="input-text" name="menu[name]" value="{{$menu['name']}}" id="menu_name" style="width: 200px;"></td>
                    <td class="tips">一级菜单不超过4个字，二级不超过7个字</td>
                </tr>
                <tr>
                    <td>响应类型</td>
                    <td>
                        <select title="" class="select" name="menu[type]" id="menu_type" style="width: 200px;">
                            @foreach($menu_types as $k=>$v)
                            <option value="{{$k}}"@if($k==$menu['type']) selected="selected"@endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="tips">点击菜单后所执行的操作</td>
                </tr>
                </tbody>
                <tbody id="menu-action"></tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><button type="button" class="button button-long" id="submitButton">提交</button></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/x-template" id="menu_tpl_1">
        <tr>
            <td width="60">网页链接</td>
            <td><input title="" type="text" class="input-text" name="menu[url]" value="{{$menu['url']}}" style="width: 200px;"></td>
            <td class="tips">用户点击菜单可打开链接，不超过1024字节</td>
        </tr>
    </script>
    <script type="text/x-template" id="menu_tpl_2">
        <tr>
            <td width="60">永久素材ID</td>
            <td><input title="" type="text" class="input-text" name="menu[media_id]" value="{{$menu['media_id']}}" style="width: 200px;"></td>
            <td class="tips">填写永久素材的合法media_id</td>
        </tr>
    </script>
    <script type="text/x-template" id="menu_tpl_3">
        <tr>
            <td width="60">菜单KEY值</td>
            <td><input title="" type="text" class="input-text" name="menu[key]" value="{{$menu['key']}}" style="width: 200px;"></td>
            <td class="tips">用于消息接口推送，不超过128字节</td>
        </tr>
    </script>
    <script type="text/javascript">
        function selectMenu(type){
            if(!type) type = 'view';
            if(type === 'view') {
                $("#menu-action").html($("#menu_tpl_1").html());
            }else if(type === 'media_id' || type === 'view_limited'){
                $("#menu-action").html($("#menu_tpl_2").html());
            }else {
                $("#menu-action").html($("#menu_tpl_3").html());
            }
        }
        selectMenu('{{$menu['type']}}');
        $("#menu_type").change(function(e) {
            selectMenu($(this).val());
        });
        $(function () {
            $("#submitButton").on('click', function () {
                var name = $.trim($("#menu_name").val());
                if (!name) {
                    DSXUI.error('请填写菜单名称');
                    return false;
                }

                $("#menuForm").ajaxSubmit({
                    dataType:'json',
                    success:function (response) {
                        if (response.errcode){
                            DSXUI.error(response.errmsg);
                        }else {
                            if (window.parent.afterMenuSave){
                                window.parent.afterMenuSave(response);
                            }
                        }
                    }
                });
            });
        })
    </script>
@stop
