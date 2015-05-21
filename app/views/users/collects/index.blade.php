@extends('master')
@section('hdsrc')
<link href={{ URL::asset('images/css/sb-admin-2.css') }} rel="stylesheet">
<link href={{ URL::asset('images/css/timeline.css') }} rel="stylesheet">
<script type="text/javascript" src={{ URL::asset('images/metisMenu/dist/metisMenu.js') }}></script>
<script type="text/javascript" src={{ URL::asset('images/js/sb-admin-2.js') }}></script>

@stop
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<div class="sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
        <li><a href="{{URL::to('users')}}" class="btn btn-default btn1" type="button">我的测评</a></li>
        <li><a href="{{URL::to('users/specialties')}}" class="btn btn-default btn1" type="button">专业列表</a></li>
        <li><a href="{{URL::to('users/matches')}}" class="btn btn-default btn1" type="button">院校列表</a></li>
	       <li>
                <a href="{{URL::to('users/collects')}}" class="btn btn-default btn1" type="button">我的收藏</a>
               <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('users/collects/colleges')}}" >院校收藏</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('users/collects/specialites')}}">专业收藏</a>
                                </li>
                                <li>
                                 <a课程收藏</a>
                                </li>
                                <li>
                                   <a href="{{URL::to('users/collects/others')}}" >其他收藏</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
      </ul>
	</div>
	</div>
	</div>
	<div class='col-md-7'>
		<h2>
			会员中心
		</h2>
		<h2>
			会员名称：
		</h2>
		<p>会员信息：</p>
		
		 
	<ul>
		<li><a href="{{URL::to('users/collects/colleges')}}" >院校收藏</a>收藏您所关注的院校，包括院校的批次科类等信息</li>
        <li><a href="{{URL::to('users/collects/specialites')}}">专业收藏</a>收藏您所关注的专业，以便于您对这些专业 进行对比与匹配</li>
        <li><a href="{{URL::to('users/collects/training')}}" >课程收藏</a>收藏您所喜好的课程，您可以随时通过这些课程进行学习</li>
        <li><a href="{{URL::to('users/collects/others')}}" >其他收藏</a>对于您的测试结果和一些视频信息，可以在此处进行收藏并随时查阅</li>
       
	</ul>
            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop