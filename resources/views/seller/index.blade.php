@extends('layouts.seller')

@section('title', '卖家中心')

@section('content')
    <script>$('body').css({'background-color':'#f0f0f0'});</script>
    @if ($shop['closed'])
        <div class="notice-nav">
            <a href="{{url('/seller/shop')}}" class="float-right">完善资料</a>
            你的店铺由于资料不全，已被管理员关闭，请完善店铺资料和认证资料，向管理员申请重新开启。
        </div>
    @endif
    <div class="row">
        <div class="seller-module live-data">
            <iframe style="height: 240px; width: 100%;" frameborder="0" scrolling="no" src="{{url('/seller/shop/live_data')}}"></iframe>
        </div>
        <div class="seller-module bidu">
            <div class="title">卖家必读</div>
            <div class="content">
                <ul class="articles">
                    @foreach ($postList as $item)
                        <li><a href="{{post_url($item['aid'])}}" target="_blank"><span>{{$loop->iteration}}.</span> {{$item['title']}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="blank"></div>
    <div class="row">
        <div class="seller-module order-notice">
            <div class="title">订单提醒</div>
            <div class="content">
                <ul class="todo-list">
                    <li>待付款订单: {{$waitPayCount}}</li>
                    <li>待发货订单: {{$waitSendCount}}</li>
                    <li>待收货订单: 0</li>
                    <li>待评价订单: 0</li>
                    <li>退款中订单: 0</li>
                    <li>已关闭订单: 0</li>
                </ul>
            </div>
        </div>
        <div class="seller-module">
            <div class="title">财务信息</div>
            <div class="wallet-wrap">
                <div class="wallet-row">
                    <h2>账户余额:{{$wallet['balance']}}</h2>
                    <div class="sub-links">
                        <a href="{{url('/user/wallet')}}" target="_blank">交易记录</a>
                    </div>
                </div>
                <div class="wallet-row" style="border-bottom: none;">
                    <h2>支付方式</h2>
                    <div class="sub-links">
                        <a href="{{url('/user/wallet?pay_type=balance')}}" target="_blank">余额支付</a>
                        <a href="{{url('/user/wallet?pay_type=wxpay')}}" target="_blank">微信支付</a>
                        <a href="{{url('/user/wallet?pay_type=alipay')}}" target="_blank">支付宝支付</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
