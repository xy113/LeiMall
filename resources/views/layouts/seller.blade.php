<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', '卖家中心')</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/seller.css')}}">
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/common.js')}}" type="text/javascript"></script>
</head>
<body>
@include('common.top')

<div class="seller-header">
    <div class="area header">
        <strong class="logo"><img src="{{asset('images/common/maijia_logo.png')}}"></strong>
        <div class="right-menu">
            <a href="{{url('/seller')}}">首页</a>
            <a href="{{url('/seller/shop')}}">基本设置</a>
            <a href="{{url('/seller/shop/auth')}}" target="_blank">店铺认证</a>
        </div>
    </div>
</div>
<div class="area" style="margin-top: 20px;">
    <div class="sidebar">
        <div class="sidebar-content">
            <div class="menus">
                <dl>
                    <dd><a><i class="iconfont icon-shopfill"></i>我的店铺</a></dd>
                    <dt>
                        <ul>
                            <li><a href="{{url('/seller/shop')}}"@if($menu==='shop_set') class="cur"@endif>店铺设置</a></li>
                            <li><a href="{{url('/seller/analyse')}}"@if($menu==='analyse') class="cur"@endif>数据统计</a></li>
                        </ul>
                    </dt>
                </dl>

                <dl>
                    <dd><a><i class="iconfont icon-presentfill"></i>宝贝管理</a></dd>
                    <dt>
                        <ul>
                            <li><a href="{{url('/seller/item/sell')}}"@if($menu==='sell') class="cur"@endif>发布宝贝</a></li>
                            <li><a href="{{url('/seller/item/itemlist?saleStatus=on_sale')}}"@if($menu==='on_sale_item') class="cur"@endif>出售中的宝贝</a></li>
                            <li><a href="{{url('/seller/item/itemlist?saleStatus=off_sale')}}"@if($menu==='off_sale_item') class="cur"@endif>仓库中的宝贝</a></li>
                        </ul>
                    </dt>
                </dl>
                <dl>
                    <dd><a><i class="iconfont icon-moneybagfill"></i>交易管理</a></dd>
                    <dt>
                        <ul>
                            <li><a href="{{url('/seller/sold/itemlist')}}"@if($menu==='sold_items') class="cur"@endif>已卖出的宝贝</a></li>
                        </ul>
                    </dt>
                </dl>
            </div>
        </div>
    </div>
    <div class="mainframe">
        <div class="main-content">
            @yield('content', '')
        </div>
    </div>
</div>
<div id="footer">
    <div class="area">
        <div class="bottomNav">
            <a href="javascript:;">关于我们</a><span class="split">|</span>
            <a href="javascript:;">联系方式</a><span class="split">|</span>
            <a href="javascript:;">广告服务</a><span class="split">|</span>
            <a href="javascript:;">法律援助</a><span class="split">|</span>
            <a href="javascript:;">加入我们</a><span class="split">|</span>
            <a href="javascript:;">支付方式</a><span class="split">|</span>
            <a href="javascript:;">技术支持</a>
        </div>

        <div class="copyright">{{setting('copyright')}}   {{setting('icp')}}</div>
    </div>
</div>
</body>
</html>
