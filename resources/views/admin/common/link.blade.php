@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>链接管理</h2>
    </div>
    <div class="content-div">
        <form method="post">
            {{form_verify_field()}}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="40">删?</th>
                    <th width="40">图片</th>
                    <th>名称</th>
                    <th width="60">显示顺序</th>
                    <th>网址</th>
                </tr>
                </thead>
                @foreach($categorylist as $catid=>$cat)
                <tbody id="tbcontent_$catid">
                <tr>
                    <td><input type="checkbox" title="" class="checkmark" name="delete[]" value="{{$catid}}" /></td>
                    <td></td>
                    <td><input type="text" title="" class="form-control w200" name="itemlist[{{$catid}}][title]" value="{{$cat['title']}}" maxlength="10"></td>
                    <td><input type="text" title="" class="form-control w60" name="itemlist[{{$catid}}][displayorder]" value="{{$cat['displayorder']}}" maxlength="4"></td>
                    <td></td>
                </tr>
                @if(isset($itemlist[$catid]))
                @foreach($itemlist[$catid] as $id=>$item)
                <tr>
                    <td><input type="checkbox" title="" class="checkmark" name="delete[]" value="{{$id}}" /></td>
                    <td><img src="{{image_url($item['image'])}}" width="40" height="40" rel="pickimg" data-id="{{$id}}"></td>
                    <td>
                        <div class="catlog">
                            <input type="text" title="" class="form-control w200" name="itemlist[{{$id}}][title]" value="{{$item['title']}}" maxlength="10">
                        </div>
                    </td>
                    <td><input type="text" title="" class="form-control w60" name="itemlist[{{$id}}][displayorder]" value="{{$item['displayorder']}}" maxlength="4"></td>
                    <td><input type="text" title="" class="form-control w300" name="itemlist[{{$id}}][url]" value="{{$item['url']}}"></td>
                </tr>
                @endforeach
                @endif
                </tbody>
                <tbody id="newItem_{{$catid}}"></tbody>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                        <div class="addnew-wrap">
                            <a rel="addItem" data-id="{{$catid}}"><i class="iconfont icon-roundadd"></i><span>添加链接</span></a>
                        </div>
                    </td>
                </tr>
                </tbody>
                @endforeach
                <tbody id="newCategory"></tbody>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3"><a id="addCategory"><i class="iconfont icon-roundadd"></i><span>添加分类</span></a></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <div class="btn-group-sm">
                            <label><input type="submit" class="btn btn-primary" value="提交" /></label>
                            <label><input type="button" class="btn btn-default" value="刷新" data-action="refresh" /></label>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        var k = 0;
        $(function () {
            $("#addCategory").on('click', function () {
                $("#newCategory").append('<tr>' +
                    '        <td><input type="hidden" name="itemlist['+k+'][type]" value="category" /></td>' +
                    '        <td></td>' +
                    '        <td><input type="text" title="" class="form-control w200" name="itemlist['+k+'][title]" value="新分类" maxlength="10"></td>' +
                    '        <td><input type="text" title="" class="form-control w60" name="itemlist['+k+'][displayorder]" value="0" maxlength="4"></td>' +
                    '        <td></td>' +
                    '    </tr>');
                k--;
            });

            $("[rel=addItem]").on('click', function () {
                var catid = $(this).attr('data-id');
                $("#newItem_"+catid).append('<tr>' +
                    '        <td><input type="hidden" name="itemlist['+k+'][catid]" value="'+catid+'" /></td>\n' +
                    '        <td><input type="hidden" name="itemlist['+k+'][type]" value="item" /></td>\n' +
                    '        <td><div class="catlog"><input type="text" class="form-control w200" name="itemlist['+k+'][title]" value="新链接" maxlength="10"></div></td>\n' +
                    '        <td><input type="text" class="form-control w60" name="itemlist['+k+'][displayorder]" value="0" maxlength="4"></td>\n' +
                    '        <td><input type="text" class="form-control w300" name="itemlist['+k+'][url]" value=""></td>\n' +
                    '    </tr>');
                k--;
            });

            $("img[rel=pickimg]").on('click', function () {
                var id = $(this).attr('data-id'), self = this;
                DSXUI.showImagePicker(function (data) {
                    $(self).attr('src', data.thumburl);
                    $.post("{{url('/admin/link/setimage')}}",{id:id,image:data.image});
                });
            });
        });
    </script>
@stop
