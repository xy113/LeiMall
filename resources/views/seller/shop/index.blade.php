@extends('layouts.seller')

@section('title', '店铺设置')

@section('content')
    <div class="navigation">
        <a>我是卖家</a>
        <span>></span>
        <a>店铺设置</a>
        <span>></span>
        <a>基本设置</a>
    </div>
    @if ($shop['closed'])
        <div class="notice-nav">
            你的店铺由于资料不全，已被管理员关闭，请完善店铺资料和认证资料，向管理员申请重新开启。
        </div>
    @endif
    <div class="content-div">
        <div class="tab-console">
            <span class="item cur">基本信息</span>
            <span class="item"><a href="{{url('/seller/shop/auth')}}" target="_blank">店铺认证</a></span>
        </div>
        <div class="form-div">
            <form method="post" id="shopForm" autocomplete="off">
                {{csrf_field()}}
                <input type="hidden" name="formsubmit" value="yes">
                <table cellspacing="0" cellpadding="0" width="100%" class="formtable">
                    <tbody>
                    <tr>
                        <td class="cell-name" width="80">店铺名称</td>
                        <td><input title="" type="text" name="shop[shop_name]" value="{{$shop['shop_name']}}" id="shop_name" class="input-text w300"></td>
                    </tr>
                    <tr>
                        <td class="cell-name">联系电话</td>
                        <td><input title="" type="text" name="shop[phone]" value="{{$shop['phone']}}" id="phone" class="input-text w300"></td>
                    </tr>
                    <tr>
                        <td class="cell-name">店铺标志</td>
                        <td>
                            <input type="hidden" name="shop[logo]" value="{{$shop['logo']}}" id="logo">
                            <img src="{{image_url($shop['logo'])}}" width="100" height="100" id="logo_preview">
                            <p>
                                <span class="button button-cancel" style="border-radius: 5px;" id="upload-logo">上传图标</span>
                                <span>文件格式GIF、JPG、JPEG、PNG文件大小100K以内，建议尺寸150px*150px</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-name">店铺简介</td>
                        <td>
                            <textarea class="textarea" name="shop[description]" style="width: 300px; height: 80px;" placeholder="【掌柜签名】/【店铺动态】/【主营宝贝】">{{$shop['description']}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-name">经营地址</td>
                        <td>
                            <select title="" class="select" name="shop[province]" id="province" style="width: auto;">
                                <option value="">请选择</option>
                            </select>
                            <select title="" class="select" name="shop[city]" id="city" style="width: auto;">
                                <option value="">请选择</option>
                            </select>
                            <select title="" class="select" name="shop[district]" id="district" style="width: auto;">
                                <option value="">请选择</option>
                            </select>
                            <input type="text" name="shop[street]" id="street" class="input-text w300" value="{{$shop['street']}}" placeholder="街道地址">
                            <a present-modal="#modal" style="color: #0B90EF;">地图定位</a>
                            <input type="hidden" name="shop[lng]" id="longitude" value="{{$shop['lng']}}">
                            <input type="hidden" name="shop[lat]" id="latitude" value="{{$shop['lat']}}">
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-name">主要货源</td>
                        <td>
                            <label><input type="radio" class="radio" name="shop[main_source]" value="1"@if($shop['main_source'] == 1) checked="checked"@endif> 自己生产</label>
                            <label><input type="radio" class="radio" name="shop[main_source]" value="2"@if($shop['main_source'] == 2) checked="checked"@endif> 代工生产</label>
                            <label><input type="radio" class="radio" name="shop[main_source]" value="3"@if($shop['main_source'] == 3) checked="checked"@endif> 线下批发</label>
                            <label><input type="radio" class="radio" name="shop[main_source]" value="4"@if($shop['main_source'] == 4) checked="checked"@endif> 分销代销</label>
                            <label><input type="radio" class="radio" name="shop[main_source]" value="5"@if($shop['main_source'] == 5) checked="checked"@endif> 自由渠道</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-name">店铺介绍</td>
                        <td>
                            <div style="width: 660px;">
                                @include('common.editor', ['name' => 'content', 'content'=>$content['content'], 'params'=>[]])
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td width="80"></td>
                        <td colspan="2"><button type="submit" class="button btn-100" id="button-submit">提交</button></td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="/static/js/DSXModal.js"></script>
    <script type="text/javascript">
        $(function () {
            var district = new DistrictSelector({
                province:'{{$shop['province']}}',
                city:'{{$shop['city']}}',
                district:'{{$shop['district']}}'
            });
            $("#upload-logo").on('click', function () {
                DSXUI.showImagePicker(function (data) {
                    $("#logo").val(data.image);
                    $("#logo_preview").attr('src', data.imageurl);
                });
            });
            $("#shopForm").on('submit', function () {
                var shop_name = $.trim($("#shop_name").val());
                if (!shop_name) {
                    DSXUI.error('请输入店铺名称');
                    return false;
                }
                var phone = $.trim($("#phone").val());
                if (!DSXValidate.IsMobile(phone)){
                    DSXUI.error('手机号码输入错误');
                    return false;
                }
            });

            $("[present-modal]").on('click', function () {
                var address = $("#province").val()+' '+$("#city").val()+' '+$("#county").val()+' '+$("#street").val();
                $("#map").attr('src','/index.php?m=plugin&c=map&address='+address);
                $("#modalbox").DSXModal();
                window.setLocation = function (location) {
                    $("#longitude").val(location.lng);
                    $("#latitude").val(location.lat);
                    $("#modalbox").DSXModal({event:'hide'});
                }
            });
        });
    </script>
@stop
