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
                    <div class="label">店铺名称:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="shop_name" value="{{$shop_name}}"></div>
                </div>
                <div class="cell">
                    <div class="label">卖家账号:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="username" value="{{$username}}"></div>
                </div>
                <div class="cell">
                    <div class="label">联系电话:</div>
                    <div class="field"><input title="" type="text" class="form-control w200" name="phone" value="{{$phone}}"></div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">店铺状态:</div>
                    <div class="field">
                        <select title="" class="form-control w200" name="shop_status">
                            <option value="0">全部</option>
                            <option value="OPEN"@if($shop_status=='OPEN') selected="selected"@endif>正常营业</option>
                            <option value="CLOSE"@if($shop_status=='CLOSE') selected="selected"@endif>已关闭</option>
                        </select>
                    </div>
                </div>
                <div class="cell" style="width: auto;">
                    <div class="label">开店时间:</div>
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
                        <label><button type="button" class="btn btn-primary" id="btn-search">搜索店铺</button></label>
                        <label><button type="button" class="btn btn-default" id="btn-export">批量导出</button></label>
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
            {{form_verify_field()}}
            <input type="hidden" name="eventType" value="" id="eventType">
            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="listtable">
                <thead>
                <tr>
                    <th width="20"><input title="" type="checkbox" class="checkmark" data-action="checkall"></th>
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
                        <div class="btn-group-sm">
                            <label><input type="checkbox" class="checkmark" data-action="checkall"> 全选</label>
                            <label><button type="button" class="btn btn-default btn-action" id="delete" disabled="disabled">删除店铺</button></label>
                            <label><button type="button" class="btn btn-default btn-action" id="close" disabled="disabled">关闭店铺</button></label>
                            <label><button type="button" class="btn btn-default btn-action" id="open" disabled="disabled">开启店铺</button></label>
                            <label><button type="button" class="btn btn-default" data-action="refresh">刷新</button></label>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <iframe id="expore_frame" style="display: none;"></iframe>
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0) {
                    $(".btn-action").enable();
                }else {
                    $(".btn-action").disable();
                }
            });
            function submitForm() {
                $("#listForm").ajaxSubmit({
                    dataType:'json',
                    beforeSend:function () {
                        DSXUI.showSpinner();
                    },
                    success:function (response) {
                        setTimeout(function () {
                            DSXUI.hideSpinner();
                            DSXUtil.reFresh();
                        }, 500);
                    }
                });
            }

            $("#delete").on('click', function () {
                DSXUI.showConfirm('删除店铺','确认要删除所选店铺吗?', function () {
                    $("#eventType").val('delete');
                    submitForm();
                });
            });
            $("#open").on('click', function () {
                $("#eventType").val('open');
                submitForm();
            });
            $("#close").on('click', function () {
                var shops = [];
                $(".shopItem:checked").each(function () {
                    shops.push($(this).val());
                });
                DSXUI.dialog({
                    width:600,
                    height:320,
                    showFooter:false,
                    title:'关闭店铺',
                    iframe:"{{url('admin/shop/close?shops=')}}"+shops.join(','),
                    afterShow:function (dlg) {
                        window.afterCloseShop = function () {
                            dlg.close();
                            DSXUtil.reFresh();
                        }
                    }
                });
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
