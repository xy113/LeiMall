@extends('layouts.mall')

@section('title', '企业店铺')

@section('content')
    <div class="area shop-filter">
        <ul class="tab">
            <li><a class="cur">默认</a></li>
            <li><a>销量</a></li>
            <li><a>信誉</a></li>
        </ul>
        <div class="search-hd">
            <form method="get">
                <span>店铺名称:</span>
                <input title="" type="text" class="input-text" name="q" value="{{$q or ''}}">
                <input type="submit" class="button" value="搜索">
            </form>
        </div>
    </div>
    <div class="area shop" style="min-height: 600px;">
        <div class="shop-grid-wrap">
            <ul>
                @foreach ($shoplist as $shop)
                    <li>
                        <div class="hd">
                            <div class="logo bg-cover asyncload" data-original="{{image_url($shop['logo'])}}">
                                <a href="{{shop_url($shop['shop_id'])}}" target="_blank" title="{{$shop['shop_name']}}"></a>
                            </div>
                            <div class="shop-name">
                                <a href="{{shop_url($shop['shop_id'])}}" target="_blank">{{$shop['shop_name']}}</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="pagination">{{$pagination}}</div>
    </div>
@stop
