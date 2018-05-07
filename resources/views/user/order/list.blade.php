@extends('layouts.user')

@section('title', '已买到的宝贝')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <form method="get">
                <input type="text" name="q" value="{{$q or ''}}" class="input-text" placeholder="订单号">
                <input type="submit" class="button" value="搜索">
            </form>
        </div>
        <ul class="tab">
            <li @if($tab=='all') class="tab on"@else class="tab"@endif><a href="{{url('/user/order?tab=all')}}">全部订单</a></li>
            <li @if($tab=='waitPay') class="tab on"@else class="tab"@endif><a href="{{url('/user/order?tab=waitPay')}}">待付款</a></li>
            <li @if($tab=='waitSend') class="tab on"@else class="tab"@endif><a href="{{url('/user/order?tab=waitSend')}}">待发货</a></li>
            <li @if($tab=='waitConfirm') class="tab on"@else class="tab"@endif><a href="{{url('/user/order?tab=waitConfirm')}}">待收货</a></li>
            <li @if($tab=='waitRate') class="tab on"@else class="tab"@endif><a href="{{url('/user/order?tab=waitRate')}}">待评价</a></li>
        </ul>
    </div>

    <div class="content-div">
        <table class="order-title-table" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
            <tr>
                <td>宝贝</td>
                <td width="80">单价</td>
                <td width="60">数量</td>
                <td width="100">商品操作</td>
                <td width="100">实付款</td>
                <td width="100">交易状态</td>
                <td width="100">交易操作</td>
            </tr>
            </tbody>
        </table>
        @foreach ($orderList as $order_id=>$order)
        <div class="order-item-wrap" id="order-item-{{$order_id}}">
            <table class="order-item-table" cellspacing="0" cellpadding="0" width="100%">
                <thead>
                <tr>
                    <th>
                        <span class="wrap-checkbox"><input title="" type="checkbox"></span>
                        <span class="wrap-time">{{@date('Y-m-d', $order['cretaed_at'])}}</span>
                        <span class="wrap-order-no">{{$order['order_no']}}</span>
                    </th>
                    <th colspan="2">
                        <h3>
                            <a href="{{shop_url($order['shop_id'])}}" title="{{$order['shop_name']}}" target="_blank">
                                {{substring($order['shop_name'], 6)}}</a>
                        </h3>
                    </th>
                    <th></th>
                    <th colspan="3" style="text-align: right;">
                        <a class="iconfont icon-deletefill delete-order" title="删除订单" rel="delete" data-id="{{$order_id}}"></a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($order['items'] as $itemid=>$item)
                <tr>
                    <td class="col1">
                        <div class="goods-pic">
                            <a href="{{item_url($itemid)}}" target="_blank"><img src="{{image_url($item['thumb'])}}"></a>
                        </div>
                        <div style="margin-left: 90px; overflow: hidden;">
                            <div class="goods-name"><a href="{{item_url($itemid)}}" target="_blank">{{$item['title']}}</a></div>
                            <div class="goods-attr">产品属性</div>
                        </div>
                    </td>
                    <td class="col2">
                        <p>￥{{$item['price']}}</p>
                    </td>
                    <td class="col3">{{$item['quantity']}}</td>
                    <td class="col4">
                        @if($loop->index === 1)
                            @if($order['pay_status'] && !$order['buyer_closed'])
                                @if ($order['receive_status'])
                                    <p><a>申请售后</a></p>
                                @else
                                    @if (!$order['refund_status'])
                                        <p><a href="{{url('/refund/apply?order_id='.$order_id)}}" target="_blank">退款/退货</a></p>
                                    @endif
                                @endif
                            @endif
                            <p><a>投诉卖家</a></p>
                        @endif
                    </td>
                    <td class="col5">
                        @if($loop->index === 1)
                        <p><strong style="color: #FF0000;">￥{{$order['total_fee']}}</strong></p>
                        <p style="font-size: 11px;">(含运费:￥{{$order['shipping_fee']}})</p>
                        @endif
                    </td>
                    <td class="col6">
                        @if ($loop->index === 1)
                            @if ($order['pay_type'] == 2)
                                @if ($order['shipping_status'])
                                    <p>需求提交成功</p>
                                @else
                                    <p>需求已提交</p>
                                @endif
                            @else
                                @if ($order['trade_status']==4||$order['trade_status']==5)
                                    <p>交易成功</p>
                                @else
                                    <p>{{$order['trade_status_tips'] or ''}}</p>
                                @endif
                            @endif
                                <p><a href="{{url('/user/order/detail?order_id='.$order_id)}}" target="_blank">订单详情</a></p>
                            @if ($order['shipping_status'])
                                 <p>查看物流</p>
                            @endif
                        @endif
                    </td>
                    <td class="col7">
                        @if ($loop->index === 1)
                            @if ($order['pay_type']==1)
                                @if ($order['trade_status']==1)
                                    <a href="{{url('/buy/pay?order_id='.$order_id)}}" target="_blank" class="button btn">立即支付</a>
                                    <p style="margin: 3px 0;"><a rel="closeOrder" data-id="{{$order_id}}">取消订单</a></p>
                                @elseif($order['trade_status']==2)
                                    <a>提醒卖家发货</a>
                                @elseif($order['trade_status']==3)
                                    <a href="{{url('/user/order/detail?order_id='.$order_id)}}" class="button btn" target="_blank">确认收货</a>
                                @elseif($order['trade_status']==4)
                                    <p><a>立即评价</a></p>
                                @elseif($order['trade_status']==5)
                                    <p><a>申请退货</a></p>
                                @endif
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
    <div>{{$pagination}}</div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("a[rel=delete]").on('click', function () {
                var order_id = $(this).attr('data-id');
                DSXUI.showConfirm('删除订单','确认要删除此订单吗?', function () {
                    var spinner = null;
                    $.ajax({
                        url:"{U:('c=order&a=delete')}",
                        data:{order_id:order_id},
                        dataType:'json',
                        beforeSend:function () {
                            spinner = DSXUI.showSpinner();
                        },
                        success:function (response) {
                            setTimeout(function () {
                                spinner.close();
                                if (response.errcode == 0){
                                    $("#order-item-"+order_id).remove();
                                }else {
                                    DSXUI.error('系统繁忙,请稍后再试');
                                }
                            }, 500);
                        }
                    });
                });
            });

            $("[rel=closeOrder]").on('click', function () {
                var order_id = $(this).attr('data-id');
                DSXUI.dialog({
                    title:'关闭订单',
                    iframe:"{U:('m=member&c=order&a=frame_close&order_id=')}"+order_id,
                    hideFooter:true,
                    height:'260px',
                    width:'550px',
                    afterShow:function (dlg) {
                        window.afterCloseOrder = function () {
                            dlg.close();
                            DSXUtil.reFresh();
                        }
                    }
                });
            });
        })
    </script>
@stop
