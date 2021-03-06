@extends('layouts.mall')

@section('title', $iteminfo['title'])
@section('keywords', $iteminfo['subtitle'])
@section('description', $iteminfo['subtitle'])

@section('content')
    <div class="yourpos">
        <div class="area">
            <a href="{{url('/')}}">粗耕首页</a>
            <span> > </span>
            <a href="{{url('/item/search?catid='.$catlog['catid'])}}">{{$catlog['name']}}</a>
            <span> > </span>
            <span>{{substring($iteminfo['title'], 12)}}</span>
        </div>
    </div>
    <div style="height: 10px; clear: both;"></div>
    <div class="area">
        <div class="preview-wrap">
            <div class="preview">
                <div id="showbox">
                    @foreach ($gallery as $img)
                        <img src="{{image_url($img['image'])}}" width="400" height="400" />
                    @endforeach
                </div><!--展示图片盒子-->
                <div id="showsum"></div><!--展示图片里边-->
                <p class="showpage">
                    <a href="javascript:void(0);" id="showlast"> < </a>
                    <a href="javascript:void(0);" id="shownext"> > </a>
                </p>
            </div>
        </div>
        <form method="post" id="J_Frmbuy" action="{U:('m=buy&c=order&a=buy_now')}">
            <input type="hidden" name="itemid" value="{$item_data[itemid]}">
            <input type="hidden" name="quantity" value="1" id="J_quantity">
            <input type="hidden" name="shipping_type" value="1" id="J_shipping_type">
            <input type="hidden" name="pay_type" value="1" id="J_pay_type">
            <input type="hidden" name="from" value="item_detail">
        </form>
        <div class="iteminfo-wrap">
            <h1 class="item-name">{{$iteminfo['title']}}</h1>
            <div class="item-brief">{{$iteminfo['subtitle']}}</div>
            <div class="price-wrap">
                <div class="item-group" style="height: 60px; line-height: 60px; padding-top: 20px;">
                    <div class="label">价　　格</div>
                    <div class="info">
                        <div class="p-price">
                            <span>￥</span>
                            <strong>{{$iteminfo['price']}}</strong>
                        </div>
                    </div>
                </div>
                <ul class="p-stat">
                    <li>
                        <h3>0</h3>
                        <p>累计评论</p>
                    </li>
                    <li>
                        <h3>{{$iteminfo['sold']}}</h3>
                        <p>交易成功</p>
                    </li>
                </ul>
            </div>

            <dl class="item-group">
                <dd class="label">配送方式</dd>
                <dt class="info">
                    <label><input type="radio" class="radio shipping_type" name="shipping_type" value="1" checked> 快递</label>
                    <label><input type="radio" class="radio shipping_type" name="shipping_type" value="2"> 物流配送</label>
                    <label><input type="radio" class="radio shipping_type" name="shipping_type" value="3"> 上门自取</label>
                </dt>
            </dl>
            <div class="item-group">
                <div class="label">购买数量</div>
                <div class="info">
                    <div class="buy-num-wrap">
                        <span class="btn" id="operate-left">-</span>
                        <input title="" type="text" class="buy-num" value="1" id="quantity">
                        <span class="btn" id="operate-right">+</span>
                    </div>
                </div>
            </div>
            <dl class="item-group">
                <dd class="label">支付方式</dd>
                <dt class="info">
                    <label><input type="radio" class="radio pay_type" name="pay_type" value="1" checked> 在线支付</label>
                    <label><input type="radio" class="radio pay_type" name="pay_type" value="2"> 货到付款</label>
                </dt>
            </dl>
            <div class="item-group">
                <div class="info">
                    <a class="btn-lg btn-buy-now" id="btn-buy-now">立即购买</a>
                    <a class="btn-lg" id="add-to-cart"><i class="iconfont icon-cartfill"></i> <span>加入购物车</span></a>
                </div>
            </div>
            <div class="item-group">
                <div class="share"><i class="iconfont icon-share"></i><span>分享</span></div>
                <div class="favorite" data-action="collection" data-id="{{$itemid}}" data-type="item">
                    <i class="iconfont icon-favor_fill_light"></i>
                    <span>收藏商品({{$iteminfo['collections']}})</span>
                </div>
            </div>
        </div>
        <!--goodsinfo end-->
        <div class="shopinfo-wrap">
            <div class="shop-header">
                <img src="{{asset('images/common/shop-header.png')}}">
            </div>
            <div class="shopinfo">
                <h3 title="{{$shop['shop_name']}}">{{substring($shop['shop_name'], 8)}}</h3>
                <div class="row">
                    <dl>
                        <dt>信誉</dt>
                        <dd>
                            <img src="{{asset('images/common/icon-guan.gif')}}">
                            <img src="{{asset('images/common/icon-guan.gif')}}">
                            <img src="{{asset('images/common/icon-guan.gif')}}">
                        </dd>
                    </dl>
                </div>
                <div class="row">
                    <dl>
                        <dt>掌柜</dt>
                        <dd title="{{$shop['username']}}">{{substring($shop['username'], 12)}}</dd>
                    </dl>
                </div>
                <div class="row">
                    <dl>
                        <dt>电话</dt>
                        <dd>{{$shop['phone']}}</dd>
                    </dl>
                </div>
                <div class="separate"></div>
                <div class="row" style="padding: 10px 0 20px;">
                    <a href="{{shop_url($shop['shop_id'])}}" class="btn" style="margin-right: 10px;">进入店铺</a>
                    <a class="btn" data-action="addCollection" data-id="{{$shop['shop_id']}}" data-type="shop">收藏店铺</a>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
    </div>
    <div class="blank"></div>
    <div class="area">
        <div class="item-detail" id="detail">
            <div class="tabbar-wrap">
                <ul class="tabbar">
                    <li class="cur"><a>宝贝详情</a></li>
                    <li><a>累计评论</a></li>
                </ul>
            </div>
            <div class="detail-content">
                {!! $content['content'] !!}
            </div>
        </div>

        <div class="item-detail-right">
            <div class="inner">
                <h3 class="hot-sale-title">掌柜热卖</h3>
                <ul class="hot-item-list">
                    @foreach ($hotSaleList as $item)
                        <li>
                            <div class="g-pic bg-cover asyncload" data-original="{{image_url($item['thumb'])}}">
                                <div class="g-name"><p>{{$item['title']}}</p></div>
                                <a href="{{item_url($item['itemid'])}}" target="_blank" title="{{$item['title']}}"></a>
                            </div>
                            <div class="line">
                                <span class="sold">已售出<span style="color: #f40;">{{$item['sold']}}</span>件</span>
                                <strong class="price"><span>¥</span>{{$item['price']}}</strong>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $("#operate-left").on('click', function () {
                var quantity = parseInt($("#quantity").val());
                if (quantity <= 1) {
                    return;
                }else {
                    quantity--;
                    $("#quantity").val(quantity);
                }
            });
            $("#operate-right").on('click', function () {
                var quantity = parseInt($("#quantity").val());
                quantity++;
                $("#quantity").val(quantity);
            });
            $("#btn-buy-now").on('click', function (e) {
                var submitForm = function () {
                    var shipping_type = $("input.shipping_type:checked").val();
                    var pay_type = $("input.pay_type:checked").val();
                    var quantity = $("#quantity").val();
                    $("#J_quantity").val(quantity);
                    $("#J_shipping_type").val(shipping_type);
                    $("#J_pay_type").val(pay_type);
                    $("#J_Frmbuy").submit();
                }
                DSXUtil.checkLogin(function () {
                    submitForm();
                }, function () {
                    DSXUI.showAjaxLogin(function () {
                        submitForm();
                    });
                });
            });
            $("#add-to-cart").on('click', function () {
                DSXUtil.checkLogin(function (data) {
                    var itemid = "{{$itemid}}";
                    var quantity = $("#quantity").val();
                    $.ajax({
                        url:"{{url('/cart/add')}}",
                        data:{itemid:itemid,quantity:quantity},
                        dataType:'json',
                        success:function (response) {
                            if (response.errcode){
                                DSXUI.error(response.errmsg);
                            }else {
                                DSXUI.success('已成功加入购物车');
                            }
                        }
                    });
                }, function () {
                    DSXUI.showAjaxLogin(function () {
                        DSXUtil.reFresh();
                    });
                });
            });
        });
    </script>
@stop
