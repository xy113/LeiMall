@extends('layouts.user')

@section('title', '订单详情')

@section('content')
    <div class="console-title">
        <h2>已买到的宝贝->订单详情</h2>
    </div>
    <div class="content-div">
        <h3 class="section-title">订单信息</h3>
        <table cellspacing="0" cellpadding="0" width="100%" class="formtable">
            <tbody>
            <tr>
                <td width="80">订单编号</td>
                <td>{$order[order_no]}</td>
            </tr>
            <tr>
                <td>下单时间</td>
                <td>{date:$order[create_time]|'Y-m-d H:i::s'}</td>
            </tr>
            <tr>
                <td>订单金额</td>
                <td>{amount:$order[total_fee]}</td>
            </tr>
            <tr>
                <td>付款方式</td>
                <td>{$_lang[pay_types][$order[pay_type]]}</td>
            </tr>
            <tr>
                <td>支付状态</td>
                <td>{if $order[pay_status]}已支付{else}未支付{/if}</td>
            </tr>
            {if $order[pay_time]}
            <tr>
                <td>付款时间</td>
                <td>{date:$order[pay_time]|'Y-m-d H:i::s'}</td>
            </tr>
            {/if}
            <tr>
                <td>交易流水</td>
                <td>{$order[trade_no]}</td>
            </tr>
            {if $order[pay_type]==2}
            <tr>
                <td>订单状态</td>
                <td>{if $order[shipping_status]}卖家已发货{else}买家已提交需求，等待卖家发货{/if}</td>
            </tr>
            {else}
            <tr>
                <td>订单状态</td>
                <td>{$trade_status_tips}</td>
            </tr>
            {/if}
            </tbody>
        </table>
        <h3 class="section-title">收货人信息</h3>
        <table cellspacing="0" cellpadding="0" width="100%" class="formtable">
            <tbody>
            <tr>
                <td width="80">收货人</td>
                <td>{$order[consignee]}</td>
            </tr>
            <tr>
                <td>联系电话</td>
                <td>{$order[phone]}</td>
            </tr>
            <tr>
                <td>收货地址</td>
                <td>{$order[address]}</td>
            </tr>
            </tbody>
        </table>
        {if $order[shipping_status]}
        <h3 class="section-title">发货信息</h3>
        <table cellspacing="0" cellpadding="0" width="100%" class="formtable">
            <tbody>
            {if $shipping[shipping_type]==1}
            <tr>
                <td width="80">发货方式</td>
                <td>快递</td>
            </tr>
            <tr>
                <td>快递公司</td>
                <td>{$shipping[express_name]}</td>
            </tr>
            <tr>
                <td>快递单号</td>
                <td>
                    <span>{$shipping[express_no]}</span>
                </td>
            </tr>
            {else}
            <tr>
                <td width="80">发货方式</td>
                <td>虚拟商品，无需物流</td>
            </tr>
            {/if}
            <tr>
                <td>发货时间</td>
                <td>{date:$shipping[shipping_time]|'Y-m-d H:i::s'}</td>
            </tr>
            </tbody>
        </table>
        {/if}
        <h3 class="section-title">商品信息</h3>
        <table class="order-title-table" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
            <tr>
                <td>宝贝</td>
                <td width="100">单价</td>
                <td width="80">数量</td>
                <td width="100">实付款</td>
            </tr>
            </tbody>
        </table>
        <div class="order-item-wrap" id="order-item-{$order_id}">
            <table class="order-item-table" cellspacing="0" cellpadding="0" width="100%">
                <tbody>
                {loop $itemlist $item}
                <tr>
                    <td class="col1">
                        <div class="goods-pic">
                            <img src="{img $item[thumb]}">
                        </div>
                        <div style="margin-left: 90px; overflow: hidden;">
                            <div class="goods-name">{$item[title]}</div>
                            <div class="goods-attr">商品属性</div>
                        </div>
                    </td>
                    <td class="col2">
                        {if $item[market_price]}<p><s>￥{amount:$item[market_price]}</s></p>{/if}
                        <p>￥{amount:$item[price]}</p>
                    </td>
                    <td class="col3">x{$item[quantity]}</td>
                    <td class="col5">
                        <p><strong style="color: #FF0000;">￥{amount:$order[total_fee]}</strong></p>
                        <p style="font-size: 11px;">(含运费:￥{amount:$order[shipping_fee]})</p>
                    </td>
                </tr>
                {/loop}
                </tbody>
            </table>
        </div>
        {if $trade_status==3}
        <a name="receipt"></a>
        <h3 class="section-title">确认收货</h3>
        <p style="padding: 0 10px; font-size: 12px;">请在确认收货前确保已收到货物，以免财物两空</p>
        <form method="post" id="receiptForm" action="{U:('c=order&a=receipt')}" autocomplete="off">
            <input type="hidden" name="order_id" value="{$order_id}">
            <table cellpadding="0" cellspacing="0" width="100%" class="formtable">
                <tbody>
                <tr>
                    <td class="cell-name" width="72">输入密码</td>
                    <td width="210"><input type="password" name="password" id="password" class="input-text" value="" placeholder="输入登录密码"></td>
                    <td><input type="button" id="receiptButton" class="button" value="确认收货"></td>
                </tr>
                </tbody>
            </table>
        </form>
        {/if}
    </div>
    <div style="clear: both; height: 50px;"></div>
    {if $trade_status==3}
    <form id="J_FrmreceiptSuccess" method="post" action="{$_G[BASEURL]}"></form>
    <script type="text/javascript">
        $(function () {
            $("#receiptButton").on('click',function () {
                var password = $.trim($("#password").val());
                if (!password){
                    DSXUI.error('请输入密码');
                }
                if (!DSXValidate.IsPassword(password)) {
                    DSXUI.error('密码输入错误');
                    return false;
                }
                var spinner = null;
                $("#receiptForm").ajaxSubmit({
                    dataType:'json',
                    beforeSend:function () {
                        spinner = DSXUI.showSpinner();
                    },
                    success:function (response) {
                        setTimeout(function () {
                            spinner.close();
                            if (response.errcode == 0){
                                DSXUI.success('确认收货成功', DSXUtil.reFresh);
                                /**
                                 * @author panjone
                                 * 确认收货成功后，跳转到订单列表待评价
                                 */
                                window.location.href = "{U:('c=order&a=itemlist&tab=waitRate')}";
                            }else {
                                DSXUI.error(response.errmsg);
                            }
                        }, 500);
                    }
                });
            });
        });
    </script>
    {/if}
@stop
