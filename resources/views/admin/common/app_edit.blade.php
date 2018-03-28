@extends('layouts.admin')

@section('title', '应用管理')

@section('content')
    <div class="console-title">
        <a href="{{url('/admin/app')}}" class="button float-right">应用列表</a>
        <h2>应用管理->编辑应用</h2>
    </div>
    <div class="content-div">
        <form method="post" id="Form">
            {{csrf_field()}}
            <input type="hidden" name="formsubmit" value="yes">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formtable">
                <tbody>
                <tr>
                    <td width="80">应用名称</td>
                    <td width="320"><input title="" type="text" class="input-text w300" name="app[app_name]" value="{{$app['app_name']}}" id="app_name"></td>
                    <td class="tips">应用名称</td>
                </tr>
                <tr>
                    <td>AppId</td>
                    <td><input title="" type="text" class="input-text w300" name="app[app_id]" value="{{$app['app_id']}}" id="app_id"></td>
                    <td class="tips">应用ID</td>
                </tr>
                <tr>
                    <td>AppSecret</td>
                    <td><input title="" type="text" class="input-text w300" name="app[app_secret]" value="{{$app['app_secret']}}" id="app_secret"></td>
                    <td class="tips">应用秘钥</td>
                </tr>
                <tr>
                    <td>版本号</td>
                    <td><input title="" type="text" class="input-text w300" name="app[app_version]" value="{{$app['app_version']}}" id="app_version"></td>
                    <td class="tips">应用版本号</td>
                </tr>
                <tr>
                    <td>应用网址</td>
                    <td><input title="" type="text" class="input-text w300" name="app[app_url]" value="{{$app['app_url']}}" id="app_url"></td>
                    <td class="tips">应用网址</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <input type="submit" class="button" value="提交">　
                        <input type="button" class="button button-cancel" value="刷新" data-action="refresh">
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
