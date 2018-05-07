@extends('layouts.admin')

@section('title', '待审核店铺')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <form name="search">
                <label><input type="text" class="form-control w200" name="q" value="{{$q or ''}}" placeholder="店铺名称"></label>
                <label><input type="submit" class="btn btn-primary" value="搜索"></label>
            </form>
        </div>
        <h2>店铺管理->等待审核的店铺</h2>
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
                    <th width="80">状态</th>
                    <th width="120">开店时间</th>
                    <th width="60">详情</th>
                </tr>
                </thead>
                <tbody>
                @foreach($shoplist as $shop)
                <tr>
                    <td><input title="" type="checkbox" class="checkmark" name="shops[]" value="{{$shop['shop_id']}}"></td>
                    <td>
                        <a href="{{shop_url($shop['shop_id'])}}" target="_blank">
                            <div class="bg-cover lazyload" data-original="{{image_url($shop['logo'])}}" style="width: 50px; height: 50px;"></div>
                        </a>
                    </td>
                    <td><a href="{{shop_url($shop['shop_id'])}}" target="_blank">{{$shop['shop_name']}}</a></td>
                    <td>{{$shop['username']}}</td>
                    <td>{{$shop['phone']}}</td>
                    <td>
                        @if($shop['shop_status']=='FAIL')
                        <span>审核不过</span>
                        @else
                        <span>等待审核</span>
                        @endif
                    </td>
                    <td>{{@date('Y年m月d日', $shop['created_at'])}}</td>
                    <td><a href="{{url('/admin/shop/detail/'.$shop['shop_id'].'.html')}}" target="_blank">查看</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="20">
                        <div class="float-right">{{$pagination}}</div>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" class="checkmark"> 全选</label>
                            <label><button type="button" class="btn btn-default btn-action" data-action="delete">删除</button></label>
                            <label><button type="button" class="btn btn-default btn-action" data-action="accept">审核通过</button></label>
                            <label><button type="button" class="btn btn-default btn-action" data-action="refuse">审核不过</button></label>
                            <label><button type="button" class="btn btn-default" data-action="refresh">刷新</button></label>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $(function () {
            $(".btn-action").on('click', function () {
                if ($(".itemCheckBox:checked").length === 0){
                    DSXUI.error('请选择店铺');
                    return false;
                }
                var eventType = $(this).attr('data-action');
                var submitForm = function () {
                    $("#listForm").ajaxSubmit({
                        dataType:'json',
                        beforeSend:function () {
                            DSXUI.showSpinner();
                        },success:function (response) {
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
                $("#J_eventType").val(eventType);
                if (eventType === 'delete'){
                    DSXUI.showConfirm('删除店铺', '确认要删除所选店铺吗?', submitForm);
                }else {
                    submitForm();
                }
            });
        });
    </script>
@stop
