<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>店铺认证</title>
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link href="{{asset('css/openshop.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/common.js')}}" type="text/javascript"></script>
    <script src="{{asset('DatePicker/WdatePicker.js')}}" type="text/javascript"></script>
</head>
<body>
<div class="top">
    <div class="area">
        <h3 class="h3">申请遇到问题，拨打客服电话:0858-8772117</h3>
        <h1 class="h1">申请开店->填写认证资料</h1>
    </div>
</div>
<div class="area store-form-div">
    <div class="form-content">
        <form method="post" id="authForm">
            {{csrf_field()}}
            <input type="hidden" name="formsubmit" value="yes">
            <div class="form-group">
                <div class="lable-name">店主姓名:</div>
                <div class="label-input">
                    <input type="text" class="input-text" name="auth[owner_name]" value="{{$auth['owner_name']}}" id="owner_name" maxlength="40" placeholder="请输入你的姓名">
                    <div class="err-tips" id="err_owner_name"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="lable-name">身份证号:</div>
                <div class="label-input">
                    <input type="text" class="input-text" name="auth[owner_id]" value="{{$auth['owner_id']}}" id="owner_id" maxlength="18" placeholder="请输入身份证号">
                    <div class="err-tips" id="err_owner_id"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="lable-name">身份证照正面:</div>
                <div class="label-input">
                    <div class="pic-item">
                        <div class="pic-demo">
                            <img src="{{asset('images/common/id_1.png')}}">
                            <span class="t">示例</span>
                        </div>
                        <div class="pic-uploader" data-target="id_card_pic_1">
                            <div class="t">点击上传</div>
                            <div class="preview bg-cover" id="preview_id_card_pic_1"@if($auth['id_card_pic_1'])style="background-image: url({{image_url($auth['id_card_pic_1'])}}); display: block;"@endif>
                        </div>
                        <input type="hidden" name="auth[id_card_pic_1]" value="{{$auth['id_card_pic_1']}}" id="id_card_pic_1">
                    </div>
                    <div class="pic-tips">一张清晰的身份证正面照片<br>支持JPG/JPEG/PNG格式图片，文件大小不超过5MB</div>
                </div>
                <div class="err-tips" id="err_id_card_pic_1"></div>
            </div>

            <div class="form-group">
                <div class="lable-name">身份证照背面:</div>
                <div class="label-input">
                    <div class="pic-item">
                        <div class="pic-demo">
                            <img src="{{asset('images/common/id_2.png')}}">
                            <span class="t">示例</span>
                        </div>
                        <div class="pic-uploader" data-target="id_card_pic_2">
                            <div class="t">点击上传</div>
                            <div class="preview bg-cover" id="preview_id_card_pic_2"{if $auth[id_card_pic_2]} style="background-image: url({echo image($auth[id_card_pic_2])}); display: block;"{/if}>
                        </div>
                        <input type="hidden" name="auth[id_card_pic_2]" value="{$auth[id_card_pic_2]}" id="id_card_pic_2">
                    </div>
                    <div class="pic-tips">一张清晰的身份证背面照片<br>支持JPG/JPEG/PNG格式图片，文件大小不超过5MB</div>
                </div>
                <div class="err-tips" id="err_id_card_pic_2"></div>
            </div>

            <div class="form-group">
                <div class="lable-name">手持身份证照:</div>
                <div class="label-input">
                    <div class="pic-item">
                        <div class="pic-demo">
                            <img src="/static/images/common/id_3.png">
                            <span class="t">示例</span>
                        </div>
                        <div class="pic-uploader" data-target="id_card_pic_3">
                            <div class="t">点击上传</div>
                            <div class="preview bg-cover" id="preview_id_card_pic_3"{if $auth[id_card_pic_3]} style="background-image: url({echo image($auth[id_card_pic_3])}); display: block;"{/if}>
                        </div>
                        <input type="hidden" name="auth[id_card_pic_3]" value="{$auth[id_card_pic_3]}" id="id_card_pic_3">
                    </div>
                    <div class="pic-tips">一张清晰的手持身份证正面照片<br>支持JPG/JPEG/PNG格式图片，文件大小不超过5MB</div>
                </div>
                <div class="err-tips" id="err_id_card_pic_3"></div>
            </div>
            <div class="form-group">
                <div class="lable-name">营业执照编号:</div>
                <div class="label-input">
                    <input type="text" class="input-text" name="auth[license_no]" id="license_no" value="{$auth[license_no]}" maxlength="40" placeholder="营业执照编号">
                    <div class="err-tips" id="err_license_no"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="lable-name">营业执照照片:</div>
                <div class="label-input">
                    <div class="pic-item">
                        <div class="pic-demo">
                            <img src="/static/images/common/yyzz.jpg">
                            <span class="t">示例</span>
                        </div>
                        <div class="pic-uploader" data-target="license_pic">
                            <div class="t">点击上传</div>
                            <div class="preview bg-cover" id="preview_license_pic"{if $auth[license_pic]} style="background-image: url({img $auth[license_pic]});"{/if}></div>
                        <input type="hidden" name="auth[license_pic]" id="license_pic" value="{$auth[license_pic]}">
                    </div>
                    <div class="pic-tips">一张清晰的营业执照照片<br>支持JPG/JPEG/PNG格式图片，文件大小不超过5MB</div>
                </div>
                <div class="err-tips" id="err_license_pic"></div>
            </div>

            <div class="form-group">
                <div class="lable-name">其他证件照片:</div>
                <div class="label-input">
                    <div class="pic-item">
                        <div class="pic-demo">
                            <img src="/static/images/common/jyxkz.jpg">
                            <span class="t">示例</span>
                        </div>
                        <div class="pic-uploader" data-target="other_card_pic">
                            <div class="t">点击上传</div>
                            <div class="preview bg-cover" id="preview_other_card_pic"{if $auth[other_card_pic]} style="background-image: url({img $auth[other_card_pic]});"{/if}></div>
                        <input type="hidden" name="auth[other_card_pic]" id="other_card_pic" value="{$auth[other_card_pic]}">
                    </div>
                    <div class="pic-tips">其他证件照片，如食品经营许可证等<br>支持JPG/JPEG/PNG格式图片，文件大小不超过5MB</div>
                </div>
                <div class="err-tips" id="err_other_card_pic"></div>
            </div>
        </form>
    </div>
</div>

<div class="button-div">
    <input type="submit" class="ui-button button" value="提交认证">
</div>
<script type="text/javascript">
    $(function () {
        $(".pic-uploader").on('click', function () {
            var target = $(this).attr('data-target');
            DSXUI.showImagePicker(function (data) {
                $("#"+target).val(data.image);
                $("#preview_"+target).css({'background-image':'url('+data.thumburl+')'});
            });
        });
        $("#authForm").on('submit', function () {
            var owner_name = $.trim($("#owner_name").val());
            if (!owner_name) {
                $("#err_owner_name").html('请填写店主姓名').show();
                return false;
            }else {
                $("#err_owner_name").hide();
            }

            if (!DSXValidate.IsChineseName(owner_name)){
                $("#err_owner_name").html('店主姓名填写错误').show();
                return false;
            }else {
                $("#err_owner_name").hide();
            }

            var owner_id = $.trim($("#owner_id").val());
            if (!owner_id) {
                $("#err_owner_id").html('请填写身份证号码').show();
                return false;
            }else {
                $("#err_owner_id").hide();
            }
            if (!DSXValidate.IsIdCardNo(owner_id)){
                $("#err_owner_id").html('身份证号码填写错误').show();
                return false;
            }else {
                $("#err_owner_id").hide();
            }

            var id_card_pic_1 = $("#id_card_pic_1").val();
            if (!id_card_pic_1){
                $("#err_id_card_pic_1").html('请上传身份证正面照').show();
                return false;
            }else {
                $("#err_id_card_pic_1").hide();
            }

            var id_card_pic_2 = $("#id_card_pic_2").val();
            if (!id_card_pic_2){
                $("#err_id_card_pic_2").html('请上传身份证背面照片').show();
                return false;
            }else {
                $("#err_id_card_pic_2").hide();
            }

            var id_card_pic_3 = $("#id_card_pic_3").val();
            if (!id_card_pic_3){
                $("#err_id_card_pic_3").html('请上传手持身份证照片').show();
                return false;
            }else {
                $("#err_id_card_pic_3").hide();
            }

            var license_pic = $("#license_pic").val();
            if (!license_pic){
                $("#err_license_pic").html('请上传营业执照照片').show();
                return false;
            }else {
                $("#err_license_pic").hide();
            }
        });
    });
</script>
</body>
</html>
