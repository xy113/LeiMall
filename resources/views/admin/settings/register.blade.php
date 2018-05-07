@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>系统设置->注册设置</h2>
    </div>
    <div class="content-div">
        <form method="post" id="settingForm" action="{{url('admin/settings/save')}}">
            {{csrf_field()}}
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="formtable">
                <tbody>
                <tr>
                    <td class="cell-label" width="90">开放用户注册:</td>
                    <td width="320" class="cell-content">
                        <label><input type="radio" value="1" name="settings[regallowed]"@if ($settings['regallowed']) checked="checked"@endif> 是</label>
                        <label><input type="radio" value="0" name="settings[regallowed]"@if (!$settings['regallowed']) checked="checked"@endif> 否</label>
                    </td>
                    <td class="cell-tips">设置是否允许游客注册成为网站会员。</td>
                </tr>
                <tr>
                    <td class="cell-label">新用户注册验证:</td>
                    <td class="cell-content">
                        <select title="" class="form-control w300" name="settings[regverify]">
                            <option value="0"@if ($settings['regverify']=='0') selected="selected"@endif>无</option>
                            <option value="1"@if ($settings['regverify']=='1') selected="selected"@endif>Email验证</option>
                            <option value="2"@if ($settings['regverify']=='2') selected="selected"@endif>人工审核</option>
                        </select>
                    </td>
                    <td class="cell-tips">
                        选择“无”用户可直接注册成功；选择“Email 验证”将向用户注册 Email 发送一封验证邮件以确认邮箱的有效性；
                        选择“人工审核”将由管理员人工逐个确定是否允许新用户注册
                    </td>
                </tr>
                <tr>
                    <td class="cell-label">发送欢迎信息:</td>
                    <td class="cell-content">
                        <ul>
                            <li>
                                <label>
                                    <input title="" type="radio" value="0" name="settings[wellcomemsg]"@if ($settings['wellcomemsg']=='0') checked="checked" @endif> 不发送
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input title="" type="radio" value="1" name="settings[wellcomemsg]"@if ($settings['wellcomemsg']=='1') checked="checked" @endif> 发送欢迎短信息
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input title="" type="radio" value="2" name="settings[wellcomemsg]"@if ($settings['wellcomemsg']=='2') checked="checked" @endif> 发送欢迎Email
                                </label>
                            </li>
                        </ul>
                    </td>
                    <td class="cell-tips">可选择是否自动向新注册用户发送一条欢迎信息</td>
                </tr>
                <tr>
                    <td class="cell-label">欢迎邮件标题:</td>
                    <td class="cell-input"><input title="" type="text" class="form-control w300" name="settings[wellcomemsgtitle]"  value="{{$settings['wellcomemsgtitle'] or ''}}"></td>
                    <td class="cell-tips">系统发送的欢迎信息的标题，不支持 HTML，不超过 75 字节。</td>
                </tr>
                <tr>
                    <td class="cell-label">欢迎邮件内容:</td>
                    <td class="cell-input"><textarea title="" class="form-control w300" name="settings[wellcomemsgtxt]" style="height: 150px;">{{$settings['wellcomemsgtxt'] or ''}}</textarea></td>
                    <td class="cell-tips">系统发送的欢迎信息的内容。标题内容均支持变量替换，可以使用如下变量:<br>{username} : 用户名<br>{time} : 发送时间<br>{sitename} : 站点名称<br>{adminemail} : 管理员email</td>
                </tr>
                <tr>
                    <td class="cell-name">显示许可协议:</td>
                    <td class="cell-content">
                        <label><input type="radio" value="1" name="settings[sysrules]"@if ($settings['sysrules']) checked="checked"@endif> 是</label>
                        <label><input type="radio" value="0" name="settings[sysrules]"@if (!$settings['sysrules']) checked="checked"@endif> 否</label>
                    </td>
                    <td class="cell-tips">新用户注册时显示许可协议</td>
                </tr>
                <tr>
                    <td class="cell-name">许可协议内容:</td>
                    <td class="cell-content">
                        <textarea title="" class="form-control w300" name="settings[sysrulestxt]" style="height: 150px;">{{$settings['sysrulestxt'] or ''}}</textarea>
                    </td>
                    <td class="cell-tips">注册许可协议的详细内容</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><input type="submit" value="更新配置" class="btn btn-primary"></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
