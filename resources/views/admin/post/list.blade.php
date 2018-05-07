@extends('layouts.admin')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <div class="console-title">
        <div class="float-right">
            <form name="search" method="get">
                <input type="hidden" name="searchType" value="0">
                <label><input type="text" title="" class="form-control w200" name="q" value="{{$q or ''}}" placeholder="关键字"></label>
                <label><button type="submit" class="btn btn-primary">快速搜索</button></label>
                <label><button type="button" class="btn btn-primary" onclick="$('#search-container').toggle()">高级搜索</button></label>
            </form>
        </div>
        <h2>文章管理->文章列表</h2>
    </div>

    <div class="search-container" id="search-container"@if(!$searchType) style="display: none;"@endif>
    <form method="get" id="searchFrom">
        <input type="hidden" name="searchType" value="1">
        <div class="row">
            <div class="cell">
                <div class="label">文章标题:</div>
                <div class="field"><input type="text" title="" class="form-control w200" name="title" value="{{$title or ''}}"></div>
            </div>
            <div class="cell">
                <div class="label">用户:</div>
                <div class="field"><input type="text" title="" class="form-control w200" name="username" value="{{$username}}"></div>
            </div>
            <div class="cell">
                <div class="label">目录分类:</div>
                <div class="field">
                    <select name="catid" class="form-control w200" title="">
                        <option value="">全部</option>
                        @foreach($catloglist[0] as $catid1=>$cat1)
                        <option value="{{$catid1}}"@if($catid==$catid1) selected="selected"@endif>{{$cat1['name']}}</option>
                            @if(isset($catloglist[$catid1]))
                            @foreach($catloglist[$catid1] as $catid2=>$cat2)
                            <option value="{{$catid2}}"@if($catid==$catid2) selected="selected"@endif>|--{{$cat2['name']}}</option>
                                @if(isset($catloglist[$catid2]))
                                @foreach($catloglist[$catid2] as $catid3=>$cat3)
                                <option value="{{$catid3}}"@if($catid==$catid3) selected="selected"@endif>|--|--{{$cat3['name']}}</option>
                                @endforeach
                                @endif
                            @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <div class="label">审核状态:</div>
                <div class="field">
                    <select name="status" class="form-control w200" title="">
                        <option value="">全部</option>
                        @foreach($post_status as $k=>$v)
                        <option value="{{$k}}"@if($status=="$k") selected="selected"@endif>{{$v}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="cell">
                <div class="label">形式:</div>
                <div class="field">
                    <select name="type" class="form-control w200" title="">
                        <option value="">全部</option>
                        @foreach($post_types as $k=>$v)
                        <option value="{{$k}}"@if($type==$k) selected="selected"@endif>{{$v}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="cell">
                <div class="label">发布时间:</div>
                <div class="field">
                    <label><input type="text" title="" class="form-control" name="time_begin" value="{{$time_begin or ''}}" onclick="WdatePicker()" style="width: 100px;"></label>
                    <label class="seperator"> - </label>
                    <label><input type="text" title="" class="form-control" name="time_end" value="{{$time_end or ''}}" onclick="WdatePicker()" style="width: 100px;"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <div class="label"></div>
                <div class="field">
                    <label><button type="submit" class="btn btn-primary">搜索</button></label>
                    <label><button type="reset" class="btn btn-default">重置</button></label>
                </div>
            </div>
        </div>
    </form>
    </div>

    <div class="content-div">
        <form method="post" id="listForm">
            {{form_verify_field()}}
            <input type="hidden" name="eventType" id="eventType" value="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="40" class="center"><input title="全选" type="checkbox" class="checkbox checkall checkmark"></th>
                    <th width="60">图片</th>
                    <th>标题</th>
                    <th>用户</th>
                    <th>分类</th>
                    <th>形式</th>
                    <th>点击</th>
                    <th>时间</th>
                    <th>状态</th>
                    <th width="45">编辑</th>
                </tr>
                </thead>
                <tbody>
                @foreach($itemlist as $aid=>$item)
                <tr>
                    <td class="center"><input title="" type="checkbox" class="checkmark" name="items[]" value="{{$aid}}"></td>
                    <td><img src="{{image_url($item['image'])}}" width="50" height="50" rel="pickimage" data-id="{{$aid}}"></td>
                    <th><a href="{{post_url($aid)}}" target="_blank">{{$item['title']}}</a></th>
                    <td>{{$item['username']}}</td>
                    <td>{{$item['cat_name']}}</td>
                    <td>{{$post_types[$item['type']]}}</td>
                    <td>{{$item['views']}}</td>
                    <td>{{date('Y-m-d H:i:s', $item['created_at'])}}</td>
                    <td>{{$post_status[$item['status']]}}</td>
                    <td><a href="{{url('/admin/post/newpost?aid='.$aid)}}">编辑</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="float-right">{{$pagination}}</div>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" class="checkmark" data-action="checkall"> {{trans('common.selectall')}}</label>
                            <label><button type="button" class="btn btn-default btn-action" data-action="delete" disabled="disabled">删除</button></label>
                            <label><button type="button" class="btn btn-default btn-action" data-action="move" disabled="disabled">移动</button></label>
                            <label><button type="button" class="btn btn-default btn-action" data-action="resove" disabled="disabled">审核通过</button></label>
                            <label><button type="button" class="btn btn-default btn-action" data-action="reject" disabled="disabled">审核不过</button></label>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/html" id="targetTpl">
        <span style="float: left; line-height: 28px;">选择目标分类：</span>
        <label>
            <select name="target" class="form-control w300" title="" id="moveTarget">
                @foreach($catloglist[0] as $catid1=>$cat1)
                    <option value="{{$catid1}}"@if($catid==$catid1) selected="selected"@endif>{{$cat1['name']}}</option>
                    @if(isset($catloglist[$catid1]))
                        @foreach($catloglist[$catid1] as $catid2=>$cat2)
                            <option value="{{$catid2}}"@if($catid==$catid2) selected="selected"@endif>|--{{$cat2['name']}}</option>
                            @if(isset($catloglist[$catid2]))
                                @foreach($catloglist[$catid2] as $catid3=>$cat3)
                                    <option value="{{$catid3}}"@if($catid==$catid3) selected="selected"@endif>|--|--{{$cat3['name']}}</option>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </select>
        </label>
    </script>
    <script type="text/javascript">
        $(function () {
            $(document).on('click', function () {
                if ($(".checkmark:checked").length > 0){
                    $(".btn-action").enable();
                } else {
                    $(".btn-action").disable();
                }
            });

            $("img[rel=pickimage]").on('click', function () {
                var self = this;
                var aid = $(this).attr('data-id');
                DSXUI.showImagePicker(function (data) {
                    $(self).attr('src', data.imageurl);
                    $.post("{{url('/admin/post/setimage')}}", {aid:aid,image:data.image});
                });
            });

            function submitForm(){
                $("#listForm").ajaxSubmit({
                    dataType:'json',
                    beforeSend:DSXUI.showSpinner,
                    success:function (response) {
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

            $(".btn-action").on('click', function () {

                var action = $(this).attr('data-action');
                if (action === 'delete'){
                    $("#eventType").val('delete');
                    DSXUI.showConfirm('删除文章', '确认要删除所选文章吗?', submitForm);
                }

                if (action === 'move'){
                    DSXUI.dialog({
                        content:$("#targetTpl").html(),
                        title:'移动文章',
                        onConfirm:function (dlg) {
                            var target = $("#moveTarget").val();
                            $("#eventType").val('move');
                            $("#listForm").ajaxSubmit({
                                dataType:'json',
                                data:{target:target},
                                beforeSend:DSXUI.showSpinner,
                                success:function (response) {
                                    setTimeout(function () {
                                        dlg.close();
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
                    });
                }

                if (action === 'resove'){
                    $("#eventType").val('resove');
                    submitForm();
                }

                if (action === 'reject') {
                    $("#eventType").val('reject');
                    submitForm();
                }
            });
        });
    </script>
@stop
