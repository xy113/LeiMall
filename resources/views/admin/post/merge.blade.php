@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <a href="{{url('/admin/postcatlog')}}" class="btn btn-primary float-right">返回列表</a>
        <h2>文章管理 > 合并分类</h2>
    </div>
    <div class="content-div">
        <form method="post">
            {{form_verify_field()}}
            <table cellpadding="0" cellspacing="0" width="100%" class="formtable">
                <tbody>
                <tr>
                    <th width="300">源分类</th>
                    <td width="50"></td>
                    <th>目标分类</th>
                </tr>
                <tr>
                    <td>
                        <select name="source[]" size="10" class="form-control w300" multiple="multiple" title="" style="height:300px;">
                            @if(isset($catloglist[0]))
                                @foreach($catloglist[0] as $catid1=>$cat1)
                                    <option value="{{$catid1}}">{{$cat1['name']}}</option>
                                    @if (isset($catloglist[$catid1]))
                                        @foreach($catloglist[$catid1] as $catid2=>$cat2)
                                            <option value="{{$catid2}}">|--{{$cat2['name']}}</option>
                                            @if (isset($catloglist[$catid2]))
                                                @foreach($catloglist[$catid2] as $catid3=>$cat3)
                                                    <option value="{{$catid3}}">|--|--{{$cat3['name']}}</option>
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
                        <select name="target" size="10" class="form-control w300" title="" style="width:300px; height:300px;">
                            @if(isset($catloglist[0]))
                                @foreach($catloglist[0] as $catid1=>$cat1)
                                    <option value="{{$catid1}}">{{$cat1['name']}}</option>
                                    @if (isset($catloglist[$catid1]))
                                        @foreach($catloglist[$catid1] as $catid2=>$cat2)
                                            <option value="{{$catid2}}">|--{{$cat2['name']}}</option>
                                            @if (isset($catloglist[$catid2]))
                                                @foreach($catloglist[$catid2] as $catid3=>$cat3)
                                                    <option value="{{$catid3}}">|--|--{{$cat3['name']}}</option>
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
                        <label><input type="submit" class="btn btn-primary" value="确认合并"></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
