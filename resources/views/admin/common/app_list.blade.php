@extends('layouts.admin')

@section('title', '应用管理')

@section('content')
    <div class="console-title">
        <a href="{{url('/admin/app/edit')}}" class="button float-right">添加应用</a>
        <h2>应用管理->应用列表</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            {{csrf_field()}}
            <input type="hidden" name="formsubmit" value="yes">
            <input type="hidden" name="eventType" value="" id="J_eventType">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="40" class="text-center"><label><input type="checkbox" class="checkbox checkall checkmark"></label></th>
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
                        <td><input title="" type="checkbox" class="checkbox checkmark itemCheckBox" name="items[]" value="{{$item['id']}}"></td>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['app_name']}}</td>
                        <td>{{$item['app_id']}}</td>
                        <td>{{$item['app_secret']}}</td>
                        <td>{{$item['app_version']}}</td>
                        <td>{{$item['app_url']}}</td>
                        <td>@if($item['app_status']==='enable')正常@else已停用@endif</td>
                        <td><a href="{{url('/admin/app/edit?id='.$item['id'])}}">编辑</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="float-right">{!! $pagination !!}</div>
                        <label><input type="checkbox" class="checkbox checkall checkmark"> 全选</label>
                        <label><button type="button" class="btn btn-action" data-action="delete">删除</button></label>
                        <label><button type="button" class="btn btn-action" data-action="enable">启用</button></label>
                        <label><button type="button" class="btn btn-action" data-action="disable">停用</button></label>
                        <label><button type="button" class="btn" data-action="refresh">刷新</button></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            $(".btn-action").on('click', function () {
                var eventType = $(this).attr('data-action');
                if ($(".itemCheckBox:checked").length === 0){
                    DSXUI.error('请选择选项');
                    return false;
                }
                var spinner = null;
                var submitForm = function () {
                    $("#listForm").ajaxSubmit({
                        dataType:'json',
                        beforeSend:function () {
                            spinner = DSXUI.showSpinner();
                        },success:function (response) {
                            setTimeout(function () {
                                spinner.close();
                                if (response.errcode === 0){
                                    DSXUtil.reFresh();
                                }else {
                                    DSXUI.error(response.errmsg);
                                }
                            }, 500);
                        }
                    })
                }
                $("#J_eventType").val(eventType);
                if (eventType === 'delete'){
                    DSXUI.showConfirm('删除确认', '确认要删除所选应用吗?', submitForm);
                }else {
                    submitForm();
                }
            });
        });
    </script>
@stop
