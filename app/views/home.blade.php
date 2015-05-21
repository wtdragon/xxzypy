@extends('master')
@section('header')
@stop
@section('content')
	<div class="col-md-12 column b1">
						<img class='img1'  src="images/img/t1.png">
						<div class="carousel-caption">
							<h4>
								九子高校匹配
							</h4>
							<p>
								欢迎来到九子高考志愿匹配网 进行志愿匹配测试请先【注册登录】
								<a href="{{URL::to('users')}}">点击进入>>></a>			</p>
						  </div>
		</div>
		</div>
	<div class="row clearfix">
	    <div class="col-md-5ths text-center"> 
				<img src="images/img/colleges.jpg" class='imgcenter'>
			
				<a href="{{URL::to('colleges/articles')}}" class="acenter"><h2>院校资讯</h2></a>
			
			<p class="t1">
				九子高考志愿匹配网为您提供权威的、全面的职业院校新闻资讯和招生信息。为您对于院校及专业的情况了解进行科学系统的导向。	</p>
			
		</div>
		<div class="col-md-5ths text-center"> 
				<img alt="150x150" src="images/img/matches.jpg">
		 
				<a href="{{URL::to('matches')}}" class="acenter"><h2>志愿匹配</h2></a>
		 
			<p class="t1">
				注册登录之后，您可以进行我们给您提供的一套权威的职业测评，为您推荐职业匹配，以便于您进行职业筛选和专业比较，对合适的选择可以收藏并记录。	</p>
		
		</div>
		<div class="col-md-5ths text-center"> 
				<img alt="150x150" src="images/img/colleges_s.jpg">
			<a href="{{URL::to('colleges/search')}}" class="acenter"><h2>
				院校搜索
			</h2></a>
			<p class="t1">
				九子高考志愿匹配网为您提供全面的院校数据搜索功能，以便于您可以根据搜索结果，查询所需要的院校信息。
		</p>
			
		</div>
		<div class="col-md-5ths text-center"> 
			<img alt="150x150" src="images/img/specialties.jpg">
			<a href="{{URL::to('specialties')}}" class="acenter"><h2>
				专业搜索
			</h2></a>
			<p class="t1">
				九子高考志愿匹配网为您提供全面的专业数据库搜索功能，以便于您可以根据搜索结果，查询所需要的专业信息。			</p>
			
		</div>
		<div class="col-md-5ths text-center"> 
			<img alt="150x150" src="images/img/training.jpg" class="acenter">
			<a href="{{URL::to('trainings')}}" class="acenter"><h2>
				培训信息
			</h2></a>
			<p class="t1">
				根据我们给您做出的志愿匹配测评结果，为您提供适合您自身的职业培训课程信息和培训课程推荐。
			</p>
		</div>
 
@stop
@section('bootor')
@stop