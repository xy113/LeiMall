@extends('layouts.app')

@section('title', $article['title'])

@section('content')
    <div class="news-detail">
        <section class="head">
            <h1>{{$article['title']}}</h1>
            <p style="float: right;">粗耕农品集市</p>
            <p>{{@date('Y-m-d H:i', $article['created_at'])}}   |   浏览量 {{$article['view_num']}}</p>
        </section>
        <div class="body">
            <div class="content">{!! $content['content'] !!}</div>
        </div>

        <div class="share">
            <div class="line"><span class="text">分享</span> </div>
            <ul class="item-list" id="shareChannel">
                <li data-action="share" data-target="weixin">
                    <img src="{{asset('images/share/weixin.png')}}" class="ico">
                    <p class="title">微信好友</p>
                </li>
                <li data-action="share" data-target="pengyouquan">
                    <img src="{{asset('images/share/pengyouquan.png')}}" class="ico">
                    <p class="title">微信朋友圈</p>
                </li>
                <li data-action="share" data-target="qq">
                    <img src="{{asset('images/share/qq.png')}}" class="ico">
                    <p class="title">QQ好友</p>
                </li>
                <li data-action="share" data-target="qzone">
                    <img src="{{asset('images/share/qzone.png')}}" class="ico">
                    <p class="title">QQ空间</p>
                </li>
            </ul>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            window.postMessage(JSON.stringify({
                event:'shareMessage',
                data:{
                    title:'{{$article['title']}}',
                    message:'{{$article['summary']}}',
                    pic:'{{image_url($article['image'])}}',
                    link:window.location.href
                }
            }));
            $("[data-action=share]").on('tap', function () {
                window.postMessage(JSON.stringify({
                    event:'shareTo',
                    data:$(this).attr('data-target')
                }));
            });
        });
    </script>
@stop
