@extends('layouts.user')

@section('title', '我的钱包')

@section('content')
    <div class="console-title">
        <div class="float-right"><strong style="font-size: 18px;">当前余额: <span>{{$wallet['balance']}}</span></strong></div>
        <h2>我的钱包->交易明细</h2>
    </div>

    <div class="content-div">
        <div class="trade-filter-div">
            <form method="get" id="J_Frmsearch">
                <input type="hidden" name="date_range" value="{{$date_range}}" id="J_date_range">
                <input type="hidden" name="trade_type" value="{{$trade_type}}" id="J_trade_type">
                <input type="hidden" name="pay_type" value="{{$pay_type}}" id="J_pay_type">
                <div class="row">
                    <div class="label">交易时间:</div>
                    <div class="content">
                        <a daterange="all">全部</a>
                        <a daterange="3days">近三天</a>
                        <a daterange="7days">近一周</a>
                        <a daterange="oneMonth">近一个月</a>
                        <a daterange="threeMonth">近三个月</a>
                        <a daterange="oneYear">近一年</a>
                    </div>
                </div>
                <div class="row">
                    <div class="label">交易类型:</div>
                    <div class="content">
                        <a tradetype="all">全部</a>
                        <a tradetype="shopping">购物</a>
                        <a tradetype="charge">缴费</a>
                        <a tradetype="withdraw">提现</a>
                        <a tradetype="other">其他</a>
                    </div>
                </div>
                <div class="row">
                    <div class="label">支付方式:</div>
                    <div class="content">
                        <a paytype="all">全部</a>
                        <a paytype="wxpay">微信支付</a>
                        <a paytype="alipay">支付宝</a>
                        <a paytype="balance">余额支付</a>
                    </div>
                </div>
                <div class="row">
                    <div class="label">关键字:</div>
                    <div class="content">
                        <span><input type="text" class="input-text" name="q" placeholder="交易名称，流水号" value="{{$q}}"></span>
                        <span><input type="submit" class="button" value="搜索"></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="content-div">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="listtable trade-list-table">
            <thead>
            <tr>
                <th class="head-time">创建时间</th>
                <th>名称 | 流水 | 对方账户</th>
                <th class="amount">金额</th>
                <th class="status">状态</th>
            </tr>
            </thead>
            <tbody>
            @foreach($itemlist as $trade_id=>$item)
                <tr>
                    <td class="time"><span>{{@date('Y年m月d日', $item['created_at'])}}</span></td>
                    <td class="name">
                        <h3>{{$item['trade_name']}}</h3>
                        <p>{{$item['trade_no']}} | {{$item['payee_name']}}</p>
                    </td>
                    <td class="amount"><span>{{$item['trade_fee']}}</span></td>
                    <td class="status">{{$item['trade_status_name']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination" style="margin-top: 20px;"><div style="float:left;">总计{{$totalCount}}条记录</div>{{$pagination}}</div>
    </div>
    <script type="text/javascript">
        $(function(){
            $("[daterange={{$date_range}}]").addClass('cur');
            $("[daterange]").on('click', function () {
                $("#J_date_range").val($(this).attr('daterange'));
                $("#J_Frmsearch").submit();
            });
            $("[tradetype={{$trade_type}}]").addClass('cur');
            $("[tradetype]").on('click', function () {
                $("#J_trade_type").val($(this).attr('tradetype'));
                $("#J_Frmsearch").submit();
            });
            $("[paytype={{$pay_type}}]").addClass('cur');
            $("[paytype]").on('click', function () {
                $("#J_pay_type").val($(this).attr('paytype'));
                $("#J_Frmsearch").submit();
            });
        });
    </script>
@stop
