@extends('layouts.admin')

@section('title', '合并分类')

@section('content')
    <div class="console-title">
        <a href="{{url('/admin/itemcatlog')}}" class="button float-right">返回列表</a>
        <h2>商品管理 > 合并分类</h2>
    </div>
    <div class="content-div">
        <form method="post">
            {{csrf_field()}}
            <input type="hidden" name="formsubmit" value="yes">
            <table cellpadding="0" cellspacing="0" width="100%" class="formtable">
                <tbody>
                <tr>
                    <th width="300">源分类</th>
                    <td width="50"></td>
                    <th>目标分类</th>
                </tr>
                <tr>
                    <td>
                        <select name="source[]" size="10" class="select" multiple="multiple" title="" style="height:300px;">
                            @if (isset($catloglist[0]))
                                @foreach ($catloglist[0] as $catid1=>$catlog1)
                                    <option value="{{$catid1}}">{{$catlog1['name']}}</option>
                                    @if (isset($catloglist[$catid1]))
                                        @foreach ($catloglist[$catid1] as $catid2=>$catlog2)
                                            <option value="{{$catid2}}">|--{{$catlog2['name']}}</option>
                                            @if (isset($catloglist[$catid2]))
                                                @foreach ($catloglist[$catid2] as $catid3=>$catlog3)
                                                    <option value="{{$catid3}}">|--|--{{$catlog3['name']}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </td>
                    <td class="align-center" style="vertical-align: middle;">>></td>
                    <td>
                        <select name="target" size="10" class="select" title="" style="width:300px; height:300px;">
                            @if (isset($catloglist[0]))
                                @foreach ($catloglist[0] as $catid1=>$catlog1)
                                    <option value="{{$catid1}}">{{$catlog1['name']}}</option>
                                    @if (isset($catloglist[$catid1]))
                                        @foreach ($catloglist[$catid1] as $catid2=>$catlog2)
                                            <option value="{{$catid2}}">|--{{$catlog2['name']}}</option>
                                            @if (isset($catloglist[$catid2]))
                                                @foreach ($catloglist[$catid2] as $catid3=>$catlog3)
                                                    <option value="{{$catid3}}">|--|--{{$catlog3['name']}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td>
                        <input type="submit" class="button" value="确认合并">
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
