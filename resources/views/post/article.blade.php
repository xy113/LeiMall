@extends('layouts.mall')

@section('title', $article['title'])
@section('keywords', $keywords)
@section('description', $description)

@section('content')
    <div class="area post-detail-div">
        <div class="main-frame">
            <h1 class="post-title">{{$article['title']}}</h1>
            <div class="post-info">
                <span>{{@date('Y年m月d日 H:i',$article['created_at'])}}</span>
                <span>阅读:{{$article['views']}}</span>
                <a>评论:({{$article['comments']}})</a>
                <a data-action="addToCollection" data-id="{{$article['aid']}}" data-type="article">收藏本文</a>
            </div>

            <div class="post-body">{!! $content['content'] !!}</div>
            @if ($article['tags'])
                <div class="post-tags">标签:
                    @foreach ($article['tags'] as $tag)
                        <a href="">{$tag}</a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="right-frame">
            <div class="content-div">
                <h3 class="title">热点文章</h3>
                <ul class="itemlist">
                    @foreach ($newPostList as $item)
                        <li><a href="{{post_url($item['aid'])}}">{{$item['title']}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="blank"></div>
            <div class="content-div">
                <h3 class="title">热点图文</h3>
                <ul class="picitemlist">
                    @foreach ($hotPostList as $item)
                        <li>
                            <div class="imgbox">
                                <a href="{{post_url($item['aid'])}}">
                                    <img src="{{image_url($item['image'])}}">
                                </a>
                            </div>
                            <div class="title">
                                <a href="{{post_url($item['aid'])}}">{{$item['title']}}</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop
