@extends('layouts.home')
@section('info')
    <title>{{$field -> art_title}} - {{Config::get('web.web_title')}}</title>
    <meta name="keywords" content="{{$field -> art_tag}}" />
    <meta name="description" content="{{$field -> art_description}}" />
    @endsection
@section('content')
<article class="blogs">
    <link href="{{asset('resources/views/home/css/template.css')}}" rel="stylesheet">
    <style>
        h1.t_nav1 span { float: right; color: #999; background:url(../images/5849.png) no-repeat left center; padding-left:20px }
        h1.t_nav1 span a { margin: 0 5px }
        h1.t_nav1 { border-bottom: #F1F1F1 1px solid; font-size: 12px; font-weight: normal; line-height: 40px; height: 40px; }
    </style>
    <h1 class="t_nav1"><span>您當前的位置：<a href="{{url('/')}}">首頁</a>&nbsp;&gt;&nbsp;<a href="{{url('cate/'.$field->cate_id)}}">{{$field -> cate_name}}</a></span><a href="{{url('/')}}" class="n1">網站首頁</a><a href="{{url('cate/'.$field->cate_id)}}" class="n2">{{$field -> cate_name}}</a></h1>
    <div class="index_about">
        <h2 class="c_titile">{{$field -> art_title}}</h2>
        <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d' , $field -> art_time)}}</span><span>编辑：{{$field -> art_editor}}</span><span>查看次数：{{$field -> art_view}}</span></p>
        <ul class="infos">
            {!! $field -> art_content !!}
        </ul>
        <div class="keybq">
            <p><span>关键字词</span>：{{$field -> art_tag}}</p>

        </div>
        <div class="ad"> </div>
        <div class="nextinfo">
            <p>上一篇：
                @if($article['pre'])
                    <a href="{{url('a/'.$article['pre'] -> art_id)}}">{{$article['pre'] -> art_title}}</a></p>
                @else
                    <span>沒有上一篇了</span>
                @endif
            <p>下一篇：
                @if($article['next'])
                    <a href="{{url('a/'.$article['next'] -> art_id)}}">{{$article['next'] -> art_title}}</a></p>
                @else
                    <span>沒有下一篇了</span>
                @endif
        </div>
        <div class="otherlink">
            <h2>相關文章</h2>
            <ul>
                @foreach($data as $d)
                <li><a href=""{{url('a/'.$d -> art_id)}}" title="{{$d -> art_title}}">{{$d -> art_title}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <aside class="right">
        <!-- Baidu Button BEGIN -->
        <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
        <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
        <script type="text/javascript" id="bdshell_js"></script>
        <script type="text/javascript">
            document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
        </script>
        <!-- Baidu Button END -->
        <div class="blank"></div>
        <div class="news">
            @parent
        </div>
    </aside>
</article>
@endsection