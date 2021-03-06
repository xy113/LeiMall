@extends('layouts.admin')

@section('content')
    <div class="console-title">
        <div class="float-right">
            <label><input type="button" class="btn btn-primary" value="应用菜单" onclick="apply()" /></label>
            <label><input type="button" class="btn btn-primary" value="删除菜单" onclick="remove()" /></label>
        </div>
        <h2>微信自定义菜单设置</h2>
    </div>
    <div class="table-wrap">
        <form method="post">
            {{form_verify_field()}}
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable border-none">
                <thead>
                <tr>
                    <th width="40" class="center">删?</th>
                    <th width="40">ID</th>
                    <th width="300">菜单名称</th>
                    <th width="200">菜单类型</th>
                    <th>选项</th>
                </tr>
                </thead>
            </table>
            <div id="menu-item-list">
                @if(isset($menulist[0]))
                @foreach($menulist[0] as $id=>$menu)
                <div class="menu-item">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable border-none">
                        <tbody>
                        <tr>
                            <td width="40"><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$id}}"></td>
                            <td width="40">{{$id}}</td>
                            <td width="300">
                                <input title="" type="text" class="form-control w200" name="menulist[{{$id}}][name]" value="{{$menu['name']}}" maxlength="10" style="font-weight:bold;">
                                <a onclick="addMenu({{$id}})">+添加子分类</a>
                            </td>
                            <td width="200">{{$menu['type_name']}}</td>
                            <td><a onclick="editMenu({{$id}})">编辑</a></td>
                        </tr>
                        </tbody>
                    </table>
                    @if(isset($menulist[$id]))
                    <div class="menu-sub-list">
                        @foreach($menulist[$id] as $id2=>$menu2)
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable sub-item border-none">
                            <tbody>
                            <tr>
                                <td width="40"><input title="" type="checkbox" class="checkmark" name="delete[]" value="{{$id2}}" /></td>
                                <td width="40">{{$id2}}</td>
                                <td width="300">
                                    <div class="cat-level cat-level-2"></div>
                                    <input title="" type="text" class="form-control w200" name="menulist[{{$id2}}][name]" value="{{$menu2['name']}}" maxlength="10">
                                </td>
                                <td width="200">{{$menu2['type_name']}}</td>
                                <td><a onclick="editMenu({{$id2}})">编辑</a></td>
                            </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
                @endif
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtable border-none">
                <tfoot>
                <tr>
                    <td>
                        <label><input type="checkbox" class="checkall" /> 全选</label>
                        <a onclick="addMenu(0)" style="margin-left:20px;"><i class="iconfont icon-roundaddfill"></i>添加菜单</a>
                        <p class="tips">提示:提交后选中项将被删除，微信菜单一级菜单最多3个，二级菜单最多5个，一级菜单最多4个字，二级菜单最多7各字</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label><input type="submit" class="btn btn-primary" value="提交" /></label>
                        <label><input type="button" class="btn btn-primary" value="刷新" data-action="refresh" /></label>
                    </td>
                </tr>
                </tfoot>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        $("#menu-item-list").sortable({item:'.menu-item'});
        $(".menu-sub-list").sortable({item:'.sub-item'});
        function addMenu(fid){
            DSXUI.dialog({
                width:650,
                height:300,
                title:'添加菜单',
                iframe:'{{action('Admin\WeixinController@edit_menu')}}?fid='+fid,
                hideFooter:true,
                afterShow:function (dlg) {
                    window.afterMenuSave = function () {
                        dlg.close();
                        DSXUtil.reFresh();
                    }
                }
            });
        }
        function editMenu(id){
            DSXUI.dialog({
                width:650,
                height:300,
                title:'添加菜单',
                iframe:'{{action('Admin\WeixinController@edit_menu')}}?id='+id,
                hideFooter:true,
                afterShow:function (dlg) {
                    window.afterMenuSave = function () {
                        dlg.close();
                        DSXUtil.reFresh();
                    }
                }
            });
        }

        function apply(){
            DSXUI.showConfirm('应用菜单', '应用成功后，微信公众号现有的自定义菜单将会被替换', function () {
                var spinner = null;
                $.ajax({
                    url:'{{action('Admin\WeixinController@apply_menu')}}',
                    dataType:"json",
                    beforeSend:function () {
                        spinner = DSXUI.showSpinner();
                    },
                    success: function(json){
                        setTimeout(function () {
                            spinner.close();
                            if (response.errcode){
                                DSXUI.error('菜单应用失败');
                            }else {
                                DSXUI.success('菜单应用成功');
                            }
                        }, 500);
                    }
                });
            });
        }

        function remove(){
            DSXUI.showConfirm('删除菜单', '确认要删除微信菜单吗?', function () {
                var spinner = null;
                $.ajax({
                    url:'{{action('Admin\WeixinController@remove_menu')}}',
                    dataType:'json',
                    beforeSend:function () {
                        spinner = DSXUI.showSpinner();
                    },success:function () {
                        setTimeout(function () {
                            spinner.close();
                            if (response.errcode){
                                DSXUI.error(response.errmsg);
                            }else {
                                DSXUI.success('菜单删除成功');
                            }
                        }, 500);
                    }
                })
            });
        }
    </script>
@stop
