@extends('layouts.admin')

@section('title', '选项管理')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{url('admin/attribute/newoption?typeid='.$typeid)}}" class="btn btn-primary">
                <i class="iconfont icon-roundadd"></i>添加选项
            </a>
        </div>
        <h2>分类属性管理->选项管理->{{$type['typename']}}</h2>
    </div>
    <div class="content-div">
        <div class="form-group">
            <form method="get" id="search">
                <span class="float-left" style="padding-top: 8px;">选择类别</span>
                <div class="col-sm-10">
                    <select title="" name="typeid" class="form-control w300" onchange="$('#search').submit()">
                        @foreach ($typelist as $type)
                            <option value="{{$type['typeid']}}}"@if($type['typeid']==$typeid) selected="selected"@endif>{{$type['typename']}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="content-div">
        <form method="post" id="listForm">
            {{form_verify_field()}}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="40">删?</th>
                    <th width="60">optionid</th>
                    <th>名称</th>
                    <th width="160">字段名</th>
                    <th width="80">类型</th>
                    <th width="80">必填项</th>
                    <th width="80">显示顺序</th>
                    <th width="40">选项</th>
                </tr>
                </thead>
                <tbody id="typelist">
                @foreach($optionlist as $option)
                    <tr>
                        <td><input type="checkbox" title="" class="checkbox checkmark" name="delete[]" value="{{$option['optionid']}}" /></td>
                        <td>{{$option['optionid']}}</td>
                        <td>{{$option['title']}}</td>
                        <td>{{$option['identifier']}}</td>
                        <td>{{$option_types[$option['type']]}}</td>
                        <td><input title="" type="checkbox" name="optionlist[{{$option['optionid']}}][required]" value="1" @if($option['required']) checked="checked"@endif></td>
                        <td><input title="" type="text" name="optionlist[{{$option['optionid']}}][displayorder]" value="{{$option['displayorder']}}" class="form-control w60"></td>
                        <td class="actions">
                            <a href="{{url('admin/attribute/newoption?typeid='.$typeid.'&optionid='.$option['optionid'])}}">编辑</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <label><input type="checkbox" class="checkbox" data-action="checkall" /> 全选</label>
                        <label><input type="button" class="btn btn-sm btn-default" value="提交" id="submitBtn" /></label>
                        <label><input type="button" class="btn btn-sm btn-default" value="刷新" data-action="refresh" /></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        (function () {
            function submitForm() {
                $("#listForm").ajaxSubmit({
                    dataType:'json',
                    beforeSend:function () {
                        DSXUI.showSpinner();
                    },
                    success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            }

            $("#submitBtn").on('click', function () {
                if ($(".checkmark:checked").length > 0) {
                    DSXUI.showConfirm('删除确认', '你确认要删除所选选项吗?', function () {
                        submitForm();
                    });
                } else {
                    submitForm();
                }
            });
        })()
    </script>
@stop
