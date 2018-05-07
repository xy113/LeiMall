@extends('layouts.admin')

@section('title', '商品管理')

@section('content')
    <div class="navigation">
        <a>后台管理</a>
        <span>></span>
        <a>商品管理</a>
        <span>></span>
        <a>商品列表</a>
    </div>
    <div class="search-container">
        <form method="get" id="searchFrom">
            <div class="row">
                <div class="cell">
                    <div class="label">店铺名称:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="shop_name" value="{{$shop_name}}"></div>
                </div>
                <div class="cell">
                    <div class="label">卖家账号:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="seller_name" value="{{$seller_name}}"></div>
                </div>
                <div class="cell">
                    <div class="label">销售状态:</div>
                    <div class="field">
                        <select title="" class="form-control w200" name="sale_status">
                            <option value="0">全部</option>
                            <option value="on_sale"@if($sale_status=='on_sale') selected="selected"@endif>出售中</option>
                            <option value="off_sale"@if($sale_status=='off_sale') selected="selected"@endif>已下架</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">产品名称:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="title" value="{{$title}}"></div>
                </div>
                <div class="cell" style="width: auto;">
                    <div class="label">价格区间:</div>
                    <div class="field">
                        <label><input type="text" title="" class="form-control w100" name="min_price" value="{{$min_price}}"> </label>
                        <label class="seperator">-</label>
                        <label><input type="text" title="" class="form-control w100" name="max_price" value="{{$max_price}}"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">商品ID:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="itemid" value="{{$itemid}}"></div>
                </div>
                <div class="cell">
                    <div class="label">目录分类:</div>
                    <div class="field">
                        <select title="" class="form-control w200" name="catid">
                            <option value="0">全部</option>
                            @if (isset($catloglist[0]))
                                @foreach ($catloglist[0] as $catid1=>$catlog1)
                                    <option value="{{$catid1}}"@if($catid1==$catid) selected="selected"@endif>{{$catlog1['name']}}</option>
                                    @if (isset($catloglist[$catid1]))
                                        @foreach ($catloglist[$catid1] as $catid2=>$catlog2)
                                            <option value="{{$catid2}}"@if($catid2==$catid) selected="selected"@endif>|--{{$catlog2['name']}}</option>
                                            @if (isset($catloglist[$catid2]))
                                                @foreach ($catloglist[$catid2] as $catid3=>$catlog3)
                                                    <option value="{{$catid3}}"@if($catid3==$catid) selected="selected"@endif>|--|--{{$catlog3['name']}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label"></div>
                    <div class="field">
                        <label><button type="submit" class="btn btn-primary">搜索</button></label>
                        <label><button type="reset" class="btn btn-default">重置</button></label>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            {{form_verify_field()}}
            <input type="hidden" name="eventType" value="" id="eventType">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="listtable">
                <thead>
                <tr>
                    <th width="20"><input title="" type="checkbox" class="checkbox checkall"></th>
                    <th width="80">图片</th>
                    <th>商品名称|卖家</th>
                    <th>目录分类</th>
                    <th>价格</th>
                    <th>销量</th>
                    <th width="80">状态</th>
                    <th width="140">上架时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($itemlist as $item)
                <tr>
                    <td><input title="" type="checkbox" class="checkbox checkmark" name="items[]" value="{{$item['itemid']}}"></td>
                    <td>
                        <a href="{{item_url($item['itemid'])}}" target="_blank">
                            <div class="bg-cover" style="background-image: url({{image_url($item['thumb'])}}); width: 80px; height: 80px;"></div>
                        </a>
                    </td>
                    <td>
                        <h3 class="title"><a href="{{item_url($item['itemid'])}}" target="_blank">{{$item['title']}}</a></h3>
                        <p class="subtitle"><a href="{{shop_url($item['shop_id'])}}" target="_blank">{{$item['shop_name']}}</a></p>
                    </td>
                    <td>{{$catlognames[$item['catid']] or ''}}</td>
                    <td><p><strong style="color: #f40;">{{$item['price']}}</strong></p></td>
                    <td>{{$item['sold']}}</td>
                    <td>
                        @if($item['on_sale'])
                        出售中
                        @else
                        已下架
                        @endif
                    </td>
                    <td>{{@date('Y-m-d H:i:s', $item['created_at'])}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="20">
                        <div class="pagination float-right">{{$pagination}}</div>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" data-action="checkall"> 全选</label>
                            <label><button type="button" class="btn btn-default btn-action" data-action="delete" disabled="disabled">删除</button></label>
                            <label><button type="button" class="btn btn-default btn-action" data-action="on_sale" disabled="disabled">上架</button></label>
                            <label><button type="button" class="btn btn-default btn-action" data-action="off_sale" disabled="disabled">下架</button></label>
                            <label><button type="button" class="btn btn-default btn-action" disabled="disabled">移动</button></label>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <form method="post" id="J_Frmmove" action="{U:('c=item&a=move')}"><input type="hidden" name="items" id="J_items"></form>
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0) {
                    $(".btn-action").enable();
                } else {
                    $(".btn-action").disable();
                }
            });
            $(".btn-action").on('click', function () {
                var eventType = $(this).attr('data-action');
                var submitForm = function () {
                    $("#listForm").ajaxSubmit({
                        dataType:'json',
                        beforeSend:function () {
                            DSXUI.showSpinner();
                        },
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
                };
                $("#eventType").val(eventType);
                if (eventType === 'delete') {
                    DSXUI.showConfirm('删除商品', '确认要删除所选商品吗?', function () {
                        submitForm();
                    });
                }else {
                    submitForm();
                }
            });

            $(".btn-move").on('click', function () {
                var items = [];
                $(".checkmark:checked").each(function () {
                    items.push($(this).val());
                });
                $("#J_items").val(items.join(','));
                $("#J_Frmmove").submit();
            });
        });
    </script>
@stop
