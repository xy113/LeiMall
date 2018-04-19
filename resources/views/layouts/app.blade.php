<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title', setting('sitename'))</title>
    <meta name="keywords" content="@yield('keywords', setting('keywords'))">
    <meta name="description" content="@yield('description', setting('description'))">
    <meta name="render" content="webkit">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link href="{{asset('images/common/favicon.png')}}" rel="icon">
    <link href="{{asset('css/app.css?'.time())}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/common.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/app.common.js?v=1.1')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.mobile.touch.min.js')}}" type="text/javascript"></script>
</head>
<body>
    @yield('content', '')
</body>
</html>
