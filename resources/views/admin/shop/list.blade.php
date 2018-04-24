@extends('layouts.admin')

@section('title', '店铺管理')
@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}"></script>
@stop

@section('content')
    <div class="navigation">
        <a>后台管理</a>
        <span>></span>
        <a>店铺管理</a>
        <span>></span>
        <a>店铺列表</a>
    </div>
    <div class="search-container">
        <form method="get" id="searchFrom">
            <div class="row">
                <div class="cell">
                    <label>店铺名称:</label>
                    <div class="field"><input title="" type="text" class="input-text" name="shop_name" value="{{$shop_name}}"></div>
                </div>
                <div class="cell">
                    <label>卖家账号:</label>
                    <div class="field"><input title="" type="text" class="input-text" name="username" value="{{$username}}"></div>
                </div>
                <div class="cell">
                    <label>联系电话:</label>
                    <div class="field"><input title="" type="text" class="input-text" name="phone" value="{{$phone}}"></div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <label>店铺状态:</label>
                    <div class="field">
                        <select title="" class="select" name="shop_status">
                            <option value="0">全部</option>
                            <option value="OPEN"@if($shop_status=='OPEN') selected="selected"@endif>正常营业</option>
                            <option value="CLOSE"@if($shop_status=='CLOSE') selected="selected"@endif>已关闭</option>
                        </select>
                    </div>
                </div>
                <div class="cell" style="width: auto;">
                    <label>开店时间:</label>
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
                        <button type="button" class="button" id="btn-search">搜索店铺</button>
                        <button type="button" class="button button-cancel" id="btn-export">批量导出</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="tabs-container">
        <div class="tabs">
            <div @if($tab=='all')class="tab on" @else class="tab"@endif><a href="{{url('/admin/shop?tab=all')}}">所有店铺</a><span>|</span></div>
            <div @if($tab=='open')class="tab on" @else class="tab"@endif><a href="{{url('/admin/shop?tab=open')}}">正常营业</a><span>|</span></div>
            <div @if($tab=='closed')class="tab on" @else class="tab"@endif><a href="{{url('/admin/shop?tab=closed')}}">已关闭</a></div>
        </div>
    </div>

    <div class="content-div">
        <form method="post" id="listForm" autocomplete="off">
            {{csrf_field()}}
            <input type="hidden" name="formsubmit" value="yes">
            <input type="hidden" name="eventType" value="" id="J_eventType">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="listtable">
                <thead>
                <tr>
                    <th width="20"><input title="" type="checkbox" class="checkbox checkall checkmark"></th>
                    <th width="70">LOGO</th>
                    <th>店铺名称</th>
                    <th>店主账号</th>
                    <th>电话</th>
                    <th width="80">营业状态</th>
                    <th width="120">开店时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shoplist as $shop)
                <tr>
                    <td><input title="" type="checkbox" class="checkbox checkmark shopItem" name="shops[]" value="{{$shop['shop_id']}}"></td>
                    <td>
                        <a href="{{shop_url($shop['shop_id'])}}" target="_blank">
                            <div class="bg-cover asyncload" data-original="{{image_url($shop['logo'])}}" style="width: 50px; height: 50px;"></div>
                        </a>
                    </td>
                    <td><a href="{{shop_url($shop['shop_id'])}}" target="_blank">{{$shop['shop_name']}}</a></td>
                    <td>{{$shop['username']}}</td>
                    <td>{{$shop['phone']}}</td>
                    <td>
                        @if($shop['closed'])
                        <span style="color: #ff0000">已打烊</span>
                        @else
                        <span style="color: #4cae4c;">营业中</span>
                        @endif
                    </td>
                    <td>{{@date('Y年m月d日', $shop['created_at'])}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="20">
                        <div class="pagination float-right">{{$pagination}}</div>
                        <label><input type="checkbox" class="checkbox checkall checkmark"> 全选</label>
                        <label><button type="button" class="btn" id="deleteShopBtn">删除店铺</button></label>
                        <label><button type="button" class="btn" id="closeShopBtn">关闭店铺</button></label>
                        <label><button type="button" class="btn" id="openShopBtn">开启店铺</button></label>
                        <label><button type="button" class="btn" data-action="refresh">刷新</button></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <iframe id="expore_frame" style="display: none;"></iframe>
    <script type="text/javascript">
        $(function () {
            var spinner = null;
            $("#deleteShopBtn").on('click', function () {
                DSXUI.showConfirm('删除店铺','确认要删除所选店铺吗?', function () {
                    $("#J_eventType").val('delete');
                    $("#listForm").ajaxSubmit({
                        dataType:'json',
                        beforeSend:function () {
                            spinner = DSXUI.showSpinner();
                        },
                        success:function (response) {
                            setTimeout(function () {
                                spinner.close();
                                DSXUtil.reFresh();
                            }, 500);
                        }
                    });
                });
            });
            $("#openShopBtn").on('click', function () {
                $("#J_eventType").val('open');
                $("#listForm").ajaxSubmit({
                    dataType:'json',
                    beforeSend:function () {
                        spinner = DSXUI.showSpinner();
                    },
                    success:function (response) {
                        setTimeout(function () {
                            spinner.close();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            });
            $("#closeShopBtn").on('click', function () {
                if ($(".shopItem:checked").length > 0){
                    var shops = [];
                    $(".shopItem:checked").each(function () {
                        shops.push($(this).val());
                    });
                    DSXUI.dialog({
                        width:600,
                        height:320,
                        hideFooter:true,
                        title:'关闭店铺',
                        iframe:"{U:('c=shop&a=close&shops=')}"+shops.join(','),
                        afterShow:function (dlg) {
                            window.afterCloseShop = function () {
                                dlg.close();
                                DSXUtil.reFresh();
                            }
                        }
                    });
                }else {
                    DSXUI.error('请选择店铺');
                }
            });

            $("#btn-search").on('click', function () {
                $("#J_a").val('itemlist');
                $("#searchFrom").submit();
            });
            $("#btn-export").on('click', function () {
                $("#J_a").val('download');
                $("#searchFrom").ajaxSubmit({
                    dataType:'json',
                    beforeSend:function () {
                        spinner = DSXUI.showSpinner();
                    },
                    success:function (response) {
                        setTimeout(function () {
                            spinner.close();
                            $("#expore_frame").attr('src', "{U:('c=shop&a=get_excel')}");
                        }, 500);
                    }
                });
            });
        });
    </script>
@stop
