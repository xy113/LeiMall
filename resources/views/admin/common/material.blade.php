@extends('layouts.admin')

@section('scripts')
    <script src="{{asset('DatePicker/WdatePicker.js')}}" type="text/javascript"></script>
@stop

@section('content')
    <div class="navigation">
        <a>后台管理</a>
        <span>></span>
        <a>素材管理</a>
        <span>></span>
        <a>素材列表</a>
    </div>

    <div class="search-container" id="search-container">
        <form method="get" id="searchFrom">
            <input type="hidden" name="type" value="{{$type}}">
            <div class="row">
                <div class="cell">
                    <div class="label">用户ID:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="uid" value="{{$uid}}"></div>
                </div>
                <div class="cell">
                    <div class="label">用户名:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="username" value="{{$username}}"></div>
                </div>
                <div class="cell">
                    <div class="label">名称:</div>
                    <div class="field"><input type="text" title="" class="form-control w200" name="name" value="{{$name}}"></div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label">上传时间:</div>
                    <div class="field">
                        <label><input type="text" title="" class="form-control w100" name="time_begin" value="{{$time_begin}}" onclick="WdatePicker()"></label>
                        <label class="seperator"> - </label>
                        <label><input type="text" title="" class="form-control w100" name="time_end" value="{{$time_end}}" onclick="WdatePicker()"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="cell">
                    <div class="label"></div>
                    <div class="field">
                        <button type="submit" class="btn btn-primary">搜索</button>
                        <button type="button" class="btn btn-default" id="addMaterial">添加素材</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="tabs-container">
        <div class="tabs">
            @foreach($material_types as $k=>$v)
                <div class="tab @if($type==$k)on @endif"><a href="{{url('/admin/material?type='.$k)}}">{{$v}}</a><span>|</span></div>
            @endforeach
        </div>
    </div>
    <div class="content-div">
        <form method="post" autocomplete="off" id="listForm">
            {{form_verify_field()}}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable">
                <thead>
                <tr>
                    <th width="50" class="center">选?</th>
                    <th width="60">图片</th>
                    <th>名称</th>
                    <th>所属用户</th>
                    <th width="120">大小</th>
                    <th width="140">上传时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($itemlist as $id=>$item)
                    <tr>
                        <td class="center">
                            <input type="checkbox" title="" class="checkmark" name="items[]" value="{{$id}}">
                        </td>
                        <td>
                            @if($type === 'image')
                            <img src="{{image_url($item['thumb'])}}" width="50" height="50">
                            @elseif($type === 'video')
                            <img src="{{asset('images/common/video.png')}}" width="50" height="50">
                            @elseif($type === 'voice')
                            <img src="{{asset('images/common/audio.png')}}" width="50" height="50">
                            @elseif($type === 'doc')
                            <img src="{{asset('images/common/doc.png')}}" width="50" height="50">
                            @else
                            <img src="{{asset('images/common/file.png')}}" width="50" height="50">
                            @endif
                        </td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['username']}}</td>
                        <td>{{formatSize($item['size'])}}</td>
                        <td>{{@date('Y-m-d H:i:s', $item['created_at'])}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <span class="float-right">{!! $pagination !!}</span>
                        <div class="btn-group-sm">
                            <label><input type="checkbox" class="checkmark" data-action="checkall"> {{trans('common.selectall')}}</label>
                            <label><button type="button" class="btn btn-default" id="delete" disabled="disabled">删除</button></label>
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
                if ($(".checkmark:checked").length > 0) {
                    $("#delete").enable();
                } else {
                    $("#delete").disable();
                }
            });

            $("#delete").on('click', function () {
                DSXUI.showConfirm('删除素材', '确认要删除所选素材吗?', function () {
                    $("#listForm").ajaxSubmit({
                        dataType:'json',
                        beforeSend:function () {
                            DSXUI.showSpinner();
                        },success:function (response) {
                            setTimeout(function () {
                                DSXUI.hideSpinner();
                                if (response.errcode){
                                    DSXUI.error('删除失败');
                                }else {
                                    DSXUtil.reFresh();
                                }
                            }, 500);
                        }
                    });
                });
            });
        });
    </script>
    @if($type === 'image')
    <script type="text/javascript">
        $("#addMaterial").on('click', function () {
            DSXUI.showImagePicker(function () {
                DSXUtil.reFresh();
            });
        });
    </script>
    @endif
@stop
