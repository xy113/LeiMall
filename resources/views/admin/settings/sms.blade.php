@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>系统设置->短息平台设置(阿里短息)</h2>
    </div>
    <div class="content-div">
        <form method="post" id="settingForm" action="{{url('/admin/settings/save')}}">
            {{csrf_field()}}
            <table class="formtable" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody id="weixin">
                <tr>
                    <td class="cell-label" width="110">accountId:</td>
                    <td width="320"><input title="" name="settings[sms_accountid]" value="{{$settings['sms_accountid'] or ''}}" class="form-control w300" type="text"></td>
                    <td>阿里云accountId</td>
                </tr>
                <tr>
                    <td class="cell-label">accessKeyId:</td>
                    <td><input title="" name="settings[sms_accesskeyid]" value="{{$settings['sms_accesskeyid'] or ''}}" class="form-control w300" type="text"></td>
                    <td>阿里云accessKeyId:</td>
                </tr>
                <tr>
                    <td class="cell-label">accessKeySecret:</td>
                    <td><input title="" name="settings[sms_accesskeysecret]" value="{{$settings['sms_accesskeysecret'] or ''}}" class="form-control w300" type="text"></td>
                    <td>阿里云accessKeySecret</td>
                </tr>
                <tr>
                    <td class="cell-label">短信签名:</td>
                    <td><input title="" name="settings[sms_signname]" value="{{$settings['sms_signname'] or ''}}" class="form-control w300" type="text"></td>
                    <td>短信签名，如你的公司名称</td>
                </tr>
                <tr>
                    <td class="cell-label">新用户注册模板:</td>
                    <td><input title="" name="settings[sms_tpl_register]" value="{{$settings['sms_tpl_register'] or ''}}" class="form-control w300" type="text"></td>
                    <td>模版内容:验证码${code}，您正在注册成为新用户，感谢您的支持！</td>
                </tr>
                <tr>
                    <td class="cell-label">身份验证模板:</td>
                    <td><input title="" name="settings[sms_tpl_verify]" value="{{$settings['sms_tpl_verify'] or ''}}" class="form-control w300" type="text"></td>
                    <td>模版内容:验证码${code}，您正在进行身份验证，打死不要告诉别人哦！</td>
                </tr>
                <tr>
                    <td class="cell-label">新订单通知模板:</td>
                    <td><input title="" name="settings[sms_tpl_create_order]" value="{{$settings['sms_tpl_create_order'] or ''}}" class="form-control w300" type="text"></td>
                    <td>模版内容:尊敬的卖家，你的店铺有新的订单，订单号为${order_no}，请及时处理。</td>
                </tr>
                <tr>
                    <td class="cell-label">付款通知模板:</td>
                    <td><input title="" name="settings[sms_tpl_pay_order]" value="{{$settings['sms_tpl_pay_order'] or ''}}" class="form-control w300" type="text"></td>
                    <td>阿里云accessKeySecret</td>
                </tr>
                <tr>
                    <td class="cell-label">发货通知模板:</td>
                    <td><input title="" name="settings[sms_tpl_send_order]" value="{{$settings['sms_tpl_send_order'] or ''}}" class="form-control w300" type="text"></td>
                    <td>阿里云accessKeySecret</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><input class="btn btn-primary" value="更新配置" type="submit"></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
