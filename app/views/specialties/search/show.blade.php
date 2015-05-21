@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h3 class="acolor">
			专业搜索
		</h3>
		<p class='t1'>九子高考志愿匹配网为您提供全面的专业数据库搜索功能，以便于您可以根据搜索结果，查询所需要的专业信息。</p>
			
	</div>
	<div class='col-md-7 bottom top'>
 <div id="onepage">

<p>专业名称：{{ $zy->zymc}} </p>
<p>专业介绍：</p>
<p> <?php
echo preg_replace("/(。)/", "。</p><p>", $zy->zyjs);
	 ?>
	</p>
</div>
</div>
@stop
@section('bootor')
@stop