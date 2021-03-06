@extends('layouts.mall')

@section('title', $shop['shop_name'])

@section('content')
    <div class="area shop-wrap">
        <div class="frame-left">
            <div class="content">
                <div class="rank-div">
                    <h3>掌柜热卖</h3>
                    <ul>
                        @foreach ($hotSaleList as $item)
                            <li>
                                <div class="g-pic bg-cover asyncload" data-original="{{image_url($item['thumb'])}}">
                                    <a href="{{item_url($item['itemid'])}}" target="_blank" title="{{$item['title']}}"></a>
                                </div>
                                <div class="g-info">
                                    <p><a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></p>
                                    <p class="price">￥<strong>{{$item['price']}}</strong></p>
                                    <p>已售出{{$item['sold']}}件</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="frame-right">
            <div class="shop-filter">
                <ul>
                    <li><a>人气</a></li>
                    <li><a>销量</a></li>
                    <li><a>新品</a></li>
                    <li><a>价格</a></li>
                    <li><a data-action="addToCollection" data-id="{{$shop_id}}" data-type="shop">收藏</a></li>
                </ul>
            </div>
            <div class="item-list-wrap">
                <ul class="item-list">
                    @foreach ($itemlist as $item)
                        <li>
                            <div class="bd">
                                <div class="g-pic bg-cover asyncload" data-original="{{image_url($item['thumb'])}}">
                                    <a href="{{item_url($item['itemid'])}}" title="{{$item['title']}}" target="_blank"></a>
                                </div>
                                <div class="g-name">
                                    <a href="{{item_url($item['itemid'])}}" title="{{$item['title']}}" target="_blank">{{$item['title']}}</a>
                                </div>
                                <div class="line">
                                    <span class="sold">已售出{{$item['sold']}}件</span>
                                    <div class="price"><span>￥</span><strong>{{$item['price']}}</strong></div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="blank"></div>
                <div class="pagination">{{$pagination}}</div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.get("{{url('/shop/service/update_visit?shop_id='.$shop_id)}}");
    </script>
@stop
