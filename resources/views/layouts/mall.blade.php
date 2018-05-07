<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', setting('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/style_cg.css')}}" rel="stylesheet" type="text/css">
    @yield('styles')
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/common.js')}}" type="text/javascript"></script>
    @yield('scripts')
</head>
<body>
@include('common.top')

<div class="header">
    <div class="area banner">
        <div class="global-logo">
            <img src="{{asset('images/cugeng/global-logo.png')}}">
        </div>
        <div class="global-search-box">
            <form method="get" action="{{url('/')}}">
                <input type="hidden" name="m" value="item">
                <input type="hidden" name="c" value="search">
                <div class="input-box">
                    <input type="text" class="text" placeholder="商品名称" name="q" value="{{$q or ''}}">
                    <input type="submit" class="btn" value="搜索">
                </div>
            </form>
            <div class="hot">
                热门搜索:
                <a href="{{url('/item/search?q=花菜')}}">花菜</a>、
                <a href="{{url('/item/search?q=胡萝卜')}}">胡萝卜</a>、
                <a href="{{url('/item/search?q=五花肉')}}">五花肉</a>
            </div>
        </div>
        <ul class="apps">
            <li>
                <div class="pic showqrcode"><img src="{{asset('images/common/weixin_qrcode.jpg')}}"></div>
                <p>在微信关注我们</p>
            </li>
            <li>
                <div class="pic showqrcode"><img src="{{asset('images/common/app_qrcode.jpg')}}"></div>
                <p>下载粗耕APP</p>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    $(".showqrcode").mouseenter(function () {
        var src = $(this).find('img').attr('src');
        var offset = $(this).offset();
        var img = $("<img/>").width(200).height(200).attr('id','J-qrcode-preview').attr('src', src).appendTo(document.body);
        img.css({'z-index':9999, 'left':offset.left + $(this).width() - 200, 'top':offset.top+$(this).height(),'position':'fixed', 'border':'1px #DDD solid'});
    }).mouseleave(function () {
        $("#J-qrcode-preview").remove();
    });
</script>
<div class="global-nav">
    <div class="nav">
        <div class="cat"><a href="{{url('/item/catlog')}}"><span class="iconfont icon-sort"></span> 全部商品分类</a></div>
        <ul>
            <li><a href="{{url('/')}}"@if(isset($globalNav)&&$globalNav==='home') class="cur"@endif>首页</a></li>
            <li><a href="{{url('/youxuan')}}"@if(isset($globalNav)&&$globalNav==='item') class="cur"@endif>粗耕优选</a></li>
            <li><a href="{{url('/shop')}}"@if(isset($globalNav)&&$globalNav==='shop') class="cur"@endif>企业店铺</a></li>
            <li><a href="{{url('/user/order')}}">我的订单</a></li>
        </ul>
        <div class="cart" id="nav-cart">
            <a href="{{url('/cart')}}">
                <span class="ico"></span>
                <span>购物车{{intval(cookie('cart_total_count')->getValue())}}件</span>
                <strong>去结算>></strong>
            </a>
        </div>
    </div>
</div>

@yield('content', '')

<div id="footer">
    <div class="area">
        <div class="bottomNav">
            <a href="http://cg.liaidi.com/index.php?m=page&c=detail&pageid=33">关于我们</a><span>|</span>
            <a href="http://cg.liaidi.com/index.php?m=page&c=detail&pageid=42">联系我们</a><span>|</span>
            <a href="http://cg.liaidi.com/index.php?m=page&c=detail&pageid=36">隐私政策</a><span>|</span>
            <a href="http://cg.liaidi.com/index.php?m=page&c=detail&pageid=37">新手入门</a><span>|</span>
            <a href="http://cg.liaidi.com/index.php?m=page&c=detail&pageid=43">加入我们</a><span>|</span>
            <a href="http://cg.liaidi.com/index.php?m=page&c=detail&pageid=40">支付方式</a>
        </div>

        <div class="copyright">{{setting('copyright')}}   {{setting('icp')}}</div>
    </div>
    <script>(function(){
            var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?4e167525feb56e71d659c7894c10757c":"https://jspassport.ssl.qhimg.com/11.0.1.js?4e167525feb56e71d659c7894c10757c";
            document.write('<script src="' + src + '" id="sozz"><\/script>');
        })();
    </script>
</div>
</body>
</html>
