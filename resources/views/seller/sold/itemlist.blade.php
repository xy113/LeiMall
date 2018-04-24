@extends('layouts.seller')

@section('title', '已卖出的宝贝')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}"></script>
@stop

@section('content')
    <div class="navigation">
        <a>我是卖家</a>
        <span>></span>
        <a>宝贝管理</a>
        <span>></span>
        <a>已卖出的宝贝</a>
    </div>
    <div class="order-search">
        <form method="get" id="searchFrom">
            <div class="row">
                <div class="cell">
                    <label>商品ID:</label>
                    <div class="field"><input title="" type="text" class="input-text" name="itemid" value="{{$itemid}}"></div>
                </div>
                <div class="cell">
                    <label>订单编号:</label>
                    <div class="field"><input title="" type="text" class="input-text" name="order_no" value="{{$order_no}}"></div>
                </div>
                <div class="cell">
                    <label>买家昵称:</label>
                    <div class="field"><input title="" type="text" class="input-text" name="buyer_name" value="{{$buyer_name}}"></div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <label>订单状态:</label>
                    <div class="field">
                        <select title="" class="select" name="order_status">
                            <option value="0">全部</option>
                            <option value="1"{if $order_status==1} selected{/if}>等待买家付款</option>
                            <option value="2"{if $order_status==2} selected{/if}>买家已付款</option>
                            <option value="3"{if $order_status==3} selected{/if}>卖家已发货</option>
                            <option value="4"{if $order_status==4} selected{/if}>交易成功</option>
                            <option value="5"{if $order_status==5} selected{/if}>买家已评价</option>
                            <option value="6"{if $order_status==6} selected{/if}>退款中的订单</option>
                            <option value="7"{if $order_status==7} selected{/if}>退款完成</option>
                        </select>
                    </div>
                </div>
                <div class="cell">
                    <label>支付方式:</label>
                    <div class="field">
                        <select class="select" name="pay_type">
                            <option value="0">全部</option>
                            <option value="1"{if $pay_type==1} selected{/if}>在线支付</option>
                            <option value="2"{if $pay_type==2} selected{/if}>货到付款</option>
                        </select>
                    </div>
                </div>
                <div class="cell">
                    <label>物流状态:</label>
                    <div class="field">
                        <select class="select" name="wuliu_status">
                            <option value="0">全部</option>
                            <option value="1"{if $wuliu_status==1} selected{/if}>未发货</option>
                            <option value="2"{if $wuliu_status==2} selected{/if}>已发货</option>
                            <option value="3"{if $wuliu_status==3} selected{/if}>已收货</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <label>宝贝名称:</label>
                    <div class="field"><input title="" type="text" class="input-text" name="title" value="{{$title}}"></div>
                </div>
                <div class="cell" style="width: auto;">
                    <label>交易时间:</label>
                    <div class="field">
                        <input title="" type="text" class="input-text" name="time_begin" onclick="WdatePicker()" value="{{$time_begin}}"> -
                        <input title="" type="text" class="input-text" name="time_end" onclick="WdatePicker()" value="{{$time_end}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <label></label>
                    <div class="field">
                        <button type="button" class="button" id="btn-search">搜索订单</button>
                        <button type="button" class="button button-cancel" id="btn-export">批量导出</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="tabs-container">
        <div class="tabs">
            <div @if($tab=='all') class="tab on"@else class="tab"@endif><a href="{{url('seller/sold/itemlist?tab=all')}}">全部订单</a><span>|</span></div>
            <div @if($tab=='waitPay') class="tab on"@else class="tab"@endif><a href="{{url('seller/sold/itemlist?tab=waitPay')}}">等待买家付款</a><span>|</span></div>
            <div @if($tab=='waitSend') class="tab on"@else class="tab"@endif><a href="{{url('seller/sold/itemlist?tab=waitSend')}}">等待发货</a><span>|</span></div>
            <div @if($tab=='send') class="tab on"@else class="tab"@endif><a href="{{url('seller/sold/itemlist?tab=send')}}">已发货</a><span>|</span></div>
            <div @if($tab=='waitRate') class="tab on"@else class="tab"@endif><a href="{{url('seller/sold/itemlist?tab=waitRate')}}">等待买家评价</a><span>|</span></div>
            <div @if($tab=='refunding') class="tab on"@else class="tab"@endif><a href="{{url('seller/sold/itemlist?tab=refunding')}}">退款中</a></div>
            <div @if($tab=='closed') class="tab on"@else class="tab"@endif><a href="{{url('seller/sold/itemlist?tab=closed')}}">已关闭的订单</a></div>
        </div>
    </div>
    <div class="list-div">
        <table class="order-title-table" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
            <tr>
                <td>宝贝</td>
                <td width="100">单价</td>
                <td width="80">数量</td>
                <td width="100">买家</td>
                <td width="100">交易状态</td>
                <td width="100">实收款</td>
                <td width="100">操作</td>
            </tr>
            </tbody>
        </table>
        @foreach($orderList as $order_id=>$order)
        {loop $order_list $order_id $order}
        <div class="order-item-wrap" id="order-item-{$order_id}">
            <table class="order-item-table" cellspacing="0" cellpadding="0" width="100%">
                <thead>
                <tr>
                    <th>
                        <span class="wrap-checkbox"><input type="checkbox" class="checkbox checkmark"></span>
                        <span class="wrap-time">{date:$order[create_time]|'Y-m-d H:i'}</span>
                        <span class="wrap-order-no">{$order[order_no]}</span>
                    </th>
                    <th colspan="3"></th>
                    <th colspan="3"></th>
                </tr>
                </thead>
                <tbody>
                {eval $index=0}
                {loop $order[items] $itemid $item}
                <tr>
                    <td class="col1">
                        <div class="goods-pic">
                            <a href="{U:('m=item&c=item&id='.$itemid)}" target="_blank"><img src="{img $item[thumb]}"></a>
                        </div>
                        <div style="margin-left: 90px; overflow: hidden;">
                            <div class="goods-name"><a href="{U:('m=item&c=item&id='.$itemid)}" target="_blank">{$item[title]}</a></div>
                            <div class="goods-attr">商品属性</div>
                        </div>
                    </td>
                    <td class="col2">
                        {if $item[promotion_price]>0}
                        <p><s>￥{$item[price]}</s></p>
                        <p>￥{$item[promotion_price]}</p>
                        {else}
                        <p>￥{$item[price]}</p>
                        {/if}
                    </td>
                    <td class="col3">{$item[quantity]}</td>
                    <td class="col4">
                        {if $index==0}
                        {$order[buyer_name]}
                        {/if}
                    </td>
                    <td class="col6">
                        {if $index==0}
                        {if $order[pay_type]==1}
                        {if $order[order_trade_status]==0}
                        <p><span style="color: #FF0000;">交易关闭</span></p>
                        {elseif $order[order_trade_status]==1}
                        <p>等待买家付款</p>
                        <p><a rel="edit-price" class="link" data-id="{$order[order_id]}">修改价格</a></p>
                        {elseif $order[order_trade_status]==2}
                        <p>买家已付款</p>
                        {elseif $order[order_trade_status]==3}
                        <p>宝贝运送中</p>
                        <p>查看物流</p>
                        {elseif $order[order_trade_status]==4}
                        <p>交易成功</p>
                        <p>货物已签收</p>
                        {elseif $order[order_trade_status]==5}
                        <p>交易成功</p>
                        <p>货物已签收</p>
                        <p>买家已评价</p>
                        {elseif $order[order_trade_status]==6}
                        <p><a href="{U:('m=refund&c=accept&order_id='.$order_id)}" target="_blank">买家申请退款</a></p>
                        {elseif $order[order_trade_status]==7}
                        <p>退款完成</p>
                        <p><span style="color: #FF0000;">交易关闭</span></p>
                        {/if}
                        {else}
                        {if $order[closed]}
                        <p><span style="color: #FF0000;">交易关闭</span></p>
                        {else}
                        {if $order[shipping_status]}
                        <p>货物已发出</p>
                        {else}
                        <p>买家已提交需求</p>
                        <p><a data-id="{$order_id}">关闭订单</a></p>
                        {/if}
                        {/if}
                        {/if}
                        <p><a href="{U:('&c=order&a=detail&order_id='.$order_id)}" class="link" target="_blank">订单详情</a></p>
                        {/if}
                    </td>
                    <td class="col5">
                        {if $index==0}
                        <p><strong style="color: #FF0000;">￥{amount:$order[total_fee]}</strong></p>
                        <p style="font-size: 11px;">(含运费:￥{amount:$order[shipping_fee]})</p>
                        {/if}
                    </td>
                    <td class="col7">
                        {if $index==0}
                        {if $order[pay_type]==1}
                        {if $order[order_trade_status]==1}
                        <p><a class="button btn" rel="edit-price" data-id="{$order_id}">修改价格</a></p>
                        {/if}
                        {if $order[order_trade_status]==2}
                        <p><a href="{U:('&c=order&a=detail&order_id='.$order_id)}" target="_blank" class="button btn">发货</a></p>
                        {/if}
                        {if $order[order_trade_status]==4}
                        <p><a>评价买家</a></p>
                        {/if}
                        {if $order[order_trade_status]==5}
                        <p>交易成功</p>
                        {/if}
                        {else}
                        {if !$order[shipping_status]}
                        <p><a href="{U:('&c=order&a=detail&order_id='.$order_id)}" target="_blank" class="button btn">发货</a></p>
                        {/if}
                        {/if}
                        {/if}
                    </td>
                </tr>
                {eval $index++}
                {/loop}
                </tbody>
            </table>
        </div>
        @endforeach
        <div class="bottom-actions">
            <div class="pagination float-right">{{$pagination}}</div>
            <label><input type="checkbox" class="checkbox checkall checkmark"> 全选</label>
        </div>
    </div>
    <iframe id="J_frame" src="" style="display: none;"></iframe>
    <script type="text/javascript">
        var waiting = null;
        function downloadOrder() {
            $.ajax({
                url:"{U:('c=sold&a=download&q='.$q)}",
                dataType:'json',
                success:function (response) {
                    if (response.errcode === 0){
                        setTimeout(function () {
                            downloadOrder();
                        }, 500);
                    }else {
                        waiting.close();
                        $("#J_frame").attr('src', "{U:('c=sold&a=get_excel')}");
                    }
                }
            });
        }
        $(function () {
            $("#btn-search").on('click', function () {
                $("#J_a").val('index');
                $("#searchFrom").submit();
            });
            $("#btn-export").on('click', function () {
                DSXUI.showConfirm('订单下载过程可能需要花费几分钟，在此期间请不要关闭页面',function () {
                    waiting = DSXUI.showloading('正在导出数据...');
                    $("#J_a").val('download');
                    downloadOrder();
                });
            });
        });
    </script>
    <script src="/static/js/seller/seller.js" type="text/javascript"></script>
@stop
