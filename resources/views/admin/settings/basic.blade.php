@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <h2>系统设置->基本设置</h2>
    </div>
    <div class="content-div">
        <form method="post" id="settingForm" action="{{url('admin/settings/save')}}">
            {{csrf_field()}}
            <table class="formtable" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody id="basic">
                <tr>
                    <td class="cell-label" width="90">网站名称:</td>
                    <td width="320" class="cell-input"><input title="" name="settings[sitename]" class="form-control w300" value="{{$settings['sitename'] or ''}}" type="text"></td>
                    <td class="cell-tips">系统名称，将显示在导航条和标题中</td>
                </tr>
                <tr>
                    <td class="cell-label">网站地址:</td>
                    <td class="cell-input"><input title="" name="settings[siteurl]" class="form-control w300" value="{{$settings['siteurl'] or ''}}" type="text"></td>
                    <td class="cell-tips">网站 URL，将作为链接显示在页面底部</td>
                </tr>
                <tr>
                    <td class="cell-label">关键字:</td>
                    <td class="cell-input"><input title="" name="settings[keywords]" class="form-control w300" value="{{$settings['keywords'] or ''}}"></td>
                    <td class="cell-tips">Keywords 项出现在页面头部的 Meta 标签中，用于记录本页面的关键字，多个关键字间请用半角逗号 "," 隔开</td>
                </tr>
                <tr>
                    <td class="cell-label">网站描述:</td>
                    <td class="cell-input"><textarea title="" name="settings[description]" class="form-control w300" style="height: 100px;">{{$settings['description'] or ''}}</textarea></td>
                    <td class="cell-tips">Description 出现在页面头部的 Meta 标签中，用于记录本页面的概要与描述</td>
                </tr>
                <tr>
                    <td class="cell-label">备案信息:</td>
                    <td class="cell-input"><input title="" name="settings[icp]" class="form-control w300" value="{{$settings['icp'] or ''}}" type="text"></td>
                    <td class="cell-tips">页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入您的授权码，它将显示在页面底部，如果没有请留空</td>
                </tr>
                <tr>
                    <td class="cell-label">版权信息:</td>
                    <td class="cell-input"><input title="" name="settings[copyright]" class="form-control w300" value="{{$settings['copyright'] or ''}}"></td>
                    <td class="cell-tips">网站的版权信息，将显示在页面底部</td>
                </tr>
                <tr>
                    <td class="cell-label">统计代码:</td>
                    <td class="cell-input"><textarea title="" name="settings[statcode]" class="form-control w300" style="height: 100px;">{{$settings['statcode'] or ''}}</textarea></td>
                    <td class="cell-tips">用于统计网站访问情况的第三方统计代码，通常为JS代码</td>
                </tr>
                <tr>
                    <td class="cell-label">关闭网站:</td>
                    <td class="cell-content">
                        <label><input name="settings[sysclosed]" class="form-check-input" value="1" type="radio"@if (isset($settings['sysclosed']) && $settings['sysclosed']) checked="checked"@endif> 是</label>
                        <label><input name="settings[sysclosed]" class="form-check-input" value="0" type="radio"@if (!$settings['sysclosed']) checked="checked"@endif> 否</label>
                    </td>
                    <td class="cell-tips">暂时将网站关闭，其他人无法访问，但不影响管理员访问</td>
                </tr>
                <tr>
                    <td class="cell-label">关闭原因:</td>
                    <td class="cell-input"><textarea title="" name="settings[sysclosedreason]" class="form-control w300">{{$settings['sysclosedreason'] or ''}}</textarea></td>
                    <td class="cell-tips">网站关闭时出现的提示信息</td>
                </tr>
                <tr>
                    <td class="cell-label">地图接口Key:</td>
                    <td class="cell-input"><input title="" name="settings[amap_key]" class="form-control w300" value="{{$settings['amap_key'] or ''}}"></td>
                    <td class="cell-tips">高德地图访问接口Key</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2"><input name="button-submit" class="btn btn-primary" value="更新配置" type="submit"></td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
