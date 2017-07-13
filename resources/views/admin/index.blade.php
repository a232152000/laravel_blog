@extends('layouts.admin')
@section('content')

<!--头部 开始-->
<div class="top_box">
	<div class="top_left">
		<div class="logo">後台管理模板</div>
		<ul>
			<li><a href="#" class="active">首頁</a></li>
			<li><a href="#">管理頁</a></li>
		</ul>
	</div>
	<div class="top_right">
		<ul>
			<li>管理员：admin</li>
			<li><a href="{{url('admin/pass')}}" target="main">修改密碼</a></li>
			<li><a href="{{url('admin/quit')}}">退出</a></li>
		</ul>
	</div>
</div>
<!--头部 结束-->

<!--左侧导航 开始-->
<div class="menu_box">
	<ul>
					<li>
						<h3><i class="fa fa-fw fa-clipboard"></i>常用操作</h3>
							<ul class="sub_menu">
								<li><a href="{{url('admin/category/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>添加分頁</a></li>
								<li><a href="{{url('admin/category')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>分頁列表</a></li>

								<li><a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加文章</a></li>
								<li><a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>文章列表</a></li>
							</ul>
					</li>
					<li>
						<h3><i class="fa fa-fw fa-cog"></i>系統設置</h3>
							<ul class="sub_menu">
									<li><a href="#" target="main"><i class="fa fa-fw fa-cubes"></i>網站配置</a></li>
									<li><a href="#" target="main"><i class="fa fa-fw fa-database"></i>備份還原</a></li>
							</ul>
					</li>
					<li>
						<h3><i class="fa fa-fw fa-thumb-tack"></i>工具導航</h3>
							<ul class="sub_menu">
									<li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>圖標調用</a></li>
									<li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery手册</a></li>
									<li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色板</a></li>
									<li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他組件</a></li>
							</ul>
					</li>
			</ul>
</div>
<!--左侧导航 结束-->

<!--主体部分 开始-->
<div class="main_box">
	<iframe src="{{url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
</div>
<!--主体部分 结束-->

<!--底部 开始-->
<div class="bottom_box">
	CopyRight © 2015. Powered By <a href="http://www.houdunwang.com">http://www.houdunwang.com</a>.
</div>

@endsection
