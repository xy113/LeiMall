@extends('layouts.admin')

@section('title', $shop['shop_name'])

@section('content')
    <div class="console-title">
        <h2>店铺管理->店铺详情</h2>
    </div>
    <div class="content-div">
        <table cellspacing="0" cellpadding="0" width="100%" class="formtable">
            <tbody>
            <tr>
                <td class="cell-name" width="80">店铺LOGO</td>
                <td width="320">
                    <span data-fancybox="gallery" href="{{image_url($shop['logo'])}}">
                        <img src="{{image_url($shop['logo'])}}" width="150">
                    </span>
                </td>
                <td class="cell-tips"></td>
            </tr>
            <tr>
                <td class="cell-name">店铺名称</td>
                <td id="shop_name">{{$shop['shop_name']}}</td>
                <td class="cell-tips"><a href="javascript:;" id="edit_name">修改</a></td>
            </tr>
            <tr>
                <td class="cell-name">手机号码</td>
                <td id="shop_phone">{{$shop['phone']}}</td>
                <td class="cell-tips"><a href="javascript:;" id="edit_phone">修改</a></td>
            </tr>
            <tr>
                <td class="cell-name">所在位置</td>
                <td>{{$shop['province']}} {{$shop['city']}} {{$shop['district']}} {{$shop['street']}}</td>
                <td class="cell-tips"></td>
            </tr>
            <tr>
                <td class="cell-name">申请时间</td>
                <td>{{@date('Y年m月d日 H:i:s', $shop['created_at'])}}</td>
                <td class="cell-tips"></td>
            </tr>
            <tr>
                <td class="cell-name">店主姓名</td>
                <td>{{$auth['owner_name']}}</td>
                <td class="cell-tips"></td>
            </tr>
            <tr>
                <td class="cell-name">证件号码</td>
                <td>{{$auth['owner_id']}}</td>
                <td class="cell-tips"></td>
            </tr>
            <tr>
                <td class="cell-name">证件照片</td>
                <td colspan="2">
                    <span data-fancybox="gallery" href="{{image_url($auth['id_card_pic_1'])}}"><img src="{{image_url($auth['id_card_pic_1'])}}" width="150"></span>
                    <span data-fancybox="gallery" href="{{image_url($auth['id_card_pic_2'])}}"><img src="{{image_url($auth['id_card_pic_2'])}}" width="150"></span>
                    <span data-fancybox="gallery" href="{{image_url($auth['id_card_pic_3'])}}"><img src="{{image_url($auth['id_card_pic_3'])}}" width="150"></span>
                </td>
            </tr>
            <tr>
                <td class="cell-name">营业执照</td>
                <td>
                    <span data-fancybox="gallery" href="{{$auth['license_pic']}}">
                        <img src="{{image_url($auth['license_pic'])}}" width="150">
                    </span>
                </td>
                <td class="cell-tips"></td>
            </tr>
            @if($auth['other_card_pic'])
            <tr>
                <td class="cell-name">其他证件</td>
                <td>
                    <span data-fancybox="gallery" href="{{image_url($auth['other_card_pic'])}}">
                        <img src="{{image_url($auth['other_card_pic'])}}" width="150">
                    </span>
                </td>
                <td class="cell-tips"></td>
            </tr>
            @endif
            <tr>
                <td class="cell-name">经营范围</td>
                <td>{{$auth['scope']}}</td>
                <td class="cell-tips"></td>
            </tr>
            </tbody>
        </table>
        <div class="blank"></div>
        @if($shop['auth_status'] !== 'SUCCESS')
        <form method="post" autocomplete="off" action="{{url('admin/shop/auth')}}">
            <input type="hidden" name="shop_id" value="{{$shop_id}}">
            <table cellspacing="0" cellpadding="0" width="100%" class="formtable">
                <tbody>
                <tr>
                    <td class="cell-name" width="80">审核状态</td>
                    <td>
                        <label><input type="radio" class="radio" name="auth_status" value="SUCCESS" checked> <span>审核通过</span></label>
                        <label><input type="radio" class="radio" name="auth_status" value="SUCCESS"> <span>审核不过</span></label>
                    </td>
                </tr>
                <tr>
                    <td class="cell-name">审核理由</td>
                    <td><textarea title="" class="textarea" name="message" style="width: 300px; height: 100px;"></textarea></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td class="cell-name"></td>
                    <td><input type="submit" class="button" value="提交"></td>
                </tr>
                </tfoot>
            </table>
        </form>
        @endif
    </div>
    <link href="{{asset('fancybox/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('fancybox/jquery.fancybox.min.js')}}" type="text/javascript"></script>
@stop
