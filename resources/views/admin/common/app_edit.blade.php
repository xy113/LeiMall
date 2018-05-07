@extends('layouts.admin')

@section('title', '应用管理')

@section('content')
    <div class="console-title">
        <a href="{{url('/admin/app')}}" class="btn btn-primary float-right">应用列表</a>
        <h2>应用管理->编辑应用</h2>
    </div>
    <div class="content-div">
        <form method="post" id="Form">
            {{form_verify_field()}}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="formtable">
                <tbody>
                <tr>
                    <td width="80">应用名称</td>
                    <td width="320"><input title="" type="text" class="form-control w300" name="app[name]" value="{{$app['name']}}" id="app_name"></td>
                    <td class="tips">应用名称</td>
                </tr>
                <tr>
                    <td>AppId</td>
                    <td><input title="" type="text" class="form-control w300" name="app[appid]" value="{{$app['appid']}}" id="appid"></td>
                    <td class="tips">应用ID</td>
                </tr>
                <tr>
                    <td>AppSecret</td>
                    <td><input title="" type="text" class="form-control w300" name="app[secret]" value="{{$app['secret']}}" id="secret"></td>
                    <td class="tips">应用秘钥</td>
                </tr>
                <tr>
                    <td>版本号</td>
                    <td><input title="" type="text" class="form-control w300" name="app[version]" value="{{$app['version']}}" id="version"></td>
                    <td class="tips">应用版本号</td>
                </tr>
                <tr>
                    <td>应用网址</td>
                    <td><input title="" type="text" class="form-control w300" name="app[url]" value="{{$app['url']}}" id="url"></td>
                    <td class="tips">应用网址</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <input type="submit" class="btn btn-primary" value="提交">　
                        <input type="button" class="btn btn-default" value="刷新" data-action="refresh">
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
@stop
