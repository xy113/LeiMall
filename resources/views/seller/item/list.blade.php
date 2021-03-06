@extends('layouts.seller')

@section('title', '宝贝管理')

@section('content')
    <div class="navigation">
        <a>我是卖家</a>
        <span>></span>
        <a>宝贝管理</a>
        <span>></span>
        @if ($saleStatus=='on_sale')
            <a>出售中的宝贝</a>
        @else
            <a>仓储中的宝贝</a>
        @endif
    </div>
    <div class="list-div">
        <form method="post" id="listForm" autocomplete="off">
            {{csrf_field()}}
            <input type="hidden" name="formsubmit" value="yes">
            <input type="hidden" name="eventType" value="" id="J_eventType">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="listtable">
                <thead>
                <tr>
                    <th width="20"><input title="" type="checkbox" class="checkbox checkall checkmark"></th>
                    <th width="80">图片</th>
                    <th>商品名称</th>
                    <th>价格</th>
                    <th>销量</th>
                    <th>上架时间</th>
                    <th>状态</th>
                    <th width="80" class="align-center">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($itemlist as $item)
                    <tr id="row_{$item[id]}">
                        <td><input title="" type="checkbox" class="checkbox checkmark itemCheckBox" name="items[]" value="{{$item['itemid']}}"></td>
                        <td><a href="{{item_url($item['itemid'])}}" target="_blank"><div class="bg-cover asyncload" data-original="{{image_url($item['thumb'])}}" style="width: 80px; height: 80px;"></div></a></td>
                        <td>
                            <h3 style="font-size: 12px;"><a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></h3>
                            <p style="margin-top: 5px; color: #888; font-size: 11px;">{{$item['subtitle']}}</p>
                        </td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['sold']}}</td>
                        <td>{{@date('Y-m-d H:i', $item['created_at'])}}</td>
                        <td>
                            @if ($item['on_sale'])
                                出售中
                            @else
                                已下架
                            @endif
                        </td>
                        <td class="align-center">
                            <a href="{{url('/seller/item/publish?catid='.$item['catid'].'&itemid='.$item['itemid'])}}">编辑宝贝</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="20" class="operations">
                        <div class="pagination float-right">{{$pagination}}</div>
                        <label><input type="checkbox" class="checkbox checkall checkmark"> 全选</label>
                        <label><button type="button" class="btn" data-action="delete">删除</button></label>
                        <label><button type="button" class="btn" data-action="on_sale">上架</button></label>
                        <label><button type="button" class="btn" data-action="off_sale">下架</button></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            $(".operations .btn").on('click', function () {
                if ($(".itemCheckBox:checked").length === 0){
                    DSXUI.error('请选择宝贝');
                    return false;
                }
                var eventType = $(this).attr('data-action');
                $("#J_eventType").val(eventType);
                if (eventType === 'delete'){
                    DSXUI.showConfirm('删除宝贝', '确认要删除所选宝贝吗?', function () {
                        $("#listForm").submit();
                    });
                }else {
                    $("#listForm").submit();
                }
            });
        });
    </script>
@stop
