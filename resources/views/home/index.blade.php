@extends('layouts.mall')

@section('content')
    <div class="area">
        <div class="category-panel">
            <ul class="cat-list" id="cat-list" style="height: 496px;">
                @foreach ($catlogList[0] as $catlog)
                    <li><a href="{{item_catlog_url($catlog['catid'])}}"><span>{{$catlog['name']}}</span></a></li>
                @endforeach
            </ul>
            <div class="childs-panel" id="childs-panel">
                @foreach ($catlogList[0] as $catlog)
                    <div class="cat-group">
                        <h3><a href="{{item_catlog_url($catlog['catid'])}}" class="more">更多 >></a> {{$catlog['name']}}</h3>
                        <ul>
                            @if (isset($catlogList[$catlog['catid']]))
                                @foreach ($catlogList[$catlog['catid']] as $child)
                                    <li><a href="{{item_catlog_url($child['catid'])}}">{{$child['name']}}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="home-main">
            <div class="swiper-div" id="swiper-div">
                <div class="swiper" id="swiper">
                    <ul class="swiper-wrapper">
                        @foreach ($slideList as $item)
                            <li class="swiper-slide"><a href="{{$item['url']}}" target="_blank"><img src="{{image_url($item['image'])}}"></a></li>
                        @endforeach
                    </ul>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <script type="text/javascript">
                (function(){
                    var swiper = new Swiper('#swiper',
                        {loop:true,pagination:'.swiper-pagination',autoplay:2500});
                })();
            </script>
            <div class="news">
                <div class="content">
                    <h3>农产品资讯</h3>
                    <ul>
                        @foreach ($newsList as $item)
                            <li><a href="{{post_url($item['aid'])}}" target="_blank">&bull; {{$item['title']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="best-goods-wrap">
                <ul class="best-goods">
                    @foreach ($bestList as $item)
                        <li><div class="bd"><a href="{{$item['url']}}"><img src="{{image_url($item['image'])}}"></a></div></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $("#cat-list li").mouseenter(function (e) {
                var self = this;
                $(this).addClass('cur').siblings().removeClass('cur');
                $("#childs-panel").show();
                $("#childs-panel .cat-group").eq($(this).index()).show().siblings('.cat-group').hide();
                $(document).mousemove(function (e) {
                    $("#childs-panel").hide();
                    $(self).removeClass('cur');
                });
            }).mousemove(function (e) {
                DSXUtil.stopPropagation(e);
            });
            $("#childs-panel").mousemove(function (e) {
                DSXUtil.stopPropagation(e);
            });
        });
    </script>
    <div class="blank10"></div>
    <div class="area">
        <div class="home-youxuan">
            <h2>
                <span><a href="{{url('/item/youxuan')}}">更多>></a></span>
                <strong>粗耕优选</strong>
            </h2>
            <div id="glist-wrap">
                <ul class="glist">
                    @foreach ($youxuanList as $item)
                        <li>
                            <div class="bd">
                                <div class="pic bg-cover asyncload" data-original="{{image_url($item['thumb'])}}">
                                    <a href="{{item_url($item['itemid'])}}" target="_blank"></a>
                                </div>
                                <div class="name"><a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></div>
                                <div class="price">
                                    <strong class="shop-price">￥:{{$item['price']}}</strong>
                                </div>
                                <div class="buynow">
                                    <a href="{{item_url($item['itemid'])}}" target="_blank" class="btn">立即购买</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="blank"></div>
    <div class="area home">
        <div class="qiyedianpu-title">
            <a href="{{url('/shop')}}" class="more">更多>></a>
            <strong>企业店铺</strong>
        </div>
        <div class="qiyedianpu-wrap">
            <div class="shop-list">
                <ul>
                    @foreach ($shopList as $shop)
                        <li>
                            <div class="bd">
                                <div class="pic bg-cover asyncload" data-original="{{image_url($shop['logo'])}}">
                                    <a href="{{shop_url($shop['shop_id'])}}" target="_blank"></a>
                                </div>
                                <div class="name"><a href="{{shop_url($shop['shop_id'])}}" target="_blank">{{$shop['shop_name']}}</a></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="remai">
                <h3 class="hot-sale">掌柜热卖</h3>
                <ul>
                    @foreach ($hotSales as $item)
                        <li>
                            <div class="pic bg-cover asyncload" data-original="{{image_url($item['thumb'])}}">
                                <a href="{{item_url($item['itemid'])}}" target="_blank"></a>
                            </div>
                            <div class="g-info">
                                <p class="name"><a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></p>
                                <p class="market-price"><s>￥{{$item['market_price']}}</s></p>
                                <p class="shop-price">￥{{$item['price']}}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="blank"></div>
    </div>
    <div style="background-color: #F2F2F2;">
        <div class="area">
            <div class="home-recommend-list">
                <h2>猜你喜欢</h2>
                @foreach ($recommendList as $item)
                    <div class="item">
                        <div class="hd">
                            <a href="{{item_url($item['itemid'])}}" target="_blank">
                                <div class="img bg-cover asyncload" data-original="{{image_url($item['thumb'])}}"></div>
                            </a>
                            <div class="info">
                                <div class="title">{{$item['title']}}</div>
                                <div class="price">￥{{$item['price']}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
