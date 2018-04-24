<select name="{{$select_name}}" class="w300" title="">
    <option value="0">无上级分类</option>
    @if (isset($catloglist[0]))
        @foreach ($catloglist[0] as $catid1=>$catlog1)
            <option value="{{$catid1}}"@if($catid1==$default_catid) selected@endif>{{$catlog1['name']}}</option>
            @if (isset($catloglist[$catid1]))
                @foreach ($catloglist[$catid1] as $catid2=>$catlog2)
                    <option value="{{$catid2}}"@if($catid2==$default_catid) selected@endif>|--{{$catlog2['name']}}</option>
                    @if (isset($catloglist[$catid2]))
                        @foreach ($catloglist[$catid2] as $catid3=>$catlog3)
                            <option value="{{$catid3}}"@if($catid3==$default_catid) selected@endif>|--|--{{$catlog3['name']}}</option>
                        @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif
</select>
