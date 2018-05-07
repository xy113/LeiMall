@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <a href="{{url('/admin/block/newitem?block_id='.$block_id)}}" class="btn btn-primary float-right">添加项目</a>
        <h2>板块内容列表</h2>
    </div>
    <div class="content-div table-wrap">
        <form method="post" id="listForm" autocomplete="off">
            {{form_verify_field()}}
            <input type="hidden" name="eventType" value="" id="J_eventType">
            <table cellpadding="0" cellspacing="0" width="100%" class="listtable border-none">
                <thead>
                <tr>
                    <th width="60"><label><input type="checkbox" class="checkmark" data-action="checkall">删?</label></th>
                    <th width="70">图片</th>
                    <th width="320">标题</th>
                    <th>链接</th>
                    <th width="50">选项</th>
                </tr>
                </thead>
            </table>
            <div class="sortable">
                @foreach($itemlist as $id=>$item)
                <table cellspacing="0" cellpadding="0" width="100%" class="listtable border-none">
                    <tbody>
                    <tr>
                        <td width="40"><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$id}}"></td>
                        <td width="70"><img src="{{image_url($item['image'])}}" width="50" height="50" rel="pickimg" data-id="{{$id}}"></td>
                        <td width="320"><input title="" type="text" class="form-control w300" name="itemlist[{{$id}}][title]" value="{{$item['title']}}"></td>
                        <td><input title="" type="text" class="form-control w400" name="itemlist[{{$id}}][url]" value="{{$item['url']}}"></td>
                        <td width="50"><a href="{{url('/admin/block/newitem?block_id='.$block_id.'&id='.$id)}}">编辑</a></td>
                    </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="listtable border-none">
                <tfoot>
                <tr>
                    <td>
                        <label><input type="checkbox" class="checkmark" data-action="checkall"> 全选</label>
                        <label><button type="submit" class="btn btn-primary">提交</button></label>
                        <label><button type="button" class="btn btn-default" data-action="refresh">刷新</button></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            $("img[rel=pickimg]").on('click', function () {
                var self = this;
                var id = $(this).attr('data-id');
                DSXUI.showImagePicker(function (data) {
                    $(self).attr('src', data.imageurl);
                    $.ajax({
                        url:"{{url('/admin/block/setimage')}}",
                        data:{id:id,image:data.image},
                        dataType:'json',
                        success:function (response) {

                        }
                    });
                });
            });
        });
    </script>
@stop
