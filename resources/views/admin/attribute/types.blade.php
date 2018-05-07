@extends('layouts.admin')

@section('title', '分类属性管理')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="javascript:;" class="btn btn-primary" id="addType">
                <i class="iconfont icon-roundadd"></i>添加分类
            </a>
        </div>
        <h2>分类属性管理->类型管理</h2>
    </div>
    <div class="content-div">
        <form method="post" id="listForm">
            {{form_verify_field()}}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="40">删?</th>
                    <th width="60">typeid</th>
                    <th width="200">名称</th>
                    <th>选项</th>
                </tr>
                </thead>
                <tbody id="typelist">
                @foreach($typelist as $type)
                    <tr>
                        <td><input type="checkbox" title="" class="checkbox checkmark" name="delete[]" value="{{$type['typeid']}}" /></td>
                        <td>{{$type['typeid']}}</td>
                        <td>{{$type['typename']}}</td>
                        <td class="actions">
                            <a href="javascript:;" rel="edit" data-typeid="{{$type['typeid']}}" data-typename="{{$type['typename']}}">编辑</a>
                            <a href="{{url('admin/attribute/option?typeid='.$type['typeid'])}}">选项管理</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <label><input type="checkbox" class="checkbox" data-action="checkall" /> 全选</label>
                        <label><input type="button" class="btn btn-sm btn-default" value="删除" id="deleteBtn" disabled="disabled" /></label>
                        <label><input type="button" class="btn btn-sm btn-default" value="刷新" data-action="refresh" /></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        (function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length === 0){
                    $("#deleteBtn").disable();
                }else {
                    $("#deleteBtn").enable();
                }
            });
            function showTypeBox(typeid, typename){
                if (typeid === undefined) typeid = 0;
                if (typename === undefined) typename = '';
                DSXUI.dialog({
                    style:{
                        width:'400px'
                    },
                    title:'编辑名称',
                    content:'<div class="alert alert-warning" style="display: none;">' +
                    '</div><input type="text" class="form-control" title="" id="typename" value="'+typename+'" placeholder="名称">',
                    onConfirm:function (dialog) {
                        var typename = $.trim($("#typename").val());
                        if (!typename) {
                            $(".alert").text('请输入名称!').show();
                        }else {
                            $.ajax({
                                url:'{{url('admin/attribute/savetype')}}',
                                dataTyle:'json',
                                type:'POST',
                                data:{typeid:typeid,typename:typename,'_token':'{{csrf_token()}}'},
                                success:function (response) {
                                    if (response.errcode) {
                                        $(".alert").text(response.errmsg).show();
                                    } else {
                                        dialog.close();
                                        DSXUtil.reFresh();
                                    }
                                }
                            });
                        }
                    }
                });
            }
            $("#addType").on('click', function () {
                showTypeBox();
            });

            $("a[rel=edit]").on('click', function () {
                var typeid = $(this).attr('data-typeid');
                var typename = $(this).attr('data-typename');
                showTypeBox(typeid, typename);
            });

            $("#deleteBtn").on('click', function () {
                DSXUI.showConfirm('删除确认', '你确认要删除所选项目吗?', function () {
                    $("#listForm").ajaxSubmit({
                        dataType:'json',
                        beforeSend:function () {
                            DSXUI.showSpinner();
                        },
                        success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                DSXUtil.reFresh();
                            });
                        }
                    });
                });
            });
        })()
    </script>
@stop
