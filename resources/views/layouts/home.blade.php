<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('info')

    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $k => $v)<a href="{{$v -> navs_url}}"><span>{{$v -> nav_name}}</span><span class="en">{{$v -> nav_alias}}</span></a>@endforeach
    </nav>
</header>

@yield('content')

<footer>
    <p>{{Config::get('web.copyright')}} {!! Config::get('web.web_count') !!}</p>
</footer>
{{--自定義導航選取變色--}}
{{--<script src="{{asset('resources/views/home/js/silder.js')}}"></script>--}}
</body>
</html>
