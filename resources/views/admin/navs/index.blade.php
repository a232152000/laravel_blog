@extends('layouts.admin')
@section('content')
<!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首頁</a> &raquo; 自定義導航管理
</div>
<!--面包屑导航 结束-->

<!--结果页快捷搜索框 开始-->
{{--<div class="search_wrap">--}}
    {{--<form action="" method="post">--}}
        {{--<table class="search_tab">--}}
            {{--<tr>--}}
                {{--<th width="120">選擇分類:</th>--}}
                {{--<td>--}}
                    {{--<select onchange="javascript:location.href=this.value;">--}}
                        {{--<option value="">全部</option>--}}
                        {{--<option value="http://www.baidu.com">擺渡</option>--}}
                        {{--<option value="http://www.sina.com">新浪</option>--}}
                    {{--</select>--}}
                {{--</td>--}}
                {{--<th width="70"></th>--}}
                {{--<td><input type="text" name="keywords" placeholder="關鍵字"></td>--}}
                {{--<td><input type="submit" name="sub" value="查詢"></td>--}}
            {{--</tr>--}}
        {{--</table>--}}
    {{--</form>--}}
{{--</div>--}}
{{--<!--结果页快捷搜索框 结束-->--}}

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_title">
            <h3>自定義導航列表</h3>
        </div>
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>添加導航</a>
                <a href="{{url('admin/navs')}}"><i class="fa fa-recycle"></i>全部導航</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">排序</th>
                    <th class="tc" width="5%">ID</th>
                    <th>導航名稱</th>
                    <th>導航別名</th>
                    <th>導航超連結</th>
                    <th>操作</th>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,{{$v -> nav_id}})" value="{{$v -> nav_order}}">
                    </td>
                    <td class="tc">{{$v -> nav_id}}</td>
                    <td>
                        <a href="#">{{$v -> nav_name}}</a>
                    </td>
                    <td>{{$v -> nav_alias}}</td>
                    <td>{{$v -> nav_url}}</td>
                    <td>
                        <a href="{{url('admin/navs/'.$v -> nav_id.'/edit')}}">修改</a>
                        <a href="javascript:" onclick="delCate({{$v -> nav_id}})">刪除</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->

    <script>
        function changeOrder(obj,nav_id){
            var nav_order = $(obj).val();
           $.post("{{url('admin/navs/changeorder')}}" , {'_token':'{{csrf_token()}}' , 'nav_id':nav_id , 'nav_order':nav_order}, function (data) {
               if(data.status==0)
                   layer.msg(data.msg, {icon: 6});
               else
                   layer.msg(data.msg, {icon: 5});
           });
        }

        //刪除自定義導航提示框
        function delCate(nav_id) {
            //询问框
            layer.confirm('您確定要刪除此自定義導航？', {
                btn: ['確定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/navs/')}}/"+nav_id , {'_method':'delete' , '_token':"{{csrf_token()}}" },function (data) {
                if(data.status == 0){
                    layer.msg(data.msg, {icon: 6});
                    location.href = location.href;
                }
                else{
                    layer.msg(data.msg, {icon: 5});
                }
                });

//                layer.msg('的确很重要', {icon: 1});
            }, function(){
                });
        }
    </script>
@endsection