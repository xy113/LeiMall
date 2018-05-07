@extends('layouts.admin')

@section('title', '应用管理')

@section('content')
    <div class="console-title">
        <a href="{{url('/admin/app/edit')}}" class="btn btn-primary float-right">添加应用</a>
        <h2>应用管理->应用列表</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            {{form_verify_field()}}
            <input type="hidden" name="eventType" value="" id="J_eventType">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="40" class="text-center">
                        <label><input type="checkbox" class="checkmark" data-action="checkall"></label>
                    </th>
                    <th width="60">ID</th>
                    <th>应用名称</th>
                    <th>ppId</th>
                    <th>APPSecret</th>
                    <th>版本</th>
                    <th>网址</th>
                    <th>状态</th>
                    <th width="40">编辑</th>
                </tr>
                </thead>
                <tbody id="mainbody">
                @foreach($itemlist as $item)
                    <tr>
                        <td><input title="" type="checkbox" class="checkmark" name="items[]" value="{{$item['id']}}"></td>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['appid']}}</td>
                        <td>{{$item['secret']}}</td>
                        <td>{{$item['version']}}</td>
                        <td>{{$item['url']}}</td>
                        <td>@if($item['status']==='enable')正常@else已停用@endif</td>
                        <td><a href="{{url('/admin/app/edit?id='.$item['id'])}}">编辑</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="float-right">{!! $pagination !!}</div>
                        <label><input type="checkbox" class="checkmark" data-action="checkall"> 全选</label>
                        <label><button type="button" class="btn btn-default" id="deleteBtn" disabled="disabled">删除</button></label>
                        <label><button type="button" class="btn btn-default" id="enableBtn" disabled="disabled">启用</button></label>
                        <label><button type="button" class="btn btn-default" id="disableBtn" disabled="disabled">停用</button></label>
                        <label><button type="button" class="btn btn-default" data-action="refresh">刷新</button></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length === 0){
                    $("#deleteBtn,#enableBtn,#disableBtn").disable();
                } else {
                    $("#deleteBtn,#enableBtn,#disableBtn").enable();
                }
            });
            function submitForm(){
                $("#listForm").ajaxSubmit({
                    dataType:'json',
                    beforeSend:function () {
                        DSXUI.showSpinner();
                    },success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            if (response.errcode) {
                                DSXUI.error(response.errmsg);
                            } else {
                                DSXUtil.reFresh();
                            }
                        }, 500);
                    }
                });
            }
            $("#deleteBtn").on('click', function () {
                $("#J_eventType").val('delete');
                DSXUI.showConfirm('删除确认', '你确认要删除所选应用吗?', function () {
                    submitForm();
                });
            });

            $("#enableBtn").on('click', function () {
                $("#J_eventType").val('enable');
                submitForm();
            });
            $("#disableBtn").on('click', function () {
                $("#J_eventType").val('disable');
                submitForm();
            });
        });
    </script>
@stop
