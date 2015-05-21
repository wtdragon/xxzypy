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
			 
		<nav class="navbar navbar-default btn-group1" role="navigation">
		 <ul class="nav navbar-nav">
		 <li><a href="{{URL::to('users')}}" class="headera">志愿匹配</a></li> 
		 <li><a href="{{URL::to('colleges/search')}}" class="headera">院校搜索</a></li>
		 <li><a href="/specialties " class="headera">专业搜索</a></li>
		<li><a class='headera'>培训信息</a></li>
		</ul>
		</nav>
		</div>
	</div>