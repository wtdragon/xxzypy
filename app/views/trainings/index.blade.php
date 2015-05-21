@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h2>
			培训信息
		</h2>
		<p class='p-wid'>根据我们给您做出的志愿匹配测评结果，为您提供适合您自身的职业培训课程信息和培训课程推荐。</p>
			
	</div>
	<div class='col-md-7'>
    <h3>
			培训信息
		</h3>
     </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop