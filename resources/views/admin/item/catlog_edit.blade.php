@extends('layouts.admin')

@section('title', '编辑分类')

@section('content')
    <div class="console-title">
        <a href="{{url('/admin/itemcatlog')}}" class="button float-right">返回列表</a>
        @if($catid)
        <h2>商品管理 > 添加分类</h2>
        @else
        <h2>商品管理 > 编辑分类</h2>
        @endif
    </div>
    <div class="content-div">
        <form method="post" onSubmit="return checkSubmit();">
            {{csrf_field()}}
            <input type="hidden" name="formsubmit" value="yes">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formtable">
                <tbody>
                <tr>
                    <td width="80">分类名称</td>
                    <td width="320"><input type="text" title="" class="input-text w300" name="catlog[name]" value="{{$catlog['name']}}" id="name"></td>
                    <td class="tips">分类名称，20个字符以内，不要使用特殊字符和符号</td>
                </tr>
                <tr>
                    <td>上级分类</td>
                    <td>
                        <select name="catlog[fid]" class="w300" title="">
                            <option value="0">无上级分类</option>
                            @if (isset($catloglist[0]))
                                @foreach ($catloglist[0] as $catid_1=>$catlog_1)
                                    <option value="{{$catid_1}}"@if($catlog['fid']==$catid_1) selected="selected"@endif>{{$catlog_1['name']}}</option>
                                    @if (isset($catloglist[$catid_1]))
                                        @foreach ($catloglist[$catid_1] as $catid_2=>$catlog_2)
                                            <option value="{{$catid_2}}"@if($catlog['fid']==$catid_2) selected="selected"@endif>|--{{$catlog_2['name']}}</option>
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
                        <label><input type="radio" class="radio" name="catlog[available]" value="1"@if($catlog['available']) checked="checked"@endif> 是 </label>
                        <label><input type="radio" class="radio" name="catlog[available]" value="0"@if(!$catlog['available']) checked="checked"@endif> 否</label>
                    </td>
                    <td class="tips">在发布内容是分类是否可选</td>
                </tr>
                <tr>
                    <td>首页模板</td>
                    <td><input type="text" title="" class="input-text w300" name="catlog[template_index]" value="{{$catlog['template_index']}}"></td>
                    <td class="tips">分类首页模板,留空将使用系统默认模板</td>
                </tr>
                <tr>
                    <td>列表页模板</td>
                    <td><input type="text" title="" class="input-text w300" name="catlog[template_list]" value="{{$catlog['template_list']}}"></td>
                    <td class="tips">分类列表页模板,留空将使用系统默认模板</td>
                </tr>
                <tr>
                    <td>详细页模板</td>
                    <td><input type="text" title="" class="input-text w300" name="catlog[template_detail]" value="{{$catlog['template_detail']}}"></td>
                    <td class="tips">分类详细页模板,留空将使用系统默认模板</td>
                </tr>
                <tr>
                    <td>SEO关键字</td>
                    <td><input type="text" title="" class="input-text w300" name="catlog[keywords]" value="{{$catlog['keywords']}}"></td>
                    <td class="tips">分类关键字,留空将使用系统默认</td>
                </tr>
                <tr>
                    <td>SEO描述</td>
                    <td><textarea title="" class="textarea w300" name="catlog[description]">{{$catlog['description']}}</textarea></td>
                    <td class="tips">分类描述,留空将使用系统默认</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="5">
                        <label><input type="submit" class="button button-long" value="提交"></label>
                        <label><input type="button" class="button button-cancel button-long" value="刷新" onclick="DSXUtil.reFresh()"></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        function checkSubmit(){
            if(!$("#name").val()){
                DSXUI.error('分类名称不能为空');
                return false;
            }
            return true;
        }
    </script>
@stop
