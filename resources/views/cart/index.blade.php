<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', '购物车')</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/cart.css')}}" rel="stylesheet" type="text/css">
    @yield('styles')
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/common.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/angular.min.js')}}" type="text/javascript"></script>
    @yield('scripts')
</head>
<body>
@include('common.top', [])
<div class="header">
    <div class="area banner">
        <div class="global-logo">
            <img src="{{asset('images/cugeng/global-logo.png')}}">
        </div>
        <div class="global-search-box">
            <form method="get" action="{{url('/search')}}">
                <div class="input-box">
                    <input type="text" class="text" placeholder="商品名称" name="q" value="{{$q or ''}}">
                    <input type="submit" class="btn" value="搜索">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="area cart">
    <div class="cart-filter-bar">
        <span>总计{{$totalCount}}件商品</span>
        <strong>全部商品</strong>
    </div>
    <div class="cart-main">
        <form method="post" id="J_Frmcart" autocomplete="off" action="{{url('/buy/order/confirm_order')}}">
            <div class="cart-table-th">
                <table cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                    <tr>
                        <th width="100">
                            <label>
                                <input type="checkbox" class="checkbox checkall checkmark">
                                <span>全选</span>
                            </label>
                        </th>
                        <th>商品信息</th>
                        <th width="100">单价</th>
                        <th width="120">数量</th>
                        <th width="100">金额</th>
                        <th width="100">操作</th>
                    </tr>
                    </tbody>
                </table>
            </div>
            @if ($itemlist)
                @foreach ($itemlist as $shop_id=>$shop)
                    <div class="cart-item">
                        <h3>
                            <input title="" type="checkbox" class="checkbox checkmark groupCheckbox" data-target=".group_{{$shop_id}}">
                            <span class="iconfont icon-shopfill"></span><a href="{{shop_url($shop_id)}}" target="_blank">{{$shop['shop_name']}}</a>
                        </h3>
                        <div class="order-content">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                @foreach($shop['items'] as $itemid=>$item)
                                <tbody id="item-{$itemid}">
                                <tr @if($loop->first) class="first"@endif>
                                <td class="item-info">
                                    <input type="hidden" id="J_price_{{$itemid}}" value="{{$item['price']}}">
                                    <div class="chk">
                                        <input title="" type="checkbox" class="checkbox checkmark J_CheckBoxItem group_{{$shop_id}}" name="items[]" value="{{$itemid}}">
                                    </div>
                                    <div class="g-pic bg-cover lazyload" data-original="{{image_url($item['thumb'])}}">
                                        <a href="{{item_url($itemid)}}" target="_blank"></a>
                                    </div>
                                    <div class="g-info">
                                        <div class="g-name"><a href="{{item_url($itemid)}}" target="_blank">{{$item['title']}}</a></div>
                                    </div>
                                </td>
                                <td width="100"></td>
                                <td width="100">
                                    <p style="color: #999; margin-bottom: 3px;"><s>{{$item['cart_price'] or ''}}</s></p>
                                    <strong>￥{{$item['price']}}</strong>
                                </td>
                                <td width="120">
                                    <div class="quantity-inner">
                                    <span class="btn opLeft" data-id="{$itemid}">-
                                    </span><input title="" type="text" class="text" value="{{$item['quantity']}}" id="quantity_{{$itemid}}"><span class="btn opRight" data-id="{{$itemid}}">+</span>
                                    </div>
                                </td>
                                <td width="100"><strong style="color: #f40;" id="simple_price_{{$itemid}}">￥{{$item['total_fee']}}</strong></td>
                                <td width="100">
                                    <p><a>移入收藏夹</a></p>
                                    <p><a rel="delete" data-id="{{$itemid}}">删除</a></p>
                                </td>
                                </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="noaccess"><a href="{{url('/')}}">购物车空空也, 快去选购宝贝吧</a></div>
            @endif
        </form>
    </div>
    <div class="float-bar">
        <div class="wrap">
            <div class="chk">
                <input title="" type="checkbox" class="checkbox checkall checkmark" autocomplete="off">
                <span>全选</span>
            </div>
            <div class="operations">
                <a id="multi-delete">删除</a>
                <a id="move-to-favor">移入收藏夹</a>
            </div>
            <div class="right">
                <div class="item-sum">已选中<strong id="total_count">0</strong>件商品</div>
                <div class="item-sum">合计 (不含运费): <strong id="total_fee">0.00</strong></div>
                <div class="submit-btn btn-disabled" id="submit-btn">结算</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        function checkSubmit() {
            if($(".J_CheckBoxItem:checked").length > 0) $("#J_Frmcart").submit();
        }
        function settlement() {
            var total_count = 0, total_fee = 0;
            $(".J_CheckBoxItem:checked").each(function () {
                var itemid = $(this).val();
                var quantity = parseInt($("#quantity_"+itemid).val());
                var price = $("#J_price_"+itemid).val();
                total_count+= quantity;
                total_fee+= price * quantity;
            });
            $("#total_count").text(total_count.toString());
            $("#total_fee").text(total_fee.toFixed(2));
        }
        $(document).on('click', function () {
            if($(".J_CheckBoxItem:checked").length > 0){
                $("#submit-btn").removeClass("btn-disabled").off('click').on('click', checkSubmit);
            }else {
                $("#submit-btn").addClass("btn-disabled").off('click');
            }
        });
        var spinner = null;
        $("a[rel=delete]").on('click', function (e) {
            var itemid = $(this).attr('data-id');
            DSXUI.showConfirm('移除购物车','确认要从购物车中移除此宝贝吗？', function () {
                $.ajax({
                    url:"{U:('m=cart&c=index&a=delete')}",
                    data:{items:itemid},
                    dataType:'json',
                    beforeSend:function () {
                        spinner = DSXUI.showSpinner();
                    },
                    success:function (response) {
                        setTimeout(function () {
                            spinner.close();
                            if (response.errcode == 0){
                                $("#item-"+itemid).remove();
                                settlement();
                            }else {
                                DSXUI.error(response.errmsg);
                            }
                        }, 300);
                    }
                });
            });
        });

        $("#multi-delete").on('click', function () {
            if ($(".J_CheckBoxItem:checked").length > 0){
                var ids = [];
                $(".J_CheckBoxItem:checked").each(function () {
                    ids.push($(this).val());
                });
                DSXUI.showConfirm('移除购物车','确认要从购物车中移除此宝贝吗？', function () {
                    $.ajax({
                        url:"{U:('m=cart&c=index&a=delete')}",
                        data:{items:ids.join(',')},
                        dataType:'json',
                        beforeSend:function () {
                            spinner = DSXUI.showSpinner();
                        },
                        success:function (response) {
                            setTimeout(function () {
                                spinner.close();
                                if (response.errcode == 0){
                                    DSXUtil.reFresh();
                                }else {
                                    DSXUI.error(response.errmsg);
                                }
                            }, 300);
                        }
                    });
                });
            }
        });
        $("#move-to-favor").on('click', function () {
            if ($(".J_CheckBoxItem:checked").length > 0){
                var ids = [];
                $(".J_CheckBoxItem:checked").each(function () {
                    ids.push($(this).val());
                });
                DSXUI.showConfirm('移除购物车','确认要将所选宝贝移入收藏夹吗?', function () {
                    $.ajax({
                        url:"{U:('m=cart&c=index&a=move_to_favor')}",
                        data:{items:ids.join(',')},
                        dataType:'json',
                        beforeSend:function () {
                            spinner = DSXUI.showSpinner();
                        },
                        success:function (response) {
                            setTimeout(function () {
                                spinner.close();
                                if (response.errcode == 0){
                                    DSXUtil.reFresh();
                                }else {
                                    DSXUI.error(response.errmsg);
                                }
                            }, 300);
                        }
                    });
                });
            }
        });
        $(".opLeft").on('click', function () {
            var itemid = $(this).attr('data-id');
            var quantity = $("#quantity_"+itemid).val();
            var price = $("#J_price_"+itemid).val();
            if (quantity <= 1) {
                return false;
            }else {
                quantity--;
                var simple_price = (price*quantity).toFixed(2);
                $("#quantity_"+itemid).val(quantity);
                $("#simple_price_"+itemid).text('￥'+simple_price);
                $.ajax({
                    type:'POST',
                    url:"{U:('m=cart&c=index&a=update_quantity')}",
                    data:{itemid:itemid, quantity:quantity},
                    dataType:'json',
                    beforeSend:function () {
                        spinner = DSXUI.showSpinner();
                        settlement();
                    },
                    success:function (response) {
                        setTimeout(function () {
                            spinner.close();
                        }, 500);
                    }
                });
            }
        });

        $(".opRight").on('click', function () {
            var itemid = $(this).attr('data-id');
            var quantity = $("#quantity_"+itemid).val();
            var price = $("#J_price_"+itemid).val();

            quantity++;
            var simple_price = (price*quantity).toFixed(2);
            $("#quantity_"+itemid).val(quantity);
            $("#simple_price_"+itemid).text('￥'+simple_price);
            $.ajax({
                type:'POST',
                url:"{U:('m=cart&c=index&a=update_quantity')}",
                data:{itemid:itemid, quantity:quantity},
                dataType:'json',
                beforeSend:function () {
                    spinner = DSXUI.showSpinner();
                    settlement();
                },
                success:function (response) {
                    setTimeout(function () {
                        spinner.close();
                    }, 500);
                }
            });
        });
        $(".groupCheckbox").on('click', function () {
            var target = $(this).attr('data-target');
            $(target).prop('checked', $(this).is(":checked"));
            settlement();
        });
        $(".checkall, .J_CheckBoxItem").on('click', settlement);
    });
</script>

@include('common.footer')
