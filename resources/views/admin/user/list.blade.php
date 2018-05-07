@extends('layouts.admin')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <ol class="breadcrumb">
        <li>后台管理</li>
        <li>用户管理</li>
        <li>用户列表</li>
    </ol>
    <div class="search-container">
        <form method="get" id="searchFrom">
            <div class="row">
                <div class="cell">
                    <div class="label">用户名:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="username" value="{{$username or ''}}"></div>
                </div>
                <div class="cell">
                    <div class="label">手机号:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="mobile" value="{{$mobile}}"></div>
                </div>
                <div class="cell">
                    <div class="label">邮箱:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="email" value="{{$email}}"></div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">会员ID:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="uid" value="{{$uid}}"></div>
                </div>
                <div class="cell">
                    <div class="label">注册日期:</div>
                    <div class="field">
                        <label><input type="text" title="" class="form-control" name="reg_time_begin" onclick="WdatePicker()" value="{{$reg_time_begin}}" style="width: 100px;"></label>
                        <label class="seperator"> - </label>
                        <label><input type="text" title="" class="form-control" name="reg_time_end" onclick="WdatePicker()" value="{{$reg_time_end}}" style="width: 100px;"></label>
                    </div>
                </div>
                <div class="cell">
                    <div class="label">最后登录:</div>
                    <div class="field">
                        <label><input type="text" title="" class="form-control" name="last_visit_begin" onclick="WdatePicker()" value="{{$last_visit_begin}}" style="width: 100px;"></label>
                        <label class="seperator">-</label>
                        <label><input type="text" title="" class="form-control" name="last_visit_end" onclick="WdatePicker()" value="{{$last_visit_end}}" style="width: 100px;"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label"></div>
                    <div class="field">
                        <button type="submit" class="btn btn-primary" id="btn-search">搜索</button>
                        <button type="button" class="btn btn-default" id="btn-export">重置</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="content-div">
        <form method="post" id="listForm">
            {{form_verify_field()}}
            <input type="hidden" id="eventType" name="eventType" value="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="20">选</th>
                    <th width="30">头像</th>
                    <th>姓名</th>
                    <th>手机号</th>
                    <th>电子邮箱</th>
                    <th>用户组</th>
                    <th>注册日期</th>
                    <th>最后登录</th>
                    <th>状态</th>
                </tr>
                </thead>
                <tbody id="members">
                @foreach($itemlist as $uid=>$user)
                <tr>
                    <td><input title="" type="checkbox" class="checkmark" name="items[]" value="{{$uid}}" /></td>
                    <td><img src="{{avatar($uid, 'small')}}" width="30" height="30" style="border-radius:100%;"></td>
                    <th><a>{{$user['username']}}</a></th>
                    <td>{{$user['mobile']}}</td>
                    <td>{{$user['email']}}</td>
                    <td>{{$user['grouptitle']}}</td>
                    <td><a href="http://ip.taobao.com/?ip={{$user['created_ip']}}" target="_blank">{{date('Y-m-d H:i:s', $user['created_at'])}}</a></td>
                    <td><a href="http://ip.taobao.com/?ip={{$user['lastvisit_ip']}}" target="_blank">{{@date('Y-m-d H:i:s', $user['lastvisit_at'])}}</a></td>
                    <td>{{$user_status[$user['status']]}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="12">
                        <div class="float-right">{{$pagination}}</div>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" data-action="checkall" /> 全选</label>
                            <label><button type="button" class="btn btn-default" id="delete" disabled="disabled">删除</button></label>
                            <label><button type="button" class="btn btn-default" id="allow" disabled="disabled">允许登录</button></label>
                            <label><button type="button" class="btn btn-default" id="forbiden" disabled="disabled">禁止登录</button></label>
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
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0){
                    $("#delete,#allow,#forbiden").enable();
                } else {
                    $("#delete,#allow,#forbiden").disable();
                }
            });

            function submitForm(){
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
            }

            $("#delete").on('click', function () {
                $("#eventType").val('delete');
                DSXUI.showConfirm('删除确认', '确认要删除所选用户吗?', function () {
                    submitForm();
                });
            });
            $("#allow").on('click', function () {
                $("#eventType").val('allow');
                submitForm();
            });
            $("#forbiden").on('click', function () {
                $("#eventType").val('forbiden');
                submitForm();
            });
        });
    </script>
@stop
