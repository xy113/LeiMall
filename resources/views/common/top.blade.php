<div class="top">
    <div class="area">
        <div class="right">
            <ul>
                <li><a href="{{url('/')}}">粗耕首页</a></li>
                <li class="pipe">|</li>
                <li><a href="{{url('/user')}}">我的粗耕</a></li>
                <li class="pipe">|</li>
                <li>
                    <a href="{{url('/cart')}}">
                        <span class="iconfont icon-cartfill"></span>
                        <span>购物车</span>
                    </a>
                </li>
                <li class="pipe">|</li>
                <li><a href="{{url('/user/collection')}}"><span class="iconfont icon-favorfill"></span> <span>收藏夹</span></a></li>
                <li class="pipe">|</li>
                <li>
                    <a href="{{url('/item/catlog')}}">
                        <span>商品分类</span>
                    </a>
                </li>
                <li class="pipe">|</li>
                <li><a href="{{url('/seller')}}">卖家中心</a></li>
                <li class="pipe">|</li>
                <li><a href="{{page_url(42)}}">联系客服</a></li>
            </ul>
        </div>
        @if($isloggedin)
            <span>Hi <a href="{{url('/user')}}" style="color: #f40;">{{$username}}</a>, 欢迎回来</span>
            <a href="{{url('/account/logout')}}">[退出登录]</a>
        @else
            <span>Hi 欢迎回来</span>
            <a href="{{url('/account/login')}}">[登录]</a>
            <a href="{{url('/account/register')}}">[免费注册]</a>
        @endif
    </div>
</div>
