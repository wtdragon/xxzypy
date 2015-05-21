@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h2>
			志愿匹配
		</h2>
		<p class='p-wid'> test</p>
			
	</div>
	<div class='col-md-7'>
   <a href="{{URL::to('user/logout')}}"><h2>登出</h2></a>
</div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop