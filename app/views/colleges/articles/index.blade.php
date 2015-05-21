@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h2>
			院校资讯
		</h2>
		<p class='p-wid'>九子高考志愿匹配网为您提供权威的、全面的职业院校新闻资讯和招生信息。为您对于院校及专业的情况了解进行科学系统的导向。
</p>
			
	</div>
	<div class='col-md-7'>
<table class="table table-striped">
<thead>
<tr>
<th>标题</th>
<th>详情</th>
</tr>
</thead>
<tbody>
@foreach ($articles as $article)
<tr>
<td>{{ $article->title }}</td>
<td><a href="{{ URL::route('colleges.articles.show', $article->id) }}">详情</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop