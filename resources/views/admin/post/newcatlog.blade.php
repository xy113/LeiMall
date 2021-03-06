@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <a href="{{url('/admin/postcatlog')}}" class="btn btn-primary float-right">返回列表</a>
        @if($catid)
        <h2>文章管理 > 添加分类</h2>
        @else
        <h2>文章管理 > 编辑分类</h2>
        @endif
    </div>
    <div class="content-div">
        <form method="post" id="Form">
            {{form_verify_field()}}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formtable">
                <tbody>
                <tr>
                    <td width="80">分类名称</td>
                    <td width="320"><input type="text" title="" class="form-control w300" name="catlog[name]" value="{{$catlog['name']}}" id="name"></td>
                    <td class="tips">分类名称，20个字符以内，不要使用特殊字符和符号</td>
                </tr>
                <tr>
                    <td>上级分类</td>
                    <td>
                        <select name="catlog[fid]" class="form-control w300" title="">
                            <option value="0">无上级分类</option>
                            @if(isset($catloglist[0]))
                                @foreach($catloglist[0] as $catid1=>$cat1)
                                    <option value="{{$catid1}}"@if($catid1==$catlog['fid']) selected="selected"@endif>{{$cat1['name']}}</option>
                                    @if (isset($catloglist[$catid1]))
                                        @foreach($catloglist[$catid1] as $catid2=>$cat2)
                                            <option value="{{$catid2}}"@if($catid2==$catlog['fid']) selected="selected"@endif>|--{{$cat2['name']}}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </td>
                    <td class="tips">选择上级分类</td>
                </tr>
                <tr>
                    <td>可发布内容</td>
                    <td>
                        <label><input type="radio" name="catlog[available]" value="1"@if($catlog['available']) checked="checked"@endif> 是 </label>
                        <label><input type="radio" name="catlog[available]" value="0"@if(!$catlog['available']) checked="checked"@endif> 否</label>
                    </td>
                    <td class="tips">在发布内容是分类是否可选</td>
                </tr>
                <tr>
                    <td>首页模板</td>
                    <td><input type="text" title="" class="form-control w300" name="catlog[template_index]" value="{{$catlog['template_index']}}"></td>
                    <td class="tips">分类首页模板,留空将使用系统默认模板</td>
                </tr>
                <tr>
                    <td>列表页模板</td>
                    <td><input type="text" title="" class="form-control w300" name="catlog[template_list]" value="{{$catlog['template_list']}}"></td>
                    <td class="tips">分类列表页模板,留空将使用系统默认模板</td>
                </tr>
                <tr>
                    <td>详细页模板</td>
                    <td><input type="text" title="" class="form-control w300" name="catlog[template_detail]" value="{{$catlog['template_detail']}}"></td>
                    <td class="tips">分类详细页模板,留空将使用系统默认模板</td>
                </tr>
                <tr>
                    <td>SEO关键字</td>
                    <td><input type="text" title="" class="form-control w300" name="catlog[keywords]" value="{{$catlog['keywords']}}"></td>
                    <td class="tips">分类关键字,留空将使用系统默认</td>
                </tr>
                <tr>
                    <td>SEO描述</td>
                    <td><textarea title="" class="form-control w300" name="catlog[description]" style="height: 80px;">{{$catlog['description']}}</textarea></td>
                    <td class="tips">分类描述,留空将使用系统默认</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="5">
                        <label><input type="submit" class="btn btn-primary" value="提交"></label>
                        <label><input type="button" class="btn btn-default" value="刷新" data-action="refresh"></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $("#Form").on('submit', function () {
            if(!$("#name").val()){
                DSXUI.error('分类名称不能为空');
                return false;
            }
        });
    </script>
@stop
