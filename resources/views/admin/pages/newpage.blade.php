@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <a href="{{url('/admin/pages/category')}}" class="btn btn-primary">分类管理</a>
            <a href="{{url('/admin/pages?catid='.$catid)}}" class="btn btn-primary">返回列表</a>
        </div>
        <h2>@if($pageid)编辑页面@else添加页面@endif</h2>
    </div>
    <div class="content-div">
        <form method="post" action="" id="pageForm">
            {{form_verify_field()}}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formtable">
                <tr>
                    <td width="60">标题</td>
                    <td><input type="text" title="" id="title" class="form-control w300" name="newpage[title]" value="{{$page['title']}}"></td>
                    <td width="60">别名</td>
                    <td><input type="text" title="" class="form-control w300" name="newpage[alias]" value="{{$page['alias']}}"></td>
                </tr>
                <tr>
                    <td>分类</td>
                    <td>
                        <select name="newpage[catid]" class="form-control w300" title="">
                            @foreach($categorylist as $id=>$cat)
                            <option value="{{$id}}"@if($id===$catid) selected="selected"@endif>{{$cat['title']}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>模板</td>
                    <td><input type="text" title="" class="form-control w300" name="newpage[template]" value="{{$page['template']}}"></td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formtable">
                <tr>
                    <td width="60">摘要</td>
                    <td><textarea title="" class="form-control" style="height: 100px;" name="newpage[summary]">{{$page['summary']}}</textarea></td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formtable">
                <tr>
                    <td width="60">内容</td>
                    <td>
                        <div style="box-sizing:border-box">
                            @include('common.editor', ['name' => 'newpage[content]', 'content'=>$page['content'], 'params'=>[]])
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><label><button type="submit" class="btn btn-primary">发布</button></label></td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $("#pageForm").on('submit', function () {
            var title = $.trim($("#title").val());
            if (!title){
                DSXUI.error('请填写标题');
                return false;
            }
        });
    </script>
@stop
