@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>快递管理</h2>
    </div>
    <div class="content-div">
        <form method="post" autocomplete="off" id="listForm">
            {{form_verify_field()}}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="50" class="center">删?</th>
                    <th width="220">快递名称</th>
                    <th width="120">公司代码</th>
                    <th>单号规则</th>
                </tr>
                </thead>
                <tbody id="express_list">
                @foreach($itemlist as $id=>$item)
                <tr>
                    <td><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$id}}"></td>
                    <td><input title="" type="text" class="form-control w200" name="itemlist[{{$id}}][name]" value="{{$item['name']}}"></td>
                    <td><input title="" type="text" class="form-control w100" name="itemlist[{{$id}}][code]" value="{{$item['code']}}"></td>
                    <td><input title="" type="text" class="form-control w300" name="itemlist[{{$id}}][regular]" value="{{$item['regular']}}"></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <label><input type="checkbox" data-action="checkall"> {{trans('common.selectall')}}</label>
                        <a id="addnew"><i class="iconfont icon-roundaddfill"></i>添加快递</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="10">
                        <div class="btn-group-sm">
                            <label><input type="button" class="btn btn-primary" value="{{trans('common.submit')}}" id="SubmitButton"></label>
                            <label><input type="button" class="btn btn-default" value="{{trans('common.refresh')}}" data-action="refresh"></label>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        var express_id = 0;
        $("#addnew").on('click', function () {
            $("#express_list").append('<tr>' +
                '                <td></td>' +
                '                <td><input type="text" class="form-control w200" name="itemlist['+express_id+'][name]"></td>\n' +
                '                <td><input type="text" class="form-control w100" name="itemlist['+express_id+'][code]"></td>\n' +
                '                <td><input type="text" class="form-control w300" name="itemlist['+express_id+'][regular]"></td>\n' +
                '            </tr>');
            express_id--;
        });
        $("#SubmitButton").on('click', function () {
            if ($(".checkmark:checked").length > 0) {
                DSXUI.showConfirm('删除确认', '你确认要删除所选项目吗?', function () {
                    $("#listForm").submit();
                });
            } else {
                $("#listForm").submit();
            }
        });
    </script>
@stop
