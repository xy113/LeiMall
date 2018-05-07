<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{trans('admin.title')}}-后台管理中心</title>
    <meta name="render" content="webkit">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/admin.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/common.js')}}" type="text/javascript"></script>
</head>
<body>
<div class="admin-header">
    <div class="header">
        <strong class="logo">后台管理中心</strong>
        <div class="right-menu">
            <a href="{{url('/')}}" target="_blank">网站首页</a>
            <a href="{{url('admin/logout')}}">退出登录</a>
        </div>
    </div>
</div>
<div class="sidebar">
    <div class="sidebar-content">
        <div class="scroll">
            <div class="menus" id="menus">
                <dl>
                    <dd><a><i class="iconfont icon-radioboxfill"></i>系统设置</a></dd>
                    <dt>
                        <ul>
                            <li><a rel="item" data-action="{{url('admin/settings/basic')}}">基本设置</a></li>
                            <li><a rel="item" data-action="{{url('admin/settings/optimiz')}}">优化设置</a></li>
                            <li><a rel="item" data-action="{{url('admin/settings/register')}}">注册设置</a></li>
                            <li><a rel="item" data-action="{{url('admin/settings/attach')}}">附件设置</a></li>
                            <li><a rel="item" data-action="{{url('admin/settings/water')}}">图片水印</a></li>
                            <li><a rel="item" data-action="{{url('admin/settings/weixin')}}">微信设置</a></li>
                            <li><a rel="item" data-action="{{url('admin/settings/sms')}}">短息平台设置</a></li>
                            <li><a rel="item" data-action="{{url('admin/attribute')}}">分类选项管理</a></li>
                            <li><a rel="item" data-action="{{url('admin/app')}}">应用管理</a></li>
                        </ul>
                    </dt>
                </dl>
                <dl>
                    <dd><a><i class="iconfont icon-peoplefill"></i>用户管理</a></dd>
                    <dt>
                        <ul>
                            <li><a rel="item" data-action="{{url('admin/user')}}">用户列表</a></li>
                            <li><a rel="item" data-action="{{url('admin/usergroup')}}">分组管理</a></li>
                        </ul>
                    </dt>
                </dl>
                <dl>
                    <dd><a><i class="iconfont icon-attentionfill"></i>界面管理</a></dd>
                    <dt>
                        <ul>
                            <li><a rel="item" data-action="{{url('admin/menu')}}">菜单管理</a></li>
                            <li><a rel="item" data-action="{{url('admin/ad')}}">广告管理</a></li>
                            <li><a rel="item" data-action="{{url('admin/block')}}">内容板块</a></li>
                        </ul>
                    </dt>
                </dl>

                <dl>
                    <dd><a><i class="iconfont icon-presentfill"></i>商品管理</a></dd>
                    <dt>
                        <ul>
                            <li><a rel="item" data-action="{{url('admin/item')}}">商品列表</a></li>
                            <li><a rel="item" data-action="{{url('admin/itempush')}}">商品推送</a></li>
                            <li><a rel="item" data-action="{{url('admin/itemcatlog')}}">商品分类</a></li>
                            <li><a rel="item" data-action="{{url('admin/itemcatlog/merge')}}">合并分类</a></li>
                        </ul>
                    </dt>
                </dl>
                <dl>
                    <dd><a><i class="iconfont icon-shopfill"></i>店铺管理</a></dd>
                    <dt>
                        <ul>
                            <li><a rel="item" data-action="{{url('admin/shop')}}">店铺列表</a></li>
                            <li><a rel="item" data-action="{{url('admin/shop/pending')}}">等待审核</a></li>
                        </ul>
                    </dt>
                </dl>
                <dl>
                    <dd><a><i class="iconfont icon-rechargefill"></i>交易管理</a></dd>
                    <dt>
                        <ul>
                            <li><a rel="item" data-action="{{url('admin/order')}}">订单记录</a></li>
                            <li><a rel="item" data-action="{{url('admin/trade')}}">交易记录</a></li>
                        </ul>
                    </dt>
                </dl>

                <dl>
                    <dd><a><i class="iconfont icon-newsfill"></i>文章管理</a></dd>
                    <dt>
                        <ul>
                            <li><a rel="item" data-action="{{url('admin/post/newpost')}}">发布文章</a></li>
                            <li><a rel="item" data-action="{{url('admin/post')}}">文章列表</a></li>
                            <li><a rel="item" data-action="{{url('admin/postcatlog')}}">分类管理</a></li>
                            <li><a rel="item" data-action="{{url('admin/postcatlog/merge')}}">合并分类</a></li>
                        </ul>
                    </dt>
                </dl>

                <dl>
                    <dd><a><i class="iconfont icon-messagefill"></i>微信管理</a></dd>
                    <dt>
                        <ul>
                            <li><a rel="item" data-action="{{url('admin/weixin/menu')}}">菜单设置</a></li>
                            <li><a rel="item" data-action="{{url('admin/weixin/material')}}">素材管理</a></li>
                            <li><a rel="item" data-action="{{url('admin/weixin/news')}}">图文消息</a></li>
                        </ul>
                    </dt>
                </dl>

                <dl>
                    <dd><a><i class="iconfont icon-babyfill"></i>页面管理</a></dd>
                    <dt>
                        <ul>
                            <li><a rel="item" data-action="{{url('admin/pages/newpage')}}">新建页面</a></li>
                            <li><a rel="item" data-action="{{url('admin/pages')}}">页面列表</a></li>
                            <li><a rel="item" data-action="{{url('admin/pages/category')}}">页面分类</a></li>
                        </ul>
                    </dt>
                </dl>

                <dl>
                    <dd><a><i class="iconfont icon-tagfill"></i>其他项目</a></dd>
                    <dt>
                        <ul>
                            <li><a rel="item" data-action="{{url('admin/material')}}">素材管理</a></li>
                            <li><a rel="item" data-action="{{url('admin/district')}}">地区管理</a></li>
                            <li><a rel="item" data-action="{{url('admin/express')}}">快递管理</a></li>
                            <li><a rel="item" data-action="{{url('admin/link')}}">友情链接</a></li>
                        </ul>
                    </dt>
                </dl>
            </div>
        </div>
    </div>
</div>
<div class="mainframe">
    <div class="main-content"><iframe name="mainframe" id="mainframe" src="{{url('admin/index/wellcome')}}" frameborder="0" style="width: 100%; height: 100%; position: absolute; display: block;"></iframe></div>
</div>
<script type="text/javascript">
    $("#menus dl").each(function () {
        var self = this;
        $(this).find('dd').on('click', function () {
            $(self).find('dt').toggle();
        });
    });
    $("a[rel=item]").on('click', function () {
        $("#mainframe").attr('src', $(this).attr('data-action'));
        $("a[rel=item]").removeClass('cur');
        $(this).addClass('cur');
    });
</script>
</body>
</html>
