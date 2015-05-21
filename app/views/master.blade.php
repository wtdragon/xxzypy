<html lang="en">
<head>
  <meta charset="utf-8">
  <title>九子高考志愿匹配网</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="为您提供全面，专业的数据库搜索功能，根据搜索结果查询专业信息">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="images/js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href={{ URL::asset('images/css/bootstrap.min.css') }} rel="stylesheet">
	<link href={{ URL::asset('images/css/style.css') }} rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="images/js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="images/img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="images/img/favicon.png">
  
	<script type="text/javascript" src={{ URL::asset('images/js/jquery.min.js') }}></script>
	<script type="text/javascript" src={{ URL::asset('images/js/bootstrap.min.js') }}></script>
	<script type="text/javascript" src={{ URL::asset('images/js/scripts.js') }}></script>
     @yield('hdsrc')
</head>

<body>
<div class="container">
	<div class="row clearfix header-row">
	<nav class="collapse navbar-collapse bs-navbar-collapse">
	 <ul class="nav navbar-nav navbar-right">
	 <li><a href="{{URL::to('/')}}">首页</a></li> 
				@if(App::make('authenticator')->getLoggedUser())
         <li><a href="{{URL::to('users')}}">会员中心</a></li>  
         <li><a href="{{URL::to('user/logout')}}">登出</a></li> 
@else
         <li><a href="{{URL::to('users')}}">注册登录</a></li>
@endif
	 <li><a href="http://jiuziguoji.smzds.cn/index.html">返回九子国际</a></li> 
	 <li><p class="navbar-text">{{{ date("Y年m月d") }}}</p></li>  
		</ul>
	</nav>
	</div>
	<div class="row clearfix bordor_bgcolor">
		<div class="col-md-4 column c1">
			<img alt="200x30" src={{ URL::asset('images/img/logo.png') }}>
		</div>
		
		<div class="col-md-8 clearfix mp0_right">
		@section('header.nav')	 
		<nav class="navbar navbar-default btn-group1" role="navigation">
		 <ul class="nav navbar-nav">
		 <li><a href="{{URL::to('users')}}" class="headera">志愿匹配</a></li> 
		 <li><a href="{{URL::to('colleges/search')}}" class="headera">院校搜索</a></li>
		 <li><a href="/specialties " class="headera">专业搜索</a></li>
		<li><a class='headera'>培训信息</a></li>
		</ul>
		</nav>
		@show
		</div>
	</div>
	<div class="row clearfix b1">
		
		@yield('content')

	</div>

	<div class="row clearfix b1 fbg">
		<div class="center">
			<p> <strong>北京九子国际文化传播有限公司</strong></p>
			<p class='center'>版权所有</p>
			<p>友情链接 | 加入收藏 | 联系我们</p>
			
		</div>
	</div>
	@yield('bootor')
</div>
</body>
</html>
