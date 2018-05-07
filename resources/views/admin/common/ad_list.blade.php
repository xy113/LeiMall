@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <a href="{{url('/admin/ad/edit')}}" class="btn btn-primary float-right">添加广告</a>
        <h2>广告管理</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            {{form_verify_field()}}
            <input type="hidden" name="eventType" value="" id="J_eventType">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="40" class="text-center"><label><input type="checkbox" class="checkmark" data-action="checkall"></label></th>
                    <th width="60">ID</th>
                    <th>广告名称</th>
                    <th width="100">类型</th>
                    <th width="100">开始时间</th>
                    <th width="100">结束时间</th>
                    <th width="80" class="center">点击数</th>
                    <th width="80">状态</th>
                    <th width="40">编辑</th>
                </tr>
                </thead>
                <tbody id="mainbody">
                @foreach($itemlist as $id=>$item)
                <tr>
                    <td><input title="" type="checkbox" class="checkbox checkmark itemCheckBox" name="ads[]" value="{{$id}}"></td>
                    <td>{{$id}}</td>
                    <td>{{$item['title']}}</td>
                    <td>{{$item['type_name']}}</td>
                    <td>{{$item['begin_time']}}</td>
                    <td>{{$item['end_time']}}</td>
                    <td class="align-center">{{$item['clicks']}}</td>
                    <td>@if($item['available'])可用@else已停用@endif</td>
                    <td><a href="{{action('Admin\AdController@edit', ['id'=>$id])}}">编辑</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="float-right">{!! $pagination !!}</div>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" class="checkmark" data-action="checkall"> 全选</label>
                            <label><button type="button" class="btn btn-default" id="delete" disabled="disabled">删除</button></label>
                            <label><button type="button" class="btn btn-default" id="enable" disabled="disabled">启用</button></label>
                            <label><button type="button" class="btn btn-default" id="disable" disabled="disabled">停用</button></label>
                            <label><button type="button" class="btn btn-default" data-action="refresh">刷新</button></label>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            function submitForm(){
                $("#listForm").ajaxSubmit({
                    dataType:'json',
                    beforeSend:function () {
                        DSXUI.showSpinner();
                    },success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            if (response.errcode){
                                DSXUI.error(response.errmsg);
                            }else {
                                DSXUtil.reFresh();
                            }
                        }, 500);
                    }
                });
            }

            $(document).on('click', function () {
                if ($(".itemCheckBox:checked").length > 0) {
                    $("#enable,#disable,#delete").enable();
                } else {
                    $("#enable,#disable,#delete").disable();
                }
            });

            $("#delete").on('click', function () {
                $("#eventType").val('delete');
                DSXUI.showConfirm('删除确认', '确认要删除所选项目吗?', function () {
                    submitForm();
                });
            });

            $("#enable").on('click', function () {
                $("#eventType").val('enable');
                submitForm();
            });

            $("#disable").on('click', function () {
                $("#eventType").val('disable');
                submitForm();
            });
        });
    </script>
@stop
