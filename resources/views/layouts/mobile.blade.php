<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', setting('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('images/common/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('css/mobile.css')}}" type="text/css">
    @yield('styles')
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/common.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/angular.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.mobile.touch.min.js')}}" type="text/javascript"></script>
    @yield('scripts')
</head>
<body>
<div class="page">
    @yield('content', '')
</div>

<script type="text/javascript">
    $("[data-link]").on('tap', function () {
        if ($(this).attr('data-link')){
            window.location.href = $(this).attr('data-link');
        }
    });
</script>
</body>
</html>
