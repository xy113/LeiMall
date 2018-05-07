@extends('layouts.admin')

@section('title', '交易记录')
@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}"></script>
@stop

@section('content')
    <div class="navigation">
        <a>后台管理</a>
        <span>></span>
        <a>交易管理</a>
        <span>></span>
        <a>交易记录</a>
    </div>
    <div class="search-container">
        <form method="get" id="searchFrom">
            <div class="row">
                <div class="cell">
                    <div class="label">交易名称:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="trade_name" value="{{$trade_name}}"></div>
                </div>
                <div class="cell">
                    <div class="label">付款方:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="payer_name" value="{{$payer_name}}"></div>
                </div>
                <div class="cell">
                    <div class="label">收款方:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="payee_name" value="{{$payee_name}}"></div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">付款状态:</div>
                    <div class="field">
                        <select title="" class="form-control w200" name="pay_status">
                            <option value="0">全部</option>
                            <option value="PAID"@if($pay_status=='PAID') selected="selected"@endif>已支付</option>
                            <option value="UNPAID"@if($pay_status=='UNPAID') selected="selected"@endif>未支付</option>
                        </select>
                    </div>
                </div>
                <div class="cell">
                    <div class="label">付款金额:</div>
                    <div class="field">
                        <label><input title="" type="text" class="form-control w100" name="min_fee" value="{{$min_fee}}" style="width: 100px;"></label>
                        <label class="seperator">-</label>
                        <label><input title="" type="text" class="form-control w100" name="max_fee" value="{{$max_fee}}" style="width: 100px;"></label>
                    </div>
                </div>
                <div class="cell">
                    <div class="label">支付方式:</div>
                    <div class="field">
                        <select title="" class="form-control w200" name="pay_type">
                            <option value="0">全部</option>
                            <option value="balance"@if($pay_type=='balance') selected="selected"@endif>余额支付</option>
                            <option value="wxpay"@if($pay_type=='wxpay') selected="selected"@endif>微信支付</option>
                            <option value="alipay"@if($pay_type=='alipay') selected="selected"@endif>支付宝支付</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">交易流水:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="trade_no" value="{{$trade_no}}"></div>
                </div>
                <div class="cell" style="width: auto;">
                    <div class="label">交易时间:</div>
                    <div class="field">
                        <label><input title="" type="text" class="form-control w100" name="time_begin" onclick="WdatePicker()" value="{{$time_begin}}" style="width: 100px;"></label>
                        <label class="seperator">-</label>
                        <label><input title="" type="text" class="form-control w100" name="time_end" onclick="WdatePicker()" value="{{$time_end}}" style="width: 100px;"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label"></div>
                    <div class="field">
                        <label><button type="submit" class="btn btn-primary" id="btn-search">搜索订单</button></label>
                        <label><button type="button" class="btn btn-default" id="btn-export">批量导出</button></label>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="tabs-container">
        <div class="tabs">
            <div @if($tab=='all') class="tab on" @else class="tab" @endif><a href="{{url('/admin/trade?tab=all')}}">全部</a><span>|</span></div>
            <div @if($tab=='paid') class="tab on" @else class="tab" @endif><a href="{{url('/admin/trade?tab=paid')}}">已支付</a><span>|</span></div>
            <div @if($tab=='unpaid') class="tab on" @else class="tab" @endif><a href="{{url('/admin/trade?tab=unpaid')}}">未支付</a></div>
        </div>
    </div>

    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            {{form_verify_field()}}
            <input type="hidden" name="eventType" id="eventType" value="delete">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="40" class="center">选?</th>
                    <th width="50">头像</th>
                    <th>名称 | 流水 | 收款方账户</th>
                    <th>付款账户</th>
                    <th width="100">金额</th>
                    <th width="140">时间</th>
                    <th width="60">状态</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tradelist as $trade_id=>$trade)
                <tr>
                    <td class="center"><input title="" type="checkbox" class="checkbox checkmark" name="trades[]" value="{{$trade_id}}"></td>
                    <td><img src="{{avatar($trade['payer_uid'])}}" width="30" height="30"></td>
                    <td>
                        <h3 class="title">{{$trade['trade_name']}}</h3>
                        <p class="subtitle">
                            <span>{{$trade['trade_no']}} |</span>
                            <a href="{{shop_url($trade['payee_uid'])}}" target="_blank">{{$trade['payee_name']}}</a>
                        </p>
                    </td>
                    <td>{{$trade['payer_name']}}</td>
                    <td>{{$trade['trade_fee']}}</td>
                    <td>{{@date('Y-m-d H:i:s', $trade['created_at'])}}</td>
                    <td>{{$pay_status[$trade['pay_status']]}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <span class="pagination float-right">{{$pagination}}</span>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" data-action="checkall"> 全选</label>
                            <label><input type="button" class="btn btn-default" value="删除" id="delete" disabled="disabled"></label>
                            <label><input type="button" class="btn btn-default" value="刷新" data-action="refresh"></label>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <iframe id="J_frame" src="" style="display: none;"></iframe>
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0) {
                    $("#delete").enable();
                } else {
                    $("#delete").disable();
                }
            });

            $("#btn-export").on('click', function () {
                var waiting = null;
                DSXUI.showConfirm('下载交易记录', '交易记录下载过程可能需要几分钟时间，在此期间请不要关闭页面', function () {
                    $("#J_a").val('export');
                    $("#searchFrom").ajaxSubmit({
                        beforeSend:function () {
                            waiting = DSXUI.showloading('正在导出数据...');
                        },
                        success:function (response) {
                            if (response.errcode === 0){
                                waiting.close();
                                $("#J_frame").attr('src', "{{url('/admin/trade/download')}})}");
                            }
                        }
                    });
                });
            });
            $("#delete").on('click', function () {
                DSXUI.showConfirm('删除记录', '确认要删除所选记录吗?', function () {
                    $("#eventType").val('delete');
                    $("#listForm").ajaxSubmit({
                        beforeSend:DSXUI.showSpinner,
                        success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                if (response.errcode){
                                    DSXUI.error(response.errmsg);
                                }else {
                                    DSXUtil.reFresh();
                                }
                            }, 500);
                        }
                    });
                });
            });
        });
    </script>
@stop
