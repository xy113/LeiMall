@extends('layouts.admin')

@section('title', '订单列表')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}"></script>
@stop

@section('content')

    <div class="navigation">
        <a>后台管理</a>
        <span>></span>
        <a>订单管理</a>
        <span>></span>
        <a>订单列表</a>
    </div>
    <div class="search-container">
        <form method="get" id="searchFrom">
            <div class="row">
                <div class="cell">
                    <div class="label">商品ID:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="itemid" value="{{$itemid}}"></div>
                </div>
                <div class="cell">
                    <div class="label">订单编号:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="order_no" value="{{$order_no}}"></div>
                </div>
                <div class="cell">
                    <div class="label">买家昵称:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="buyer_name" value="{{$buyer_name}}"></div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">订单状态:</div>
                    <div class="field">
                        <select title="" class="form-control w200" name="order_status">
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
                    <div class="label">支付方式:</div>
                    <div class="field">
                        <select title="" class="form-control w200" name="pay_type">
                            <option value="0">全部</option>
                            <option value="1"{if $pay_type==1} selected{/if}>在线支付</option>
                            <option value="2"{if $pay_type==2} selected{/if}>货到付款</option>
                        </select>
                    </div>
                </div>
                <div class="cell">
                    <div class="label">物流状态:</div>
                    <div class="field">
                        <select title="" class="form-control w200" name="wuliu_status">
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
                    <div class="label">宝贝名称:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="title" value="{{$title}}"></div>
                </div>
                <div class="cell" style="width: auto;">
                    <div class="label">交易时间:</div>
                    <div class="field">
                        <label><input title="" type="text" class="form-control w100" name="time_begin" onclick="WdatePicker()" value="{{$time_begin}}"></label>
                        <label class="seperator">-</label>
                        <label><input title="" type="text" class="form-control w100" name="time_end" onclick="WdatePicker()" value="{{$time_end}}"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label"></div>
                    <div class="field">
                        <button type="button" class="btn btn-primary" id="btn-search">搜索订单</button>
                        <button type="button" class="btn btn-default" id="btn-export">批量导出</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="tabs-container">
        <div class="tabs">
            <div @if($tab==='all')class="tab on" @else class="tab"@endif><a href="{{url('/admin/order?tab=all')}}">全部订单</a><span>|</span></div>
            <div @if($tab==='waitPay')class="tab on" @else class="tab"@endif><a href="{{url('/admin/order?tab=waitPay')}}">等待买家付款</a><span>|</span></div>
            <div @if($tab==='waitSend')class="tab on" @else class="tab"@endif><a href="{{url('/admin/order?tab=waitSend')}}">等待卖家发货</a><span>|</span></div>
            <div @if($tab==='send')class="tab on" @else class="tab"@endif><a href="{{url('/admin/order?tab=send')}}">卖家已发货</a><span>|</span></div>
            <div @if($tab==='received')class="tab on" @else class="tab"@endif><a href="{{url('/admin/order?tab=received')}}">买家已收货</a><span>|</span></div>
            <div @if($tab==='reviewed')class="tab on" @else class="tab"@endif><a href="{{url('/admin/order?tab=reviewed')}}">买家已评价</a><span>|</span></div>
            <div @if($tab==='refunding')class="tab on" @else class="tab"@endif><a href="{{url('/admin/order?tab=refunding')}}">退款中</a></div>
            <div @if($tab==='closed')class="tab on" @else class="tab"@endif><a href="{{url('/admin/order?tab=closed')}}">已关闭的订单</a></div>
        </div>
    </div>
    <div class="content-div">
        <form method="post" id="listForm">
            {{csrf_field()}}
            <input type="hidden" name="formsubmit" value="yes" />
            <input type="hidden" name="eventType" value="" id="J_eventType">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="40" class="center">选?</th>
                    <th width="60">图片</th>
                    <th>商品名称 | 订单号 | 卖家账号</th>
                    <th>买家账号</th>
                    <th>金额</th>
                    <th>下单时间</th>
                    <th>订单状态</th>
                    <th width="60">详情</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orderlist as $order_id=>$order)
                <tr>
                    <td class="center"><input title="" type="checkbox" class="checkmark" name="orders[]" value="{{$order_id}}"></td>
                    <td><img src="{{image_url($order['item']['thumb'])}}" width="50" height="50"></td>
                    <td>
                        <h3 class="title"><a href="{{item_url($order['item']['itemid'])}}" target="_blank">{{$order['item']['title']}}</a></h3>
                        <p class="subtitle">
                            <span>{{$order['order_no']}} |</span>
                            <a href="{{shop_url($order['shop_id'])}}" target="_blank">{{$order['seller_name']}}</a>
                        </p>
                    </td>
                    <td>{{$order['buyer_name']}}</td>
                    <td>{{$order['order_fee']}}</td>
                    <td>{{@date('Y-m-d H:i:s', $order['created_at'])}}</td>
                    <td>{$order[order_status]}</td>
                    <td><a href="{{url('/admin/order/detail?order_id='.$order_id)}}" target="_blank">查看</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="15">
                        <div class="float-right">{{$pagination}}</div>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" data-action="checkall"> 全选</label>
                            <label><button type="button" class="btn btn-default" id="delete" disabled="disabled">删除订单</button></label>
                            <label><button type="button" class="btn btn-default" data-action="refresh">刷新</button></label>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <iframe id="J_frame" src="" style="display: none;"></iframe>
    <script type="text/javascript">
        $(document).on('click', function () {
            if ($(".checkmark:checked").length > 0){
                $("#delete").enable();
            }else {
                $("#delete").disable();
            }
        });

        var waiting = null;
        function downloadOrder() {
            $("#searchFrom").ajaxSubmit({
                dataType:'json',
                success:function (response) {
                    if (response.errcode == 0){
                        setTimeout(function () {
                            downloadOrder();
                        }, 500);
                    }else {
                        waiting.close();
                        $("#J_frame").attr('src', "{U:('c=order&a=get_excel')}");
                    }
                }
            });
        }
        $(function () {
            $(function () {
                $("#btn-search").on('click', function () {
                    $("#J_a").val('index');
                    $("#searchFrom").submit();
                });
                $("#btn-export").on('click', function () {
                    DSXUI.showConfirm('导出订单','订单下载过程可能需要花费几分钟，在此期间请不要关闭页面。',function () {
                        waiting = DSXUI.showloading('正在导出数据...');
                        $("#J_a").val('download');
                        downloadOrder();
                    });
                });
            });

            $("#delete").on('click', function () {
                DSXUI.showConfirm('删除订单','确认要删除所选订单吗?', function () {
                    $("#eventType").val('delete');
                    $("#listForm").ajaxSubmit({
                        beforeSend:function () {
                            spinner = DSXUI.showSpinner();
                        },
                        success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                DSXUtil.reFresh();
                            }, 500);
                        }
                    });
                });
            });
        });
    </script>
@stop
